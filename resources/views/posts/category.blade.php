@extends('layouts.app')

@section('content')


    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            @foreach($posts as $post)

                @include ('posts/_show')
            @endforeach
            <!-- /row -->

        </div>
        <!-- /container -->
    </div>

    <!-- /section -->
@endsection
