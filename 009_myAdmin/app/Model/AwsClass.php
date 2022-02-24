<?php

namespace app\Model;

use Aws\S3\S3Client;  
use Aws\Exception\AwsException;



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



}