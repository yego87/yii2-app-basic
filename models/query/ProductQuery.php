<?php

namespace app\models\query;
use app\models\Category;
use app\models\ProductTag;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\Product]].
 *
 * @see \app\models\Product
 */
class ProductQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return \app\models\Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
