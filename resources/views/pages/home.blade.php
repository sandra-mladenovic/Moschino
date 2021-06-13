@extends('layouts.layout')
@section('title')
    Home
@endsection
@section('content')
    <div id="content" class="site-content">
        <div id="primary" class="content-area column two-thirds">
            <main id="main" class="site-main" role="main">
                <div class="grid bloggrid">
                    <div class="row" id="postovi">
                    @component('partials.post', ['posts'=>$posts])
                    @endcomponent
                    </div>
                </div>
                <div class="clearfix">
                </div>
                <nav class="container">
                    <div class="row">
                        <div class="col-sm-12 pagination">
                            {{$posts->links()}}
                        </div>
                    </div>
                    <!-- <span class="page-numbers current">1</span>
                    <a class="page-numbers" href="#">2</a>
                    <a class="next page-numbers" href="#">Next »</a> -->
                </nav>
                <br/>
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->

        @include('fixed.sidebar')
        <!-- #secondary -->
    </div>

@endsection
