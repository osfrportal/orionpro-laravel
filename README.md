Взаимодействие с Модулем интеграции АРМ Орион ПРО в части работы с подсистемой СКУД.

Системные требования - 
* Laravel 10
* php >= 8.1

После установки пакета необходимо опубликовать настройки и миграции
php artisan vendor:publish --provider="Osfrportal\OrionproLaravel\Providers\OrionproServiceProvider\"

в файл .env добавить адрес сервера с развернутым Модулем интеграции АРМ Орион ПРО
ORION_RFID_SOAP_URL = http://....


Интерфейс API для работы с данными
/api/osfr/v1/orionpro/*

