<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class UserRoleRule extends Rule
{
    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
            if ($item->name === 'admin') {
                return $role == 1;
            } elseif ($item->name === 'customer') {
                return $role == 2;
            }
        }
        return true;
    }
}
