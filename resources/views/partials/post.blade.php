@foreach($posts as $p)
    <article>
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
            </p>
        </div>
        <footer class="entry-footer">
					<span class="cat-links blueText">
					{{$p->full_name}}
					</span>
        </footer>
    </article>
@endforeach
