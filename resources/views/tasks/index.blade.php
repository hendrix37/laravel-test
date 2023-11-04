<ul>
    @foreach ($tasks as $task)
        <li>{{ $task->name }} ({{ $task->name }})</li>
    @endforeach
</ul>
