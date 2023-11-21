<?php
declare(strict_types=1);
namespace common\domain\models\queries;

use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

/**
 *
 */
class CategoryQuery extends ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::class,
        ];
    }
}
