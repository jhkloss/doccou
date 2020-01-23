@extends('layout/layout')

@section('content')

    <h1 class="title">Create a new Course</h1>

    <form action="{{ route('formNewCourse')  }}" method="POST">
        {{ csrf_field() }}
        <div class="tile is-ancestor is-vertical is-6">

            <div class="tile is-parent">
                <div class="field">
                    <label for="name" class="label">Name</label>
                    <p class="control has-icons-left">
                        <input id="name" class="input" name="name" type="text">
                        <span class="icon is-small is-left">
                     <i class="fas fa-school"></i>
                </span>
                    </p>
                </div>
            </div>

            <div class="tile is-parent">

                <div class="field">
                    <label class="label" for="description">Description</label>
                    <textarea id="description" class="textarea" name="description" placeholder="Description" rows="5">
                    </textarea>
                </div>
            </div>

            <div class="tile is-parent">
                <div class="field">
                    <p class="control">
                        <button class="button" type="submit">
                            Save
                        </button>
                    </p>
                </div>
            </div>

        </div>
    </form>

@endsection
