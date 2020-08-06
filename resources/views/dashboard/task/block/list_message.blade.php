@if (count($tasks))
        @foreach ($tasks as $task)
            <div class="lcPageHelpArchLeft__item">
                <a href="{{ route('tasks.show', $task->id) }}#chat">
                    <span>
                        # {{ $task->id }}
                    </span>
                    <p>
                        {{ $task->title }}
                    </p>
                </a>
            </div>
        @endforeach
@else
    <div class="lcPageHelpArchLeft__item">
        <p>Нет обращений</p>
    </div>
@endif

