@if($posts)
    <div class="row">
        <div class="col-md-12">
            <div class="section-title">
                <h2>@lang('posts.last_posts')</h2>
            </div>
        </div>
        <!-- post -->
        @each('Widgets::_lastPost', $posts, 'post')
        <!-- /post -->

    </div>
@endif
