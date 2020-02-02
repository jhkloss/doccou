<div class="box">
    <a href="{{ route('viewTask', $task->id) }}">
        <p><strong>{{ $task->name }}</strong>
    </a>

    @php
        $course = App\Task::find($task->id)->course;
    @endphp

    <small> Course: <a href="{{ route('viewCourse', $course->id) }}"></a>{{ $course->name }}</small></p>
</div>
