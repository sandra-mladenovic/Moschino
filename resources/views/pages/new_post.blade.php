@extends('layouts.layout')
@section('title')
    @if(isset($post)) Edit Post @else Create Post  @endif
@endsection
@section('content')
    <div class="container-fluid centered">
        <div class="row">
            <main class="centered col-lg-12">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="editOrCreatePost">
                    {{isset($post)? "Edit Post" : "Create New Post"}}
                </div>
                <div class="card card-default">
                    <div class="card-body">
                        <form action="{{isset($post)? route('user_posts.update',$post->id_post):route('user_posts.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($post))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="title" class="labelText">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{isset($post)? $post->title : ''}}">
                            </div>
                            <div class="form-group">
                                <label for="description" class="labelText">Description</label>
                                <textarea name="description" id="description" cols="20" rows="5" class="form-control">{{isset($post)? $post->description : ''}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="content" class="labelText">Content</label>
                                <textarea id="content" type="textarea" cols="20" rows="20"  class="form-control" name="content">{{isset($post)? $post->content : ''}}</textarea>
                                <trix-editor input="content" ></trix-editor>
                            </div>
                            <div class="form-group">
                                <label for="categories[]" class="labelText">Categories</label><br>
                                @if(isset($post))
                                    @foreach ($categories as $c)
                                        @if($post->postCategories->contains('category',$c->category))
                                            <input type="checkbox" name="categories[]" checked value="{{$c->id_category}}" />
                                            {{$c->category}}
                                        @else
                                            <input type="checkbox" name="categories[]" value="{{$c->id_category}}" />{{$c->category}}
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($categories as $c)
                                        <input type="checkbox" name="categories[]" value="{{$c->id_category}}" />
                                        {{$c->category}}
                                    @endforeach
                                @endif
                            </div>
                            @isset($post)
                                <div class="form-group">
                                    <img src="{{asset('/assets/images/'.$post->photo)}}" alt="" style="width: 100%">
                                </div>
                            @endisset
                            <div class="form-group">
                                <label for="image" class="labelText">Image</label>
                                <input type="file" name="image" id="image" class="form-control" >
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-blue">
                                    {{isset($post)? "Update Post":"Create Post"}}

                                </button>
                            </div>
                        </form>
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
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
            @endsection
            @section('javascript')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>

            @endsection
            @section('css')
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css"/>

@endsection


