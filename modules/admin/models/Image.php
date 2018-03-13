<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\web\UploadedFile;

class Image extends Model
{
    /** @var UploadedFile */
    public $attachment;

    public function rules()
    {
        return [
            [['attachment'], 'required'],
            [['attachment'], 'file'],
        ];
    }


    public function upload($file, $fileName)
    {
        $this->attachment = $file;

        if ($this->validate()) {
            $this->attachment->saveAs("{$fileName}.{$this->attachment->extension}");
            return true;
        } else {
            return false;
        }
    }
}