<?php

namespace App\Providers;

use Storage;
use League\Flysystem\Filesystem;
use Srmklive\Dropbox\Client\DropboxClient;
use Srmklive\Dropbox\Adapter\DropboxAdapter;
use Illuminate\Support\ServiceProvider;

class DropboxFilesystemServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Storage::extend('dropbox', function ($app, $config) {

            $client = new DropboxClient($config['accessToken']);

            $adapter = new DropboxAdapter($client);

            return new Filesystem($adapter);

            // $client = new DropboxClient($config['accessToken'], $config['appSecret']);

            // return new Filesystem(new DropboxAdapter($client));
        });
    }

    public function register()
    {
        //
    }
}