<?php


namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Category
 * @package app\models
 * @property int $id;
 * @property int $parent_id;
 * @property string $name;
 * @property string $keywords;
 * @property string $description;
 */
class Category extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'categories';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }
}