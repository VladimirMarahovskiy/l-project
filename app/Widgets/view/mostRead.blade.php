@if($posts)
    <div class="row">
        <div class="col-md-12">
            <div class="section-title">
                <h2>@lang('posts.most_read')</h2>
            </div>
        </div>
        @each('Widgets::_mostReadPost', $posts, 'post')

    </div>
@endif
