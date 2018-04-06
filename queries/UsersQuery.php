<?php

namespace app\queries;

use yii\db\ActiveQuery;

class UsersQuery extends ActiveQuery
{
    /**
     * @param string $username
     * @return $this
     */
    public function byUsername(string $username)
    {
        return $this->andWhere(['username' => $username])->one();
    }
}