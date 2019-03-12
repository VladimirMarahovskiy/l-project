<div class="col-md-12">
    <div class="post post-row">
        <a class="post-img" href="">
            {{ Html::image($post->getImageAttribute(), $post->image, ['class' => 'card-img-top']) }}
        </a>
        <div class="post-body">
            <div class="post-meta">
                <a class="post-category cat-2" href="category.html">category</a>
                <span class="post-date">{{ humanize_date($post->posted_at) }} {{ $post->comments_count }}</span>
            </div>
            <h3 class="post-title">
                {{ link_to_route('posts.show', $post->title, $post) }}</h3>
            <p>{{ $post->content }}</p>
        </div>
    </div>
</div>
