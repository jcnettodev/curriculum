#!/bin/bash

###############################################################################
# Script de Verificação de Status - Laravel Curriculum
# Descrição: Verifica status de todos os serviços e configurações
###############################################################################

# Cores
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}========================================${NC}"
echo -e "${BLUE}  Status do Sistema - Curriculum       ${NC}"
echo -e "${BLUE}========================================${NC}\n"

# Função para verificar serviço
check_service() {
    if systemctl is-active --quiet "$1"; then
        echo -e "${GREEN}✓${NC} $2: ${GREEN}RODANDO${NC}"
    else
        echo -e "${RED}✗${NC} $2: ${RED}PARADO${NC}"
    fi
}

# Função para verificar comando
check_command() {
    if command -v "$1" &> /dev/null; then
        VERSION=$($2)
        echo -e "${GREEN}✓${NC} $3: ${GREEN}$VERSION${NC}"
    else
        echo -e "${RED}✗${NC} $3: ${RED}NÃO INSTALADO${NC}"
    fi
}

# Verificar Serviços
echo -e "${YELLOW}Serviços:${NC}"
check_service "nginx" "Nginx"
check_service "php8.2-fpm" "PHP-FPM"

# Verificar Comandos/Versões
echo -e "\n${YELLOW}Ferramentas Instaladas:${NC}"
check_command "php" "php -v | head -n 1" "PHP"
check_command "composer" "composer --version 2>&1 | head -n 1" "Composer"
check_command "node" "node -v" "Node.js"
check_command "npm" "npm -v" "npm"

# Verificar Portas
echo -e "\n${YELLOW}Portas:${NC}"
if ss -tuln | grep -q ":80 "; then
    echo -e "${GREEN}✓${NC} Porta 80 (HTTP): ${GREEN}ATIVA${NC}"
else
    echo -e "${RED}✗${NC} Porta 80 (HTTP): ${RED}INATIVA${NC}"
fi

if ss -tuln | grep -q ":443 "; then
    echo -e "${GREEN}✓${NC} Porta 443 (HTTPS): ${GREEN}ATIVA${NC}"
else
    echo -e "${YELLOW}!${NC} Porta 443 (HTTPS): ${YELLOW}INATIVA (SSL não configurado)${NC}"
fi

# Verificar diretório do projeto
PROJECT_DIR="/var/www/curriculum/curriculum-app"
echo -e "\n${YELLOW}Projeto:${NC}"
if [ -d "$PROJECT_DIR" ]; then
    echo -e "${GREEN}✓${NC} Diretório: ${GREEN}$PROJECT_DIR${NC}"
    
    if [ -f "$PROJECT_DIR/.env" ]; then
        echo -e "${GREEN}✓${NC} Arquivo .env: ${GREEN}EXISTE${NC}"
    else
        echo -e "${RED}✗${NC} Arquivo .env: ${RED}NÃO ENCONTRADO${NC}"
    fi
    
    if [ -f "$PROJECT_DIR/database/database.sqlite" ]; then
        echo -e "${GREEN}✓${NC} Banco SQLite: ${GREEN}EXISTE${NC}"
        SIZE=$(du -h "$PROJECT_DIR/database/database.sqlite" | cut -f1)
        echo -e "  Tamanho: $SIZE"
    else
        echo -e "${RED}✗${NC} Banco SQLite: ${RED}NÃO ENCONTRADO${NC}"
    fi
    
    if [ -d "$PROJECT_DIR/vendor" ]; then
        echo -e "${GREEN}✓${NC} Dependências PHP: ${GREEN}INSTALADAS${NC}"
    else
        echo -e "${RED}✗${NC} Dependências PHP: ${RED}NÃO INSTALADAS${NC}"
    fi
    
    if [ -d "$PROJECT_DIR/node_modules" ]; then
        echo -e "${GREEN}✓${NC} Dependências Node: ${GREEN}INSTALADAS${NC}"
    else
        echo -e "${RED}✗${NC} Dependências Node: ${RED}NÃO INSTALADAS${NC}"
    fi
    
    if [ -d "$PROJECT_DIR/public/build" ]; then
        echo -e "${GREEN}✓${NC} Assets compilados: ${GREEN}SIM${NC}"
    else
        echo -e "${RED}✗${NC} Assets compilados: ${RED}NÃO${NC}"
    fi
else
    echo -e "${RED}✗${NC} Diretório do projeto não encontrado: $PROJECT_DIR"
fi

# Verificar configuração Nginx
echo -e "\n${YELLOW}Configuração Nginx:${NC}"
if [ -f "/etc/nginx/sites-enabled/curriculum" ]; then
    echo -e "${GREEN}✓${NC} Configuração: ${GREEN}ATIVA${NC}"
else
    echo -e "${RED}✗${NC} Configuração: ${RED}NÃO ENCONTRADA${NC}"
fi

# Testar configuração Nginx
if nginx -t &> /dev/null; then
    echo -e "${GREEN}✓${NC} Sintaxe Nginx: ${GREEN}OK${NC}"
