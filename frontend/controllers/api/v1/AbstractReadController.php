<?php
declare(strict_types=1);
namespace frontend\controllers\api\v1;

use Yii;
use yii\rest\ActiveController;

/**
 * 
 */
abstract class AbstractReadController extends ActiveController
{

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (!Yii::$app->request->isAjax) {
            throw new \Exception('Bad request');
        }
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

}
