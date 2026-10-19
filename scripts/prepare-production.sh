#!/usr/bin/env bash

set -euo pipefail

script_dir="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)"
repository_root="$(cd -- "${script_dir}/.." && pwd)"
cd -- "${repository_root}"

composer install --no-dev --no-interaction --no-progress --prefer-dist --optimize-autoloader
composer audit --locked --no-interaction
test -s public/build/manifest.json

APP_ENV=production APP_DEBUG=false php artisan route:cache --no-interaction
APP_ENV=production APP_DEBUG=false php artisan event:cache --no-interaction
APP_ENV=production APP_DEBUG=false php artisan view:cache --no-interaction
