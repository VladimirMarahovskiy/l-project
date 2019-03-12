{!! Form::open(['route' => 'home', 'class' => 'd-flex', 'method' => 'GET']) !!}

{!! Form::text('q', null, ['class' => 'search-input form-control', 'placeholder' => __('posts.search')]) !!}
<button class="search-close"><i class="fa fa-times"></i></button>
<button type="submit" class="btn btn-primary">
    <i class="fa fa-search" aria-hidden="true"></i>
</button>
{!! Form::close() !!}
