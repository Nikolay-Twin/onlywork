<?php

use yii\db\Migration;

/**
 * Class m231120_151020_junion_table_for_category_and_product_tables
 */
class m231120_151020_junion_table_for_category_and_product_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cat_category_product}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cat_category-product}}');
    }
}
