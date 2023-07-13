<div class="navbar-header-container">
    <ul class="nav nav-pills mb-2">
        <!-- Kanban -->
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'kanban' ? 'active' : '' }}"
                href="{{ route('view.board.kanban', ['slug' => $project->slug, 'board_id' => $board->id]) }}">
                <i data-feather="columns" class="font-medium-3 me-50"></i>
                <span class="fw-bold">Kanban</span>
            </a>
        </li>

        <!-- Calendar -->
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'calendar' ? 'active' : '' }}"
                href="{{ route('view.board.calendar', ['slug' => $project->slug, 'board_id' => $board->id]) }}">
                <i data-feather="calendar" class="font-medium-3 me-50"></i>
                <span class="fw-bold">Calendar</span>
            </a>
        </li>
        <!-- Task List -->
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'list' ? 'active' : '' }}"
                href="{{ route('view.board.list', ['slug' => $project->slug, 'board_id' => $board->id]) }}">
                <i data-feather="list" class="font-medium-3 me-50"></i>
                <span class="fw-bold">List</span>
            </a>
        </li>
    </ul>

    <div class="filter-nav-header mb-2 {{ $tab == 'kanban' ? '' : 'd-none' }}">
        <button type="button" class="btn-lg btn-icon btn-outline-primary waves-effect button-filter-header">
            <i data-feather='filter'></i>
        </button>

        <div class="filter-list hidden">
            <form action="" method="GET">
                <div class="filter-search">
                    <div class="fw-bold">Filter</div>
                    <input type="search" id="form1" class="form-control" placeholder="Enter your task title..."
                        name="q" aria-label="Search" value="{{ request()->input('q') }}" />
                </div>

                <div class="filter-date">

                    <div class="filter-date-range">
                        <input class="form-check-input checkbox-finish-task" type="checkbox" name="dueToday"
                            {{ request()->input('dueToday') == "on" ? "checked" : "" }}>
                        <span class="filter-date-title">
                            <i data-feather="calendar" class="filter-date-icon"></i>
                            <span class="span-date-filter">Out of date in day</span>
                        </span>
                    </div>

                    <div class="filter-date-range">
                        <input class="form-check-input checkbox-finish-task" type="checkbox" name="overdue"
                            {{ request()->input('overdue') == "on" ? "checked" : "" }}>
                        <span class="filter-date-title">
                            <i data-feather="clock" class="filter-date-icon color-alert"></i>
                            <span class="span-date-filter">Overdue</span>
                        </span>
                    </div>

                    <div class="filter-date-range">
                        <input class="form-check-input checkbox-finish-task" type="checkbox" name="dueTomorrow"
                            {{ request()->input('dueTomorrow') == "on" ? "checked" : "" }}>
                        <span class="filter-date-title">
                            <i data-feather="clock" class="filter-date-icon color-primary"></i>
                            <span class="span-date-filter">Deadline is tomorrow</span>
                        </span>
                    </div>

                    <div class="filter-date-range">
                        <input class="form-check-input checkbox-finish-task" type="checkbox" name="dueNextWeek"
                            {{ request()->input('dueNextWeek') == "on" ? "checked" : "" }}>
                        <span class="filter-date-title">
                            <i data-feather="clock" class="filter-date-icon"></i>
                            <span class="span-date-filter">Deadline is next week</span>
                        </span>
                    </div>

                    <div class="filter-date-range">
                        <input class="form-check-input checkbox-finish-task" type="checkbox" name="doneTask"
                            {{ request()->input('doneTask') == "on" ? "checked" : "" }}>
                        <span class="filter-date-title">
                            <i data-feather="clock" class="filter-date-icon"></i>
                            <span class="span-date-filter">Done task</span>
                        </span>
                    </div>

                    <div class="filter-date-range">
                        <input class="form-check-input checkbox-finish-task" type="checkbox" name="doingTask"
                            {{ request()->input('doingTask') == "on" ? "checked" : "" }}>
                        <span class="filter-date-title">
                            <i data-feather="clock" class="filter-date-icon"></i>
                            <span class="span-date-filter">Doing task</span>
                        </span>
                    </div>

                    <div class="btn">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
