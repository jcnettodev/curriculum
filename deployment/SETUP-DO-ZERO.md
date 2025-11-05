# Setup Completo do Zero - VPS Formatada

Este guia é para quando você acabou de formatar a VPS Ubuntu e vai configurar tudo do zero.

---

## 📊 Informações do Projeto

- **Domínio:** cv.euonline.site
- **IP VPS:** 84.32.84.32
- **Repositório:** https://github.com/jcnettodev/curriculum.git
- **SO:** Ubuntu 20.04 ou superior

---

## ⏱️ Tempo Total Estimado: 20-30 minutos

---

## 🚀 Passo a Passo Completo

### Passo 1: Conectar na VPS Formatada

```bash
ssh root@84.32.84.32
# OU
ssh seu-usuario@84.32.84.32
```

---

### Passo 2: Criar Usuário (se estiver como root)

**⚠️ Recomendado:** Não usar root direto

```bash
# Criar usuário
adduser deploy
# (Escolha uma senha forte)

# Adicionar ao sudo
usermod -aG sudo deploy

# Trocar para o novo usuário
su - deploy
```

---

### Passo 3: Configurar Firewall Básico

```bash
# Ativar UFW
sudo ufw enable

# Permitir SSH (IMPORTANTE!)
sudo ufw allow 22/tcp

# Permitir HTTP e HTTPS
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# Verificar
sudo ufw status
```

---

### Passo 4: Clonar o Repositório

```bash
# Criar diretório
sudo mkdir -p /var/www
cd /var/www

# Clonar
sudo git clone https://github.com/jcnettodev/curriculum.git

# Entrar no projeto
cd curriculum
```

---

### Passo 5: Executar Script de Instalação

```bash
# Dar permissão
sudo chmod +x deployment/install-vps.sh

# Executar (instala PHP, Nginx, Composer, Node.js, etc)
sudo ./deployment/install-vps.sh
```

**⏱️ Aguarde 5-10 minutos** - O script instalará tudo automaticamente.

---

### Passo 6: Configurar .env

```bash
# Copiar exemplo
sudo cp .env.example .env

# Editar
sudo nano .env
```

**Cole este conteúdo:**

```env
APP_NAME=Curriculum
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://cv.euonline.site

APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=pt_BR
APP_FAKER_LOCALE=pt_BR

DB_CONNECTION=sqlite
DB_DATABASE=

SESSION_DRIVER=file
SESSION_LIFETIME=120

CACHE_STORE=file
QUEUE_CONNECTION=sync

LOG_CHANNEL=daily
LOG_LEVEL=error
```

**Salvar:** `Ctrl+O`, `Enter`, `Ctrl+X`

---

### Passo 7: Configurar Nginx

```bash
# Editar configuração
sudo nano deployment/nginx-curriculum.conf
```

**Encontre e altere estas linhas:**

```nginx
server_name cv.euonline.site www.cv.euonline.site;
root /var/www/curriculum/curriculum-app/public;
```

**Salvar:** `Ctrl+O`, `Enter`, `Ctrl+X`

**Ativar configuração:**

```bash
# Copiar para sites-available
sudo cp deployment/nginx-curriculum.conf /etc/nginx/sites-available/curriculum

# Criar link simbólico
sudo ln -s /etc/nginx/sites-available/curriculum /etc/nginx/sites-enabled/

# Remover site padrão
sudo rm /etc/nginx/sites-enabled/default

# Testar configuração
sudo nginx -t

# Se OK, reiniciar
sudo systemctl restart nginx
```

---

### Passo 8: Fazer Deploy Inicial

```bash
# Dar permissão aos scripts
sudo chmod +x deployment/*.sh

# Executar deploy
sudo ./deployment/deploy.sh
```

**⏱️ Aguarde 3-5 minutos**

O script irá:
- ✅ Instalar dependências PHP (Composer)
- ✅ Instalar dependências Node.js
- ✅ Compilar assets (CSS/JS)
- ✅ Gerar APP_KEY
- ✅ Criar banco SQLite
- ✅ Ajustar permissões
- ✅ Reiniciar serviços

---

### Passo 9: Testar HTTP

Abra no navegador: **http://cv.euonline.site**

Se aparecer o site, está funcionando! 🎉

Se não aparecer:
```bash
# Ver logs
sudo tail -50 /var/log/nginx/curriculum_error.log
sudo tail -50 /var/www/curriculum/curriculum-app/storage/logs/laravel.log
```

---

### Passo 10: Configurar SSL/HTTPS

```bash
# Executar script SSL
sudo ./deployment/setup-ssl.sh
```

**Digite quando solicitado:**
- **Domínio:** `cv.euonline.site`
- **Email:** `seu-email@exemplo.com`

**⏱️ Aguarde 2-3 minutos**

---

### Passo 11: PRONTO! 🎉

Acesse: **https://cv.euonline.site**

