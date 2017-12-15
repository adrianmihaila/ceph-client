<?php

/**
 * Created by PhpStorm.
 * User: adrian.mihaila
 * Date: 12/15/2017
 * Time: 3:08 PM
 */

namespace App;

/**
 * Interface StorageClientInterface
 */
interface StorageClientInterface {

    /**
     * @param $name
     *
     * @return mixed
     */
    public function createBucket($name);

    /**
     * @param $name
     *
     * @return mixed
     */
    public function deleteBucket($name);

    /**
     * @return mixed
     */
    public function getBuckets();

    /**
     * @param $bucket
     * @param $name
     *
     * @return mixed
     */
    public function getFile($bucket, $name);

    /**
     * @param $bucket
     * @param $file
     * @param null $name
     *
     * @return mixed
     */
    public function putFile($bucket, $file, $name = null);

    /**
     * @param $bucket
     * @param $name
     *
     * @return bool
     */
    public function removeFile($bucket, $name);

    /**
     * @param $sourceBucket
     * @param $sourceName
     * @param $destinationBucket
     * @param $destinationName
     *
     * @return mixed
     */
    public function moveFile(
        $sourceBucket,
        $sourceName,
        $destinationBucket,
        $destinationName = null
    );
}