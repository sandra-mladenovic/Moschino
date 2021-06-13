@extends('layouts.admin.layout')
@section('title')
Users
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
              <h4 class="card-title ">Users</h4>
              <p class="card-category"> Add, edit, delete users</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th class="blueText"> ID</th>
                    <th class="blueText"> Name</th>
                    <th class="blueText">Email</th>
                    <th class="blueText">Role</th>
                    <th class="blueText">Registrated at</th>
                    <th class="blueText">Edit/Delete</th>
                  </thead>
                  <tbody>
                    <?php $br=1?>
                      @foreach ($users as $u)
                    <tr>
                      <td> {{$br++}}</td>
                      <td>{{$u->full_name}}</td>
                      <td> {{$u->email}}</td>
                      <td> {{$u->role}}</td>
                      <td> {{date('d.m.Y.', strtotime($u->registrated_at))}}</td>
                      <td class="td-actions">
                       <a href="{{route('users.edit',$u->id_user)}}">
                        <button class="btn btn-success btn-fab btn-fab-mini btn-round">
                          <i class="material-icons">edit</i>
                        </button>
                       </a>
                          <button class="btn btn-danger btn-fab btn-fab-mini btn-round btnAdminDeleteUser" data-id={{$u->id_user}}>
                            <i class="material-icons">close</i>
                          </button>
                          <form action="" id="deleteFormaAdminUser" method="post">
                            @method('delete')
                            @csrf
                            <div class="modal fade" tabindex="-1" id="deleteModalAdminUser" role="dialog">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelAdmin">Remove User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Are you sure you want to remove this user?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" id="deleteFormaAdminUser" class="btn btn-primary btn-danger">Yes, remove</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
           <a href="{{route('users.create')}}"> <button class="btn btn-blue ">Add New User</button></a>
        </div>
      </div>
    </div>
</div>
@endsection
