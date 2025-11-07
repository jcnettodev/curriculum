# 📄 Currículo Digital - Laravel

> Meu currículo profissional online, desenvolvido com Laravel 11, Tailwind CSS 4.1 e deploy automatizado com Coolify.

<div align="center">

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.1-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)

[🌐 Ver Online](https://cv.euonline.site)

</div>

---

## ✨ Características

- 🎨 **Design Moderno** - Interface clean e profissional
- 📱 **Totalmente Responsivo** - Funciona perfeitamente em mobile, tablet e desktop
- ⚡ **Performance Otimizada** - Carregamento rápido e experiência fluida
- 🎭 **Animações Suaves** - Transições elegantes em CSS puro
- 🚀 **Deploy Automatizado** - CI/CD com Coolify e Nixpacks
- 🔒 **HTTPS Automático** - SSL/TLS com Let's Encrypt

---

## 🛠️ Tecnologias

### Backend
- **Laravel 11** - Framework PHP moderno e elegante
- **PHP 8.2+** - Linguagem de programação

### Frontend
- **Tailwind CSS 4.1** - Framework CSS utility-first
- **Vite** - Build tool ultra-rápido
- **Blade Templates** - Sistema de templates do Laravel

### Deploy & Infraestrutura
- **Coolify** - Plataforma de deploy self-hosted
- **Nixpacks** - Sistema de build automático
- **Docker** - Containerização
- **Nginx** - Servidor web
- **PHP-FPM** - Process manager para PHP
- **Supervisor** - Gerenciador de processos

---

## 🚀 Deploy

Este projeto está configurado para deploy automático usando **Coolify** com **Nixpacks**.

### Pré-requisitos na VPS

- Docker instalado
- Coolify instalado ([guia oficial](https://coolify.io/docs/installation))
- Domínio apontando para o servidor

### Deploy Automático

1. **Configure o projeto no Coolify:**
   - Adicione o repositório Git
   - Configure as variáveis de ambiente
   - Defina o domínio

2. **Push para o repositório:**
   ```bash
   git push origin main
   ```

3. **Deploy acontece automaticamente!** 🎉

O arquivo `nixpacks.toml` contém toda a configuração necessária para:
- Instalar dependências (Composer + npm)
- Compilar assets (Vite)
- Configurar Nginx + PHP-FPM
- Gerenciar processos com Supervisor

---

## 💻 Desenvolvimento Local

### Requisitos

- PHP 8.2 ou superior
- Composer
- Node.js 18+ e npm

### Instalação

```bash
# Clone o repositório
git clone https://github.com/jcnettodev/curriculum.git
cd curriculum

# Instale as dependências PHP
composer install

# Instale as dependências JavaScript
npm install

# Copie o arquivo de ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Compile os assets
npm run build
```

### Executar Localmente

```bash
# Em um terminal, inicie o servidor Laravel
php artisan serve

# Em outro terminal, compile os assets em modo watch
npm run dev
```

Acesse: http://localhost:8000

---

## 📝 Personalização

Para personalizar as informações do currículo, edite o arquivo:

```
app/Http/Controllers/CurriculumController.php
```

Este arquivo contém todos os dados estruturados em arrays PHP:

```php
$data = [
    'personal' => [...],    // Informações pessoais
    'about' => '...',       // Sobre você
    'experiences' => [...], // Experiências profissionais
    'education' => [...],   // Formação acadêmica
    'skills' => [...],      // Habilidades técnicas
];
```

### Customizar Estilos

- **Cores e tema:** `tailwind.config.js`
- **CSS customizado:** `resources/css/app.css`
- **Layout:** `resources/views/curriculum.blade.php`

---

## 📦 Estrutura do Projeto

```
curriculum/
├── app/
│   └── Http/
│       └── Controllers/
│           └── CurriculumController.php  # Dados do currículo
├── config/
│   └── app.php                           # Configuração do Laravel
├── public/
│   ├── index.php                         # Entry point
│   └── build/                            # Assets compilados (gitignore)
├── resources/
│   ├── css/
│   │   └── app.css                       # Estilos Tailwind
│   ├── js/
│   │   └── app.js                        # JavaScript
│   └── views/
│       └── curriculum.blade.php          # Template principal
├── routes/
│   └── web.php                           # Rotas da aplicação
├── composer.json                         # Dependências PHP
├── package.json                          # Dependências JavaScript
├── nixpacks.toml                         # Configuração de deploy
├── tailwind.config.js                    # Configuração Tailwind
└── vite.config.js                        # Configuração Vite
```

---

## 🔧 Variáveis de Ambiente

Principais variáveis necessárias para produção:

```env
APP_NAME=Curriculum
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false
APP_URL=https://seudominio.com

# Nixpacks
NIXPACKS_PHP_ROOT_DIR=/app/public
NIXPACKS_PHP_FALLBACK_PATH=/index.php
NIXPACKS_NODE_VERSION=22

# Locale
APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=pt_BR
```

---

## 🤝 Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para:

1. Fazer um fork do projeto
2. Criar uma branch para sua feature (`git checkout -b feature/MinhaFeature`)
3. Commit suas mudanças (`git commit -m 'Adiciona MinhaFeature'`)
4. Push para a branch (`git push origin feature/MinhaFeature`)
5. Abrir um Pull Request

---

## 📄 Licença

Este projeto é open source e está disponível sob a [MIT License](LICENSE).

---

## 👨‍💻 Autor

**José Carlos Vieira Netto**

- 🌐 Website: [cv.euonline.site](https://cv.euonline.site)
- 💼 LinkedIn: [José Carlos Vieira](https://www.linkedin.com/in/josé-carlos-vieira-52b401397/)
- 🐙 GitHub: [@jcnettodev](https://github.com/jcnettodev)
- 📧 Email: jcnetto.dev@gmail.com

---

<div align="center">

**⭐ Se este projeto te ajudou, considere dar uma estrela!**

Desenvolvido com ❤️ por [José Carlos Vieira Netto](https://github.com/jcnettodev)

</div>
