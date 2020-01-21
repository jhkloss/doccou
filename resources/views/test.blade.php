@extends('layout/layout')

@section('content')
    <section class="section course-list">
        <div class="container">
            <div class="tile is-ancestor is-vertical">
                @each('course/course-entry', $courses, 'course')
            </div>
        </div>
    </section>
@endsection

@section('login')
    @include('partials/login')
@endsection
