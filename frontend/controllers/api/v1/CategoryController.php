<?php
declare(strict_types=1);
namespace frontend\controllers\api\v1;

use common\domain\services\CategoryService;
use yii\base\Module;

/**
 *
 */
final class CategoryController extends AbstractController
{
    public function __construct(
        string $id,
        Module $module,
        array|null $config = [],
        private CategoryService $categoryService
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @return array
     */
    public function actionCreate(): array
    {
        if ($this->categoryService->create($this->post)) {
            return $this->success('Ok');
        }
        return $this->error('Не удалось записать категорию');
    }

    /**
     * @return array
     */
    public function actionUpdate(): array
    {
        if ($this->categoryService->update($this->post)) {
            return $this->success('Ok');
        }
        return $this->error('Не удалось изменить категорию');
    }

    /**
     * @return array
     */
    public function actionDelete(): array
    {
        if ($this->categoryService->delete($this->post)) {
            return $this->success('Ok');
        }
        return $this->error('Не удалось удалить категорию');
    }

}
