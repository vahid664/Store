<?php
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('خانه', route('home'));
});

// Home > Blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push('وبلاگ', route('Blog.index'));
});

// Home > Contact
Breadcrumbs::for('contact', function ($trail) {
    $trail->parent('home');
    $trail->push('تماس با ما', route('Contact.index'));
});

Breadcrumbs::for('search', function ($trail,$title) {
    $trail->parent('home');
    $trail->push($title, route('search.index'));
});

// Home > Blog > [Post]
Breadcrumbs::for('Blog_post', function ($trail, $post) {
    $trail->parent('blog');
    $trail->push($post->title, route('Blog.show', $post->id));
});


Breadcrumbs::for('category', function ($trail, $category) {
    if ($category->parents) {
        $trail->parent('category', $category->parents);
    } else {
        $trail->parent('home');
    }
    $trail->push($category->title, url(\Illuminate\Support\Str::slug($category->title_en)));
});

Breadcrumbs::for('product', function ($trail, $post) {
    $trail->parent('category', $post->category_last->category);
    $trail->push($post->title, route('Product.index', $post->id));
});







