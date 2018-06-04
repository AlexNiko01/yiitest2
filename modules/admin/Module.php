<?php

namespace app\modules\admin;

use yii\filters\AccessControl;


/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->layout = 'admin';
    }

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
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'roles' => ['customer'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'roles' => ['admin'],

                    ]
                ],
            ],
        ];
    }

}
