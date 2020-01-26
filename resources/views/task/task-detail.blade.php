@extends ('layout.layout')

@section('content')
    <section class="tile-course">
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification is-info">
                    <p class="title">{{ $task->name }}</p>
                    <p class="subtitle">{{ $task->description }}</p>
                </article>
            </div>
        </div>
    </section>
@endsection
