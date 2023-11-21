<?php
declare(strict_types=1);
namespace common\domain\models;

use common\domain\models\queries\CategoryQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use yii\db\ActiveRecord;

/**
 *
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_category';
    }

    /**
     * @return array[]
     */
    public function behaviors()
    {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::class,
                'leftAttribute'  => 'lft',
                'rightAttribute' => 'rgt',
                'depthAttribute' => 'depth'
            ],
        ];
    }

    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            ['name', 'required'],
        ];
    }


    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return CategoryQuery
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])
            ->viaTable('cat_category_product', ['category_id' => 'id']);
    }
}
