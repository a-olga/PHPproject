<?php
namespace frontend\components;
use Yii;
use yii\base\Component;
use common\models\Product;


/**
 * Class Cart
 * @package frontend\components
 */
class Cart extends Component
{

//    public function add($productId, $count)
    public function add($productId)
    {
        $orderId = 0;
        $session = Yii::$app->session;

        if(!$session->isActive){
            $session->open();
        }

        if($session->get('cart')){
            $orderId+=count($session['cart']);
            $session['cart'] = array_merge($session['cart'], [
                $orderId => [
                    'productId' => $productId,
                    'price' => Product::findOne(['id' => $productId])->price,
                ]
            ]);

        } else {
            $session->get('cart');
            $session['cart'] = [$orderId => [
                'productId' => $productId,
                'price' => Product::findOne(['id' => $productId])->price,
                ]
            ];
        }
        $cart = $session['cart'];
        return $cart;
    }


    public static function isEmpty()
    {
        if (!Yii::$app->session->has('cart')) {
            return true;
        }
        return false;
    }

    public static function getStatus()
    {
        if (self::isEmpty()) {
            return Yii::t('app', 'Cart is empty');
        }

        return Yii::t('app', 'In cart {productsCount, number} {productsCount, plural, one{product} few{products} many{products} other{products}}.', [
            'productsCount' => count(Yii::$app->session['cart']),
        ]);
        
    }

    public static function getProductsId()
    {
        if(Yii::$app->session->get('cart')){
            $cart = Yii::$app->session['cart'];
            $productsId = [];
            for($i = 0; $i<=max(array_keys($cart)); $i++) {
                if (isset($cart[$i])) {
                array_push($productsId, $cart[$i]['productId']);
                }
            }
            return $productsId;
        }
        return NULL;
    }
    
    public function clean()
    {
        Yii::$app->session->remove('cart');
    }

    public function delete($productId)
    {
        $cart = Yii::$app->session['cart'];
        for($i = 0; $i<count($cart); $i++){
            if($cart[$i]['productId'] == $productId){
                unset($_SESSION['cart'][$i]);
                return Yii::$app->session['cart'];
            }

        }
        return NULL;
    }


}