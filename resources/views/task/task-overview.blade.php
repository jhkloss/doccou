@extends('layout.layout')

@section('content')
    <h1 class="title">Your Tasks</h1>

    <section class="section course-list">
        <div class="tile is-ancestor is-vertical">
            @if($tasks)
                @each('task/task-entry', $tasks, 'task')
            @else
                <div class="tile">
                    <span>There are not Tasks for you!</span>
                </div>
            @endif
        </div>

        {{ $tasks->links() }}

    </section>
@endsection
