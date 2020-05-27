<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="80px">
    </a>
    <h1 align="center">Skeleton Web Application for Yii.</h1>
    <br>
</p>

[![Latest Stable Version](https://poser.pugx.org/yiisoft/app/v/stable.png)](https://packagist.org/packages/yiisoft/app)
[![Total Downloads](https://poser.pugx.org/yiisoft/app/downloads.png)](https://packagist.org/packages/yiisoft/app)
[![build](https://github.com/yiisoft/app/workflows/build/badge.svg)](https://github.com/yiisoft/app/actions)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yiisoft/app/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yiisoft/app/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/yiisoft/app/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/yiisoft/app/?branch=master)

Yii Skeleton Web Application for Yii 3 application best for rapidly creating projects.

DIRECTORY STRUCTURE
-------------------

      config/             contains application configurations
      resources/layout    contains layout files for the web application
      resources/view      contains view files for the web application
      app/                application directory
          Asset/          contains assets definition
          Controller/     contains Web controller classes
          Factory/        contains factory classes files for config
          Helper/         contains helper classes
          Provider/       contains provider classes for config
          Widget/         contains widget classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages      
      public/             contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.4.0.


INSTALLATION
------------

### Install via Composer:

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
composer create-project --prefer-dist --stability dev yiisoft/app <your project>
~~~

Now you should be able to access the application through the following URL, assuming `app` is the directory
directly under the `public` root.

### Run web server build in php:

~~~
php -S 127.0.0.1:8080 -t public
~~~

### Run web application php:

~~~
http://localhost:8080
~~~

### Run test codeception:

~~~
php -S 127.0.0.1:8080 -t public > yii.log 2>&1 &
vendor/bin/codecept run
~~~