Deve aparecer:
- ✅ Seu currículo
- ✅ Cadeado verde (HTTPS)
- ✅ Tudo funcionando perfeitamente!

---

## ✅ Checklist Final

Verifique se tudo está OK:

```bash
# Verificar status completo
sudo ./deployment/check-status.sh
```

Deve mostrar:
- ✅ Nginx: RODANDO
- ✅ PHP-FPM: RODANDO
- ✅ Porta 80: ATIVA
- ✅ Porta 443: ATIVA
- ✅ Projeto: EXISTE
- ✅ .env: EXISTE
- ✅ Banco SQLite: EXISTE
- ✅ Dependências: INSTALADAS
- ✅ Assets: COMPILADOS
- ✅ Certificado SSL: ATIVO

---

## 📝 Comandos Resumidos (Cola)

Se você quiser copiar e colar tudo de uma vez:

```bash
# 1. Configurar firewall
sudo ufw enable
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# 2. Clonar repositório
sudo mkdir -p /var/www && cd /var/www
sudo git clone https://github.com/jcnettodev/curriculum.git
cd curriculum/curriculum-app

# 3. Instalar dependências do sistema
sudo chmod +x deployment/install-vps.sh
sudo ./deployment/install-vps.sh

# 4. Configurar .env (copie o conteúdo do envy.ttxr)
sudo cp .env.example .env
sudo nano .env

# 5. Configurar Nginx (edite server_name e root)
sudo nano deployment/nginx-curriculum.conf
sudo cp deployment/nginx-curriculum.conf /etc/nginx/sites-available/curriculum
sudo ln -s /etc/nginx/sites-available/curriculum /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl restart nginx

# 6. Deploy
sudo chmod +x deployment/*.sh
sudo ./deployment/deploy.sh

# 7. SSL
sudo ./deployment/setup-ssl.sh

# 8. Verificar
sudo ./deployment/check-status.sh
```

---

## 🆘 Problemas Comuns

### DNS ainda não propagou

**Sintoma:** `ping cv.euonline.site` não retorna 84.32.84.32

**Solução:** Aguarde 15-30 minutos após configurar o DNS

---

### Erro "APP_KEY is missing"

**Solução:**
```bash
cd /var/www/curriculum
sudo php artisan key:generate
```

---

### Erro 502 Bad Gateway

**Solução:**
```bash
sudo systemctl restart php8.2-fpm
sudo systemctl status php8.2-fpm
```

---

### Erro 403 Forbidden

**Solução:**
```bash
cd /var/www/curriculum
sudo chown -R www-data:www-data .
sudo chmod -R 755 .
sudo chmod -R 775 storage bootstrap/cache
```

---

### Assets CSS/JS não carregam

**Solução:**
```bash
cd /var/www/curriculum
sudo npm run build
sudo chown -R www-data:www-data public/build
sudo systemctl reload nginx
```

---

## 🔐 Segurança Adicional (Recomendado)

Depois de tudo funcionando:

### Desabilitar login root via SSH

```bash
sudo nano /etc/ssh/sshd_config
```

Altere:
```
PermitRootLogin no
PasswordAuthentication no  # Se usar chave SSH
```

Reinicie SSH:
```bash
sudo systemctl restart sshd
```

### Configurar Fail2Ban (opcional)

```bash
sudo apt install fail2ban -y
sudo systemctl enable fail2ban
sudo systemctl start fail2ban
```

---

## 🔄 Atualizações Futuras

Quando fizer alterações no código:

```bash
# No seu PC
git add .
git commit -m "descrição"
git push origin main

# Na VPS
ssh seu-usuario@84.32.84.32
cd /var/www/curriculum
sudo git pull origin main
sudo ./deployment/deploy.sh
```

---

## 📊 Recursos da VPS

Monitore o uso:

```bash
# Uso de recursos
htop

# Uso de disco
df -h

# Uso de memória
free -h

# Ver processos Nginx
ps aux | grep nginx

# Ver processos PHP-FPM
ps aux | grep php-fpm
```

---

## 📞 Suporte

Se tiver problemas:

1. **Ver logs:**
   ```bash
   # Laravel
   sudo tail -50 /var/www/curriculum/curriculum-app/storage/logs/laravel.log
   
   # Nginx
   sudo tail -50 /var/log/nginx/curriculum_error.log
   ```

2. **Verificar status:**
   ```bash
   sudo ./deployment/check-status.sh
   ```

3. **Testar configuração:**
   ```bash
   sudo nginx -t
   sudo php artisan about
   ```

---

## ✅ Pronto!

Com a VPS formatada e seguindo este guia, seu currículo estará no ar em **20-30 minutos**, limpo, sem conflitos e funcionando perfeitamente!

**URL final:** https://cv.euonline.site 🎉

---

**Boa sorte com o setup! Está tudo documentado e pronto para funcionar!** 🚀

