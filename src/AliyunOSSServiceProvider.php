<?php

namespace LeoYi\AliyunOSS;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use OSS\OssClient;


class AliyunOSSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Storage::extend('oss', function ($app, $config) {
            $accessId = $config['access_id'];
            $accessKey = $config['access_key'];

            $cdnDomain = empty($config['cdnDomain']) ? '' : $config['cdnDomain'];
            $bucket = $config['bucket'];
            $ssl = empty($config['ssl']) ? false : $config['ssl'];
            $isCname = empty($config['isCName']) ? false : $config['isCName'];
            $debug = empty($config['debug']) ? false : $config['debug'];
            $endPoint = $config['endpoint'];
            $epInternal = empty($config['endpoint_internal']) ? $endPoint : $config['endpoint_internal'];
            if ($debug) {
                Log::debug('OSS config:', $config);
            }
            $client = new OssClient($accessId, $accessKey, $epInternal, $isCname);
            $adapter = new AliyunOSSAdapter($client, $bucket, $endPoint, $ssl, $isCname, $debug, $cdnDomain);

            return new Filesystem($adapter);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
