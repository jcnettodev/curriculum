# Scripts de Deploy para VPS Ubuntu

Este diretório contém todos os scripts necessários para fazer deploy do projeto Laravel Curriculum em uma VPS Ubuntu.

## Arquivos Disponíveis

### Scripts Shell

1. **`install-vps.sh`** - Instalação inicial da VPS
   - Instala PHP 8.2, Nginx, Composer, Node.js, Certbot
   - Execute apenas uma vez na configuração inicial
   - Requer root: `sudo ./install-vps.sh`

2. **`deploy.sh`** - Deploy e atualização do projeto
   - Atualiza código do Git
   - Instala dependências
   - Compila assets
   - Reinicia serviços
   - Execute sempre que atualizar o código: `sudo ./deploy.sh`

3. **`setup-ssl.sh`** - Configuração de SSL/HTTPS
   - Configura certificado Let's Encrypt
   - Ativa HTTPS automaticamente
   - Execute após o primeiro deploy: `sudo ./setup-ssl.sh`

### Arquivos de Configuração

4. **`nginx-curriculum.conf`** - Configuração do Nginx
   - Configuração otimizada para Laravel
   - Inclui cache, gzip, security headers
   - Edite `server_name` e `root` antes de usar

### Documentação

5. **`DEPLOY-VPS.md`** - Guia completo de deploy
   - Passo a passo detalhado
   - Solução de problemas
   - Comandos úteis
   - **LEIA ESTE ARQUIVO PRIMEIRO!**

## Ordem de Execução (Primeira Vez)

```bash
# 1. Na VPS, clonar o repositório
git clone seu-repo /var/www/curriculum
cd /var/www/curriculum/curriculum-app

# 2. Instalar dependências do sistema
sudo ./deployment/install-vps.sh

# 3. Configurar .env e Nginx
sudo cp .env.example .env
sudo nano .env
sudo nano deployment/nginx-curriculum.conf
sudo cp deployment/nginx-curriculum.conf /etc/nginx/sites-available/curriculum
sudo ln -s /etc/nginx/sites-available/curriculum /etc/nginx/sites-enabled/

# 4. Fazer deploy inicial
sudo ./deployment/deploy.sh

# 5. Configurar SSL (HTTPS)
sudo ./deployment/setup-ssl.sh
```

## Atualizações Futuras

Sempre que fizer alterações no código:

```bash
cd /var/www/curriculum/curriculum-app
sudo ./deployment/deploy.sh
```

## Recursos Mínimos da VPS

- **CPU:** 1 vCPU
- **RAM:** 1-2 GB
- **Disco:** 20 GB
- **SO:** Ubuntu 20.04+

## Suporte

Consulte `DEPLOY-VPS.md` para documentação completa e solução de problemas.

---

**Deploy simples, sem Docker, otimizado para performance!**

