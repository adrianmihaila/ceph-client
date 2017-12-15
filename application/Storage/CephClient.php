<?php

/**
 * Created by PhpStorm.
 * User: adrian.mihaila
 * Date: 12/15/2017
 * Time: 3:37 PM
 */

namespace App\Storage;

use App\StorageClientInterface;

/**
 * Class CephClient
 */
class CephClient implements StorageClientInterface {

    private $storage;

    public function __construct($storage) {
        $this->storage = $storage;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function createBucket($name) {
        return $this->storage->createBucket([
            'Bucket' => $name,
        ]);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function deleteBucket($name) {
        return $this->storage->deleteBucket([
            'Bucket' => $name,
        ]);
    }

    /**
     * @return mixed
     */
    public function getBuckets() {
        return $this->storage->listBuckets();
    }

    /**
     * @param $bucket
     * @param $name
     *
     * @return mixed
     */
    public function getFile($bucket, $name) {
        return $this->storage->getObject([
            'Bucket' => $bucket,
            'Key' => $name,
        ]);
    }

    /**
     * @param $bucket
     * @param $name
     * @param $content
     *
     * @return mixed
     */
    public function putFile($bucket, $name, $content) {
        return $this->storage->putObject([
            'Bucket' => $bucket,
            'Key' => $name,
            'Body' => $content,
            //'SourceFile' => $content,
            //'ACL' => 'public-read'
        ]);
    }

    /**
     * @param $bucket
     * @param $name
     *
     * @return mixed
     */
    public function removeFile($bucket, $name) {
        return $this->storage->deleteObject([
            'Bucket' => $bucket,
            'Key' => $name,
        ]);
    }

    public function moveFile(
        $sourceBucket,
        $sourceName,
        $destinationBucket,
        $destinationName = null
    ) {
        return $this->storage->copyObject([
            'Bucket' => $sourceBucket,
            'Key' => $sourceName,
            'CopySource' => "{$destinationBucket}/{$destinationName}",
        ]);
    }
}