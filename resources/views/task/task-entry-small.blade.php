<div class="box">
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <a href="{{ route('viewTask', $task->id) }}">
                    <strong>{{ $task->name }}</strong>
                </a>
            </div>
        </div>
        <div class="level-right">
            @if(\App\Http\Controllers\Task\TaskController::canEdit($task->id))
                <div class="level-item">
                    <a href="{{ route('editTask', $task->id) }}" class="level-item">
                        <span class="icon is-small">
                            <i class="fas fa-edit"></i>
                        </span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
