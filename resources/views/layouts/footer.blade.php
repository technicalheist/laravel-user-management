<footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">About The App</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Design by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>,
      App By <a class="orange-text text-lighten-3" href="http://technicalheist.com">Technical Heist</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="{{ url('/public/assets/js/materialize.js') }}"></script>
  <script src="{{ url('/public/assets/js/init.js') }}"></script>
  <script  src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready(function(){
    $(".dropdown-trigger").dropdown({ hover: false });
  })
  </script>
  @yield('footer_script')
  </body>
</html>
