<div class="navbar-header-container">
    <ul class="nav nav-pills mb-2">
        <!-- Kanban -->
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'kanban' ? 'active' : '' }}" href="{{ route('view.board.kanban', ['slug' => $project->slug, 'board_id' => 0]) }}">
                <i data-feather="columns" class="font-medium-3 me-50"></i>
                <span class="fw-bold">Kanban</span>
            </a>
        </li>
    
        <!-- Calendar -->
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'calendar' ? 'active' : '' }}" href="{{ route('view.board.calendar', ['slug' => $project->slug, 'board_id' => 0]) }}">
                <i data-feather="calendar" class="font-medium-3 me-50"></i>
                <span class="fw-bold">Calendar</span>
            </a>
        </li>
        <!-- Task List -->
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'list' ? 'active' : '' }}" href="{{ route('view.board.list', ['slug' => $project->slug, 'board_id' => 0]) }}">
                <i data-feather="list" class="font-medium-3 me-50"></i>
                <span class="fw-bold">List</span>
            </a>
        </li>
    </ul>
    
    <div class="filter-nav-header mb-2">
        <div class="filter-by-status card-body">
            <h5 class="section-label mb-1">
                <span class="align-middle">Filter By Status</span>
            </h5>
            <div class="calendar-events-filter">
				<div class="form-check form-check-info mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="todo-task" data-value="todo-task"
                        checked />
                    <label class="form-check-label" for="todo-task">Todo</label>
                </div>
                <div class="form-check form-check-primary mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="doing-task" data-value="doing-task"
                        checked />
                    <label class="form-check-label" for="doing-task">Doing</label>
                </div>
                <div class="form-check form-check-warning mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="reviewing-task" data-value="reviewing-task"
                        checked />
                    <label class="form-check-label" for="reviewing-task">Reviewing</label>
                </div>
                <div class="form-check form-check-success mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="ontime-task" data-value="ontime-task"
                        checked />
                    <label class="form-check-label" for="ontime-task">Done Ontime</label>
                </div>
                <div class="form-check form-check-secondary mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="late-task" data-value="late-task"
                        checked />
                    <label class="form-check-label" for="late-task">Done Late</label>
                </div>
                <div class="form-check form-check-danger mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="overdue-task" data-value="overdue-task"
                        checked />
                    <label class="form-check-label" for="overdue-task">Overdue</label>
                </div>
            </div>
        </div>

        <button class="button-filter-header">
            <i data-feather="filter" class="custom-title-icon"></i>
            <span class="filter-title">Filter</span>
        </button>

        <div class="filter-list">

        </div>
    </div>
</div>
