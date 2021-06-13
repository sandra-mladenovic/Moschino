<article class="centered">
    <header class="entry-header">
        <h1 class="entry-title"><a href="{{url('/posts',$p->id_post)}}" rel="bookmark">{{$p->title}}</a></h1>
        <div class="entry-meta">
            <span class=""><i class="fa fa-eye" aria-hidden="true"></i>{{$p->view}}</span> |
            <span class="posted-on"><time class="entry-date published">{{date('F d, Y', strtotime($p->created_at))}}</time></span>
        </div>
        <div class="entry-thumbnail">
            <img src="{{asset('assets/images/'.$p->photo)}}" alt="{{$p->title}}">
        </div>
    </header>
    <div class="entry-summary">
        <p>
            {{$p->description}}
            <a class="more-link" href="blog-single.html">Read more</a>
        </p>
    </div>
    <footer class="entry-footer">
					<span class="cat-links">
					Posted by <a href="#">{{$p->full_name}}</a>
					</span>
    </footer>
</article>
        @if(!isset($user) || ((session()->has('user')) && $id==session()->get('user')->id_user))
            <div class="edit col-lg-12 centered">
                <a href="{{route('user_posts.edit',$p->id_post)}}"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                <button type="button" class="btn btn-danger btn-sm" id="btnDeletePost" data-id="{{$p->id_post}}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                <form action="" id="deleteForma" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="form-group">Are you sure you want to delete this post?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
                                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
{{-- </div> --}}
