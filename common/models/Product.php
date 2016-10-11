<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "products".
 */
class Product extends ProductGii
{
    /**
     * @var array UploadedFile
     * http://www.yiiframework.com/doc-2.0/yii-web-uploadedfile.html
     */
    
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    public $imageFiles;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function(){
                    return time();
                },
            ] 
       ];
    }
    
    public function rules()
    {
        $newRules = [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['status'],'default','value' => self::STATUS_ACTIVE],
        ];
        return array_merge(parent::rules(),  $newRules);
    }

    public static function find()
    {
        return parent::find()->where(['status' => self::STATUS_ACTIVE]);
    }

    public static function findInactive()
    {
        return parent::find()->where(['status' => self::STATUS_INACTIVE]);
    }

    public function assignImages($model)
    {
        if(is_array($this->imageFiles)){
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension, false);
                $modelPhoto = new Image();
                $modelPhoto->link =  '@imagePath/' . $file->baseName . '.' . $file->extension;
                $modelPhoto->status = Image::STATUS_ACTIVE;
                $modelPhoto->product_id = $model->id;
                $modelPhoto->created_at = time();
                $modelPhoto->updated_at = time();
                $modelPhoto->save();
            }
        }
    }

//    public function deleteImages($model)
//    {
//        if ($model->getImages()->all()) {
//            foreach ($model->getImages()->all() as $image){
//                $image->safeDelete();
//            }
//        }
//    }

    public function safeDelete()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->save();
    }

    public function restore()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->save();
    }

//    public function getInactiveImages()
//    {
//        return $this->hasMany(Image::className(), ['product_id' => 'id'])->where(['status' => Image::STATUS_INACTIVE]);
//    }

}
