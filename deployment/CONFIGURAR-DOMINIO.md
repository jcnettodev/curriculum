# Guia Completo: Configurar Domínio euonline.site

Este guia mostra como configurar seu domínio **euonline.site** com o projeto Laravel Curriculum na VPS.

---

## 📋 Pré-requisitos

- [ ] VPS Ubuntu configurada e acessível
- [ ] Domínio **euonline.site** (você já tem ✅)
- [ ] Acesso ao painel DNS do domínio
- [ ] Projeto já clonado na VPS em `/var/www/curriculum`

---

## Passo 1: Configurar DNS

### Opção A: Usar Subdomínio (Recomendado) 🌟

Vantagens:
- Deixa o domínio principal livre para outros projetos
- Mais organizado
- Fácil de gerenciar múltiplos projetos

**No painel DNS do seu domínio, adicione:**

```
Tipo: A
Nome: curriculum
Conteúdo: [IP-DA-SUA-VPS]
TTL: 300
Prioridade: 0
```

**Resultado:** Seu site ficará em `curriculum.euonline.site`

**Alternativas de nomes:**
- `cv.euonline.site`
- `portfolio.euonline.site`
- `resume.euonline.site`

### Opção B: Usar Domínio Principal

**No painel DNS do seu domínio, edite:**

```
Tipo: A
Nome: @ (ou deixe vazio)
Conteúdo: [IP-DA-SUA-VPS]
TTL: 300
Prioridade: 0
```

**Resultado:** Seu site ficará em `euonline.site`

### Adicionar WWW (Opcional)

Para funcionar com `www.curriculum.euonline.site`:

```
Tipo: CNAME
Nome: www
Conteúdo: curriculum.euonline.site
TTL: 300
```

---

## Passo 2: Aguardar Propagação DNS

Após salvar as configurações DNS:

- **Tempo estimado:** 15 minutos a 48 horas
- **Geralmente:** 15-30 minutos

### Como Verificar se Propagou

**No seu PC/notebook:**

```bash
# Linux/Mac
ping curriculum.euonline.site

# Ou
nslookup curriculum.euonline.site

# Deve retornar o IP da sua VPS
```

**No Windows (PowerShell):**
```powershell
ping curriculum.euonline.site
```

Quando retornar o IP correto da VPS, o DNS propagou! ✅

---

## Passo 3: Deploy Inicial na VPS

### 3.1. Conectar na VPS

```bash
ssh seu-usuario@ip-da-vps
```

### 3.2. Clonar Repositório (se ainda não fez)

```bash
sudo mkdir -p /var/www
cd /var/www
sudo git clone https://github.com/jcnettodev/curriculum.git
cd curriculum/curriculum-app
```

### 3.3. Instalar Dependências (primeira vez)

```bash
sudo ./deployment/install-vps.sh
```

Aguarde 5-10 minutos.

### 3.4. Configurar .env

```bash
# Copiar exemplo
sudo cp .env.example .env

# Editar
sudo nano .env
```

**Cole o conteúdo do `envy.ttxr` e altere:**

```env
APP_URL=https://curriculum.euonline.site
```

(ou use `euonline.site` se escolheu o domínio principal)

**Salvar:** `Ctrl+O`, `Enter`, `Ctrl+X`

### 3.5. Configurar Nginx

```bash
# Editar configuração
sudo nano deployment/nginx-curriculum.conf
```

**Altere a linha 5:**

```nginx
server_name curriculum.euonline.site www.curriculum.euonline.site;
```

(ou `euonline.site www.euonline.site` se usar domínio principal)

**Salvar e ativar:**

```bash
# Copiar para sites-available
sudo cp deployment/nginx-curriculum.conf /etc/nginx/sites-available/curriculum

# Ativar site
sudo ln -s /etc/nginx/sites-available/curriculum /etc/nginx/sites-enabled/

# Remover site padrão
sudo rm /etc/nginx/sites-enabled/default

# Testar configuração
sudo nginx -t

# Se OK, reiniciar
sudo systemctl restart nginx
```

### 3.6. Fazer Deploy

```bash
sudo ./deployment/deploy.sh
```

Aguarde 3-5 minutos.

### 3.7. Testar HTTP (sem SSL ainda)

Abra no navegador: `http://curriculum.euonline.site`

Se aparecer o site, está funcionando! 🎉

---

## Passo 4: Configurar SSL/HTTPS (Certificado Gratuito)

### 4.1. Executar Script SSL

```bash
cd /var/www/curriculum
sudo ./deployment/setup-ssl.sh
```

### 4.2. Informações Solicitadas

**Digite seu domínio:**
```
curriculum.euonline.site
```

**Digite seu email:**
```
seu-email@exemplo.com
```

