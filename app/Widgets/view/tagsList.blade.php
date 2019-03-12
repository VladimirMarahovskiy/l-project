@if($categories)
    <div class="tags-widget">
        <ul>
            @foreach($categories as $category)
                <li><a href="#" >{{$category->title}}</a></li>
            @endforeach
        </ul>
    </div>
@endif
