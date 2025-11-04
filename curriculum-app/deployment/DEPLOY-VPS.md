# Guia de Deploy na VPS Ubuntu

Este guia descreve o processo completo para fazer deploy do projeto Laravel Curriculum em uma VPS Ubuntu.

## Pré-requisitos

- VPS Ubuntu 20.04 ou superior
- Acesso root (sudo)
- Domínio apontando para o IP da VPS (opcional, mas recomendado para SSL)
- Git instalado

---

## Passo 1: Instalação Inicial (Apenas na Primeira Vez)

### 1.1. Conectar na VPS

```bash
ssh seu-usuario@ip-da-vps
```

### 1.2. Clonar o Repositório

```bash
# Criar diretório para o projeto
sudo mkdir -p /var/www
cd /var/www

# Clonar repositório
sudo git clone https://github.com/seu-usuario/seu-repo.git curriculum
cd curriculum/curriculum-app
```

### 1.3. Executar Script de Instalação

```bash
# Dar permissão de execução
sudo chmod +x deployment/install-vps.sh

# Executar instalação
sudo ./deployment/install-vps.sh
```

Este script irá instalar:
- PHP 8.2 + extensões
- Nginx
- Composer
- Node.js 20.x + npm
- Certbot (para SSL)
- Outras dependências

**Tempo estimado:** 5-10 minutos

---

## Passo 2: Configuração do Projeto

### 2.1. Configurar Arquivo .env

```bash
cd /var/www/curriculum/curriculum-app

# Copiar o arquivo de exemplo
sudo cp .env.example .env

# Editar configurações
sudo nano .env
```

**Configurações mínimas necessárias:**

```env
APP_NAME=Curriculum
APP_ENV=production
APP_KEY=    # Será gerado automaticamente
APP_DEBUG=false
APP_URL=https://seu-dominio.com

DB_CONNECTION=sqlite

SESSION_DRIVER=file
CACHE_STORE=file
```

### 2.2. Configurar Nginx

```bash
# Editar arquivo de configuração
sudo nano deployment/nginx-curriculum.conf
```

**Altere as seguintes linhas:**

```nginx
server_name seu-dominio.com www.seu-dominio.com;
root /var/www/curriculum/curriculum-app/public;
```

**Copiar configuração para o Nginx:**

```bash
sudo cp deployment/nginx-curriculum.conf /etc/nginx/sites-available/curriculum
sudo ln -s /etc/nginx/sites-available/curriculum /etc/nginx/sites-enabled/
```

**Remover configuração padrão:**

```bash
sudo rm /etc/nginx/sites-enabled/default
```

**Testar e reiniciar Nginx:**

```bash
sudo nginx -t
sudo systemctl restart nginx
```

---

## Passo 3: Deploy Inicial

### 3.1. Executar Script de Deploy

```bash
cd /var/www/curriculum/curriculum-app

# Dar permissão de execução
sudo chmod +x deployment/deploy.sh

# Editar configurações do deploy (se necessário)
sudo nano deployment/deploy.sh
# Altere: PROJECT_DIR e DOMAIN

# Executar deploy
sudo ./deployment/deploy.sh
```

Este script irá:
1. Atualizar código do repositório
2. Instalar dependências PHP (Composer)
3. Instalar dependências Node.js
4. Compilar assets (CSS/JS)
5. Otimizar configurações Laravel
6. Gerar APP_KEY
7. Criar banco SQLite
8. Ajustar permissões
9. Reiniciar serviços

**Tempo estimado:** 3-5 minutos

### 3.2. Verificar se Está Funcionando

Acesse: `http://ip-da-vps` ou `http://seu-dominio.com`

Você deve ver a página do currículo!

---

## Passo 4: Configurar SSL (HTTPS)

### 4.1. Verificar DNS

Certifique-se de que seu domínio está apontando para o IP da VPS:

```bash
# Verificar DNS
dig seu-dominio.com +short
# Deve retornar o IP da sua VPS
```

### 4.2. Executar Script de SSL

```bash
cd /var/www/curriculum/curriculum-app

# Dar permissão de execução
sudo chmod +x deployment/setup-ssl.sh

# Executar configuração SSL
sudo ./deployment/setup-ssl.sh
```

