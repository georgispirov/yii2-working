<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gender`.
 */
class m180403_204609_create_gender_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('gender', [
            'id' => $this->primaryKey(),
            'name' => $this->string(10)->notNull()->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('gender');
    }
}
