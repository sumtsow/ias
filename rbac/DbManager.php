<?php

namespace app\components;

use yii\base\InvalidConfigException;
use yii\rbac\Rule;

class DbManager extends \yii\rbac\DbManager
{
    protected function executeRule($user, $item, $params)
    {
        if (empty($item->ruleName)) {
            return true;
        }

         return parent::executeRule($user, $item, $params);
    }
}
