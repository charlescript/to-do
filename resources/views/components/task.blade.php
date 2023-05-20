<div class="task {{ $data['is_done'] ? 'task_done' : 'task_pending' }}">
    <div class="title">
        <input type="checkbox" onchange="taskUpate(this)" data-id="{{$data['id']}}"
            @if ($data['is_done'])
                checked
            @endif
        />
        <div class="task_title">{{ $data['title'] ?? '' }}</div>
    </div>

    <div class="priority">
        <div class="sphere"></div>
        <div>{{ $data['category']->title ?? '' }}</div>
    </div>

    <div class="actions">
        <a href="{{ route('task.edit', ['id' => $data['id']]) }}">
            <img src="/assets/images/icon-edit.png" />
        </a>

        <a href="{{ route('task.delete', ['id' => $data['id']]) }}">
            <img src="/assets/images/icon-delete.png" />
        </a>
    </div>
</div>
