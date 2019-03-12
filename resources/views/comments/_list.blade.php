<h2 class="mt-2">{{ trans_choice('comments.count', $post->comments_count) }}</h2>

@include ('comments/_form')

@php
//var_dump($post->comments()->get());
@endphp
<ul>
    @foreach(  $post->comments()->get() as $comment)
        <li>{{$comment->content}}</li>
    @endforeach
</ul>
