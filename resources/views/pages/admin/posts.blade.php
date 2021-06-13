@extends('layouts.admin.layout')
@section('title')
Posts
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
              <h4 class="card-title ">Posts</h4>
              <p class="card-category"> Add, edit, delete post</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th class="blueText"> ID</th>
                    <th class="blueText"> Post</th>
                    <th class="blueText">Title</th>
                    <th class="blueText">Published</th>
                    <th class="blueText">Updated</th>
                    <th class="blueText">Edit/Delete</th>
                  </thead>
                  <tbody>
                    <?php $br=1?>
                      @foreach ($posts as $p)
                    <tr>
                      <td> {{$br++}}</td>
                      <td><img src="{{asset('/assets/images/'.$p->photo)}}" alt="" class="slika"></td>
                      <td> {{$p->title}}</td>
                      <td>{{date('d.m.Y.', strtotime($p->created_at))}}</td>
                      <td>{{date('d.m.Y.', strtotime($p->updated_at))}}</td>
                      <td class="td-actions">
                       <a href="{{route('posts.edit',$p->id_post)}}">
                        <button class="btn btn-success btn-fab btn-fab-mini btn-round">
                          <i class="material-icons">edit</i>
                        </button>
                       </a>
                          <button class="btn btn-danger btn-fab btn-fab-mini btn-round btnAdminDelete" data-id={{$p->id_post}}>
                            <i class="material-icons">close</i>
                          </button>
                          <form action="" id="deleteFormaAdmin" method="post">
                            @method('delete')
                            @csrf
                            <div class="modal fade" tabindex="-1" id="deleteModalAdmin" role="dialog">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelAdmin">Delete Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Are you sure you want to delete this post?</p>
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
           <a href="{{route('posts.create')}}"> <button class="btn btn-primary ">Add New Post</button></a>
        </div>
      </div>
    </div>
</div>
@endsection
