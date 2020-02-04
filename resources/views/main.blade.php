@extends ('layout.layout')

@section('scripts')
    <script src="{{ URL::asset('js/Chart.js') }}"></script>
    <script src="{{ URL::asset('js/doccou-charts.js') }}"></script>
@endsection

@section('content')
    <section class="tile-course">
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child">
                    <div class="box">
                        <p class="title">Doccou - Docker Courses for everyone.</p>
                        <p class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="welcome">
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child">
                    <div class="box">
                        <p class="title">Some stats for your entertainment.</p>
                        <canvas id="myChart"></canvas>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section>
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification is-primary">

                </article>
            </div>
        </div>
    </section>
@endsection
