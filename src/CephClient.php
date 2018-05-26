<?php

namespace AdiMihaila;

use Aws\Result;
use Aws\S3\S3Client;

/**
 * Class CephClient
 */
class CephClient implements ClientInterface {

    /** @var \Aws\S3\S3Client */
    private $s3Client;

    public function __construct(S3Client $s3Client) {
        $this->s3Client = $s3Client;
    }

    public function createBucket(string $name): Result {
        return $this->s3Client->createBucket([
            'Bucket' => $name,
        ]);
    }

    public function deleteBucket(string $name): Result {
        return $this->s3Client->deleteBucket([
            'Bucket' => $name,
        ]);
    }

    public function getBuckets(): Result {
        return $this->s3Client->listBuckets();
    }

    public function getFile(string $bucket, string $name): Result {
        return $this->s3Client->getObject([
            'Bucket' => $bucket,
            'Key' => $name,
        ]);
    }

    public function putFile(string $bucket, string $file, string $name = null): Result {
        if (is_null($name) || empty($name)) {
            $name = basename($file);
        }

        return $this->s3Client->putObject([
            'Bucket' => $bucket,
            'Key' => $name,
            'SourceFile' => $file,
            'ACL' => 'public-read'
        ]);
    }

    public function removeFile(string $bucket, string $name): Result {
        return $this->s3Client->deleteObject([
            'Bucket' => $bucket,
            'Key' => $name,
        ]);
    }

    public function moveFile(
        string $sourceBucket,
        string $sourceName,
        string $destinationBucket,
        string $destinationName = null
    ): Result {
        if (is_null($destinationName) || empty($destinationName)) {
            $destinationName = $sourceName;
        }

        return $this->s3Client->copyObject([
            'Bucket' => $sourceBucket,
            'Key' => $sourceName,
            'CopySource' => "{$destinationBucket}/{$destinationName}",
        ]);
    }
}