#!/bin/bash

###############################################################################
# Script de Instalação para VPS Ubuntu - Laravel Curriculum
# Autor: Gerado automaticamente
# Descrição: Instala todas as dependências necessárias para rodar o projeto
###############################################################################

set -e  # Parar em caso de erro

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  Instalação VPS - Laravel Curriculum  ${NC}"
echo -e "${GREEN}========================================${NC}\n"

# Verificar se está rodando como root
if [ "$EUID" -ne 0 ]; then 
    echo -e "${RED}Por favor, execute como root (sudo)${NC}"
    exit 1
fi

echo -e "${YELLOW}[1/8] Atualizando sistema...${NC}"
apt update && apt upgrade -y

echo -e "\n${YELLOW}[2/8] Instalando PHP 8.2 e extensões...${NC}"
apt install -y software-properties-common
add-apt-repository ppa:ondrej/php -y
apt update
apt install -y \
    php8.2 \
    php8.2-fpm \
    php8.2-cli \
    php8.2-common \
    php8.2-mbstring \
    php8.2-xml \
    php8.2-curl \
    php8.2-sqlite3 \
    php8.2-zip \
    php8.2-gd \
    php8.2-bcmath

echo -e "\n${YELLOW}[3/8] Instalando Nginx...${NC}"
apt install -y nginx

echo -e "\n${YELLOW}[4/8] Instalando Composer...${NC}"
if [ ! -f /usr/local/bin/composer ]; then
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
    chmod +x /usr/local/bin/composer
else
    echo "Composer já instalado"
fi

echo -e "\n${YELLOW}[5/8] Instalando Node.js 20.x e npm...${NC}"
if ! command -v node &> /dev/null; then
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
    apt install -y nodejs
else
    echo "Node.js já instalado"
fi

echo -e "\n${YELLOW}[6/8] Instalando Certbot (SSL)...${NC}"
apt install -y certbot python3-certbot-nginx

echo -e "\n${YELLOW}[7/8] Instalando utilitários...${NC}"
apt install -y git curl wget unzip

echo -e "\n${YELLOW}[8/8] Configurando permissões do PHP-FPM...${NC}"
# Configurar PHP-FPM para rodar com o usuário correto
sed -i 's/^user = www-data/user = www-data/' /etc/php/8.2/fpm/pool.d/www.conf
sed -i 's/^group = www-data/group = www-data/' /etc/php/8.2/fpm/pool.d/www.conf

# Reiniciar PHP-FPM
systemctl restart php8.2-fpm

echo -e "\n${GREEN}========================================${NC}"
echo -e "${GREEN}  ✓ Instalação Concluída!              ${NC}"
echo -e "${GREEN}========================================${NC}\n"

echo -e "Versões instaladas:"
echo -e "  PHP: $(php -v | head -n 1)"
echo -e "  Composer: $(composer --version)"
echo -e "  Node.js: $(node -v)"
echo -e "  npm: $(npm -v)"
echo -e "  Nginx: $(nginx -v 2>&1)"

echo -e "\n${YELLOW}Próximos passos:${NC}"
echo -e "1. Clone seu repositório na VPS"
echo -e "2. Configure o arquivo .env"
echo -e "3. Execute o script deploy.sh"
echo -e "4. Configure o SSL com setup-ssl.sh"

