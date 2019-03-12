<div class="card">
    {{ Html::image($post->getImageAttribute(), $post->image, ['class' => 'card-img-top']) }}


    <div class="card-body">
        <h4 v-pre class="card-title">{{ link_to_route('posts.show', $post->title, $post) }}</h4>

        <p class="card-text">
            <small v-pre
                   class="text-muted">{{ link_to_route('users.show', $post->author->fullname, $post->author) }}</small>
        </p>

        <p class="card-text">
            <small class="text-muted">{{ humanize_date($post->posted_at) }}</small>
            <br>
            <small class="text-muted">
                <i class="fa fa-comments-o" aria-hidden="true"></i> {{ $post->comments }}

            </small>
        </p>
    </div>
</div>
