<div class="comment">
    <div class="comment-header d-flex justify-content-between">
        <div class="user d-flex align-items-center">
            <div class="title"><strong>{{$c->full_name}}</strong><span class="date">/{{date('F Y', strtotime($c->date))}}</span></div>
        </div>
    </div>
    <div class="comment-body">
        <p>{{$c->comment}}</p>
    </div>
</div>
