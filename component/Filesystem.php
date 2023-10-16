<?php

namespace app\components;

use Yii;
use yii\base\Component;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class Filesystem extends Component
{
    public $fsType = 'local';
    public $localOptions = [];
    public $s3Options = [];

    public function getAdapter()
    {
        if ($this->fsType === 's3') {
            $adapter = new AwsS3Adapter(
                new S3Client([
                    'credentials' => [
                        'key' => $this->s3Options['key'],
                        'secret' => $this->s3Options['secret'],
                    ],
                    'region' => $this->s3Options['region'],
                    'version' => 'latest',
                ]),
                $this->s3Options['bucket']
            );
        } else {
            $adapter = new LocalAdapter($this->localOptions['baseDir']);
        }

        return new Filesystem($adapter);
    }
}