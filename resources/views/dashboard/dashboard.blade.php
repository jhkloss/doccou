@extends('layout.layout')

@section('content')
    <section class="tile-course">
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification">
                    <p class="title">Dashboard</p>
                    <p class="subtitle">See all the important things in one place.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="dashboard">
        <div class="tile is-ancestor ">
            <div class="tile is-parent">
                <article class="tile is-child notification">
                    <p class="title">Courses</p>
                    <p class="subtitle">Here you can see the courses you are part of.</p>
                    @if($courses)
                        @each('dashboard.dashboard-item', $courses, 'item')
                    @endif
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification">
                    <p class="title">Tasks</p>
                    <p class="subtitle">All tasks assigned to you will appear in this list.</p>
                    @if($tasks)
                        @each('dashboard.dashboard-task', $tasks, 'task')
                    @endif
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification">
                    <p class="title">Containers</p>
                    <p class="subtitle">Quick access to your development containers.</p>
                    @if($containers)
                        @each('dashboard.dashboard-container', $containers, 'container')
                    @endif
                </article>
            </div>
        </div>
    </section>
@endsection
