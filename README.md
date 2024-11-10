# Порядок запуска
- Переименовать файл окружения `cp .env.local .env`
- Установка зависимостей
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
- Запуск докера `./vendor/bin/sail up`
- Запуск миграций `./vendor/bin/sail php artisan  migrate`

# Тесты
Запуск тестов `./vendor/bin/sail php artisan test`

# Документация
/docs/swagger.yml
