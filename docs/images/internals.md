# Internals

The template comes with ready to use [Codeception](https://codeception.com/) configuration.
In order to execute tests run:

```shell
composer run serve > ./runtime/yii.log 2>&1 &
vendor/bin/codecept run
```

## Static analysis

The code is statically analyzed with [Psalm](https://psalm.dev/). To run static analysis:

```shell
./vendor/bin/psalm
```
