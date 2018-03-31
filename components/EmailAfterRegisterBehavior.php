<?php

namespace app\components;

use Yii;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

class EmailAfterRegisterBehavior extends Behavior
{
    public function attach($owner)
    {
        parent::attach($owner);
        $owner->on(ActiveRecord::EVENT_AFTER_INSERT, [$this, 'sendEmailOnSuccessfulRegister']);
    }

    public function sendEmailOnSuccessfulRegister(Event $event)
    {
        Yii::$app->getMailer()
                 ->compose('onSuccessfulRegister', ['user' => $event->sender])
                 ->setFrom('georgispirov74@gmail.com')
                 ->setTo($event->sender->email)
                 ->setSubject('Successfully Registered')
                 ->send();
    }
}