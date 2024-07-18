<?php

namespace Somecoding\Codingstandard;


class Installer
{
    public static function postInstallRun()
    {
        echo 'Installing config files'.PHP_EOL;
        $dir = getcwd();
        $filename = '.phpcstd.ini';
        $fileWithPath = $dir.'/'.$filename;
        if(!file_exists($fileWithPath)){
            file_put_contents($fileWithPath, 'include=vendor/somecoding/codingstandard/config/');
            echo 'Created config'.PHP_EOL;
        }else {
            echo 'File already exists'.PHP_EOL;
        }
    }

    public static function cleanup()
    {
        $dir = getcwd();
        $filename = '.phpcstd.ini';
        $fileWithPath = $dir.'/'.$filename;
        if(file_exists($fileWithPath)){
            unlink($fileWithPath);
        }
    }


}