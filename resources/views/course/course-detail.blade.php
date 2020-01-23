@extends('layout.layout')

@section('content')
    <section class="tile-course">
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification is-info">
                    <p class="title">{{ $course->name }}</p>
                    <p class="subtitle">Course Details</p>
                </article>
            </div>
        </div>
    </section>

    <section class="course-detail">
        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8">
                <div class="tile">
                    <div class="tile is-parent">
                        <article class="tile is-child  notification is-info">
                            <p class="title">Description</p>
                            <p class="content">
                                {{ $course->description }}
                            </p>
                        </article>
                    </div>

                    <div class="tile is-parent">
                        <article class="tile is-child notification is-info">
                            <p class="title">Info</p>

                            <p><strong>Created at:</strong></p>
                            <p>{{ $course->created_at }}</p>

                            <p><strong>Created by:</strong></p>
                            <p>{{ $creator->name }} <small>{{ $creator->email }}</small></p>

                        </article>
                    </div>
                </div>

                <div class="tile is-parent">
                    <article class="tile is-child notification is-warning">
                        <p class="title">Members</p>
                        <p class="subtitle">See who is part of this course.</p>
                        <div class="tags member-list">
                            @each('member.member-entry', $members, 'member')
                        </div>
                    </article>
                </div>

            </div>

            <div class="tile is-parent">
                <article class="tile is-child notification is-success">
                    <p class="title">Tasks</p>
                    <p class="subtitle">Here are all the Tasks that belong to this course.</p>

                    <div class="task-list">
                        @each('task.task-entry-small', $tasks, 'task' )
                    </div>

                    @if(\App\Http\Controllers\Course\CourseController::canEdit($course->id))
                        <div class="buttons">
                            <a id="create-task-btn" data-courseid="{{ $course->id }}">
                                <button class="button is-rounded">
                             <span class="icon is-small">
                                <i class="fas fa-plus"></i>
                            </span>
                                    <span>Add</span>
                                </button>
                            </a>
                        </div>
                    @endif
                </article>
            </div>
        </div>
    </section>

    <div id="course-id" class="is-hidden" data-courseid="{{ $course->id }}"></div>

@endsection
