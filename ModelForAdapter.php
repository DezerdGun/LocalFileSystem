<?php

namespace app\models;

use yii\base\Model;

class FileModel extends Model
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false],
        ];
    }

    public function upload($adapter, $path)
    {
        if ($this->validate()) {
            $contents = file_get_contents($this->file->tempName);
            $adapter->write($path, $contents);
            return true;
        } else {
            return false;
        }
    }
}