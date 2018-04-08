<?php

use app\models\Country as CountryActiveRecord;
use MenaraSolutions\Geographer\Collections\MemberCollection;
use MenaraSolutions\Geographer\Country;
use MenaraSolutions\Geographer\Earth;
use yii\db\Migration;

/**
 * Class m180406_222953_insert_cities_for_countries
 */
class m180406_222953_insert_cities_for_countries extends Migration
{
    private $countries;

    public function init()
    {
        $earth = new Earth();
        foreach ($earth->getEurope()->toArray() as $item) {
            $this->countries[$item['isoCode']] = $item['name'];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->countries as $k => $country) {
            $innerCountry = Country::build($k);
            $countryActiveRecord = CountryActiveRecord::find()->select(['id'])->where(['name' => $country])->one();

            foreach ($innerCountry->getMembers()->setLocale('en') as $member) {
                /* @var $member MemberCollection */
                $this->insert('city', [
                    'name'       => $member->toArray()['name'],
                    'country_id' => $countryActiveRecord->id
                ]);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180406_222953_insert_cities_for_countries cannot be reverted.\n";

        return false;
    }
}
