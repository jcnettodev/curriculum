#!/bin/bash

###############################################################################
# Script de Configuração SSL - Let's Encrypt
# Descrição: Configura certificado SSL gratuito para o domínio
###############################################################################

set -e

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  Configuração SSL - Let's Encrypt     ${NC}"
echo -e "${GREEN}========================================${NC}\n"

# Verificar se está rodando como root
if [ "$EUID" -ne 0 ]; then 
    echo -e "${RED}Por favor, execute como root (sudo)${NC}"
    exit 1
fi

# Solicitar domínio
read -p "Digite seu domínio (ex: curriculum.seusite.com): " DOMAIN

if [ -z "$DOMAIN" ]; then
    echo -e "${RED}Erro: Domínio não pode estar vazio${NC}"
    exit 1
fi

# Solicitar email
read -p "Digite seu email para notificações do Let's Encrypt: " EMAIL

if [ -z "$EMAIL" ]; then
    echo -e "${RED}Erro: Email não pode estar vazio${NC}"
    exit 1
fi

echo -e "\n${YELLOW}Configurando SSL para: $DOMAIN${NC}"
echo -e "${YELLOW}Email: $EMAIL${NC}\n"

# Verificar se o Nginx está rodando
if ! systemctl is-active --quiet nginx; then
    echo -e "${RED}Erro: Nginx não está rodando${NC}"
    exit 1
fi

# Obter certificado SSL
echo -e "${YELLOW}Obtendo certificado SSL...${NC}"
certbot --nginx -d "$DOMAIN" --non-interactive --agree-tos --email "$EMAIL" --redirect

# Testar renovação automática
echo -e "\n${YELLOW}Testando renovação automática...${NC}"
certbot renew --dry-run

echo -e "\n${GREEN}========================================${NC}"
echo -e "${GREEN}  ✓ SSL Configurado com Sucesso!        ${NC}"
echo -e "${GREEN}========================================${NC}\n"

echo -e "Seu site agora está disponível em:"
echo -e "${GREEN}https://$DOMAIN${NC}"
echo -e "\nO certificado será renovado automaticamente."
echo -e "Para forçar renovação: ${YELLOW}sudo certbot renew${NC}"

