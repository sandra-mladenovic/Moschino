@extends('layouts.admin.layout')
@section('title')
Inbox
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="col-lg-12">
                <div class="card card-stats">
                  <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                      <i class="fa fa-envelope"></i>
                    </div>
                    <p class="card-category">Message</p>
                  </div>
                  <div class="card-body">

                    <h5 class="card-category">From:</h5>
                    <p class="card-title">{{$message->email}}</p>
                    <h5 class="card-category">Subject:</h5>
                    <p class="card-title">{{$message->subject}}</p>
                    <h5 class="card-category">Message:</h5>
                    <p class="card-title">{{$message->message}}</p>

                  </div>
                  <div class="card-footer">
                    <div class="stats">

                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
</div>
@endsection
