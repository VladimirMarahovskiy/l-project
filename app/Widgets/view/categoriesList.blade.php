@if($categories)
    <div class="section-title">
        <h2>@lang('posts.categories')</h2>
    </div>
    <div class="category-widget">
        <ul>
            @foreach($categories as $category)
                <li><a href="#" class="cat-1">{{$category->title}}<span>340</span></a></li>
            @endforeach
        </ul>
    </div>
@endif
