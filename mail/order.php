<?php
use yii\helpers\Html;
?>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr class="table-primary">
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Sum</th>
        </tr>
        </thead>
        <tbody>
        <?php $sessionCart = $_SESSION['cart']; ?>
        <?php foreach ($sessionCart as $id=>$item): ?>
            <tr>
                <td><?= $item['name']; ?></td>
                <td><?= $item['qty']; ?></td>
                <td><?= $item['price']; ?></td>
                <td><?= $item['price'] * $item['qty']; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3">Qty</td>
            <td><?= isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] : ''; ?></td>
        </tr>
        <tr>
            <td colspan="3">Total Sum</td>
            <td><?= isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] : ''; ?></td>
        </tr>
        </tbody>
    </table>
</div>
<style>
    .table-responsive {
        min-height: .01%;
        overflow-x: auto;
    }
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }
    .table > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .table > caption + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > th, .table > thead:first-child > tr:first-child > th, .table > caption + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > td, .table > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }
</style>