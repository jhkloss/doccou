@extends ('layout.layout')

@section('scripts')
    <script src="{{ URL::asset('js/docker-engine.js') }}"></script>
@endsection

@section('content')
    <section class="tile-course">
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification">
                    <p class="title">{{ $task->name }}</p>
                    <p class="subtitle">Course: <a href="{{ route('viewCourse', $task->course->id ) }}">{{ $task->course->name }}</a></p>
                    <p class="content">{{ $task->description }}</p>
                </article>
            </div>
        </div>
    </section>

    <section class="tile-dockerfile">
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification">
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
                                        <button id="uploadDockerfile" class="button is-success" type="submit">
                                            Upload
                                        </button>
                                    </div>
                                </p>
                            </div>
                        </div>

                    </form>
                    <p class="subtitle">Current Dockerfile Contents:</p>
                    <pre>
                        @if($dockerfile)
                             {!! $dockerfile !!}
                        @else
                            No Dockerfile uploaded yet.
                        @endif
                    </pre>
                </article>
            </div>
        </div>
    </section>

    <section>
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification">
                    <p class="title">Image</p>
                    <div class="buttons">
                        <button id="create-image-btn" class="button is-success" @if(!$dockerfile) disabled @endif()>
                            Create Image from Dockerfile
                        </button>
                    </div>
                    <pre>
                        <ul>
                            <li><strong>Image Status:</strong></li>
                            @if($imageInfo)
                                <li>ImageID: {{ $imageInfo->Id }}</li>
                                <li>Tag: {{ $imageInfo->RepoTags[0] }}</li>
                                <li>Created: {{ $imageInfo->Created }}</li>
                            @else
                                <li><strong>Not created yet</strong></li>
                            @endif
                        </ul>
                    </pre>
                </article>
            </div>
        </div>
    </section>

    <section>
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification">
                    <p class="title">Container</p>
                    <div class="buttons">
                        <button id="create-container-btn" class="button is-success" @if(!$hasDockerimage) disabled @endif()>
                            Create Course Containers
                        </button>
                    </div>

                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                        <tr>
                            <th>Container</th>
                            <th>Member</th>
                        </tr>
                        </thead>
                        <tbody>
                            {!! $containerInfo !!}
                        </tbody>
                    </table>

                </article>
            </div>
        </div>
    </section>

    <div id="taskID" class="is-hidden" data-taskid="{{ $task->id }}"></div>
@endsection
