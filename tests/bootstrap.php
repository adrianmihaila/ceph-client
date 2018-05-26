<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

/**
 * Class BaseTestCase
 */
class BaseTestCase extends TestCase {

    protected function getS3ClientMock() {
        $mock = $this->getMockBuilder(\Aws\S3\S3Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->exactly(1))
            ->method('__call')
            ->withConsecutive(
                $this->equalTo('createBucket'),
                $this->equalTo('deleteBucket'),
                $this->equalTo('getBuckets'),
                $this->equalTo('getObject'),
                $this->equalTo('putObject'),
                $this->equalTo('deleteObject'),
                $this->equalTo('copyObject')
            )
            ->willReturn($this->getAwsResultMock());

        return $mock;
    }

    private function getAwsResultMock() {
        return $this->getMockBuilder(Aws\Result::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}