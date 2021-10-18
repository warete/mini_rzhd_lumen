# Mini rzhd

Домашний проект с мини-сервисом для покупки железнодорожных билетов.

Старт проекта:
```
mkdir -p storage/framework/session
touch storage/db.sqlite
docker-compose up -d
docker-compose exec backend bash
php artisan db:wipe
php artisan migrate
php artisan db:seed
```
