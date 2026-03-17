#!/usr/bin/env bash

set -e

# Ir para a raiz do projeto
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"
cd "$PROJECT_ROOT"

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

docker compose up -d --build

echo "⏳ Aguardando containers..."
sleep 5

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