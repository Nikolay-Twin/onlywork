<?php
declare(strict_types=1);
namespace frontend\controllers\api\v1;

use common\domain\models\Product;
use common\domain\services\ProductService;
use yii\base\Module;

/**
 *
 */
final class ProductController extends AbstractController
{
    public function __construct(
        string $id,
        Module $module,
        array|null $config = [],
        private ProductService $productService
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @return array
     */
    public function actionCreate(): array
    {
        if ($this->productService->create($this->post)) {
            return $this->success('Ok');
        }
        return $this->error('Не удалось добавить продукт');
    }

    /**
     * @return array
     */
    public function actionUpdate(): array
    {
        if ($this->productService->update($this->post)) {
            return $this->success('Ok');
        }
        return $this->error('Не удалось отредактировать продукт');
    }

    /**
     * @return array
     */
    public function actionDelete(): array
    {
        if ($this->productService->delete($this->post)) {
            return $this->success('Ok');
        }
        return $this->error('Не удалось удалить продукт');
    }
}