else
    echo -e "${RED}✗${NC} Sintaxe Nginx: ${RED}ERRO${NC}"
    echo -e "  Execute: ${YELLOW}sudo nginx -t${NC} para detalhes"
fi

# Verificar permissões
echo -e "\n${YELLOW}Permissões:${NC}"
if [ -d "$PROJECT_DIR/storage" ]; then
    STORAGE_PERMS=$(stat -c "%a" "$PROJECT_DIR/storage")
    if [ "$STORAGE_PERMS" = "775" ] || [ "$STORAGE_PERMS" = "777" ]; then
        echo -e "${GREEN}✓${NC} storage/: ${GREEN}$STORAGE_PERMS${NC}"
    else
        echo -e "${YELLOW}!${NC} storage/: ${YELLOW}$STORAGE_PERMS (recomendado: 775)${NC}"
    fi
fi

if [ -d "$PROJECT_DIR/bootstrap/cache" ]; then
    CACHE_PERMS=$(stat -c "%a" "$PROJECT_DIR/bootstrap/cache")
    if [ "$CACHE_PERMS" = "775" ] || [ "$CACHE_PERMS" = "777" ]; then
        echo -e "${GREEN}✓${NC} bootstrap/cache/: ${GREEN}$CACHE_PERMS${NC}"
    else
        echo -e "${YELLOW}!${NC} bootstrap/cache/: ${YELLOW}$CACHE_PERMS (recomendado: 775)${NC}"
    fi
fi

# Verificar uso de recursos
echo -e "\n${YELLOW}Recursos do Sistema:${NC}"
MEM_TOTAL=$(free -h | awk '/^Mem:/ {print $2}')
MEM_USED=$(free -h | awk '/^Mem:/ {print $3}')
MEM_PERCENT=$(free | awk '/^Mem:/ {printf "%.1f", $3/$2 * 100}')
echo -e "Memória: $MEM_USED / $MEM_TOTAL (${MEM_PERCENT}%)"

DISK_USAGE=$(df -h / | awk 'NR==2 {print $5}')
DISK_AVAIL=$(df -h / | awk 'NR==2 {print $4}')
echo -e "Disco: $DISK_USAGE usado, $DISK_AVAIL disponível"

# Verificar logs recentes
echo -e "\n${YELLOW}Logs Recentes (últimas 5 linhas):${NC}"
if [ -f "$PROJECT_DIR/storage/logs/laravel.log" ]; then
    echo -e "${BLUE}Laravel:${NC}"
    tail -5 "$PROJECT_DIR/storage/logs/laravel.log" 2>/dev/null || echo "  (vazio)"
else
    echo -e "${YELLOW}Nenhum log do Laravel encontrado${NC}"
fi

if [ -f "/var/log/nginx/curriculum_error.log" ]; then
    ERROR_COUNT=$(wc -l < /var/log/nginx/curriculum_error.log)
    if [ "$ERROR_COUNT" -gt 0 ]; then
        echo -e "\n${BLUE}Nginx Errors ($ERROR_COUNT total):${NC}"
        tail -3 /var/log/nginx/curriculum_error.log 2>/dev/null
    else
        echo -e "\n${GREEN}Nenhum erro no Nginx${NC}"
    fi
fi

# Certificado SSL
echo -e "\n${YELLOW}Certificado SSL:${NC}"
if [ -d "/etc/letsencrypt/live" ] && [ "$(ls -A /etc/letsencrypt/live)" ]; then
    DOMAINS=$(ls -1 /etc/letsencrypt/live/)
    for DOMAIN in $DOMAINS; do
        if [ -f "/etc/letsencrypt/live/$DOMAIN/cert.pem" ]; then
            EXPIRY=$(openssl x509 -enddate -noout -in "/etc/letsencrypt/live/$DOMAIN/cert.pem" | cut -d= -f2)
            echo -e "${GREEN}✓${NC} $DOMAIN"
            echo -e "  Expira em: $EXPIRY"
        fi
    done
else
    echo -e "${YELLOW}!${NC} Nenhum certificado SSL encontrado"
fi

echo -e "\n${BLUE}========================================${NC}"
echo -e "${BLUE}  Fim da Verificação                    ${NC}"
echo -e "${BLUE}========================================${NC}\n"

# Sugestões
if ! systemctl is-active --quiet nginx || ! systemctl is-active --quiet php8.2-fpm; then
    echo -e "${YELLOW}Sugestão:${NC} Alguns serviços estão parados. Execute:"
    echo -e "  ${BLUE}sudo systemctl start nginx php8.2-fpm${NC}\n"
fi

if [ ! -d "$PROJECT_DIR/vendor" ] || [ ! -d "$PROJECT_DIR/node_modules" ]; then
    echo -e "${YELLOW}Sugestão:${NC} Dependências não instaladas. Execute:"
    echo -e "  ${BLUE}cd $PROJECT_DIR && sudo ./deployment/deploy.sh${NC}\n"
fi

