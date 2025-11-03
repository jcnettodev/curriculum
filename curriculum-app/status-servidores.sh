#!/bin/bash

# Script para verificar o status dos servidores

echo "🔍 Status dos Servidores"
echo "========================"
echo ""

# Verificar Laravel
if pgrep -f "php artisan serve" > /dev/null; then
    echo "✅ Servidor Laravel: RODANDO"
    echo "   📍 http://127.0.0.1:8000"
else
    echo "❌ Servidor Laravel: PARADO"
fi

echo ""

# Verificar Vite
if pgrep -f "vite" > /dev/null; then
    echo "✅ Vite: RODANDO"
    echo "   📍 http://localhost:5173"
else
    echo "❌ Vite: PARADO"
fi

echo ""

# Testar conexão
if curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1:8000/ | grep -q "200"; then
    echo "✅ Página acessível em http://127.0.0.1:8000"
else
    echo "❌ Página não está acessível"
fi

echo ""

