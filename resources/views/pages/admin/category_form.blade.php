@extends('layouts.admin.layout')
@section('title')
@if(isset($category)) Edit Category @else Create Category  @endif
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
              <h4 class="card-title">{{isset($category)? "Edit Category" : "Add New Category"}}</h4>
              <p class="card-category">{{isset($category)? "Change category" : "Create category"}}</p>
            </div>
            <div class="card-body">
              <form action="{{isset($category)? route('category.update',$category->id_category):route('category.store')}}" method="post">
                         @csrf
                        @if(isset($category))
                        @method('PUT')
                        @endif
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Category Name</label>
                      <input type="text" class="form-control" name="category_name" value="{{isset($category)? $category->category : ''}}">
                    </div>
                  </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">{{isset($category)? "Update Category":"Create Category"}}
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


