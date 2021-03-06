<?php
use app\components\MenuWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<section id="advertisement">
    <div class="container">
        <?= Html::img('@web/images/shop/advertisement.jpg', ['alt' => 'advertisement', 'class' => '']) ?>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <ul class="panel-group category-products">
                        <?= MenuWidget::widget(['tpl' => 'menu']); ?>
                    </ul>

                    <div class="brands_products"><!--brands_products-->
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
                                <li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                                <li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
                                <li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
                                <li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
                                <li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
                                <li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                            </ul>
                        </div>
                    </div><!--/brands_products-->

                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                   data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br/>
                            <b>$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div><!--/price-range-->

                    <div class="shipping text-center"><!--shipping-->
                        <?= Html::img('@web/images/home/shipping.jpg', ['alt' => '', 'class' => '']) ?>
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <?php if (!empty($products)): ?>
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center"><?= $category->name; ?></h2>
                        <div class="clearfix">
                            <?php foreach ($products as $key => $product): ?>
                                <?php if ($key === 0 || $key % 3 === 0) {
                                    echo '<div class="row">';
                                } ?>

                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <?= Html::img('@web/images/home/' . $product->img, ['alt' => $product->name]) ?>
                                                <h2>$<?= $product->price; ?></h2>
                                                <p>
                                                    <a href="<?= Url::to(['product/view', 'id' => $product->id]); ?>">
                                                        <?= $product->name; ?>
                                                    </a>

                                                </p>

                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>$<?= $product->price; ?></h2>
                                                    <p>
                                                        <a href="<?= Url::to(['product/view', 'id' => $product->id]); ?>">
                                                            <?= $product->name; ?>
                                                        </a>

                                                    </p>
                                                    <a href="#"
                                                       class="btn btn-default add-to-cart" data-id="<?= $product->id; ?>"><i
                                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <?php if (($key % 3 === 2) || $key === count($products) - 1) {
                                    echo '</div>';
                                } ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="text-center">
                            <?php echo LinkPager::widget([
                                'pagination' => $pagination,
                            ]); ?>
                        </div>


                    </div><!--features_items-->
                <?php else: ?>
                    This category is empty yet...
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>