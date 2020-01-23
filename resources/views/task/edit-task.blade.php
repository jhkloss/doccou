@extends('layout.layout')

@section('content')
    <h1 class="title">Edit <strong>{{ $task->name }}</strong></h1>

    <form action="{{ route('formEditTask')  }}" method="POST">

        {{ csrf_field() }}

        <div class="tile is-ancestor is-vertical is-6">
            <div class="tile is-parent">
                <div class="field">
                    <label for="name" class="label">Name</label>
                    <p class="control">
                        <input id="name" class="input" name="name" type="text" value="{{ $task->name }}">
                    </p>
                </div>
            </div>

            <div class="tile is-parent">
                <div class="field">
                    <label class="label" for="description">Description</label>
                    <textarea id="description" class="textarea" name="description" placeholder="Description" rows="5">{{ $task->description }}</textarea>
                </div>
            </div>

            <input name="taskID" class="is-hidden" value="{{ $task->id }}">

            <div class="tile is-parent">
                <div class="field">
                    <p class="control">
                        <button class="button" type="submit">
                            Save Changes
                        </button>
                    </p>
                </div>
            </div>

        </div>
    </form>
@endsection
