@extends('layouts.layout')
@section('title')
    {{$post->title}}
@endsection
@section('content')
    <div id="content" class="site-content">
        <div id="primary" class="content-area column two-thirds">
            <main id="main" class="site-main" role="main">
                <article>
                    <header class="entry-header">
                        <h1 class="entry-title">{{$post->title}}</h1>
                        <div class="entry-meta">
                            <span class=""><i class="fa fa-eye" aria-hidden="true"></i>{{$post->view}}</span> |
                            <span class="posted-on"><time class="entry-date published">{{date('F d, Y', strtotime($post->created_at))}}</time></span>
                        </div>
                        <div class="entry-thumbnail">
                            <img src="http://s3.amazonaws.com/caymandemo/wp-content/uploads/sites/10/2015/09/30160348/sep4.jpg" alt="">
                        </div>
                    </header>
                    <!-- .entry-header -->
                    <div class="entry-content">
                        {!!$post->content !!}
                    </div>
                </article>
                <!-- #post-## -->

                <!-- .navigation -->
                <div id="comments" class="comments-area">
                    <div id="respond" class="comment-respond">
                        <h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow" id="cancel-comment-reply-link" href="/demo-moschino/embed-audio/#respond" style="display:none;">Cancel reply</a></small></h3>
                        <div class="post-comments">
                            <header>
                                <h3 class="h6 blueText blueTextSize">Post Comments<span class="no-of-comments">({{count($comm)}})</span></h3>
                            </header>
                            <div id="allComments">
                                @foreach ($comm as $c)
                                    @component('partials.comment',["c"=>$c])
                                    @endcomponent
                                @endforeach
                            </div>
                        </div>
                        @if(session()->has('user'))
                            <div class="add-comment">
                                <header>
                                    <h3 class="h6">Leave a comment</h3>
                                </header>
                                <form  class="commenting-form">
                                    <div class="row">
                                        <input type="hidden" name="post" id="id_post" value="{{$post->id_post}}">
                                        <input type="hidden" name="user" id="id_user" value="{{session()->get('user')->id_user}}">
                                        <div class="form-group col-md-12">
                                            <textarea name="usercomment" id="usercomment" placeholder="Type your comment" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-12 text-muted" id="text-error"></div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-secondary" id="btnComment">Submit Comment</button>
                                        </div>
                                    </div>
                                </form>
                                @isset($errors)
                                    @foreach($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                @endisset
                            </div>
                        @else
                            <a href="{{url('/login')}}"><button class=" btn-to-log-in">Login To Comment</button></a>
                        @endif

                    </div>
                    <!-- #respond -->
                </div>
                <!-- #comments -->
            </main>
            <!-- #main -->
        </div>
        @include('fixed.sidebar')
    </div>
@endsection
