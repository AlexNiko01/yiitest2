<?php

namespace app\modules\admin\controllers;

use app\controllers\AppController;
use yii\filters\AccessControl;
use yii\web\User;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => ['index'],
                        'roles' => ['customer'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['admin'],

                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->setMeta('Admin');
        return $this->render('index');
    }

}
