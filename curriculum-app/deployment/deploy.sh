#!/bin/bash

###############################################################################
# Script de Deploy - Laravel Curriculum
# Descrição: Deploy e atualização automática do projeto
###############################################################################

set -e  # Parar em caso de erro

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configurações - EDITE AQUI
PROJECT_DIR="/var/www/curriculum"
PROJECT_NAME="curriculum"
DOMAIN="seu-dominio.com"  # Altere para seu domínio

echo -e "${BLUE}========================================${NC}"
echo -e "${BLUE}  Deploy - Laravel Curriculum          ${NC}"
echo -e "${BLUE}========================================${NC}\n"

# Verificar se o diretório do projeto existe
if [ ! -d "$PROJECT_DIR" ]; then
    echo -e "${RED}Erro: Diretório do projeto não encontrado: $PROJECT_DIR${NC}"
    echo -e "${YELLOW}Execute primeiro: git clone seu-repo $PROJECT_DIR${NC}"
    exit 1
fi

cd "$PROJECT_DIR"

echo -e "${YELLOW}[1/10] Atualizando código do repositório...${NC}"
git pull origin main || git pull origin master

echo -e "\n${YELLOW}[2/10] Instalando dependências PHP...${NC}"
composer install --no-dev --optimize-autoloader

echo -e "\n${YELLOW}[3/10] Instalando dependências Node.js...${NC}"
npm ci --production

echo -e "\n${YELLOW}[4/10] Compilando assets (CSS/JS)...${NC}"
npm run build

echo -e "\n${YELLOW}[5/10] Otimizando configurações Laravel...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo -e "\n${YELLOW}[6/10] Verificando arquivo .env...${NC}"
if [ ! -f .env ]; then
    echo -e "${RED}Arquivo .env não encontrado!${NC}"
    echo -e "${YELLOW}Copiando .env.example...${NC}"
    cp .env.example .env
    echo -e "${YELLOW}IMPORTANTE: Configure o arquivo .env antes de continuar!${NC}"
    exit 1
fi

echo -e "\n${YELLOW}[7/10] Gerando APP_KEY (se necessário)...${NC}"
if ! grep -q "APP_KEY=base64:" .env; then
    php artisan key:generate
fi

echo -e "\n${YELLOW}[8/10] Criando banco de dados SQLite (se não existir)...${NC}"
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
    php artisan migrate --force
fi

echo -e "\n${YELLOW}[9/10] Ajustando permissões...${NC}"
chown -R www-data:www-data "$PROJECT_DIR"
chmod -R 755 "$PROJECT_DIR"
chmod -R 775 "$PROJECT_DIR/storage"
chmod -R 775 "$PROJECT_DIR/bootstrap/cache"

echo -e "\n${YELLOW}[10/10] Reiniciando serviços...${NC}"
systemctl restart php8.2-fpm
systemctl reload nginx

echo -e "\n${GREEN}========================================${NC}"
echo -e "${GREEN}  ✓ Deploy Concluído com Sucesso!      ${NC}"
echo -e "${GREEN}========================================${NC}\n"

echo -e "Acesse: http://$DOMAIN"
echo -e "\n${YELLOW}Dica:${NC} Para ver logs: tail -f storage/logs/laravel.log"

