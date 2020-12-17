<?php

/* @var $this yii\web\View */

use frontend\assets\GalleryAsset;

GalleryAsset::register($this);
$this->registerJsFile('@web/js/gallery/scripts.js', ['depends' => [
    GalleryAsset::class
]]);
?>

<h1>Gallery</h1>

<div class="portfolioFilter">

    <a href="#" data-filter="*" class="current">All Categories</a>
    <a href="#" data-filter=".people">People</a>
    <a href="#" data-filter=".places">Places</a>
    <a href="#" data-filter=".food">Food</a>
    <a href="#" data-filter=".wedding">Wedding</a>

</div>

<div class="portfolioContainer">

    <div class="wedding">
        <img src="/files/photos/1.jpg" alt="image">
    </div>

    <div class="wedding places">
        <img src="/files/photos/2.jpg" alt="image">
    </div>

    <div class="wedding places">
        <img src="/files/photos/3.jpg" alt="image">
    </div>

    <div class="people wedding">
        <img src="/files/photos/4.jpg" alt="image">
    </div>

    <div class="places people">
        <img src="/files/photos/5.jpg" alt="image">
    </div>

    <div class="wedding">
        <img src="/files/photos/6.jpg" alt="image">
    </div>

    <div class="places people wedding">
        <img src="/files/photos/7.jpg" alt="image">
    </div>

    <div class="places wedding">
        <img src="/files/photos/8.jpg" alt="image">
    </div>

    <div class="food">
        <img src="/files/photos/9.jpg" alt="image">
    </div>

    <div class="people places">
        <img src="/files/photos/10.jpg" alt="image">
    </div>

    <div class="people">
        <img src="/files/photos/11.jpg" alt="image">
    </div>

    <div class="people wedding">
        <img src="/files/photos/12.jpg" alt="image">
    </div>

    <div class="food">
        <img src="/files/photos/13.jpg" alt="image">
    </div>

    <div class="people places wedding">
        <img src="/files/photos/14.jpg" alt="image">
    </div>

    <div class="places">
        <img src="/files/photos/15.jpg" alt="image">
    </div>

</div>
