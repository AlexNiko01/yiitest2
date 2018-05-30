<?php
use yii\helpers\Html;

if (empty($_SESSION['cart'])) {
    echo '<h3>the cart is empty!</h3>';
} else {

    ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr class="table-primary">
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
            <?php foreach ($sessionCart as $id=>$item): ?>
                <tr>
                    <td>
                        <?= Html::img('@web/images/home/' . $item['img'], ['alt' => $item['name'], 'class' => 'cart-img']) ?>
                    </td>
                    <td><?= $item['name']; ?></td>
                    <td><?= $item['qty']; ?></td>
                    <td><?= $item['price']; ?></td>
                    <td><?= $item['price'] * $item['qty']; ?></td>
                    <th><span data-id="<?= $id; ?>" class="glyphicon-class text-danger del-item glyphicon glyphicon-remove"></span></th>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="5">Qty</td>
                <td><?= isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] : ''; ?></td>
            </tr>
            <tr>
                <td colspan="5">Total Sum</td>
                <td><?= isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] : ''; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php }