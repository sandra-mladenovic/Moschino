@extends('layouts.layout')
@section('title')
    Login
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <main class="posts-listing col-lg-8">
                <div class="container">
                    <div class="col-md-12">
                        @isset($errors)
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-group">
                                        @foreach($errors->all() as $poruka)
                                            <li class="list-group-item">
                                                {{ $poruka }} <br/>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endisset
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="">
                            <h5 class="text-center loginText">Sign in with your account</h5>
                        </div>
                        <div class="card-body">
                            <form class="wpcf7" method="POST" action="{{ url("/register") }}" id="contactform">
                                @csrf
                                <div class="form">
                                    <p><input type="text" class="form-control" id="name" name="name" placeholder="Full Name *"></p>
                                    <p><input type="email" class="form-control" id="email" name="email" placeholder="Email *"></p>
                                    <p><input type="password"  class="form-control" id="password" name="password" placeholder="Password *"></p>
                                    <button type="submit" id="submit" class="btn loginInput blue blueHover">Register</button>
                                    <a href="{{url('/login')}}" class=" loginInput blueTextHover">Sign in?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
@endsection
