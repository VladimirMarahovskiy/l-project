@foreach($category as $key=> $item)
    <li class="cat-{{$key+1}}">{{ link_to_route('category', $item->title ,$item->id) }}</li>

@endforeach
