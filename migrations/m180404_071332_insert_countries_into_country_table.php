<?php

use MenaraSolutions\Geographer\Earth;
use yii\db\Migration;
/**
 * Class m180404_071332_insert_countries_into_country_table
 */
class m180404_071332_insert_countries_into_country_table extends Migration
{
    /**
     * @var array $countries
     */
    private $countries = [];

    public function init()
    {
        $earth = new Earth();
        foreach ($earth->getEurope()->toArray() as $item) {
            $this->countries[] = $item['name'];
        }
    }
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->countries as $country) {
            $this->insert('country', [
                'name' => $country
            ]);
        }
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ($this->countries as $country) {
            $this->delete('country', [
                'name' => $country
            ]);
        }
    }
}