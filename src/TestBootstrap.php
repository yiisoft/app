<?php


namespace App;


final class TestBootstrap
{
    public static function bootstrap(): void
    {
        var_dump('I am test bootstrap.');
        die();
    }
}
