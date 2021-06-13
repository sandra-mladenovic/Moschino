@extends('layouts.admin.layout')
@section('title')
@if(isset($user)) Edit User @else Create User  @endif
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
              <h4 class="card-title">{{isset($user)? "Edit User" : "Add New User"}}</h4>
              <p class="card-category">{{isset($user)? "Change user" : "Create user"}}</p>
            </div>
            <div class="card-body">
              <form action="{{isset($user)? route('users.update',$user->id_user):route('users.store')}}" method="post">
                         @csrf
                        @if(isset($user))
                        @method('PUT')
                        @endif
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Full Name</label>
                      <input type="text" class="form-control" name="name" value="{{isset($user)? $user->full_name : ''}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                         <label class="bmd-label-floating">Email</label>
                        <input type="text" class="form-control" name="email" value="{{isset($user)? $user->email : ''}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">{{isset($user)? "Change Password" : "Password"}}</label>
                        <input type="password" class="form-control" name="password">
                      </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">{{isset($user)? "Update User":"Create User"}}
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


