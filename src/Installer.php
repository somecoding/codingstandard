<?php

namespace Somecoding\Codingstandard;


class Installer
{
    protected const string PHP_7_4 = '74';
    protected const string PHP_8_0 = '80';
    protected const string PHP_8_1 = '81';
    protected const string PHP_8_2 = '82';
    protected const string PHP_8_3 = '83';
    protected const string PHP_8_4 = '84';
    protected const string PACKAGE_NAME = 'somecoding/codingstandard';

    public static function postInstallRun()
    {
        echo 'Installing config files' . PHP_EOL;
        $dir = getcwd();
        $filename = '.phpcstd.ini';
        $fileWithPath = $dir . '/' . $filename;
        if (!file_exists($fileWithPath)) {

            $content = match(self::detectPhpVersion()){
                self::PHP_7_4 => 'include=vendor/' . self::PACKAGE_NAME . '/74/',
                self::PHP_8_0 => 'include=vendor/' . self::PACKAGE_NAME . '/80/',
                self::PHP_8_1 => 'include=vendor/' . self::PACKAGE_NAME . '/81/',
                self::PHP_8_2 => 'include=vendor/' . self::PACKAGE_NAME . '/82/',
                self::PHP_8_3 => 'include=vendor/' . self::PACKAGE_NAME . '/83/',
                self::PHP_8_4 => throw new \InvalidArgumentException('8.4 Support not enabled -> please create a PR'),
                default => throw new \InvalidArgumentException('Unsupportet PHP Verison'. PHP_VERSION),
            };
            file_put_contents($fileWithPath, $content);
            echo 'Created config with PHP: '.self::detectPhpVersion() . PHP_EOL;
        } else {
            echo 'File already exists' . PHP_EOL;
        }
    }

    public static function cleanup()
    {
        $dir = getcwd();
        $filename = '.phpcstd.ini';
        $fileWithPath = $dir . '/' . $filename;
        if (file_exists($fileWithPath)) {
            unlink($fileWithPath);
        }
    }

    protected static function detectPhpVersion()
    {
        $version = explode('.', PHP_VERSION);
        return $version[0] . $version[1];
    }


}