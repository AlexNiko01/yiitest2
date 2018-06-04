<?php

namespace app\modules\admin\controllers;

use app\controllers\AppController;
use yii\filters\AccessControl;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppController
{

    public function actionIndex()
    {
        $this->setMeta('Admin');
        return $this->render('index');
    }

}
