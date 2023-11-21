<?php
declare(strict_types=1);
namespace common\domain\services;

use common\domain\models\Category;
use common\domain\models\Product;

/**
 *
 */
class ProductService
{
    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $category = Category::findOne($data['id']);
        $product = new Product();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $save = $product->save();
        $category->link('products', $product);
        return $save;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        $product = Product::findOne($data['id']);
        $product->name = $data['name'];
        $product->description = $data['description'];
        return $product->save();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function delete(array $data): bool
    {
        $product = Product::findOne($data['id']);
        return (bool)($product->delete());
    }
}
