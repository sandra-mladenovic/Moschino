<div id="secondary" class="column third">
    <div id="sidebar-1" class="widget-area" role="complementary">
        <aside id="recent-posts-2" class="widget widget_recent_entries">
            <h4 class="widget-title">Recent Posts</h4>
            <ul>
                @foreach($recent_posts as $rp)
                <li>
                    <a href="{{url('/posts',$rp->id_post)}}">{{$rp->title}}</a>
                </li>
                @endforeach
            </ul>
        </aside>
        <div class="search-form">
            <div class="form-group">
                <input type="search"  class="form-control" placeholder="Search here" id="searchPost">
                <i class="icon-search submit"></i>
            </div>
        </div>
        <aside id="text-6" class="widget widget_text">
            <h4 class="widget-title">Like us on Facebook</h4>
            <div class="textwidget">
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fwowthemesnet-562560840468823%2F&amp;tabs=timeline&amp;width=340&amp;height=380&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=false&amp;appId=365036103630036" width="340" height="380" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true">
                </iframe>
            </div>
        </aside>

        <aside id="recent-comments-2" class="widget widget_recent_comments">
            <h4 class="widget-title">Popular Posts</h4>
            <ul id="recentcomments">
                @foreach($popular_posts as $pp)
                <li class="recentcomments"> <a href="{{url('/posts',$pp->id_post)}}">{{$pp->title}}</a></li>
                @endforeach
            </ul>
        </aside>


    </div>
    <!-- .widget-area -->
</div>
</div>
<!-- #content -->
</div>
