<?php

namespace app\models;


use yii\base\Model;

/**
 * Class Cart
 * @package app\models
 */
class Cart extends Model
{
    /**
     * @param  Product $product
     * @param int $qty
     */
    public function addToCart(Product $product, int $qty = 1): void
    {
        $id = $product->id;

        $cartProduct['qty'] = $qty;
        $cartProduct['name'] = $product->name;
        $cartProduct['price'] = $product->price;
        $cartProduct['img'] = $product->img;

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$id] = $cartProduct;
        }

        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $newProductSum = $product->price * $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $newProductSum : $newProductSum;
    }

    /**
     * @param $id
     * @return bool
     */
    public function reCalc($id)
    {
        if (!isset($_SESSION['cart'][$id])) {
            return false;
        }
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['price'] * $_SESSION['cart'][$id]['qty'];

        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$id]);
    }
}