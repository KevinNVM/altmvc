<?php

require_once __DIR__ . '/../models/post.php';

function posts_index()
{
    view('posts/index.php', [
        'posts' => all_posts()
    ]);
}
function posts_show($slug)
{
    $post = fetchOne(query(("SELECT * FROM posts WHERE slug = '$slug'")));
    view('posts/show.php', compact('post'));
}