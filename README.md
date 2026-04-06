Тестовое задание для Nutnet 

Возможности
- список альбомов
- создание / редактирование / удаление
- автозаполнение через Last.fm API
- логирование изменений
- доступ только для авторизованных пользователей
- пагинация

 Стек
- Laravel
- MySQL
- Last.fm API

## Установка
bash
git clone https://github.com/mikish-dot/nutnet-albums.git
cd nutnet-albums
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build
php artisan serve
