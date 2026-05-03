#!/bin/bash

echo "Setup do ambiente de testes"

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"
cd "$PROJECT_ROOT"

if [ ! -f .env ]; then
    echo ".env não encontrado. Rode ./setup.sh primeiro."
    exit 1
fi

echo "Criando .env.testing..."
cp .env.testing.example .env.testing

# Copiar credenciais do banco principal
DB_USERNAME=$(grep DB_USERNAME .env | cut -d '=' -f2)
DB_PASSWORD=$(grep DB_PASSWORD .env | cut -d '=' -f2)

sed -i "s/^DB_USERNAME=.*/DB_USERNAME=root/" .env.testing
sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env.testing

echo "Gerando APP_KEY de teste..."
docker compose exec app php artisan key:generate --env=testing

echo "Criando banco de testes e rodando migrations..."
docker compose exec app php artisan migrate --env=testing

echo "Rodando testes..."
docker compose exec app php artisan test