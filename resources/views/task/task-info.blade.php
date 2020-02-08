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
                    <p class="subtitle">{{ $task->description }}</p>
                </article>
            </div>
        </div>
    </section>

    <section class="tile-dockerfile">
        <div class="tile is-ancestor ">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child notification">
                    <p class="title">Your Development Info</p>
                    <p class="subtitle">Here you can see everything regarding your Development Containers</p>
                    <pre>
                        <ul>
                            <li><strong>Container Info</strong></li>
                        @if($containerInfo)
                            <li>Name: {{ $containerInfo->Name }}</li>
                            <li>Status: {{ $containerInfo->State->Status }}</li>
                            <li>IP-Address: {{ $containerInfo->NetworkSettings->IPAddress }}</li>
                        @else
                            <li><strong>Not created yet</strong></li>
                        @endif

                        </ul>
                    </pre>
                    <p class="content">
                    <div class="buttons">
                        <button id="start-container-btn" class="button is-success">
                            Start Container
                        </button>
                        <button id="stop-container-btn" class="button is-danger">
                            Stop Container
                        </button>
                    </div>
                    </p>
                </article>
            </div>
        </div>
    </section>

    <div id="taskID" class="is-hidden" data-taskid="{{ $task->id }}"></div>
@endsection
