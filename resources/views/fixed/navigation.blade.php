<body class="blog">
<div id="page">
    <div class="container-fluid">
        <header id="masthead" class="site-header">
            <div class="site-branding">
                <h1 class="site-title"><a href="{{url('/')}}" rel="home">Moschino</a></h1>
            </div>
            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle">Menu</button>
                <a class="skip-link screen-reader-text" href="#content">Skip to content</a>
                <div class="menu-menu-1-container">
                    <ul id="menu-menu-1" class="menu">
                        <li><a  href="{{url('/home')}}">Home</a></li>
                        <li><a href="#">Categories</a>
                            <ul class="sub-menu">
                                @foreach($categories as $cat)
                                <li><a href="{{url('/posts_category',$cat->id_category)}}">{{$cat->category}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{url('/contact')}}">Contact</a></li>
                        @if(!session()->has('user'))
                        <li><a href="{{url('/login')}}">Login</a></li>
                        @else
                            <li><a href="{{url('/user_posts')}}">My posts</a></li>
                            @if(session()->get('user')->role=='admin')
                            <li><a href="{{url('/admin')}}">Admin</a></li>
                            @endif
                            <li><a href="{{url('/logout')}}">Logout</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </header>
