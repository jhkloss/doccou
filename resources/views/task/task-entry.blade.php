<div class="tile is-10">
    <div class="column">
        <div class="box">
            <article class="media">
                <div class="media-left">
                    <figure class="image is-64x64">
                        <img src="{{ asset('/gfx/graduation-cap-solid.svg') }}" alt="Image">
                        {{-- Licensed under Creative Commons Attribution 4.0 by Fontawesome https://fontawesome.com/license --}}
                    </figure>
                </div>
                <div class="media-content">
                    <div class="content">
                        <p>
                            <a href="{{ route('viewTask', $task->id) }}">
                                <strong>{{ $task->name }}</strong>
                            </a>
                            <small>Created: {{ $task->created_at }}</small>
                            <br>
                            {{ $task->description }}
                        </p>
                    </div>
                    <nav class="level is-mobile">
                        <div class="level-left">
                            @if($task->canEdit)
                                <a href="{{ route('editTask', $task->id) }}" class="level-item" aria-label="reply">
                            <span class="icon is-small">
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </span>
                                </a>
                            @endif
                        </div>
                    </nav>
                </div>
            </article>
        </div>
    </div>
</div>
