@extends('layouts.admin.layout')
@section('title')
Categories
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
                <h4 class="card-title ">Category</h4>
                <p class="card-category"> Add, edit, delete category</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th class="blueText"> ID</th>
                      <th class="blueText"> Name</th>
                      <th class="blueText"> Creared</th>
                      <th class="blueText"> Updated</th>
                      <th class="blueText">Edit/Delete</th>
                    </thead>
                    <tbody>
                      <?php $br=1?>
                        @foreach ($categories as $c)
                      <tr>
                        <td> {{$br++}}</td>
                        <td>{{$c->category}}</td>
                        <td>{{date('d.m.Y.', strtotime($c->created_at))}}</td>
                        <td>{{date('d.m.Y.', strtotime($c->updated_at))}}</td>
                        <td class="td-actions">
                         <a href="{{route('category.edit',$c->id_category)}}">
                          <button class="btn btn-success btn-fab btn-fab-mini btn-round">
                            <i class="material-icons">edit</i>
                          </button>
                         </a>
                            <button class="btn btn-danger btn-fab btn-fab-mini btn-round btnAdminDeleteCat" data-id={{$c->id_category}}>
                              <i class="material-icons">close</i>
                            </button>
                            <form action="" id="deleteFormaAdminCat" method="post">
                              @method('delete')
                              @csrf
                              <div class="modal fade" tabindex="-1" id="deleteModalAdminCat" role="dialog">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabelAdminCat">Delete Category</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <p>Are you sure you want to delete this category?</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-primary btn-danger">Yes, delete</button>
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
             <a href="{{route('category.create')}}"> <button class="btn btn-blue ">Add New Category</button></a>
          </div>
      </div>
    </div>
</div>
@endsection
