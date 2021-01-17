<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > About
Breadcrumbs::for('about', function ($trail) {
    $trail->parent('home');
    $trail->push('About', route('about'));
});

// Home > Contact
Breadcrumbs::for('contact', function ($trail) {
    $trail->parent('home');
    $trail->push('contact', route('contact'));
});

// Home > Shop
Breadcrumbs::for('shop', function ($trail) {
    $trail->parent('home');
    $trail->push('shop', route('shop'));
});

// Home > Cart
Breadcrumbs::for('cart', function ($trail) {
    $trail->parent('shop');
    $trail->push('cart', route('checkout.cart'));
});

// Home > Checkout
Breadcrumbs::for('checkout', function ($trail) {
    $trail->parent('cart');
    $trail->push('checkout', route('checkout.index'));
});

// Home > Shop > [Category]
Breadcrumbs::for('category', function ($trail) {
    $trail->parent('home');
    $trail->push('categories', route('category.show'));
});

// Home > Shop > [Category] > [Product]
Breadcrumbs::for('product', function ($trail, $product) {
    $trail->parent('category', $product->categories);
    $trail->push($product->name, route('product.show', $product->slug));
});