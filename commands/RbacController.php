<?php


namespace app\commands;


use yii\console\Controller;
use app\rbac\UserRoleRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;
        $rule = new UserRoleRule();
        $auth->add($rule);

        /**
         * adding role "customer" |  "admin"
         */
        $customer = $auth->createRole('customer');
        $admin = $auth->createRole('admin');





        $admin->ruleName = $rule->name;
        $customer->ruleName = $rule->name;

        $auth->add($admin);
        $auth->add($customer);
        $auth->addChild($admin, $customer);
//
//        $auth->assign($customer, 2);
//        $auth->assign($admin, 1);
    }
}