<?php

namespace app\Model;

use Aws\S3\S3Client;  
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;

class AwsClass {

    private static $s3Client;
    private static $bucket;
    private static $region;

    // __________________________________

    public static function getS3Client () {

        if (!isset(self::$s3Client)) {
           self::init();
        }
        return self::$s3Client;
    }

    // __________________________________

    public static function init () {

        self::$bucket = $_ENV['AWS_S3_BUCKET'];
        self::$region = MyCript::decrypt($_ENV['AWS_REGION']);

        $region = self::$region;
        $key    = MyCript::decrypt($_ENV['AWS_ACCESS_KEY_ID']);
        $secret = MyCript::decrypt($_ENV['AWS_SECRET_ACCESS_KEY']);
        
        self::$s3Client = new S3Client([  
            'version' => 'latest',
            'region' => $region,
            'credentials' => [
                'key' => $key,
                'secret' => $secret
            ]
        ]);         
    }

    // __________________________________

    public static function uploadImage ($key, $file_Path) {

        if (!isset(self::$s3Client)) { self::init(); }

        try {
 
            $s3Client = self::$s3Client;

            $result = $s3Client->putObject([
                'Bucket'        => self::$bucket,
                'Key'           => $key,
                'SourceFile'    => $file_Path,
                'ACL'           => 'public-read', // make file 'public'
            ]);

            return $result;

        } catch (S3Exception $e) {

            $msg = "Error AwsClass getS3Client: <br>" .  $e->getMessage();
            error_log($msg);
            die($msg);
        }
    }

    // __________________________________



}