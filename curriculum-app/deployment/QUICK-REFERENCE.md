# Guia Rápido de Referência - Deploy VPS

Comandos mais usados para gerenciar o projeto na VPS.

## Deploy e Atualização

```bash
# Atualizar projeto (após fazer push no Git)
cd /var/www/curriculum/curriculum-app
sudo ./deployment/deploy.sh
```

## Verificar Status

```bash
# Verificar status completo do sistema
sudo ./deployment/check-status.sh

# Verificar serviços individuais
sudo systemctl status nginx
sudo systemctl status php8.2-fpm
```

## Ver Logs

```bash
# Laravel (erros da aplicação)
tail -f /var/www/curriculum/curriculum-app/storage/logs/laravel.log

# Nginx - Erros
tail -f /var/log/nginx/curriculum_error.log

# Nginx - Acessos
tail -f /var/log/nginx/curriculum_access.log

# PHP-FPM
tail -f /var/log/php8.2-fpm.log
```

## Reiniciar Serviços

```bash
# Reiniciar tudo
sudo systemctl restart nginx php8.2-fpm

# Reiniciar apenas Nginx
sudo systemctl restart nginx

# Reiniciar apenas PHP-FPM
sudo systemctl restart php8.2-fpm

# Recarregar Nginx (sem parar)
sudo systemctl reload nginx
```

## Limpar Cache

```bash
cd /var/www/curriculum/curriculum-app

# Limpar todo o cache
sudo php artisan cache:clear
sudo php artisan config:clear
sudo php artisan route:clear
sudo php artisan view:clear

# Recriar cache otimizado
sudo php artisan config:cache
sudo php artisan route:cache
sudo php artisan view:cache
```

## Recompilar Assets

```bash
cd /var/www/curriculum/curriculum-app

# Compilar para produção
sudo npm run build

# Modo desenvolvimento (com watch)
sudo npm run dev
```

## Permissões

```bash
cd /var/www/curriculum/curriculum-app

# Corrigir permissões
sudo chown -R www-data:www-data .
sudo chmod -R 755 .
sudo chmod -R 775 storage bootstrap/cache
```

## Banco de Dados

```bash
cd /var/www/curriculum/curriculum-app

# Criar banco SQLite
sudo touch database/database.sqlite
sudo chown www-data:www-data database/database.sqlite

# Executar migrations
sudo php artisan migrate

# Resetar banco (CUIDADO!)
sudo php artisan migrate:fresh
```

## SSL / HTTPS

```bash
# Configurar SSL (primeira vez)
sudo ./deployment/setup-ssl.sh

# Renovar certificado manualmente
sudo certbot renew

# Testar renovação
sudo certbot renew --dry-run

# Ver certificados instalados
sudo certbot certificates
```

## Nginx

```bash
# Testar configuração
sudo nginx -t

# Ver sites ativos
ls -la /etc/nginx/sites-enabled/

# Editar configuração
sudo nano /etc/nginx/sites-available/curriculum

# Ativar site
sudo ln -s /etc/nginx/sites-available/curriculum /etc/nginx/sites-enabled/

# Desativar site
sudo rm /etc/nginx/sites-enabled/curriculum
```

## Monitoramento

```bash
# Uso de recursos em tempo real
htop

# Uso de disco
df -h

# Uso de memória
free -h

# Processos do Nginx
ps aux | grep nginx

# Processos do PHP-FPM
ps aux | grep php-fpm

# Conexões ativas
ss -tuln
```

## Git

```bash
cd /var/www/curriculum/curriculum-app

# Ver status
git status

# Ver últimos commits
git log --oneline -10

# Atualizar código
git pull origin main

# Ver diferenças
git diff

# Descartar alterações locais
git reset --hard HEAD
git clean -fd
```

## Firewall (UFW)

```bash
# Ver status
sudo ufw status

# Permitir porta
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# Bloquear porta
sudo ufw deny 8080/tcp

# Ativar/Desativar
sudo ufw enable
sudo ufw disable
```

## Backup

```bash
# Backup do banco de dados
sudo cp /var/www/curriculum/curriculum-app/database/database.sqlite ~/backup-$(date +%Y%m%d).sqlite

# Backup do .env
sudo cp /var/www/curriculum/curriculum-app/.env ~/backup-env-$(date +%Y%m%d)

# Backup completo do projeto
sudo tar -czf ~/backup-curriculum-$(date +%Y%m%d).tar.gz /var/www/curriculum/
```

## Solução Rápida de Problemas

### Erro 502 Bad Gateway
```bash
sudo systemctl restart php8.2-fpm
```

### Erro 403 Forbidden
```bash
cd /var/www/curriculum/curriculum-app
sudo chown -R www-data:www-data .
sudo chmod -R 755 .
sudo chmod -R 775 storage bootstrap/cache
```

### Página em Branco
```bash
# Ver logs
tail -50 /var/www/curriculum/curriculum-app/storage/logs/laravel.log

# Limpar cache
cd /var/www/curriculum/curriculum-app
sudo php artisan cache:clear
sudo php artisan config:clear
```

### Assets Não Carregam
```bash
cd /var/www/curriculum/curriculum-app
sudo npm run build
sudo chown -R www-data:www-data public/build
```

### SSL Não Funciona
```bash
# Verificar certificado
sudo certbot certificates

# Reconfigurar
sudo certbot --nginx -d seu-dominio.com

# Ver logs
sudo tail -50 /var/log/letsencrypt/letsencrypt.log
```

## Informações Importantes

### Caminhos
- **Projeto:** `/var/www/curriculum/curriculum-app`
- **Public (Nginx):** `/var/www/curriculum/curriculum-app/public`
- **Config Nginx:** `/etc/nginx/sites-available/curriculum`
- **Logs Laravel:** `/var/www/curriculum/curriculum-app/storage/logs/`
- **Logs Nginx:** `/var/log/nginx/`

### Usuários e Grupos
- **Nginx:** `www-data:www-data`
- **PHP-FPM:** `www-data:www-data`
- **Deploy:** seu-usuario (com sudo)

### Portas
- **HTTP:** 80
- **HTTPS:** 443
- **SSH:** 22

---

**Salve esta página como referência rápida!**

