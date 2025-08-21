<p><h1 align="center">Веб-сайт музыканта - Александра Николайчук</h1></p>

Исходные файлы Yii2-проекта официального веб-сайта музыканта - Александра Николайчук.

Версия Yii2-фреймворка:

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-basic.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-basic)

СТРУКТУРА ПРОЕКТА
-------------------

      assets/             содержит определение assets
      commands/           содержит консольные команды (контроллеры)
      config/             содержит общую конфигурацию приложения
      messages/           содержит файлы переводов текстов для интернационализации сайта 
      migrations/         содержит все миграции БД
      modules/            содержит два основных модули сайта
      modules/admin/      содержит модуль администрирования сайта
      modules/client/     содержит модуль клиентской части сайта
      web/                содержит все веб-ресурсы сайта (стили, скрипты и т.д.)



ТРЕБОВАНИЯ
------------

Минимальное требование проекта - поддержка PHP 8.0 и выше


КОНФИГУРАЦИЯ
-------------

### СУБД PostrgeSQL

Отредактируйте файл `config/db.php`, например:

```php
return [
    'class' => 'yii\db\Connection',
        'dsn' => 'pgsql:host=localhost;port=5432;dbname=alexnikolydb;',
        'username' => 'postgres',
        'password' => 'admin',
        'charset' => 'utf8',
        'tablePrefix' => 'alexnikoly_',
        'schemaMap' => [
            'pgsql'=> [
                'class'=>'yii\db\pgsql\Schema',
                'defaultSchema' => 'public'
            ]
        ],
];
```