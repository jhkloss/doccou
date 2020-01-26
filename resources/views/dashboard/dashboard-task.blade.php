<div class="box">
    <p><strong>{{ $task->name }}</strong><small> Course: {{ App\Task::find($task->id)->course->name }}</small></p>
</div>
