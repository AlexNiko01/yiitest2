<li class="accordion">
    <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']]) ?>">
        <?php if (isset($category['childes'])): ?>
            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
        <?php endif; ?>
        <?= $category['name']; ?>
    </a>
    <?php if (isset($category['childes'])): ?>
        <ul>
            <?php echo $this->getmenuHtml($category['childes']); ?>
        </ul>
    <?php endif; ?>
</li>

