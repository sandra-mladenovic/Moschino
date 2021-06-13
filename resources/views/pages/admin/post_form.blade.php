@extends('layouts.admin.layout')
@section('title')
@if(isset($post)) Edit Post @else Create Post  @endif
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
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
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{isset($post)? "Edit Post" : "Add New Post"}}</h4>
              <p class="card-category">{{isset($post)? "Change post" : "Create post"}}</p>
            </div>
            <div class="card-body">
              <form action="{{isset($post)? route('posts.update',$post->id_post):route('posts.store')}}" method="post" enctype="multipart/form-data">
                         @csrf
                        @if(isset($post))
                        @method('PUT')
                        @endif
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Title</label>
                      <input type="text" class="form-control" name="title" value="{{isset($post)? $post->title : ''}}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Description</label>
                      <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{isset($post)? $post->description : ''}}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">Content</label>
                        <input id="content" type="hidden" name="content" cols="20" rows="20" value="{{isset($post)? $post->content : ''}}">
                        <trix-editor input="content"></trix-editor>
                    </div>
                  </div>
                </div>
                @isset($post)
                <div class="form-group">
                    <img src="{{asset('/assets/images/'.$post->photo)}}" alt="" style="width: 50%">
                </div>
                @endisset
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="image" class="bmd-label-floating">
                            Image
                        </label>
                        <input type="file" name="image" id="image" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="categories[]" class="bmd-label-floating">Categories</label><br>
                        @if(isset($post))
                        @foreach ($categories as $c)
                        @if($post->postCategories->contains('category',$c->category))
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" checked value="{{$c->id_category}}" name="categories[]">{{$c->category}}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @else
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="{{$c->id_category}}" name="categories[]">{{$c->category}}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @endif
                        @endforeach
                        @else
                        @foreach ($categories as $c)
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="{{$c->id_category}}" name="categories[]">{{$c->category}}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @endforeach
                        @endif
                    </div>
                  </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-blue pull-right">{{isset($post)? "Update Post":"Create Post"}}
                    </button>
                <div class="clearfix"></div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection

