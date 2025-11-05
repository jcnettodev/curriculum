#!/bin/bash

# Script para iniciar os servidores do projeto Laravel

echo "🚀 Iniciando servidores do Curriculum Laravel..."
echo ""

cd "$(dirname "$0")"

# Verificar se os servidores já estão rodando
if pgrep -f "php artisan serve" > /dev/null; then
    echo "⚠️  Servidor Laravel já está rodando"
else
    echo "▶️  Iniciando servidor Laravel (porta 8000)..."
    php artisan serve --host=127.0.0.1 --port=8000 > storage/logs/laravel-server.log 2>&1 &
    sleep 2
    echo "✅ Servidor Laravel iniciado"
fi

if pgrep -f "vite" > /dev/null; then
    echo "⚠️  Vite já está rodando"
else
    echo "▶️  Iniciando Vite (porta 5173)..."
    npm run dev > storage/logs/vite.log 2>&1 &
    sleep 3
    echo "✅ Vite iniciado"
fi

echo ""
echo "✨ Servidores iniciados com sucesso!"
echo ""
echo "📍 Acesse: http://127.0.0.1:8000"
echo "📍 Vite: http://localhost:5173"
echo ""
echo "💡 Para parar os servidores, execute: ./parar-servidores.sh"
echo ""

