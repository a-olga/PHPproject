<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets;

use yii\bootstrap\Carousel;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


class Slider extends Carousel
{

    public function renderControls()
    {
        return Html::a(
            Html::tag( 'span', '', ['class' => 'glyphicon glyphicon-chevron-left']),
                '#' . $this->options['id'],
                [
                    'class' => 'left carousel-control',
                    'data-slide' => 'prev',
                ]
            ) . "\n"
            . Html::a(
                Html::tag('span', '', ['class' => 'glyphicon glyphicon-chevron-right']),
                '#' . $this->options['id'],
                [
                    'class' => 'right carousel-control',
                    'data-slide' => 'next',
                ]
            );
    }
}
