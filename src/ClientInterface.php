<?php

namespace AdiMihaila;

/**
 * Interface ClientInterface
 */
interface ClientInterface {

    public function createBucket(string $name);

    public function deleteBucket(string $name);

    public function getBuckets();

    public function getFile(string $bucket, string $name);

    public function putFile(string $bucket, string $file, string $name = null);

    public function removeFile(string $bucket, string $name);

    public function moveFile(
        string $sourceBucket,
        string $sourceName,
        string $destinationBucket,
        string $destinationName = null
    );
}