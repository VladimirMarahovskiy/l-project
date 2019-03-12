@if($posts)
    <div class="row">
        <div class="col-md-12">
            <div class="section-title">
                <h2>@lang('posts.recent_posts')</h2>
            </div>
        </div>
        @each('Widgets::_recentPost', $posts, 'post')

    </div>
@endif
