# tasktracker
task tracker

# Установка
* composer install
* cp .env .env.local и настроить
* php bin/console doctrine:database:create
* php bin/console doctrine:migrations:migrate

# Тесты
./vendor/bin/codecept run unit

# Запуск
composer serve
