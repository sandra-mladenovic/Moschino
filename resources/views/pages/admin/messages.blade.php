@extends('layouts.admin.layout')
@section('title')
Inbox
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Messages</h4>
                <p class="card-category">Users messages</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th> ID</th>
                      <th> Email</th>
                      <th> Subject</th>
                      <th> Date</th>
                      <th>View</th>
                    </thead>
                    <tbody id="com">
                      <?php $br=1?>
                        @foreach ($messages as $m)
                      <tr>
                        <td> {{$br++}}</td>
                        <td>{{$m->email}}</td>
                        <td>{{$m->subject}}</td>
                        <td>{{date('d.m.Y.', strtotime($m->date))}}</td>
                        <td class="td-actions">
                           <a href="{{url('/admin/messages',$m->id_message)}}">
                              <button class="btn btn-info"> Read</button>
                           </a>
                           <button class="btn btn-danger btn-fab btn-fab-mini btn btnAdminDeleteMess " data-id="{{$m->id_message}}">
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
