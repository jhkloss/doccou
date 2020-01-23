@extends('layout/layout')

@section('content')
    <h1 class="title">Courses</h1>

    <section class="section course-list">
        <div class="tile is-ancestor is-vertical">
            @if($courses)
                @each('course/course-entry', $courses, 'course')
            @else
                <div class="tile">
                    <span>You dont see any courses? Create one!</span>
                </div>
            @endif
        </div>

        {{ $courses->links() }}

    </section>
    <a href="{{ route('createCourse')  }}">
    <button class="button is-primary is-medium is-rounded floating">
        <span class="icon is-small">
          <i class="fas fa-plus"></i>
        </span>
        <span>Add</span>
    </button>
    </a>
@endsection
