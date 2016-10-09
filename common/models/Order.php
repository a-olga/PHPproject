<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property integer $phone
 * @property string $address
 * @property integer $status
 *
 * @property OrderProduct[] $orderProducts
 */
class Order extends OrderGii
{
    public function rules()
    {
        $newRules = [
            [['status'],'default','value' => 0],
        ];
        return array_merge( parent::rules(),  $newRules);
    }
}