O script irá solicitar:
- Seu domínio (ex: curriculum.seusite.com)
- Seu email (para notificações do Let's Encrypt)

**Tempo estimado:** 2-3 minutos

### 4.3. Testar HTTPS

Acesse: `https://seu-dominio.com`

Deve aparecer o cadeado verde de segurança!

---

## Atualizações Futuras (Deploy Contínuo)

Sempre que você fizer alterações no código e fizer push para o repositório:

```bash
# Conectar na VPS
ssh seu-usuario@ip-da-vps

# Ir para o diretório do projeto
cd /var/www/curriculum/curriculum-app

# Executar deploy (atualiza automaticamente)
sudo ./deployment/deploy.sh
```

**Simples assim!** O script irá:
- Baixar últimas alterações do Git
- Reinstalar dependências
- Recompilar assets
- Reiniciar serviços

---

## Comandos Úteis

### Ver Logs do Laravel

```bash
tail -f /var/www/curriculum/curriculum-app/storage/logs/laravel.log
```

### Ver Logs do Nginx

```bash
# Erros
tail -f /var/log/nginx/curriculum_error.log

# Acessos
tail -f /var/log/nginx/curriculum_access.log
```

### Verificar Status dos Serviços

```bash
# PHP-FPM
sudo systemctl status php8.2-fpm

# Nginx
sudo systemctl status nginx
```

### Reiniciar Serviços Manualmente

```bash
sudo systemctl restart php8.2-fpm
sudo systemctl restart nginx
```

### Limpar Cache do Laravel

```bash
cd /var/www/curriculum/curriculum-app

sudo php artisan cache:clear
sudo php artisan config:clear
sudo php artisan route:clear
sudo php artisan view:clear
```

### Renovar Certificado SSL Manualmente

```bash
sudo certbot renew
```

---

## Solução de Problemas

### Erro 502 Bad Gateway

**Causa:** PHP-FPM não está rodando

**Solução:**
```bash
sudo systemctl start php8.2-fpm
sudo systemctl status php8.2-fpm
```

### Erro 403 Forbidden

**Causa:** Permissões incorretas

**Solução:**
```bash
cd /var/www/curriculum/curriculum-app
sudo chown -R www-data:www-data .
sudo chmod -R 755 .
sudo chmod -R 775 storage bootstrap/cache
```

### Página em Branco

**Causa:** Erro no código ou configuração

**Solução:**
```bash
# Ver logs
tail -50 /var/www/curriculum/curriculum-app/storage/logs/laravel.log

# Ativar modo debug temporariamente
sudo nano /var/www/curriculum/curriculum-app/.env
# Alterar: APP_DEBUG=true
```

### Assets CSS/JS Não Carregam

**Causa:** Assets não compilados ou permissões

**Solução:**
```bash
cd /var/www/curriculum/curriculum-app
sudo npm run build
sudo chown -R www-data:www-data public/build
```

### Renovação SSL Falhou

**Causa:** Domínio não está acessível ou Nginx bloqueando

**Solução:**
```bash
# Testar se domínio está acessível
curl -I http://seu-dominio.com

# Verificar configuração Nginx
sudo nginx -t

# Tentar renovar manualmente
sudo certbot renew --dry-run
```

---

## Estrutura de Arquivos na VPS

```
/var/www/curriculum/
└── curriculum-app/
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    │   └── database.sqlite       # Banco de dados SQLite
    ├── deployment/                # Scripts de deploy
    │   ├── install-vps.sh
    │   ├── deploy.sh
    │   ├── setup-ssl.sh
    │   ├── nginx-curriculum.conf
    │   └── DEPLOY-VPS.md
    ├── public/                    # Raiz do Nginx
    │   ├── index.php
    │   └── build/                 # Assets compilados
    ├── resources/
    ├── routes/
    ├── storage/
    │   └── logs/
    │       └── laravel.log
    ├── .env                       # Configurações (NÃO versionar!)
    └── composer.json
```

---

## Checklist de Deploy

- [ ] VPS Ubuntu instalada e acessível via SSH
- [ ] Domínio apontando para IP da VPS (para SSL)
- [ ] Executado `install-vps.sh` (apenas primeira vez)
- [ ] Repositório clonado em `/var/www/curriculum`
- [ ] Arquivo `.env` configurado
- [ ] Configuração Nginx ajustada e ativa
- [ ] Executado `deploy.sh` com sucesso
- [ ] Site acessível via HTTP
- [ ] Executado `setup-ssl.sh` (para HTTPS)
- [ ] Site acessível via HTTPS com cadeado verde

---

## Recursos Necessários (VPS Mínima)

Para este projeto simples:

- **CPU:** 1 vCPU
- **RAM:** 1 GB (mínimo) / 2 GB (recomendado)
- **Disco:** 20 GB
- **Banda:** Ilimitado ou 1 TB/mês

**Provedores recomendados:**
- DigitalOcean ($6/mês)
- Linode ($5/mês)
- Vultr ($5/mês)
- Hetzner (€4.5/mês - mais barato)

---

## Segurança Adicional

### Configurar Firewall

```bash
# Ativar UFW
sudo ufw enable

# Permitir SSH
sudo ufw allow 22/tcp

# Permitir HTTP e HTTPS
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# Verificar status
sudo ufw status
```

### Desabilitar Login Root via SSH

```bash
sudo nano /etc/ssh/sshd_config

# Alterar:
PermitRootLogin no

# Reiniciar SSH
sudo systemctl restart sshd
```

### Criar Usuário para Deploy

```bash
# Criar usuário
sudo adduser deploy

# Adicionar ao grupo sudo
sudo usermod -aG sudo deploy

# Adicionar ao grupo www-data
sudo usermod -aG www-data deploy

# Trocar proprietário do projeto
sudo chown -R deploy:www-data /var/www/curriculum
```

---

## Monitoramento

### Instalar Ferramenta de Monitoramento Simples

```bash
# Instalar htop
sudo apt install htop

# Usar
htop
```

### Monitorar Uso de Disco

```bash
df -h
```

### Monitorar Logs em Tempo Real

```bash
# Laravel
tail -f /var/www/curriculum/curriculum-app/storage/logs/laravel.log

# Nginx
tail -f /var/log/nginx/curriculum_error.log
```

---

## Suporte

Se encontrar problemas:

1. Verifique os logs (Laravel e Nginx)
2. Verifique se os serviços estão rodando
3. Verifique permissões de arquivos
4. Verifique configuração do `.env`
5. Teste a configuração do Nginx: `sudo nginx -t`

---

**Pronto!** Seu projeto Laravel está no ar de forma profissional, sem Docker, otimizado e seguro.

