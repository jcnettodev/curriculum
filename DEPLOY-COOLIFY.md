# Deploy com Coolify - Laravel Curriculum

Este guia mostra como fazer deploy do projeto Laravel Curriculum usando **Coolify**.

---

## 🐳 O Que É o Coolify?

Coolify é uma plataforma self-hosted open-source que simplifica deploys, similar ao Vercel/Netlify/Heroku, mas rodando na sua própria VPS.

**Vantagens:**
- ✅ Deploy automático via Git push
- ✅ SSL/HTTPS automático (Let's Encrypt)
- ✅ Interface web intuitiva
- ✅ Logs em tempo real
- ✅ Rollback com 1 clique
- ✅ Múltiplos projetos na mesma VPS
- ✅ Suporte a Laravel, Node.js, Python, Go, etc
- ✅ Gratuito e open-source

---

## 📋 Pré-requisitos

- VPS Ubuntu 20.04+ com mínimo 2 GB RAM
- Domínio: **cv.euonline.site** apontando para IP da VPS
- Acesso SSH à VPS

---

## 🚀 Passo 1: Instalar Coolify na VPS

### 1.1. Conectar na VPS

```bash
ssh root@84.32.84.32
```

### 1.2. Instalar Coolify

```bash
curl -fsSL https://get.coolify.io | bash
```

**Tempo:** 5-10 minutos

O script irá instalar:
- Docker
- Docker Compose
- Coolify
- Traefik (proxy reverso)

### 1.3. Acessar Interface Web

Após instalação, acesse:
```
http://84.32.84.32:8000
```

Ou se já configurou domínio:
```
http://coolify.euonline.site:8000
```

---

## 🔧 Passo 2: Configuração Inicial do Coolify

### 2.1. Criar Conta Admin

Na primeira vez:
1. Acesse a interface web
2. Crie conta de administrador
3. Defina email e senha forte

### 2.2. Configurar Servidor (Server)

1. Vá em **Servers**
2. O servidor local já estará lá (localhost)
3. Clique nele e verifique se está "reachable"

---

## 📦 Passo 3: Adicionar Projeto Laravel

### 3.1. Criar Novo Projeto

1. Clique em **+ New Resource**
2. Selecione **Public Repository** (ou Private se configurou SSH)
3. Cole a URL do repositório:
   ```
   https://github.com/jcnettodev/curriculum.git
   ```

### 3.2. Configurar Tipo de Aplicação

1. **Build Pack:** Selecione `nixpacks` (detecta Laravel automaticamente)
2. **Branch:** `main`
3. **Name:** `curriculum` (ou o que preferir)
4. Clique em **Continue**

---

## ⚙️ Passo 4: Configurar Variáveis de Ambiente

### 4.1. Acessar Environment Variables

Na página do projeto, vá em **Environment Variables**

### 4.2. Adicionar Variáveis

Cole estas variáveis (do arquivo `envy.ttxr`):

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

**Observações:**
- ✅ `APP_KEY` será gerado automaticamente no primeiro deploy
- ✅ `APP_URL` deve ser seu domínio final

### 4.3. Adicionar Variáveis Específicas do Coolify

```env
# Para banco SQLite funcionar
DB_DATABASE=/app/storage/database.sqlite
```

---

## 🌐 Passo 5: Configurar Domínio

### 5.1. DNS (já configurado)

Você já tem:
```
cv.euonline.site → 84.32.84.32
```

### 5.2. No Coolify

1. Vá em **Domains** do projeto
2. Adicione: `cv.euonline.site`
3. Marque **Enable Automatic SSL** (Let's Encrypt)
4. Salve

---

## 🎯 Passo 6: Deploy!

### 6.1. Iniciar Primeiro Deploy

1. Clique em **Deploy**
2. Aguarde o processo (3-5 minutos)
3. Acompanhe os logs em tempo real

O Coolify irá:
- ✅ Clonar repositório
- ✅ Instalar dependências PHP (Composer)
- ✅ Instalar dependências Node.js
- ✅ Compilar assets (npm run build)
- ✅ Gerar APP_KEY
- ✅ Configurar SSL/HTTPS
- ✅ Iniciar aplicação

### 6.2. Verificar Status

Quando aparecer **"Running"** em verde, está pronto!

### 6.3. Acessar Site

```
https://cv.euonline.site
```

---

## 🔄 Atualizações Futuras (Deploy Automático)

### Opção A: Deploy Automático via Webhook

1. No Coolify, vá em **Webhooks**
2. Copie a URL do webhook
3. No GitHub, vá em **Settings** → **Webhooks**
4. Adicione novo webhook:
   - **Payload URL:** Cole a URL do Coolify
   - **Content type:** `application/json`
   - **Events:** Selecione `Just the push event`
   - Salve

**Agora:** Cada push no GitHub fará deploy automaticamente! 🎉

### Opção B: Deploy Manual

No seu PC:
```bash
git add .
git commit -m "sua mensagem"
git push origin main
```

No Coolify, clique em **Deploy** (se não configurou webhook)

---

## 📊 Recursos do Coolify

### Ver Logs

1. Vá no projeto
2. Clique em **Logs**
3. Veja logs em tempo real:
   - Build logs
   - Application logs
   - Error logs

### Rollback

1. Vá em **Deployments**
2. Veja histórico de deploys
3. Clique em **Rollback** em qualquer deploy anterior

### Restart/Stop

- **Restart:** Reinicia aplicação
- **Stop:** Para aplicação
- **Force Deploy:** Força novo deploy

### Métricas

- CPU usage
- Memory usage
- Disk usage
- Network

---

## 🗄️ Banco de Dados SQLite

O projeto usa SQLite (banco de dados em arquivo).

### Persistência

Para o banco SQLite persistir entre deploys:

1. No Coolify, vá em **Storages**
2. Adicione storage:
   - **Source:** `/app/database`
   - **Destination:** `/app/database`
   - **Type:** Volume

Isso garante que o arquivo `database.sqlite` não seja perdido nos deploys.

---

## 🆘 Problemas Comuns

### Erro: "APP_KEY is missing"

**Solução:** 

No terminal do container:
```bash
php artisan key:generate
```

Ou adicione `APP_KEY` manualmente nas variáveis de ambiente.

### Erro 500 - Internal Server Error

**Ver logs:**
1. No Coolify, vá em **Logs**
2. Procure por erros do Laravel
3. Ajuste configuração conforme necessário

**Ativar debug temporariamente:**
```env
APP_DEBUG=true
```
(Lembre de voltar para `false` depois!)

### Assets CSS/JS não carregam

**Solução:**

Adicione comando de build nas configurações:

1. Vá em **Build Settings**
2. Em **Build Command**, adicione:
   ```bash
   npm run build
   ```

### Banco SQLite não persiste

Verifique se adicionou storage conforme seção acima.

---

## 🔐 Segurança

### Firewall (UFW)

```bash
# Permitir apenas portas necessárias
sudo ufw allow 22/tcp   # SSH
sudo ufw allow 80/tcp   # HTTP
sudo ufw allow 443/tcp  # HTTPS
sudo ufw allow 8000/tcp # Coolify (pode restringir só para seu IP)
sudo ufw enable
```

### Restringir Acesso ao Coolify

Para mais segurança, restrinja acesso à interface do Coolify (porta 8000) apenas ao seu IP:

```bash
sudo ufw delete allow 8000/tcp
sudo ufw allow from SEU_IP to any port 8000 proto tcp
```

---

## 💡 Dicas

### 1. Múltiplos Projetos

Coolify permite rodar múltiplos projetos na mesma VPS:
- `cv.euonline.site` → Curriculum
- `blog.euonline.site` → Blog
- `api.euonline.site` → API

Cada um com deploy independente!

### 2. Comandos Artisan

Para executar comandos Laravel:

1. No Coolify, vá em **Terminal**
2. Execute comandos:
   ```bash
   php artisan migrate
   php artisan cache:clear
   php artisan config:cache
   ```

### 3. Backups

Configure backup automático:
1. Vá em **Backups**
2. Configure frequência
3. Escolha destino (S3, local, etc)

### 4. Notificações

Configure notificações:
1. Vá em **Notifications**
2. Adicione Discord, Slack, Email, Telegram
3. Receba alerta de deploys/erros

---

## 📋 Checklist de Deploy

- [ ] Coolify instalado na VPS
- [ ] Conta admin criada
- [ ] Projeto adicionado no Coolify
- [ ] Variáveis de ambiente configuradas
- [ ] Domínio `cv.euonline.site` configurado
- [ ] SSL/HTTPS ativado
- [ ] Storage para SQLite configurado
- [ ] Deploy realizado com sucesso
- [ ] Site acessível em https://cv.euonline.site
- [ ] Webhook GitHub configurado (opcional)

---

## 🎉 Pronto!

Seu currículo está no ar com Coolify!

**URL:** https://cv.euonline.site

**Vantagens sobre deploy manual:**
- ✅ Deploy automático (push no Git)
- ✅ Interface web bonita
- ✅ SSL automático
- ✅ Rollback fácil
- ✅ Logs em tempo real
- ✅ Suporte a múltiplos projetos
- ✅ Menos trabalho de manutenção

---

## 📚 Recursos

- **Documentação Oficial:** https://coolify.io/docs
- **GitHub:** https://github.com/coollabsio/coolify
- **Discord:** https://discord.gg/coolify

---

**Boa sorte com o Coolify!** 🚀

