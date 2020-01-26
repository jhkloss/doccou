@extends('layout.layout')

@section('content')
    <section class="tile-course">
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification is-info">
                    <p class="title">Dashboard</p>
                    <p class="subtitle">See all the important things in one place.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="dashboard">
        <div class="tile is-ancestor ">
            <div class="tile is-parent">
                <article class="tile is-child notification is-info">
                    <p class="title">Courses</p>
                    <p class="subtitle">Here you can see the courses you are part of.</p>
                    @each('dashboard.dashboard-item', $courses, 'item')
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification is-info">
                    <p class="title">Tasks</p>
                    <p class="subtitle">All tasks assigned to you will appear here.</p>
                    @each('dashboard.dashboard-task', $tasks, 'task')
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification is-info">
                    <p class="title">Container</p>
                    <p class="subtitle">Quick access to your development containers.</p>
                </article>
            </div>
        </div>
    </section>
@endsection
