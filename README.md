# tasktracker
task tracker

# Установка

## Настройка

### Настройка окружения

    cp .env .env.local и настроить

## Запуск сервера

### Используя Docker

Установить пакеты и выполнить миграции

    docker-compose run --rm php composer install
    
    docker-compose run --rm php php bin/console doctrine:migrations:migrate

Запустить контейнер

    docker-compose up --build

### Используя встроенный сервер

Установить пакеты, создать базу и выполнить миграции

    composer install

    php bin/console doctrine:database:create

    php bin/console doctrine:migrations:migrate

Запустить

    composer serve



# Тесты

Локально

    ./vendor/bin/codecept run unit

Docker

    docker-compose run --rm php ./vendor/bin/codecept run unit
