@extends ('layout.layout')

@section('scripts')
    <script src="{{ URL::asset('js/docker-engine.js') }}"></script>
@endsection

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

    <section class="tile-dockerfile">
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification is-info">
                    <p class="title">Dockerfile</p>
                    <p class="subtitle">Update the Dockerfile for this Task:</p>
                    <form action="{{ route('uploadDockerfile', $task->id) }}" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="file has-name">
                            <label class="file-label">
                                <input class="file-input" type="file" name="dockerfile">
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Choose a file…
                                    </span>
                                </span>
                                <span class="file-name">
                                    no file selected
                                </span>
                            </label>
                            <div class="field">
                                <p class="control">
                                    <div class="buttons">
                                        <button class="button is-success" type="submit">
                                            Upload
                                        </button>
                                    </div>
                                </p>
                            </div>
                        </div>

                    </form>
                    <p class="subtitle">Current Dockerfile Contents:</p>
                    <pre>{{ $dockerfile }}</pre>
                </article>
            </div>
        </div>
    </section>

    <section>
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification is-info">
                    <p class="title">Docker Engine</p>
                    <div class="buttons">
                        <button id="create-image-btn" class="button is-success">
                            Create Image from Dockerfile
                        </button>
                        <button id="create-container-btn" class="button is-success" @if(!$hasDockerimage) disabled @endif()>
                            Create Course Containers
                        </button>
                        <button id="" class="button is-danger" @if(!$hasDockerimage) disabled @endif()>
                            Stop all Containers
                        </button>
                    </div>
                    <pre></pre>
                </article>
            </div>
        </div>
    </section>

    <div id="taskID" class="is-hidden" data-taskid="{{ $task->id }}"></div>
@endsection
