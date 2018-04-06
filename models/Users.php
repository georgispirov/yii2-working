<?php

namespace app\models;

use app\components\EmailAfterRegisterBehavior;
use ruskid\YiiBehaviors\IpBehavior;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property int $age
 * @property int $gender_id
 * @property int $created_at
 * @property int $updated_at
 * @property string $ip_address
 * @property int $city_id
 * @property string $password
 * @property string $re_password
 * @property string $email
 * @property integer $country_id
 *
 * @property Cities $city
 * @property Country $country
 * @property Gender $gender
 */
class Users extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_REGISTER = 'SCENARIO_REGISTER';
    const SCENARIO_LOGIN    = 'SCENARIO_LOGIN';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    public function behaviors()
    {
        return [
            [
                'class'      => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_AFTER_UPDATE  => ['created_at', 'updated_at']
                ],
            ],
            [
                'class'      => IpBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['ip_address'],
                    ActiveRecord::EVENT_AFTER_UPDATE  => ['ip_address']
                ]
            ],
            EmailAfterRegisterBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['age', 'gender_id', 'created_at', 'updated_at', 'city_id', 'country_id'], 'integer'],
            [['username'], 'string', 'max' => 75],
            [['ip_address'], 'string', 'max' => 20],
            [['first_name', 'last_name'], 'string', 'max' => 105],
            [['password', 're_password'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 155],
            [['username'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'age' => 'Age',
            'gender_id' => 'Gender ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ip_address' => 'Ip Address',
            'city_id' => 'City ID',
            'password' => 'Password',
            'email' => 'Email',
            're_password' => 'Re Password',
            'country_id' => 'Country'
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password',
            're_password', 'first_name', 'last_name', 'age', 'gender_id', 'city_id'];

        $scenarios[self::SCENARIO_LOGIN] = ['username', 'password'];

        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['id' => 'gender_id']);
    }

    public static function find()
    {
        return new \app\queries\UsersQuery(get_called_class());
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @param mixed $token
     * @param null $type
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('Access token functionality not implemented');
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
}
