# Библиотека Library-App

## Описание

Library-App - это PHP-приложение для управления библиотекой. Включает в себя функционал для работы с книгами, авторами, читателями и процессом выдачи книг.

## Структура проекта

'''
PHP
├─ library-app
│  ├─ apache_config.conf
│  ├─ composer.json
│  ├─ composer.lock
│  ├─ config
│  │  └─ database.php
│  ├─ docker-compose.yml
│  ├─ Dockerfile
│  ├─ initialize_db.php
│  ├─ public
│  │  ├─ .htaccess
│  │  └─ index.php
│  ├─ src
│  │  ├─ Contracts
│  │  ├─ Controller
│  │  ├─ Exception
│  │  ├─ Helper
│  │  ├─ Http
│  │  ├─ Model
│  │  ├─ Repository
│  │  ├─ Router
│  │  └─ Service
│  └─ vendor
└─ README.md
'''

## Ключевые файлы и директории

- `apache_config.conf`: Конфигурация Apache сервера.
- `composer.json` и `composer.lock`: Конфигурация Composer для управления зависимостями PHP.
- `config/database.php`: Конфигурация подключения к базе данных.
- `docker-compose.yml` и `Dockerfile`: Настройки Docker для создания контейнеризованной среды.
- `initialize_db.php`: Скрипт для инициализации базы данных.
- `public`: Публичная директория, доступная для пользователей.
  - `.htaccess` и `index.php`: Настройки Apache и точка входа в приложение.
- `src`: Исходный код приложения.
  - `Contracts`: Определения интерфейсов для компонентов.
  - `Controller`: Контроллеры для обработки запросов.
  - `Exception`: Определения исключений.
  - `Helper`: Вспомогательные классы, например, для подключения к базе данных.
  - `Http`: Компоненты для работы с HTTP-запросами и ответами.
  - `Model`: Модели данных.
  - `Repository`: Репозитории для работы с базой данных.
  - `Router`: Маршрутизация запросов.
  - `Service`: Сервисы для бизнес-логики.
- `vendor`: Зависимости, установленные через Composer.

## Установка и запуск

1. Клонируйте репозиторий.
2. Установите зависимости через Composer.
3. Настройте `config/database.php` с вашими параметрами БД.
4. Запустите `initialize_db.php` для инициализации БД.
5. Используйте `docker-compose` для запуска контейнера с приложением.
