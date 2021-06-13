{{-- </div>
</div> --}}
<footer class="footer">
    <div class="container-fluid">
      <nav class="float-left">
        <ul>
          <li>
            <a href="https://www.creative-tim.com">
              Creative Tim
            </a>
          </li>
          <li>
            <a href="https://creative-tim.com/presentation">
              About Us
            </a>
          </li>
          <li>
            <a href="http://blog.creative-tim.com">
              Blog
            </a>
          </li>
          <li>
            <a href="https://www.creative-tim.com/license">
              Licenses
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, made with <i class="material-icons">favorite</i> by
        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
      </div>
    </div>
  </footer>
  @section("javascript")
  <script src="{{ asset("vendor/jquery/jquery.min.js")}}"></script>
  <script src="{{ asset("vendor/popper.js/umd/popper.min.js")}}"> </script>
  <script src="{{ asset("vendor/bootstrap/js/bootstrap.min.js")}}"></script>
  <script src="{{ asset("vendor/js/bootstrap-material-design.min.js")}}"> </script>
  <script src="{{ asset("vendor/js/plugins/moment.min.js")}}"></script>
  <script src="{{ asset("vendor/js/plugins/sweetalert2.js")}}"></script>
  <script src="{{ asset("vendor/js/plugins/jquery.bootstrap-wizard.js")}}"></script>
  <script src="{{ asset("vendor/js/plugins/arrive.min.js")}}"></script>
  <script src="{{ asset("vendor/js/plugins/bootstrap-notify.js")}}"></script>
  <script src="{{ asset("vendor/js/plugins/perfect-scrollbar.jquery.min.js")}}"></script>
  <script src="{{ asset("vendor/js/plugins/bootstrap-selectpicker.js")}}"></script>
  <script src="{{ asset("vendor/js/plugins/nouislider.min.js")}}"></script>
  <script src="{{ asset("vendor/js/material-dashboard.js?v=2.1.2")}}" type="text/javascript"></script>
  <script src="{{ asset("assets/js/main.js")}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  @show

  

</body>

</html>