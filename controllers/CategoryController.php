<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\HttpException;

/**
 * Class CategoryController
 * @package app\controllers
 */
class CategoryController extends AppController
{
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E_SHOPPER');
        return $this->render('index', ['hits' => $hits]);
    }

    /**
     * @param $id
     * @return string
     * @throws HttpException
     */
    public function actionView(int $id): string
    {
        $category = Category::findOne($id);
        if (empty($category)) {
            throw new HttpException(404, 'The requested Item could not be found.');
        }
        $query = Product::find()->where(['category_id' => $id]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 4, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $this->setMeta('E_SHOPPER | ' . $category->name, $category->keywords, $category->description);
        return $this->render('view', ['products' => $products, 'pagination' => $pagination, 'category' => $category]);
    }

    /**
     * @param string $q
     * @return string
     */
    public function actionSearch(string $q): string
    {
        $q = trim($q);
        $this->setMeta('E_SHOPPER | ' . $q);
        if (!$q) {
            return $this->render('search');
        }
        $query = Product::find()->where(['like', 'name', $q]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 4, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('search', ['products' => $products, 'pagination' => $pagination, 'q' => $q]);
    }
}