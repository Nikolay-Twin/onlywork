<?php
declare(strict_types=1);
namespace frontend\controllers\api\v1;

use common\domain\models\Category;
use yii\rest\ActiveController;


/**
 *
 */
final class CategoryReadController extends ActiveController
{
    public $modelClass = Category::class;
}
