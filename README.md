<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://yiisoft.github.io/docs/images/yii_logo.svg" height="100px" alt="Yii">
    </a>
    <h1 align="center">Yii Application Template</h1>
    <h3 align="center">Application template for Yii 3 is best for rapidly creating projects</h3>
    <br>
</p>

[![Latest Stable Version](https://poser.pugx.org/yiisoft/app/v)](https://packagist.org/packages/yiisoft/app)
[![Total Downloads](https://poser.pugx.org/yiisoft/app/downloads)](https://packagist.org/packages/yiisoft/app)
[![Build status](https://github.com/yiisoft/app/actions/workflows/build.yml/badge.svg)](https://github.com/yiisoft/app/actions/workflows/build.yml)
[![Code Coverage](https://codecov.io/gh/yiisoft/app/branch/master/graph/badge.svg?token=TDZ2bErTcN)](https://codecov.io/gh/yiisoft/app)
[![static analysis](https://github.com/yiisoft/app/workflows/static%20analysis/badge.svg)](https://github.com/yiisoft/app/actions?query=workflow%3A%22static+analysis%22)
[![type-coverage](https://shepherd.dev/github/yiisoft/app/coverage.svg)](https://shepherd.dev/github/yiisoft/app)

Web application template for Yii 3.

<p align="center">
    <a href="https://github.com/yiisoft/app" target="_blank">
        <img src="docs/images/home.png" alt="Home page" >
    </a>
</p>

## Requirements

- PHP 8.1 or higher.

## Local installation

If you do not have [Composer](https://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](https://getcomposer.org/doc/00-intro.md).

Create a project:

```shell
composer create-project --stability=dev yiisoft/app myproject
cd myproject
```

To run the app:

```
APP_ENV=dev ./yii serve
```

Now you should be able to access the application through the URL printed to console.
Usually it is `http://localhost:8080`.

## Installation with Docker

Fork the repository, clone it, then:

```shell
cd myproject
make composer update
```

To run the app:

```shell
make up
```

To stop the app:

```shell
make down
```

The application is available at `https://localhost`.

## Directory structure

The application template has the following structure:

```
config/             Configuration files.
docker/             Docker-specific files.
docs/               Documentation.
public/             Files publically accessible from the Internet.
    assets/         Published assets.
    index.php       Entry script.
resources/          Application resources.
    assets/         Asset bundle resources.
    layout/         Layout view templates.
    messages/
    views/          View templates.
runtime/            Files generated during runtime.
src/                Application source code.
    Asset/          Asset bundle definitions.
    Command/        Console commands.
    Controller/     Web controller classes.
    EventHandler/
    Handler/
    ViewInjection/
tests/              A set of Codeception tests for the application.
vendor/             Installed Composer packages.
Makefile            Config for make command.
```

## Configuration

You can find configuration in `config` directory. There are multiple configs,
and the most interesting is `common\params.php`. Below there are details about its sections:

### Application Services

There are multiple pre-configured application services.

#### Aliases

```php
'yiisoft/aliases' => [
    'aliases' => [
        // standard directory aliases
        '@root' => dirname(__DIR__),
        '@assets' => '@root/public/assets',
        '@assetsUrl' => '/assets',
        '@npm' => '@root/node_modules',
        '@public' => '@root/public',
        '@resources' => '@root/resources',
        '@runtime' => '@root/runtime',
    ],
],
```

See ["Aliases"](https://github.com/yiisoft/docs/blob/master/guide/en/concept/aliases.md) in the guide.

#### Cache

```php
'yiisoft/cache-file' => [
    'file-cache' => [
        // cache directory path
        'path' => '@runtime/cache'
    ],
],
```

#### Log Target File

```php
use Psr\Log\LogLevel;

'yiisoft/log-target-file' => [
    'file-target' => [
        // route directory file log
        'file' => '@runtime/logs/app.log',
        // levels logs target
        'levels' => [
            LogLevel::EMERGENCY,
            LogLevel::ERROR,
            LogLevel::WARNING,
            LogLevel::INFO,
            LogLevel::DEBUG,
        ],
    ],
    'file-rotator' => [
        // maximum file size, in kilobytes. Defaults to 10240, meaning 10MB.
        'maxfilesize' => 10,
        // number of files used for rotation. Defaults to 5.
        'maxfiles' => 5,
        // the permission to be set for newly created files.
        'filemode' => null,
        // Whether to rotate files by copy and truncate in contrast to rotation by renaming files.
        'rotatebycopy' => null
    ],
],
```

See ["Logging"](https://github.com/yiisoft/docs/blob/master/guide/en/runtime/logging.md) in the guide.

#### Session

```php
'yiisoft/session' => [
    'session' => [
        // options for cookies
        'options' => ['cookie_secure' => 0],
        // session handler
        'handler' => null
    ],
],
```

#### View

```php
'yiisoft/view' => [
    // Custom parameters that are shared among view templates.
    'defaultParameters' => [
        'applicationParameters' => 'App\ApplicationParameters',
        'assetManager' => 'Yiisoft\Assets\AssetManager',
    ],
    'theme' => [
        // Apply pathMap example: ['@resources/layout' => '@resources/theme'] in yiisoft/app
        // Apply pathMap example: ['@resources/layout' => '@modulealiases/theme'] in module
        'pathMap' => [],
        'basePath' => '',
        'baseUrl' => '',
    ],    
],

```

#### Yii Debug

```php
'yiisoft/yii-debug' => [
    // enabled/disabled debugger
    'enabled' => true
],
```

#### Application Layout Parameters

```php
'app' => [
    'charset' => 'UTF-8',
    'language' => 'en',
    'name' => 'My Project',
],
```

## Testing

The template comes with ready to use [Codeception](https://codeception.com/) configuration.
To execute tests, in local installation run:

```shell
./vendor/bin/codecept build

APP_ENV=test ./yii serve > ./runtime/yii.log 2>&1 &
./vendor/bin/codecept run
```

For Docker:

```shell
make codecept build

make codecept run
```

## Static analysis

The code is statically analyzed with [Psalm](https://psalm.dev/). To run static analysis:

```shell
./vendor/bin/psalm
```

or, using Docker:

```shell
make psalm
```

## Support

If you need help or have a question, the [Yii Forum](https://forum.yiiframework.com/c/yii-3-0/63) is a good place for that.
You may also check out other [Yii Community Resources](https://www.yiiframework.com/community).

## License

The Yii application template is free software. It is released under the terms of the BSD License.
Please see [`LICENSE`](./LICENSE.md) for more information.

Maintained by [Yii Software](https://www.yiiframework.com/).

## Support the project

[![Open Collective](https://img.shields.io/badge/Open%20Collective-sponsor-7eadf1?logo=open%20collective&logoColor=7eadf1&labelColor=555555)](https://opencollective.com/yiisoft)

## Follow updates

[![Official website](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/)
[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/yiiframework)
[![Telegram](https://img.shields.io/badge/telegram-join-1DA1F2?style=flat&logo=telegram)](https://t.me/yii3en)
[![Facebook](https://img.shields.io/badge/facebook-join-1DA1F2?style=flat&logo=facebook&logoColor=ffffff)](https://www.facebook.com/groups/yiitalk)
[![Slack](https://img.shields.io/badge/slack-join-1DA1F2?style=flat&logo=slack)](https://yiiframework.com/go/slack)
