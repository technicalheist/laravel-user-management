@section('guest_nav')
<li><a href="{{url('/login')}}">Login</a></li>
<li><a href="{{url('/register')}}">Register</a></li>
@endsection


<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="{{ url('/') }}" class="brand-logo">Logo</a>
        <ul class="right hide-on-med-and-down">
        @yield('guest_nav')
        </ul>

        <ul id="nav-mobile" class="sidenav">
        @yield('guest_nav')
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>


