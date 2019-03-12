<!-- post -->
<div class="col-md-4">
    <div class="post">
        <a class="post-img" href="blog-post.html">
            {{ Html::image($post->getImageAttribute(), $post->image, ['class' => 'card-img-top']) }}

        </a>
        <div class="post-body">
            <div class="post-meta">
                <a class="post-category cat-1" href="category.html">Web Design</a>
                <span class="post-date">{{ humanize_date($post->posted_at) }}</span>
            </div>
            <h3 class="post-title">{{ link_to_route('posts.show', $post->title, $post) }}</h3>
        </div>
    </div>
</div>

<!-- /post -->
