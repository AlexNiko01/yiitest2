<?php

namespace app\controllers;

use app\models\Product;
use app\models\Cart;
use app\models\OrderItem;
use app\models\Order;
use yii\web\Response;

/**
 * Class CartController
 * @package app\controllers
 */
class CartController extends AppController
{
    /**
     * @param $id
     * @param int $qty
     * @return bool|string|\yii\web\Response
     */
    public function actionAdd(int $id, int $qty = 1)
    {
        $qty = (int)$qty;
        $qty = ($qty > 0) ? $qty : 1;

        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart;
        $cart->addToCart($product, $qty);
        if (!\Yii::$app->request->isAjax) {
            return $this->redirect(\Yii::$app->request->referrer);
        }

        $this->layout = false;
        return $this->render('cart-modal', ['session' => $session]);
    }

    /**
     * @return string
     */
    public function actionClear()
    {
        $session = \Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;

        return $this->render('cart-modal', ['session' => $session]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function actionDelItem(int $id): string
    {
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart;
        $cart->reCalc($id);

        $this->layout = false;
        return $this->render('cart-modal', ['session' => $session]);
    }

    /**
     * @return string
     */
    public function actionShowCart(): string
    {
        $session = \Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', ['session' => $session]);
    }

    /**
     * @return string|Response
     */
    public function actionView()
    {
        $session = \Yii::$app->session;
        $session->open();

        $this->setMeta('Cart');
        $order = new Order();

        if ($order->load(\Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];

            $db = \Yii::$app->db;
            $transaction = $db->beginTransaction();

            try {
                if ($save = $order->save()) {
                    $this->saveOrderItems($session['cart'], $order->id);
                }
                $transaction->commit();
            } catch (\Exception $e) {
                $save = false;
                $transaction->rollBack();
            } catch (\Throwable $e) {
                $save = false;
                $transaction->rollBack();
            }
            if ($save) {
                \Yii::$app->mailer->compose('order',['session'=>$session['cart']])
                    ->setFrom('yiitest2@gmail.com')
                    ->setTo($order->email)
                    ->setSubject('order Details')
                    ->send();
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');

                \Yii::$app->session->setflash('success', 'You order has been received');
                return $this->refresh();
            } else {
                \Yii::$app->session->setflash('error', 'Order error');
            }
        }


        return $this->render('view', ['session' => $session, 'order' => $order]);
    }

    protected function saveOrderItems($items, $orderId)
    {
        foreach ($items as $id => $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $orderId;
            $orderItem->product_id = $id;
            $orderItem->name = $item['name'];
            $orderItem->price = $item['price'];
            $orderItem->qty_item = $item['qty'];
            $orderItem->sum_item = $item['qty'] * $item['price'];
            $orderItem->save();
        }
    }
}