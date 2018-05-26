<?php

require_once __DIR__ . '/../src/CephClient.php';

use AdiMihaila\CephClient;

/**
 * Class CephClientTest
 */
class CephClientTest extends BaseTestCase {

    /** @var CephClient */
    protected $client;

    public function setUp() {
        $this->client = new CephClient(
            $this->getS3ClientMock()
        );
    }

    public function testCreateBucket() {
        $result = $this->client->createBucket('bucket-name');

        $this->assertInstanceOf(\Aws\Result::class, $result);
    }

    public function testDeleteBucket() {
        $result = $this->client->deleteBucket('bucket-name');

        $this->assertInstanceOf(\Aws\Result::class, $result);
    }

    public function testGetBuckets() {
        $result = $this->client->getBuckets();

        $this->assertInstanceOf(\Aws\Result::class, $result);
    }

    public function testGetFile() {
        $result = $this->client->getFile('bucket-name', 'file-name.jpg');

        $this->assertInstanceOf(\Aws\Result::class, $result);
    }

    public function testPutFileWithNullFileName() {
        $result = $this->client->putFile('bucket-name', '/path/file-name.jpg');

        $this->assertInstanceOf(\Aws\Result::class, $result);
    }

    public function testPutFileWithEmptyFileName() {
        $result = $this->client->putFile('bucket-name', '/path/file-name.jpg', '');

        $this->assertInstanceOf(\Aws\Result::class, $result);
    }

    public function testPutFileWithFileName() {
        $result = $this->client->putFile('bucket-name', '/path/file-name.jpg', 'new-file-name.jpg');

        $this->assertInstanceOf(\Aws\Result::class, $result);
    }

    public function testRemoveFile() {
        $result = $this->client->removeFile('bucket-name', 'new-file-name.jpg');

        $this->assertInstanceOf(\Aws\Result::class, $result);
    }

    public function testMoveFileWithNullDestinationFileName() {
        $result = $this->client->moveFile(
            'source-bucket-name',
            '/path/file-name.jpg',
            'destination-bucket-name'
        );

        $this->assertInstanceOf(\Aws\Result::class, $result);
    }

    public function testMoveFileWithEmptyDestinationFileName() {
        $result = $this->client->moveFile(
            'source-bucket-name',
            '/path/file-name.jpg',
            'destination-bucket-name',
            ''
        );

        $this->assertInstanceOf(\Aws\Result::class, $result);
    }

    public function testMoveFileWithDestinationFileName() {
        $result = $this->client->moveFile(
            'source-bucket-name',
            '/path/file-name.jpg',
            'destination-bucket-name',
            'destination-file-name.jpg'
        );

        $this->assertInstanceOf(\Aws\Result::class, $result);
    }
}