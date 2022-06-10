<?php

namespace app\components;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;


class UploadBehaviorStorege extends Behavior {

    public $imageFile;
    public $photo;
    public $path;
    public $name;

    public $uploadedFileFunction = true;

    public function events() {

        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_AFTER_VALIDATE => 'afterValidate',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];

    }

    public function beforeValidate($event){
        if($this->uploadedFileFunction == true) {
            $this->owner->{$this->imageFile} = UploadedFile::getInstance($this->owner, $this->imageFile);
        }
    }

    public function afterValidate($event) {

        if ($this->owner->{$this->imageFile}) {
            $this->deletePhoto();
            $this->uploadFile();

//            $this->owner->{$this->imageFile} = null;

        }

    }

    public function afterDelete($event) {

        $this->deletePhoto();

    }

    public function uploadFile()
    {
        $this->deletePhoto();
        $path = $this->path;

        $this->name = $path . '/' . microtime(true) . '.' . $this->owner->{$this->imageFile}->extension;
        FileHelper::createDirectory('/var/www/storage/'.$path);

        $this->owner->{$this->imageFile}->saveAs('/var/www/storage/'.$this->name);

        $this->owner->{$this->photo} = $this->name;
        
    }

    public function deletePhoto() {

        if (!empty($this->owner->{$this->photo})) {
            @unlink('/var/www/storage/'.$this->owner->{$this->photo});
        }

    }

}

?>