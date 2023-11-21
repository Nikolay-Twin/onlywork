<?php
declare(strict_types=1);
namespace common\domain\services;

use common\domain\models\Category;

/**
 *
 */
class CategoryService
{
    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $root = Category::findOne($data['id']);
        $node = new Category(['name' => $data['name']]);
        $node->prependTo($root);
        return $node->save();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        $node = Category::findOne($data['id']);
        $node->name = $data['name'];
        return $node->save();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function delete(array $data): bool
    {
        $node = Category::findOne($data['id']);
        return (bool)($node->isRoot() ? $node->deleteWithChildren() : $node->delete());
    }
}
