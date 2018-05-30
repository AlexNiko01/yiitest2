<?php

namespace app\controllers;


use app\models\Product;
use yii\web\HttpException;

/**
 * Class ProductController
 * @package app\controllers
 */
class ProductController extends AppController
{
    /**
     * @param $id
     * @return string
     * @throws HttpException
     */
    public function actionView(int $id): string
    {
        $product = Product::findOne($id);
        if (empty($product)) {
            throw new HttpException(404, 'The requested Item could not be found.');
        }
        $hits = Product::find()->where(['hit' => '1'])->limit(5)->all();
        $this->setMeta('E_SHOPPER | ' . $product->name, $product->keywords, $product->description);
        return $this->render('view', ['product' => $product, 'hits' => $hits]);
    }
}