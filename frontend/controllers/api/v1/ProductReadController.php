<?php
declare(strict_types=1);
namespace frontend\controllers\api\v1;

use common\domain\models\Category;
use common\domain\models\Product;
use yii\helpers\ArrayHelper;

/**
 *
 */
final class ProductReadController extends AbstractReadController
{
    public $modelClass = Product::class;

    /**
     * @return void
     */
    public function actionList(int $id)
    {
        $category = Category::findOne($id);
        return ArrayHelper::toArray($category->products, [
            'id', 'name', 'description'
        ]);
    }
}
