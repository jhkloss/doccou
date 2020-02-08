<div class="box">
    <a href="{{ route('viewTask', $container->task->id) }}">
        <p><strong>{{ $container->handle }}</strong> <small>Task: {{ $container->task->name }}</small></p>
    </a>
</div>
