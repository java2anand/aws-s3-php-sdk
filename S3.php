<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Description of AmazonS3
 *
 * @author wahyu widodo
 */
include ("../../libraries/vendor/autoload.php");

use Aws\S3\S3Client;

class S3 {

    private $S3;

    public function __construct() {
        $this->S3 = S3Client::factory([
            'credentials' => array(
                'key' => 'aws_key',
                'secret' => 'aws_secret'
            ),
            'region' => 'ap-south-1',
            'version' => 'latest',
        ]);
    }

    public function addBucket($bucketName) {
        $result = $this->S3->createBucket(array(
            'Bucket' => $bucketName,
            'LocationConstraint' => 'ap-south-1'));
        return $result;
    }

    public function sendFile($bucketName, $filename) {
        $result = $this->S3->putObject(array(
            'Bucket' => $bucketName,
            'Key' => $filename['name'],
            'SourceFile' => $filename['tmp_name'],
            'ContentType' => 'image/png',
            'StorageClass' => 'STANDARD',
            'ACL' => 'public-read'
        ));
        return $result['ObjectURL'] . "\n";
    }
    
    public function deleteFile($bucketName, $filename){
        $result = $this->S3->deleteObject(array(
            'Bucket' => $bucketName,
            'Key' => $filename
        ));
        return $result;
    }

}
