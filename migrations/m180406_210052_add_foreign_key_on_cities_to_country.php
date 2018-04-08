<?php

use yii\db\Migration;

/**
 * Class m180406_210052_add_foreign_key_on_cities_to_country
 */
class m180406_210052_add_foreign_key_on_cities_to_country extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('city', 'country_id', $this->integer(4));

        $this->addForeignKey('fk-city-country_id',
            'city',
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
        $this->dropForeignKey('fk-city-country_id', 'country');

        echo "m180406_210052_add_foreign_key_on_cities_to_country cannot be reverted.\n";

        return false;
    }
}
