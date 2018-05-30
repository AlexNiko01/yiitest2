<?php


namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class Product
 * @package app\models
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $content
 * @property float $price
 * @property string $keywords;
 * @property string $description;
 * @property string $img
 * @property boolean $hit;
 * @property boolean $new;
 * @property boolean $sale;
 */
class Product extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'products';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}