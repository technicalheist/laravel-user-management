<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="{{ url('/') }}" class="brand-logo">Logo</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{url('/my-account')}}">My Account</a></li>
            @if(isAuthorized('can_manage_user'))
            <li><a href="{{url('/users')}}">Users</a></li>
            @endif
            <li><a href="{{url('/logout')}}">Logout</a></li>
        </ul>

        <ul id="nav-mobile" class="sidenav">
            <li><a href="{{url('/my-account')}}">My Account</a></li>
            @if(isAuthorized('can_manage_user'))
            <li><a href="{{url('/users')}}">Users</a></li>
            @endif
            <li><a href="{{url('/logout')}}">Logout</a></li>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>
