<?php

namespace app\tests\fixtures;


use yii\test\ActiveFixture;

class ProductFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Product';
    public $depends = [
        'app\tests\fixtures\UserFixture'
    ];

}