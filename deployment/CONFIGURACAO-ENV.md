# Configuração do Arquivo .env para Produção

Este guia explica as configurações do arquivo `.env` para a VPS.

## 📋 Arquivo de Referência

Use o arquivo `envy.ttxr` como base para criar o `.env` na VPS.

---

## 🔧 Configurações Explicadas

### Configurações Principais

```env
APP_NAME=Curriculum
```
Nome da aplicação (pode manter)

```env
APP_ENV=production
```
**IMPORTANTE:** Deve ser `production` na VPS (não `local`)

```env
APP_KEY=
```
**SERÁ GERADO AUTOMATICAMENTE** pelo script `deploy.sh`
- Não precisa preencher manualmente
- O script executará: `php artisan key:generate`

```env
APP_DEBUG=false
```
**CRÍTICO:** Deve ser `false` em produção
- Se for `true`, mostra erros detalhados (risco de segurança)
- Com `false`, mostra página genérica de erro

```env
APP_URL=https://seu-dominio.com
```
**ALTERE AQUI:** Coloque seu domínio ou IP
- Com SSL: `https://seu-dominio.com`
- Sem SSL: `http://seu-ip-da-vps`

### Localização

```env
APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=pt_BR
APP_FAKER_LOCALE=pt_BR
```
Mantém português do Brasil (OK como está)

### Banco de Dados

```env
DB_CONNECTION=sqlite
DB_DATABASE=
```
**SQLite é perfeito para este projeto:**
- Não precisa MySQL/PostgreSQL
- Arquivo único em `database/database.sqlite`
- Criado automaticamente pelo `deploy.sh`

### Cache e Sessões

```env
SESSION_DRIVER=file
```
Armazena sessões em arquivos (OK para VPS simples)

```env
CACHE_STORE=file
```
Cache em arquivos (funciona bem)

```env
QUEUE_CONNECTION=sync
```
Processa filas sincronamente (adequado para projeto simples)

### Logs

```env
LOG_CHANNEL=daily
LOG_LEVEL=error
```
- `daily`: Cria um arquivo de log por dia
- `error`: Só registra erros (não warnings/info)
- Economiza espaço em disco

---

## 🚀 Como Usar na VPS

### Passo 1: Copiar o Conteúdo

Na VPS, depois de clonar o repositório:

```bash
cd /var/www/curriculum

# Criar arquivo .env
sudo nano .env
```

### Passo 2: Colar e Ajustar

Cole o conteúdo do `envy.ttxr` e **ALTERE APENAS:**

```env
APP_URL=https://seu-dominio-real.com
```

**OU** se não tiver domínio ainda:

```env
APP_URL=http://123.456.789.012
```
(use o IP real da sua VPS)

### Passo 3: Salvar

- **Salvar:** `Ctrl + O` → `Enter`
- **Sair:** `Ctrl + X`

### Passo 4: Deploy

```bash
sudo ./deployment/deploy.sh
```

O script irá **automaticamente**:
- ✅ Gerar `APP_KEY`
- ✅ Criar banco SQLite
- ✅ Configurar permissões

---

## 📝 Diferenças: Local vs Produção

| Configuração | Local (Dev) | Produção (VPS) |
|--------------|-------------|----------------|
| `APP_ENV` | `local` | `production` |
| `APP_DEBUG` | `true` | `false` |
| `APP_URL` | `localhost` | seu domínio/IP |
| `SESSION_DRIVER` | `array` | `file` |
| `CACHE_STORE` | `array` | `file` |
| `LOG_LEVEL` | `debug` | `error` |

---

## ⚠️ Configurações CRÍTICAS de Segurança

### ❌ NUNCA faça isso em produção:

```env
APP_DEBUG=true  # ❌ Expõe informações sensíveis
APP_ENV=local   # ❌ Ativa recursos de dev
```

### ✅ SEMPRE use em produção:

```env
APP_DEBUG=false   # ✅ Oculta detalhes de erro
APP_ENV=production # ✅ Otimizações ativas
```

---

## 🔐 APP_KEY - Por Que Não Preencher?

A `APP_KEY` é uma chave de criptografia única. 

**Por que deixar vazio?**
1. Cada ambiente deve ter sua própria chave
2. O script `deploy.sh` gera automaticamente
3. Evita compartilhar chaves entre ambientes

**O que ela faz?**
- Criptografa sessões
- Criptografa cookies
- Criptografa dados sensíveis

---

## 🧪 Testando Configurações

Depois do deploy, teste se está tudo certo:

```bash
# Ver configuração atual
cd /var/www/curriculum
php artisan config:show

# Verificar se APP_KEY foi gerada
php artisan tinker
>>> config('app.key');  # Deve mostrar uma chave

# Verificar ambiente
php artisan about
```

---

## 🆘 Problemas Comuns

### Erro: "No application encryption key"

**Solução:**
```bash
cd /var/www/curriculum
sudo php artisan key:generate
```

### Erro 500 - Internal Server Error

**Causa:** `APP_DEBUG=false` oculta o erro real

**Solução temporária para debugar:**
```bash
sudo nano .env
# Altere temporariamente: APP_DEBUG=true
# Acesse o site para ver erro real
# DEPOIS volte para: APP_DEBUG=false
```

### Cache com valores antigos

**Solução:**
```bash
cd /var/www/curriculum
sudo php artisan config:clear
sudo php artisan cache:clear
sudo php artisan config:cache
```

---

## 📦 Exemplo Completo Preenchido

```env
APP_NAME=Curriculum
APP_ENV=production
APP_KEY=base64:xyz123abc456...  # (gerado automaticamente)
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://curriculum.meusite.com.br

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

---

## ✅ Checklist

Antes de fazer deploy, verifique:

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL` com seu domínio/IP real
- [ ] `APP_KEY` vazio (será gerado)
- [ ] `DB_CONNECTION=sqlite`
- [ ] `SESSION_DRIVER=file`
- [ ] `CACHE_STORE=file`

---

**Pronto!** Com essas configurações, seu projeto estará seguro e otimizado para produção.

