<ul class="nav nav-pills mb-2">
    <!-- Kanban -->
    <li class="nav-item">
        <a class="nav-link {{ $tab == 'kanban' ? 'active' : '' }}" href="{{ route('view.board.kanban', ['slug' => $project->slug, 'board_id' => 0]) }}">
            <i data-feather="columns" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Kanban</span>
        </a>
    </li>

    <!-- Gantt -->
    <li class="nav-item">
        <a class="nav-link {{ $tab == 'gantt' ? 'active' : '' }}" href="{{ route('view.board.kanban', ['slug' => $project->slug, 'board_id' => 0]) }}">
            <i data-feather="trending-up" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Gantt</span>
        </a>
    </li>
    <!-- Calendar -->
    <li class="nav-item">
        <a class="nav-link {{ $tab == 'calendar' ? 'active' : '' }}" href="{{ route('view.board.kanban', ['slug' => $project->slug, 'board_id' => 0]) }}">
            <i data-feather="calendar" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Calendar</span>
        </a>
    </li>
    <!-- Task List -->
    <li class="nav-item">
        <a class="nav-link {{ $tab == 'task-list' ? 'active' : '' }}" href="{{ route('view.board.kanban', ['slug' => $project->slug, 'board_id' => 0]) }}">
            <i data-feather="list" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Task List</span>
        </a>
    </li>
</ul>
