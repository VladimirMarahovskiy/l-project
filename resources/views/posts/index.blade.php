@extends('layouts.app')

@section('content')

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            @widget('latestPosts')
            <!-- /row -->

            <!-- row -->
            <div class="row">
                <div class="col-md-8">
                    @widget('mostRead')
                </div>

                <div class="col-md-4">

                    <!-- catagories -->
                    <div class="aside-widget">
                        @widget('categoryList')
                    </div>
                    <!-- /catagories -->

                    <!-- tags -->
                    <div class="aside-widget">
                        @widget('tagsList')

                    </div>
                    <!-- /tags -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>

    <!-- /section -->

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            @widget('recentPosts')
            <!-- /row -->

        </div>
        <!-- /container -->
    </div>

    <!-- /section -->
@endsection
