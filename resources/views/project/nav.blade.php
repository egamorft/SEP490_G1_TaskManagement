<ul class="nav nav-pills mb-2">
    <!-- Kanban -->
    <li class="nav-item">
        <a class="nav-link {{ $tab == 'kanban' ? 'active' : '' }}" href="/project/{{ $project->slug }}/kanban">
            <i data-feather="columns" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Kanban</span>
        </a>
    </li>

    <!-- Gantt -->
    <li class="nav-item">
        <a class="nav-link {{ $tab == 'gantt' ? 'active' : '' }}" href="/project/{{ $project->slug }}/gantt">
            <i data-feather="trending-up" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Gantt</span>
        </a>
    </li>
    <!-- Calendar -->
    <li class="nav-item">
        <a class="nav-link {{ $tab == 'calendar' ? 'active' : '' }}" href="/project/{{ $project->slug }}/calendar">
            <i data-feather="calendar" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Calendar</span>
        </a>
    </li>
    <!-- Task List -->
    <li class="nav-item">
        <a class="nav-link {{ $tab == 'task-list' ? 'active' : '' }}" href="/project/{{ $project->slug }}/task-list">
            <i data-feather="list" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Task List</span>
        </a>
    </li>
</ul>