O script irá:
- ✅ Obter certificado Let's Encrypt (gratuito)
- ✅ Configurar Nginx para HTTPS
- ✅ Redirecionar HTTP → HTTPS automaticamente
- ✅ Configurar renovação automática

**Tempo:** 2-3 minutos

### 4.3. Testar HTTPS

Abra no navegador: `https://curriculum.euonline.site`

Deve aparecer o **cadeado verde** 🔒 e o site funcionando!

---

## Passo 5: Verificar Tudo

```bash
# Ver status completo
sudo ./deployment/check-status.sh

# Ver certificado SSL
sudo certbot certificates
```

---

## 🎯 Resumo Visual

```
┌─────────────────────────────────────────────────┐
│  1. Configurar DNS (no painel do domínio)       │
│     curriculum.euonline.site → IP da VPS        │
└─────────────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────────────┐
│  2. Aguardar propagação (15-30 min)             │
│     ping curriculum.euonline.site               │
└─────────────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────────────┐
│  3. Deploy inicial na VPS                       │
│     - install-vps.sh                            │
│     - Configurar .env e Nginx                   │
│     - deploy.sh                                 │
└─────────────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────────────┐
│  4. Testar HTTP                                 │
│     http://curriculum.euonline.site             │
└─────────────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────────────┐
│  5. Configurar SSL                              │
│     setup-ssl.sh                                │
└─────────────────────────────────────────────────┘
                    ↓
┌─────────────────────────────────────────────────┐
│  6. SITE NO AR! 🎉                              │
│     https://curriculum.euonline.site            │
└─────────────────────────────────────────────────┘
```

---

## 🔧 Configurações Finais no envy.ttxr

Antes de fazer deploy, atualize seu `envy.ttxr` local:

```env
APP_URL=https://curriculum.euonline.site
```

Depois faça commit e push:

```bash
cd /home/ossometal/Documentos/Github/Curriculum
git add .
git commit -m "Atualiza APP_URL com domínio real"
git push origin main
```

---

## 🆘 Problemas Comuns

### DNS não propaga

**Problema:** `ping curriculum.euonline.site` não retorna o IP da VPS

**Soluções:**
- Aguardar mais tempo (até 48h, mas geralmente 30 min)
- Verificar se salvou as alterações no painel DNS
- Verificar se o IP está correto
- Limpar cache DNS local:
  ```bash
  # Linux
  sudo systemd-resolve --flush-caches
  
  # Windows
  ipconfig /flushdns
  ```

### Erro 502 Bad Gateway

**Causa:** PHP-FPM não está rodando

**Solução:**
```bash
sudo systemctl restart php8.2-fpm
sudo systemctl status php8.2-fpm
```

### Erro 403 Forbidden

**Causa:** Permissões incorretas

**Solução:**
```bash
cd /var/www/curriculum
sudo chown -R www-data:www-data .
sudo chmod -R 755 .
sudo chmod -R 775 storage bootstrap/cache
```

### SSL não funciona

**Causa 1:** DNS ainda não propagou completamente

**Solução:** Aguardar propagação completa, depois rodar:
```bash
sudo ./deployment/setup-ssl.sh
```

**Causa 2:** Porta 80/443 bloqueada no firewall

**Solução:**
```bash
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
```

### Site mostra "Welcome to nginx"

**Causa:** Configuração do Nginx não está ativa

**Solução:**
```bash
sudo ln -s /etc/nginx/sites-available/curriculum /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl restart nginx
```

---

## 📞 Checklist Final

Antes de considerar pronto, verifique:

- [ ] DNS propagado (ping retorna IP correto)
- [ ] Site acessível via HTTP
- [ ] SSL configurado e funcionando
- [ ] Site acessível via HTTPS com cadeado verde
- [ ] Redirecionamento HTTP → HTTPS funcionando
- [ ] `.env` com `APP_URL` correto
- [ ] Nginx com `server_name` correto

---

## 🔄 Atualizações Futuras

Quando fizer alterações no código:

```bash
# No seu PC
git add .
git commit -m "descrição da alteração"
git push origin main

# Na VPS
ssh seu-usuario@ip-da-vps
cd /var/www/curriculum
sudo git pull origin main
sudo ./deployment/deploy.sh
```

**Simples assim!**

---

## 📊 Informações do Seu Projeto

- **Domínio:** euonline.site
- **Subdomínio sugerido:** curriculum.euonline.site
- **Repositório:** github.com/jcnettodev/curriculum
- **Caminho VPS:** /var/www/curriculum/curriculum-app

---

**Pronto!** Siga este guia passo a passo e seu currículo estará online com domínio próprio e HTTPS! 🚀

