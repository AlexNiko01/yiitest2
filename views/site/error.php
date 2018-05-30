<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="site-error">



    <div class="container text-center">
        <?= Yii::$app->user->isGuest; ?>
        <h1><?= Html::encode($this->title) ?></h1>

            <?= nl2br(Html::encode($message)) ?>

        <div class="content-404">
            <?=Html::img(['@web/images/404/404.png']) ?>

            <h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
            <p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
            <h2><a href="<?= Url::home() ?>">Bring me back Home</a></h2>
        </div>
    </div>
</div>
