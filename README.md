# Laravel-Aliyun-OSS for Laravel 5.5+
迫于 [jacobcyl/Aliyun-oss-storage](https://github.com/jacobcyl/Aliyun-oss-storage) 断更，所以自己来了，主要修改了以下几点：

1. 修复了原 repo 的几个 pull request，更新了 Aliyun OSS 的 SDK
2. 删除了上传远程图片的方法
3. 删除了获取 url 时，需要去 OSS 较验文件是否存在的代码

## Require
- Laravel 5.5+
- cURL extension

##Installation
In order to install Aliyun-OSS-storage, just run below command to install:

    composer require leo-yi/laravel-aliyun-oss

## Configuration
Add the following in app/filesystems.php:
```php
// config/filesystems.php
'disks' =>[
    'oss' => [
        'driver' => 'oss',
        'access_id' => env('ALIYUN_OSS_AK', ''),
        'access_key' => env('ALIYUN_OSS_SK', ''),
        'bucket' => env('ALIYUN_OSS_BUCKET', ''),
        'endpoint' => env('ALIYUN_OSS_ENDPOINT', ''), // 外网节点
        'endpoint_internal' => env('ALIYUN_OSS_ENDPOINT_INTERNAL', ''), // 内网节点
        'cdnDomain' => env('ALIYUN_OSS_CDN_DOMAIN', ''),
        'ssl' => false,
        'isCName' => false,
        'debug' => true,
    ],
```
Then set the default driver in app/filesystems.php:
```php
'default' => 'oss',
```
Ok, well! You are finish to configure. Just feel free to use Aliyun OSS like Storage!

## Usage
See [Larave doc for Storage](https://laravel.com/docs/)
Or you can learn here:

> First you must use Storage facade

```php
use Illuminate\Support\Facades\Storage;
```    
> Then You can use all APIs of laravel Storage

```php
Storage::disk('oss'); // if default filesystems driver is oss, you can skip this step

//fetch all files of specified bucket(see upond configuration)
Storage::files($directory);
Storage::allFiles($directory);

Storage::put('path/to/file/file.jpg', $contents); //first parameter is the target file path, second paramter is file content
Storage::putFile('path/to/file/file.jpg', 'local/path/to/local_file.jpg'); // upload file from local path

Storage::get('path/to/file/file.jpg'); // get the file object by path
Storage::exists('path/to/file/file.jpg'); // determine if a given file exists on the storage(OSS)
Storage::size('path/to/file/file.jpg'); // get the file size (Byte)
Storage::lastModified('path/to/file/file.jpg'); // get date of last modification

Storage::directories($directory); // Get all of the directories within a given directory
Storage::allDirectories($directory); // Get all (recursive) of the directories within a given directory

Storage::copy('old/file1.jpg', 'new/file1.jpg');
Storage::move('old/file1.jpg', 'new/file1.jpg');
Storage::rename('path/to/file1.jpg', 'path/to/file2.jpg');

Storage::prepend('file.log', 'Prepended Text'); // Prepend to a file.
Storage::append('file.log', 'Appended Text'); // Append to a file.

Storage::delete('file.jpg');
Storage::delete(['file1.jpg', 'file2.jpg']);

Storage::makeDirectory($directory); // Create a directory.
Storage::deleteDirectory($directory); // Recursively delete a directory.It will delete all files within a given directory, SO Use with caution please.

Storage::url('path/to/img.jpg') // get the file url
```

## Documentation
More development detail see [Aliyun OSS DOC](https://help.aliyun.com/document_detail/32099.html)

## License
Source code is release under MIT license. Read LICENSE file for more information.
