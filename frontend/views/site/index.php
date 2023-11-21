<?php

/** @var yii\web\View $this */

use frontend\assets\CatalogueAsset;
$this->title = 'Test work';

CatalogueAsset::register($this);
?>
<div class="catalogue">
    <div class="catalogue-sidebar">
        <span class="span-h2">Категории</span>
        <div class="category-popup">
            <span class="close-popup">🅧</span>
            <input type="text" id="category-name">
            <button id="category-action"></button>
        </div>
        <div class="tree"></div>
    </div>
    <div class="catalogue-content">
        <div class="product-popup">
            <span class="close-popup">🅧</span>
            <h2 class="product-name"></h2>
            <div class="product-description"></div>
        <div id="product-edit-button"></div>
        </div>
        <span class="span-h2">Товары <span class="product-add"> ✚ </span>
            <input type="hidden" id="category-id">
            <input type="hidden" id="product-id">
        </span>
        <ul class="product-list"></ul>
    </div>
</div>
