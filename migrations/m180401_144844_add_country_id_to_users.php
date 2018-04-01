<?php

use yii\db\Migration;

/**
 * Class m180401_144548_add_country_id_to_users
 */
class m180401_144844_add_country_id_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'country_id', $this->integer()->notNull());

        $this->addForeignKey('fk-user-country_id',
                             'users',
                             'country_id',
                             'country',
                             'id',
                             'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user-country_id', 'users');

        $this->dropColumn('users', 'country_id');

        echo "m180401_144548_add_country_id_to_users cannot be reverted.\n";

        return false;
    }
}