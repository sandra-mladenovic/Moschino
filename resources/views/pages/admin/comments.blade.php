@extends('layouts.admin.layout')
@section('title')
Comments
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="flash-message">
              @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                @endif
              @endforeach
            </div>
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Comments</h4>
                <p class="card-category">delete comments</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th class="blueText"> ID</th>
                      <th class="blueText"> User</th>
                      <th class="blueText"> Post</th>
                      <th class="blueText"> Comment</th>
                      <th class="blueText"> Date</th>
                      <th class="blueText">Delete</th>
                    </thead>
                    <tbody id="com">
                      <?php $br=1?>
                        @foreach ($comments as $c)
                      <tr>
                        <td> {{$br++}}</td>
                        <td>{{$c->full_name}}</td>
                        <td>{{$c->title}}</td>
                        <td>{{$c->comment}}</td>
                        <td>{{date('d.m.Y.', strtotime($c->date))}}</td>
                        <td class="td-actions">
                            <button class="btn btn-danger btn-fab btn-fab-mini btn-round btnAdminDeleteCom " data-id={{$c->id_comment}}>
                              <i class="material-icons">close</i>
                            </button>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
      </div>
    </div>
@endsection
