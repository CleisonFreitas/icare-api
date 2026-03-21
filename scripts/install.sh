#!/usr/bin/env bash

set -e

# Função para aguardar MySQL
wait_for_mysql() {
  echo "⏳ Aguardando MySQL..."
  until docker compose exec -T mysql mysql -u root -p$DB_PASSWORD -e "SELECT 1" > /dev/null 2>&1; do
    sleep 1
  done
  echo "✅ MySQL pronto!"
}   

# Função para aguardar Redis
wait_for_redis() {
  echo "⏳ Aguardando Redis..."
  until docker compose exec -T redis redis-cli ping | grep -q PONG; do
    sleep 1
  done
  echo "✅ Redis pronto!"
}

# Ir para a raiz do projeto
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"
cd "$PROJECT_ROOT"

HOST_UID=$(id -u)
HOST_GID=$(id -g)
export HOST_UID
export HOST_GID

echo "🚀 Preparando ambiente do projeto..."

############################################
# Criar .env
############################################

if [ ! -f ".env" ]; then
    echo "📄 Criando .env a partir do .env.example"
    cp .env.example .env

    DB_USERNAME=user$(openssl rand -hex 2)
    DB_PASSWORD=$(openssl rand -hex 12)

    MINIO_USER=minio$(openssl rand -hex 2)
    MINIO_PASSWORD=$(openssl rand -hex 12)

    sed -i "s/^DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" .env
    sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" .env

    sed -i "s/^MINIO_ROOT_USER=.*/MINIO_ROOT_USER=${MINIO_USER}/" .env
    sed -i "s/^MINIO_ROOT_PASSWORD=.*/MINIO_ROOT_PASSWORD=${MINIO_PASSWORD}/" .env
fi


############################################
# Subir containers
############################################

echo "🐳 Subindo containers..."

docker compose build --no-cache && docker compose up -d

echo "⏳ Aguardando containers..."
wait_for_mysql
wait_for_redis

echo "📦 Instalando dependências..."

docker compose exec app composer install

############################################
# Gerar chave da aplicação
############################################

echo "🔑 Gerando APP_KEY..."

docker compose exec app php artisan key:generate

############################################
# Rodar migrations
############################################

echo "🗄 Rodando migrations..."

docker compose exec app php artisan migrate --force

############################################
# Rodar seeders
############################################

echo "🌱 Rodando seeders..."

docker compose exec app php artisan db:seed --force

############################################
# Criar link simbólico para storage
############################################

echo "🔗 Criando link simbólico para storage..."

docker compose exec app php artisan storage:link

if command -v npm > /dev/null 2>&1; then
  echo "📦 Instalando dependências do frontend..."
  npm install
  echo "🏗 Construindo assets..."
  npm run build
fi

############################################
# Gerar Swagger
############################################

echo "📚 Gerando documentação Swagger..."

docker compose exec app php artisan l5-swagger:generate


echo ""
echo "✅ Projeto pronto para uso!"
echo ""
echo "Aplicação:"
echo "http://localhost:8081"
echo ""
echo "Swagger:"
echo "http://localhost:8081/api/documentation"