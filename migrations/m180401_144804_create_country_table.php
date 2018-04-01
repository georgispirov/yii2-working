<?php

use yii\db\Migration;

/**
 * Handles the creation of table `country`.
 */
class m180401_144804_create_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('country', [
            'id'   => $this->primaryKey(),
            'name' => $this->string(55)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('country');
    }
}
