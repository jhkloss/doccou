<div class="container">
    <div id="menu-box" class="box">
        <img src="{{ asset('gfx/Doccou.svg') }}" width="112" height="50">
        <aside class="menu">
            <p class="menu-label">
                General
            </p>
            <ul class="menu-list">
                <li class="is-disabled"><a href="{{ URL::to('/') }}">Doccou Home</a></li>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @if(Auth::check())
                    <li><a href="">Your Profile</a></li>
                @endif
            </ul>
            @if(Auth::check())
            <p class="menu-label">
                Course Administration
            </p>
            <ul class="menu-list">
                <li><a href="{{ route('courses') }}">Courses</a></li>
                <li><a class="">Tasks</a></li>
                <li><a class="">Containers</a></li>
            </ul>
            <p class="menu-label">
                Latest Activity
            </p>
            <ul class="menu-list">
                <li><a>Task 1</a></li>
                <li><a>Task 2</a></li>
                <li><a>Task 3</a></li>
            </ul>
            @endif
            <p class="menu-label">
                About
            </p>
            <ul class="menu-list">
                <li><a>Docker</a></li>
                <li><a>Doccou</a></li>
            </ul>
            <p class="menu-label">Account</p>
            <ul class="menu-list">
                @if(Auth::check())
                    <li>
                        Logged in as <strong>{{ Auth::user()->name }}</strong>
                        <div id="logout" class="buttons is-left">
                            <a href="{{ route('logout')  }}" class="button is-danger is-outlined">
                                <strong>Logout</strong>
                            </a>
                        </div>
                    </li>
                @else
                <li>
                    <div class="buttons is-centered">
                        <a href="{{ route('register')  }}" class="button is-primary">
                            <strong>Sign up</strong>
                        </a>
                        <a id="login-btn" class="button is-light">
                            Log in
                        </a>
                    </div>
                </li>
                @endif
            </ul>
        </aside>
    </div>
</div>

