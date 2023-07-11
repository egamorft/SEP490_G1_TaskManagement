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
        <button class="button-filter-header">
            <i data-feather="filter" class="custom-title-icon"></i>
            <span class="filter-title">Filter</span>
        </button>

        <div class="filter-list hidden">
            <form action="" method="GET">
                <div class="filter-search">
                    <div class="fw-bold">Từ khóa</div>
                    <input type="search" id="form1" class="form-control" placeholder="Nhập từ khóa..." name="q" aria-label="Search" />
                </div>

                <div class="filter-date">

                        <div class="filter-date-range">
                            <input class="form-check-input checkbox-finish-task" type="checkbox" name="dueToday"
                            id="checkToday">
                            <span class="filter-date-title">
                                <i data-feather="calendar" class="filter-date-icon"></i>
                                <span class="span-date-filter">Sẽ hết hạn vào hôm nay</span>
                            </span>
                        </div>
        
                        <div class="filter-date-range">
                            <input class="form-check-input checkbox-finish-task" type="checkbox" name="overdue"
                            id="checkOverdue">
                            <span class="filter-date-title">
                                <i data-feather="clock" class="filter-date-icon color-alert"></i>
                                <span class="span-date-filter">Quá hạn</span>
                            </span>
                        </div>
        
                        <div class="filter-date-range">
                            <input class="form-check-input checkbox-finish-task" type="checkbox" name="dueTomorrow"
                            id="checkTomorrow">
                            <span class="filter-date-title">
                                <i data-feather="clock" class="filter-date-icon color-primary"></i>
                                <span class="span-date-filter">Sẽ hết hạn vào ngày mai</span>
                            </span>
                        </div>
        
                        <div class="filter-date-range">
                            <input class="form-check-input checkbox-finish-task" type="checkbox" name="dueNextWeek"
                            id="checkNextWeek">
                            <span class="filter-date-title">
                                <i data-feather="clock" class="filter-date-icon"></i>
                                <span class="span-date-filter">Sẽ hết hạn vào tuần sau</span>
                            </span>
                        </div>
        
                        <div class="filter-date-range">
                            <input class="form-check-input checkbox-finish-task" type="checkbox" name="markDone"
                            id="checkAsDone">
                            <span class="filter-date-title">
                                <i data-feather="clock" class="filter-date-icon"></i>
                                <span class="span-date-filter">Đã đánh dấu là hoàn thành</span>
                            </span>
                        </div>
        
                        <div class="filter-date-range">
                            <input class="form-check-input checkbox-finish-task" type="checkbox" name="markNotDone"
                            id="checkAsNotdone">
                            <span class="filter-date-title">
                                <i data-feather="clock" class="filter-date-icon"></i>
                                <span class="span-date-filter">Không được đánh dấu là đã hoàn thành</span>
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
