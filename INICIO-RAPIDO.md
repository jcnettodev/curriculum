# Início Rápido - Página de Currículo

## Resumo do Que Foi Criado

Uma página de currículo completa e moderna com:

- Laravel 11 estruturado manualmente
- Tailwind CSS 4.1 configurado
- Design responsivo com animações
- Rotas e controller funcionais
- View completa com todas as seções

## Passos Rápidos para Começar

### 1. Configurar Arquivo .env

Abra o arquivo `dados.md` e copie o conteúdo indicado para criar o arquivo `.env` na raiz do projeto.

### 2. Instalar Dependências

Você precisará ter instalado:
- PHP 8.2+
- Composer
- Node.js e npm

Depois, execute:

```bash
cd curriculum-app
composer install
npm install
php artisan key:generate
touch database/database.sqlite
```

### 3. Compilar e Executar

Terminal 1 - Compilar assets:
```bash
npm run dev
```

Terminal 2 - Servidor Laravel:
```bash
php artisan serve
```

Acesse: http://localhost:8000

## Personalizar Seu Currículo

Edite o arquivo: `app/Http/Controllers/CurriculumController.php`

### Alterar Informações Pessoais

```php
'personal' => [
    'name' => 'SEU NOME AQUI',
    'title' => 'SEU CARGO/TÍTULO',
    'email' => 'seuemail@example.com',
    'phone' => 'seu telefone',
    // ... outros campos
]
```

### Adicionar Experiências

```php
'experiences' => [
    [
        'position' => 'Cargo',
        'company' => 'Empresa',
        'period' => 'Período',
        'description' => 'Descrição do que fez',
        'achievements' => [
            'Conquista 1',
            'Conquista 2',
        ]
    ],
    // Adicione mais experiências aqui
]
```

### Modificar Habilidades

```php
'skills' => [
    'Categoria 1' => ['Skill 1', 'Skill 2', 'Skill 3'],
    'Categoria 2' => ['Skill A', 'Skill B', 'Skill C'],
    // Adicione mais categorias
]
```

## Personalizar Cores

Edite `tailwind.config.js` para mudar as cores do gradiente e animações.

Edite `resources/css/app.css` para ajustar estilos customizados.

## Estrutura de Arquivos Importantes

```
curriculum-app/
├── app/Http/Controllers/
│   └── CurriculumController.php    ← Dados do currículo
├── resources/
│   ├── css/app.css                  ← Estilos customizados
│   ├── js/app.js                    ← Animações JavaScript
│   └── views/curriculum.blade.php   ← Layout HTML
├── routes/web.php                   ← Rotas
├── tailwind.config.js               ← Config Tailwind
└── vite.config.js                   ← Config Vite
```

## Features Incluídas

- Header com gradiente animado
- Seção "Sobre Mim"
- Experiências profissionais com conquistas
- Formação acadêmica
- Habilidades por categoria
- Links para redes sociais
- Design totalmente responsivo
- Animações suaves ao scroll
- Hover effects interativos
- Footer profissional

## Próximos Passos

1. Personalize seus dados no controller
2. Troque a foto do perfil por sua imagem
3. Ajuste cores se desejar (tailwind.config.js)
4. Teste em diferentes dispositivos
5. Faça deploy quando estiver pronto!

## Precisa de Ajuda?

- Leia o README.md completo
- Consulte o dados.md para instruções de setup
- Documentação Laravel: https://laravel.com/docs
- Documentação Tailwind: https://tailwindcss.com/docs

Divirta-se personalizando seu currículo!

