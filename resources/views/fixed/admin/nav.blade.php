<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">

        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link" href="{{url('/admin/messages')}}" id="navbarDropdownMenuLink"  aria-haspopup="true" >
              <i class="material-icons">notifications</i>
              @if($numOfmes)
                  @if($numOfmes == 1)
              <span class="numberOfMessages">{{$numOfmes}} New message</span>
                    @else
                        <span class="numberOfMessages">{{$numOfmes}} New messages</span>
                      @endif
              @else
                    <span class="numberOfMessages">No new messages</span>
                @endif

            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
