<?php

use SameerShelavale\PhpCountriesArray\CountriesArray;
use yii\db\Migration;

/**
 * Class m180401_150027_insert_countries_into_country_table
 */
class m180401_150027_insert_countries_into_country_table extends Migration
{
    /**
     * @var array $countries
     */
    private $countries = [];

    public function init()
    {
        $this->countries = CountriesArray::getFromContinent('alpha2', 'name', 'Europe');
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
