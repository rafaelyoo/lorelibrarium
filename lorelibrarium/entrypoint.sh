#!/bin/sh

# Garante que o npm e o node estão no PATH
export PATH="$PATH:/usr/local/bin"

echo "🌟 Ambiente: $APP_ENV"

# Se for produção, só builda o front
if [ "$APP_ENV" = "production" ]; then
  echo "🔧 Ambiente de produção: instalando dependências e buildando..."
  npm ci && npm run build
else
  echo "💻 Ambiente de desenvolvimento: instalando dependências e rodando npm run dev..."
  npm install && npm run dev &
fi

# Rodar PHP-FPM em foreground (mantém o container vivo)
echo "🚀 Iniciando PHP-FPM..."
exec php-fpm
