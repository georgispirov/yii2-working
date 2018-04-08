<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m180403_203140_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id'          => $this->primaryKey(),
            'username'    => $this->string(155)->notNull()->unique(),
            'first_name'  => $this->string(155)->notNull(),
            'last_name'   => $this->string(155)->notNull(),
            'email'       => $this->string(155)->notNull()->unique(),
            'age'         => $this->integer(3)->notNull(),
            'gender_id'   => $this->integer(3)->notNull(),
            'city_id'     => $this->integer(3)->notNull(),
            'country_id'  => $this->integer(3)->notNull(),
            'password'    => $this->string(255)->notNull(),
            're_password' => $this->string(255)->notNull(),
            'created_at'  => $this->integer(11)->notNull(),
            'updated_at'  => $this->integer(11)->notNull(),
            'ip_address'  => $this->string(20)->notNull()
        ]);

        $this->addForeignKey('fk-users-city_id', 'users', 'city_id', 'city', 'id', 'RESTRICT');
        $this->addForeignKey('fk-users-country_id', 'users', 'country_id', 'country', 'id', 'RESTRICT');
        $this->addForeignKey('fk-users-gender_id', 'users', 'gender_id', 'gender', 'id', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-users-city_id',
            'users'
        );

        $this->dropForeignKey(
            'fk-users-country_id',
            'users'
        );

        $this->dropForeignKey(
            'fk-users-gender_id',
            'users'
        );

        $this->dropTable('users');
    }
}
