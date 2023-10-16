<?php

return [
    // nu others things
    'components' => [
        'filesystem' => [
            'class' => 'app\components\Filesystem',
            'fsType' => 's3',
            'localOptions' => [
                'baseDir' => '/path/to/local/filesystem',
            ],
            's3Options' => [
                'key' => 'YOUR_AWS_ACCESS_KEY',
                'secret' => 'YOUR_AWS_SECRET_KEY',
                'region' => 'YOUR_AWS_REGION',
                'bucket' => 'YOUR_AWS_BUCKET',
            ],
        ],
    ],
    // nu others things
];