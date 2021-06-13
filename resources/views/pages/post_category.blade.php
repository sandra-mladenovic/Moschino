@extends('layouts.layout')
@section('title')
    {{$name->category}}
@endsection
@section('content')

                <header class="">
                    <h3 class="page-title">
                        {{$name->category}}
                    </h3>
                </header>

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
                            {{$posts->links()}}
                            <br/>
                        </main>
                        <!-- #main -->
                    </div>
                    <!-- #primary -->

                @include('fixed.sidebar')
                <!-- #secondary -->
                </div>

@endsection
