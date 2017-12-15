<?php
/**
 * Created by PhpStorm.
 * User: adrian.mihaila
 * Date: 12/15/2017
 * Time: 2:46 PM
 */

require 'vendor/autoload.php';

use Aws\S3\S3Client as Storage;
use App\Storage\CephClient;

$storage = new Storage([
    'version' => 'latest',
    'region' => '',
    'endpoint' => 'CEPH_ENDPOINT',
    'credentials' => [
        'key' => 'CEPH_KEY',
        'secret' => 'CEPH_SECRET',
    ],
]);

$client = new CephClient($storage);

// Create a new bucket.
$bucketName = 'BUCKET_NAME';
$client->createBucket($bucketName);

// Dump all existing buckets.
foreach ($client->getBuckets() as $bucket) {
    var_dump($bucket);
}

// Put a file in the new bucket and dump the result.
$filePath = 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png';
$fileName = basename($filePath);
$result = $client->putFile($bucketName, $fileName, $filePath);
var_dump($result);

// Get the new file from bucket and dump the result.
$result = $client->getFile($bucketName, $fileName);
var_dump($result);
