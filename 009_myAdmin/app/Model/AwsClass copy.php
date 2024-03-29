<?php

namespace app\Model;

use Aws\S3\S3Client;  
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;

class AwsClass {

    protected static $s3Client;
    protected static $bucket;
    protected static $region;

    // __________________________________

    public static function getS3Client () {

        if (!isset(self::$s3Client)) {
           self::init();
        }
        return self::$s3Client;
    }

    // __________________________________

    public static function init () {

        try {

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

        } catch (S3Exception $e) {

            $msg = "Error AwsClass init: <br>" .  $e->getMessage();
            error_log($msg);
            die($msg);
        }        
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

            $msg = "Error AwsClass uploadImage: <br>" .  $e->getMessage();
            error_log($msg);
            die($msg);
        }
    }

    // __________________________________

    public static function removeImage ($key) {

        if (!isset(self::$s3Client)) { self::init(); }

        try {

            $s3Client = self::$s3Client;
 
            $result = $s3Client->deleteObjects([
                'Bucket'  => self::$bucket,
                'Delete' => [
                    'Objects' => [
                        [ 'Key' => $key ]
                    ]
                ]
            ]);


            return $result;

        } catch (S3Exception $e) {

            $msg = "Error AwsClass removeImage: <br>" .  $e->getMessage();
            error_log($msg);
            die($msg);
        }
    }

    // __________________________________
    
    public static function deleteProjectsImagesFromAWS (...$projectIds) {

        if (empty($projectIds)) return;

        if (!isset(self::$s3Client)) { self::init(); }

        try {

            $s3Client = self::$s3Client;

            $currentUser = unserialize($_SESSION['currentUser']);
            $userId = $currentUser->getId();

            $bucket = $_ENV['AWS_S3_BUCKET'];


            foreach ($projectIds as $pId) {

                // 1. List the project objects in AWS

                $objects = $s3Client->listObjects([
                    'Bucket' => $bucket,
                    'Prefix' => "user{$userId}/poject{$pId}/"
                ]);

                // 2. Delete all project objects from AWS.

                if (!$objects['Contents']) continue;

                foreach ($objects['Contents'] as $imgObj) {
                    $s3Client->deleteObjects([
                        'Bucket'  => $bucket,
                        'Delete' => [
                            'Objects' => [
                                [
                                    'Key' => $imgObj['Key']
                                ]
                            ]
                        ]
                    ]);
                }
            }


        } catch (S3Exception $e) {

            $msg = "Error AwsClass removeImage: <br>" .  $e->getMessage();
            error_log($msg);
            die($msg);
        }
    }

    // __________________________________
}