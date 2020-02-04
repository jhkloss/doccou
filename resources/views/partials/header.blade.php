<nav class="navbar is-light" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{ URL::to('/') }}">
            <img src="{{ asset('gfx/Doccou.svg') }}" width="112" height="50">
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
           data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
        </div>
        <div class="navbar-end">
            @if(Auth::check())
                <div class="navbar-item">
                    <div class="box">
                        Logged in as <strong>{{ Auth::user()->name }}</strong>
                    </div>
                </div>
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="{{ route('logout')  }}" class="button is-danger is-outlined">
                            <strong>Logout</strong>
                        </a>
                    </div>
                </div>
            @else
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="{{ route('register')  }}" class="button is-primary">
                            <strong>Sign up</strong>
                        </a>
                        <a id="login-btn" class="button is-light">
                            Log in
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>
