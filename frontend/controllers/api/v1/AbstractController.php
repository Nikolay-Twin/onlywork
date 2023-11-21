<?php
declare(strict_types=1);
namespace frontend\controllers\api\v1;

use Yii;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\Response;

/**
 * 
 */
abstract class AbstractController extends Controller
{

    protected array $post;

    /**
     * @return array[]
     */
    public function behaviors()
    {
        return [[
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ]];
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $request = Yii::$app->request;
        $this->post = $request->post();
        if (!$request->isAjax) {
            throw new \Exception('Bad request');
        }
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * @param string|array $data
     * @return array
     */
    protected function success(string|array $data = [], int $code = 200): array
    {
        Yii::$app->response->statusCode = $code;
        return [
            'status' => 'success',
            'data'   => is_array($data) ? $data : [$data],
            'code'   => $code
        ];
    }

    /**
     * @param string $message
     * @param int $code
     * @return array
     */
    protected function error(string $message, int $code = 400): array
    {
        Yii::$app->response->statusCode = $code;
        return [
            'status' => 'error',
            'message'   => $message,
            'code'   => $code
        ];
    }
}
