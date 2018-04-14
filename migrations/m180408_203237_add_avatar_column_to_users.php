<?php

use yii\db\Migration;

/**
 * Class m180408_203237_add_avatar_column_to_users
 */
class m180408_203237_add_avatar_column_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'avatar', $this->string()
             ->defaultValue(Yii::$app->getBasePath(). '/images/no-image.jpg'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'avatar');
        echo "m180408_203237_add_avatar_column_to_users cannot be reverted.\n";

        return false;
    }
}
