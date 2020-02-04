<div class="container">
    <article>


    <div id="menu-box" class="box">
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
                <li><a>Courses</a></li>
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
            <p class="menu-label">
                More
            </p>
            <ul class="menu-list">
                <li><a>Report an Issue</a></li>
                <li><a>Contact</a></li>
                <li><a>Imprint</a></li>
            </ul>
        </aside>
    </div>
    </article>
</div>

