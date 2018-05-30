<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm; ?>


<?php if (Yii::$app->session->hasflash('success')) { ?>
    <div class="container">
        <div class="alert alert-success">
            <strong>Success!</strong><?= Yii::$app->session->getflash('success'); ?>
        </div>
    </div>
<?php } else if (Yii::$app->session->hasflash('error')) { ?>
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <strong>Error!</strong><?= Yii::$app->session->getflash('error'); ?>
        </div>
    </div>
<?php }; ?>


<?php if (empty($_SESSION['cart'])) {
    echo ' <div class="container"><h3>the cart is empty!</h3></div>';
} else {

    ?>

    <section id="cart_items">

        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <th>Img</th>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Sum</th>
                        <th><span class="glyphicon glyphicon-remove"></span></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $sessionCart = $_SESSION['cart']; ?>
                    <?php foreach ($sessionCart as $id => $item): ?>
                        <tr>
                            <td>
                                <?= Html::img('@web/images/home/' . $item['img'], ['alt' => $item['name'], 'class' => 'cart-img']) ?>
                            </td>
                            <td><a href="<?= Url::to(['product/view', 'id' => $id]); ?>"><?= $item['name']; ?></a></td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href=""> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity"
                                           value="<?= $item['qty']; ?>" autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href=""> - </a>
                                </div>
                            </td>
                            <td><?= $item['price']; ?></td>
                            <td><?= $item['price'] * $item['qty']; ?></td>
                            <th><span data-id="<?= $id; ?>"
                                      class="glyphicon-class text-danger del-item glyphicon glyphicon-remove"></span>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5">Qty</td>
                        <td><?= isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td colspan="5">Sum</td>
                        <td><?= isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] : ''; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
    <section>
        <div class="container">
            <?php $form = ActiveForm::begin() ?>
            <?= $form->field($order, 'name') ?>
            <?= $form->field($order, 'email') ?>
            <?= $form->field($order, 'phone') ?>
            <?= $form->field($order, 'address') ?>
            <?= Html::submitButton('Make order', ['class' => 'btn btn-success']); ?>
            <?php ActiveForm::end() ?>
        </div>
    </section>

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                    delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>Use Coupon Code</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Use Gift Voucher</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Estimate Shipping & Taxes</label>
                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>Country:</label>
                                <select>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field">
                                <label>Region / State:</label>
                                <select>
                                    <option>Select</option>
                                    <option>Dhaka</option>
                                    <option>London</option>
                                    <option>Dillih</option>
                                    <option>Lahore</option>
                                    <option>Alaska</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field zip-field">
                                <label>Zip Code:</label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">Get Quotes</a>
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>$59</span></li>
                            <li>Eco Tax <span>$2</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>$61</span></li>
                        </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->

<?php } ?>