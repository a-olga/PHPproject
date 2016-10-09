<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property integer $product_id
 * @property integer $order_id
 * @property integer $count
 * @property integer $price
 *
 * @property Order $order
 * @property Product $product
 */
class OrderProduct extends OrderProductGii
{
    public function rules()
    {
        $newRules = [
            [['count'],'default','value' => 0],
        ];
        return array_merge( parent::rules(),  $newRules);
    }
}