<?php

Breadcrumbs::for('front_index', function ($trail) {
    $trail->push('Главная', route('front_index'));
});

Breadcrumbs::for('front_catalog', function ($trail, $category) {
    $trail->parent('front_index');
    if ($category->parent) {
        if ($category->parent->parent) {
            $trail->push($category->parent->parent->title, $category->parent->parent->getPath());
        }
        $trail->push($category->parent->title, $category->parent->getPath());
    }
    $trail->push($category->title, $category->getPath());
});

Breadcrumbs::for('front_product', function ($trail, $product) {
    //dd($product->category);
    $trail->parent('front_catalog', $product->category);
    $trail->push($product->title, '');
});

Breadcrumbs::for('page', function ($trail, $title) {
    $trail->parent('front_index');
    $trail->push($title, '');
});

Breadcrumbs::for('login', function ($trail) {
    $trail->parent('front_index');
    $trail->push('Авторизация', route('login'));
});

