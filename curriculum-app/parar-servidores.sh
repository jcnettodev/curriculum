#!/bin/bash

# Script para parar os servidores do projeto Laravel

echo "🛑 Parando servidores do Curriculum Laravel..."
echo ""

# Parar servidor Laravel
if pgrep -f "php artisan serve" > /dev/null; then
    pkill -f "php artisan serve"
    echo "✅ Servidor Laravel parado"
else
    echo "ℹ️  Servidor Laravel não estava rodando"
fi

# Parar Vite
if pgrep -f "vite" > /dev/null; then
    pkill -f "vite"
    echo "✅ Vite parado"
else
    echo "ℹ️  Vite não estava rodando"
fi

echo ""
echo "✅ Todos os servidores foram parados"
echo ""

