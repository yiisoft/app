@echo off
@setlocal
set YII_PATH=%~dp0
if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe
"%PHP_COMMAND%" "%YII_PATH%yii" %*
@endlocal
