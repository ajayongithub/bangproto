<?php

Yii::import('application.models._base.BaseUserDetails');

class UserDetails extends BaseUserDetails{
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function init() {
        return parent::init();
    }
}