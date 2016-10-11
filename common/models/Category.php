<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property Product[] $products
 */
class Category extends CategoryGii
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function rules()
    {
        $newRules = [
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

    public static function getList()
    {
        $categoryArray = self::find()
            ->select(['id', 'parent_id', 'name'])
            ->orderBy('parent_id ASC')
            ->asArray()
            ->all();
        $categories = [];
        foreach ($categoryArray as $category) {
            $categories[$category['parent_id']][$category['id']] = $category;
        }
        return $categories;
    }

    public static function isParent($categoryId)
    {
        $categoryList = self::getList();
        if (isset($categoryList[$categoryId])){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
}