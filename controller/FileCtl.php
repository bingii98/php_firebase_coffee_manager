<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';
include './config/Query.php';


class FileCtl
{

    protected $storage;
    protected $bucket;

    /**
     * UserCtl constructor.
     * @param $firebase
     */
    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount('./secret/key.json');
        $storage = $factory->createStorage();
        $this->storage = $storage;
        $this->bucket = $storage->getBucket('chbcoffee-4efec.appspot.com');
    }

    public function upload($file)
    {
        $uploadedObject = $this->bucket->upload(
            file_get_contents($_FILES['file']['tmp_name']),
            [
                'name' => $_FILES['file']['name']
            ]
        );
        $expiresAt = new \DateTime('2050-01-22');
        $uploadedObject->signedUrl($expiresAt).PHP_EOL;
        return $this->storage->getBucket()->object($_FILES['file']['name'])->signedUrl($expiresAt);
    }
}