# Página de Currículo - Laravel + Tailwind CSS 4.1

Uma página de currículo moderna, responsiva e elegante desenvolvida com Laravel e Tailwind CSS 4.1.

## Características

- Design moderno e profissional
- Totalmente responsivo (mobile, tablet, desktop)
- Animações CSS suaves e elegantes
- Tailwind CSS 4.1 com configuração personalizada
- Efeitos visuais interativos
- Otimizado para performance
- Fácil personalização

## Requisitos

- PHP 8.2 ou superior
- Composer
- Node.js 18+ e npm
- SQLite (já incluído no PHP)

## Instalação

### 1. Configurar Ambiente

Crie o arquivo `.env` na raiz do projeto e copie o conteúdo do arquivo `dados.md`.

### 2. Instalar Dependências

```bash
# Instalar dependências PHP
composer install

# Instalar dependências JavaScript
npm install

# Gerar chave da aplicação
php artisan key:generate

# Criar banco de dados SQLite
touch database/database.sqlite
```

### 3. Compilar Assets

```bash
# Desenvolvimento (com hot reload)
npm run dev

# Produção
npm run build
```

### 4. Iniciar Servidor

```bash
php artisan serve
```

Acesse: http://localhost:8000

## Personalização

### Editar Informações do Currículo

Edite o arquivo `app/Http/Controllers/CurriculumController.php` e altere os dados:

- **Informações Pessoais**: Nome, título, contatos, foto
- **Sobre Mim**: Descrição profissional
- **Experiências**: Cargos, empresas, períodos, conquistas
- **Formação**: Cursos, instituições
- **Habilidades**: Tecnologias e competências

### Personalizar Cores e Estilos

- **Tailwind Config**: `tailwind.config.js`
- **CSS Customizado**: `resources/css/app.css`
- **Animações**: Configuradas em ambos os arquivos acima

### Modificar Layout

Edite a view principal em: `resources/views/curriculum.blade.php`

## Estrutura do Projeto

```
curriculum-app/
├── app/
│   └── Http/
│       └── Controllers/
│           └── CurriculumController.php
├── config/
├── public/
│   ├── css/
│   └── js/
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       └── curriculum.blade.php
├── routes/
│   └── web.php
├── tailwind.config.js
├── vite.config.js
├── composer.json
├── package.json
└── dados.md
```

## Tecnologias Utilizadas

- **Laravel 11**: Framework PHP moderno
- **Tailwind CSS 4.1**: Framework CSS utility-first
- **Vite**: Build tool moderna e rápida
- **JavaScript Vanilla**: Para animações interativas
- **SQLite**: Banco de dados leve

## Animações Incluídas

- Fade In
- Slide In (Left/Right)
- Slide Up
- Float
- Hover Effects
- Gradient Animation
- Shine Effect
- Scroll Animations

## Deploy

Para fazer deploy em produção:

1. Configure o ambiente de produção
2. Execute `npm run build` para compilar assets
3. Configure o servidor web (Apache/Nginx)
4. Aponte para a pasta `public/`
5. Configure as permissões adequadas

## Licença

MIT License - Sinta-se livre para usar e modificar.

## Suporte

Para dúvidas ou problemas, consulte a documentação oficial do Laravel: https://laravel.com/docs

