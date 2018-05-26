# CephClient [![Build Status](https://travis-ci.org/adrianmihaila/working-with-ceph-in-php.svg?branch=master)](https://travis-ci.org/adrianmihaila/working-with-ceph-in-php)

Provides a CephClient for storing files in PHP.

## Installation
```
composer require adimihaila/ceph-client
```

## Usage
```
<?php

use Aws\S3\S3Client;
use AdiMihaila\CephClient;

$s3Client = new S3Client([
    'version' => 'latest',
    'region' => '',
    'endpoint' => 'CEPH_ENDPOINT',
    'credentials' => [
        'key' => 'CEPH_KEY',
        'secret' => 'CEPH_SECRET',
    ],
]);

$client = new CephClient($s3Client);

// Create a new bucket.
$bucketName = 'BUCKET_NAME';
$client->createBucket($bucketName);

// Dump all existing buckets.
foreach ($client->getBuckets() as $bucket) {
    var_dump($bucket);
}

// Put a file in the new bucket and dump the result.
$file = 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png';
$result = $client->putFile($bucketName, $file);
var_dump($result);

// Get the new file from bucket and dump the result.
$fileName = basename($file);
$result = $client->getFile($bucketName, $fileName);
var_dump($result);
```