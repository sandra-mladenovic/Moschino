<body class="">
    <div class="wrapper ">
      <div class="sidebar" data-color="purple" data-background-color="white">
        <div class="logo adminName" class="simple-text logo-normal">
            {{session()->get('user')->full_name}}<br>{{session()->get('user')->email}}
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
            @foreach ($navigation as $nav)
            <li @if(Request::url() === url($nav['href']))
            class="nav-item active" @else class="nav-item" @endif>
              <a class="nav-link" href="{{ url($nav['href']) }}">
                <i class="material-icons">{{$nav['icon']}}</i>
                <p>{{$nav['title']}}</p>
              </a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="main-panel">