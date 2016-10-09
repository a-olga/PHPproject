<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property string $link
 * @property string $created_at
 * @property string $updated_at
 * @property integer $product_id
 * @property integer $status
 *
 * @property Product $product
 */
class Image extends ImageGii
{
    /**
     * @inheritdoc
     */

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const NO_IMAGE_URL = '@imagePath/no_image.png';

    public $file;
    


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
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['status'],'default','value' => self::STATUS_ACTIVE],
        ];
        return array_merge( parent::rules(),  $newRules);
    }

    public static function find()
    {
        return parent::find()->where(['status' => self::STATUS_ACTIVE]);
    }

    public static function findInactive()
    {
        return parent::find()->where(['status' => self::STATUS_INACTIVE]);
    }

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

//    public function getProduct()
//    {
//        return $this->hasOne(Product::className(), ['id' => 'product_id'])->where(['status' => Product::STATUS_ACTIVE]);
//    }
}