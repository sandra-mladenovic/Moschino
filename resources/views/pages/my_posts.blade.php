@extends("layouts.layout")
@section('title')
    My Posts
@endsection
@section('content')
    <div class="container">
        <div class="col-lg-12 centered">

            <main id=""class="posts-listing">
                <div class="container">
                    <div class="row" id="bb"></div>
                    <div class="">
                        <div class="prof-info col-md-6">
                            <h3>{{isset($user)?$user->full_name : session()->get('user')->full_name}}'s Posts</h3>
                            <span class="info"><i class="fa fa-envelope-o" aria-hidden="true"></i>  email {{isset($user)?$user->email : session()->get('user')->email}}</span><br>
                            <span class="info"><i class="fa fa-calendar-o" aria-hidden="true"></i> Joined {{isset($user)? date('F Y', strtotime($user->registrated_at)) :  date('F Y', strtotime(session()->get('user')->registrated_at)) }}</span>
                        </div>
                    </div>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                            @endif
                        @endforeach
                    </div>
                    @if(count($posts))

                        @if(!isset($user) || ((session()->has('user')) && $id==session()->get('user')->id_user))
                                <div class="prof-info col-md-6">
                                <a href="{{url('user_posts/create')}}" class="new"><button type="button" class="btn btn-blue">Create Post</button></a>
                                </div>
                    </div>
                        @endif
                        @foreach ($posts as $post)
                            @if(isset($user))
                                @component('partials.my_posts',["p"=>$post,"user"=>$user,"id"=>$id])
                                @endcomponent
                            @else
                                @component('partials.my_posts',["p"=>$post])
                                @endcomponent
                            @endif
                        @endforeach
                    @else
                        <div class="container" id="noPosts">
                            <h3>No posts yet</h3>
                            @if(!isset($user) || ((session()->has('user')) && $id==session()->get('user')->id_user))
                                <a href="{{url('user_posts/create')}}"><button type="button" class="btn btn-outline-success">Create First Post</button></a>
                            @endif
                        </div>
                    @endif
                </div>
            </main>
    </div>
@endsection
