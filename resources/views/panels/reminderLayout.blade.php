<div class="reminder-layout-wrapper" id="reminder-canvas-wrapper" title="Remind your work">
    <div class="reminder-button-wrapper">
        <i data-feather="check-square" class="reminder-icon-wrapper"></i>
        <div class="count-reminder"></div>
    </div>

    <div id="reminder-canvas" class="hidden">
        <div class="reminder-header">
            <div class="reminder-close">
                <i data-feather="x" ></i>
            </div>
            <div class="reminder-header-title">Reminders</div>
            <div class="tabs clear-fix">
                <div class="reminder-tab active" data-tab="important">
                    <i data-feather="bell" class="reminder-icon-tab"></i>
                    <span class="reminder-text">Important</span>
                </div>
                <div class="reminder-tab" data-tab="today">
                    <i data-feather="circle" class="reminder-icon-tab"></i>
                    <span class="reminder-text">Today</span>
                </div>
                <div class="reminder-tab" data-tab="late">
                    <i data-feather="alert-circle" class="reminder-icon-tab"></i>
                    <span class="reminder-text">Late</span>
                </div>
            </div>
        </div>
        <div class="reminder-body">
            <div class="tab tab-important active">
                @foreach ($tasksReminder as $taskRemind)
                    @php
                        $task = (object) $taskRemind;
                        $status = $task->status;
                        $statusView = [
                            'text' => '',
                            'class' => '',
                        ];
                        switch ($status) {
                            case 1:
                                $statusView = [
                                    'text' => 'Doing',
                                    'class' => 'badge-light-primary',
                                ];
                                break;
                        
                            case 2:
                                $statusView = [
                                    'text' => 'Reviewing',
                                    'class' => 'badge-light-warning',
                                ];
                                break;
                        
                            case 3:
                                $statusView = [
                                    'text' => 'Done Ontime',
                                    'class' => 'badge-light-success',
                                ];
                                break;
                        
                            case -1:
                                $statusView = [
                                    'text' => 'Done Late',
                                    'class' => 'badge-light-secondary',
                                ];
                                break;
                        
                            case 0:
                                $statusView = [
                                    'text' => 'Todo',
                                    'class' => 'badge-light-info',
                                ];
                                break;
                        
                            default:
                                $statusView = [
                                    'text' => 'Todo',
                                    'class' => 'badge-light-info',
                                ];
                                break;
                        }
                        if (($status == 0 || $status == 1) && strtotime($task->due_date) < time()) {
                            $statusView = [
                                'text' => 'Overdue',
                                'class' => 'badge-light-danger',
                            ];
                        }
                    @endphp

                    <div class="reminder-content">
                        <div class="reminder-title">
                            <a href="{{ route('task.modalsDetail', ['slug' => $taskRemind->project->slug, 'board_id' => $taskRemind->board->id, 'task_id' => $taskRemind->id]) }}">{{ $taskRemind->title }}</a>
                        </div>
                        <div class="reminder-sub-title {{ $statusView["class"] }}">
                            <div class="reminder-date-input">{{ date("d/m/Y", strtotime($taskRemind->due_date)) }}</div>
                            <div class="reminder-status">· {{ $statusView["text"] }}</div>
                        </div>
                    </div>
                @endforeach
                
            </div>

            <div class="tab tab-today">
                @foreach ($tasksTodayReminder as $taskRemind)
                    @php
                        $task = (object) $taskRemind;
                        $status = $task->status;
                        $statusView = [
                            'text' => '',
                            'class' => '',
                        ];
                        switch ($status) {
                            case 1:
                                $statusView = [
                                    'text' => 'Doing',
                                    'class' => 'badge-light-primary',
                                ];
                                break;
                        
                            case 2:
                                $statusView = [
                                    'text' => 'Reviewing',
                                    'class' => 'badge-light-warning',
                                ];
                                break;
                        
                            case 3:
                                $statusView = [
                                    'text' => 'Done Ontime',
                                    'class' => 'badge-light-success',
                                ];
                                break;
                        
                            case -1:
                                $statusView = [
                                    'text' => 'Done Late',
                                    'class' => 'badge-light-secondary',
                                ];
                                break;
                        
                            case 0:
                                $statusView = [
                                    'text' => 'Todo',
                                    'class' => 'badge-light-info',
                                ];
                                break;
                        
                            default:
                                $statusView = [
                                    'text' => 'Todo',
                                    'class' => 'badge-light-info',
                                ];
                                break;
                        }
                        if (($status == 0 || $status == 1) && strtotime($task->due_date) < time()) {
                            $statusView = [
                                'text' => 'Overdue',
                                'class' => 'badge-light-danger',
                            ];
                        }
                    @endphp

                    <div class="reminder-content">
                        <div class="reminder-title">
                            <a href="{{ route('task.modalsDetail', ['slug' => $taskRemind->project->slug, 'board_id' => $taskRemind->board->id, 'task_id' => $taskRemind->id]) }}">{{ $taskRemind->title }}</a>
                        </div>
                        <div class="reminder-sub-title {{ $statusView["class"] }}">
                            <div class="reminder-date-input">{{ date("d/m/Y", strtotime($taskRemind->due_date)) }}</div>
                            <div class="reminder-status">· {{ $statusView["text"] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tab tab-late">
                @foreach ($tasksLateReminder as $taskRemind)
                    @php
                        $task = (object) $taskRemind;
                        $status = $task->status;
                        $statusView = [
                            'text' => '',
                            'class' => '',
                        ];
                        switch ($status) {
                            case 1:
                                $statusView = [
                                    'text' => 'Doing',
                                    'class' => 'badge-light-primary',
                                ];
                                break;
                        
                            case 2:
                                $statusView = [
                                    'text' => 'Reviewing',
                                    'class' => 'badge-light-warning',
                                ];
                                break;
                        
                            case 3:
                                $statusView = [
                                    'text' => 'Done Ontime',
                                    'class' => 'badge-light-success',
                                ];
                                break;
                        
                            case -1:
                                $statusView = [
                                    'text' => 'Done Late',
                                    'class' => 'badge-light-secondary',
                                ];
                                break;
                        
                            case 0:
                                $statusView = [
                                    'text' => 'Todo',
                                    'class' => 'badge-light-info',
                                ];
                                break;
                        
                            default:
                                $statusView = [
                                    'text' => 'Todo',
                                    'class' => 'badge-light-info',
                                ];
                                break;
                        }
                        if (($status == 0 || $status == 1) && strtotime($task->due_date) < time()) {
                            $statusView = [
                                'text' => 'Overdue',
                                'class' => 'badge-light-danger',
                            ];
                        }
                    @endphp

                    <div class="reminder-content">
                        <div class="reminder-title">
                            <a href="{{ route('task.modalsDetail', ['slug' => $project->slug, 'board_id' => $board->id, 'task_id' => $taskRemind->id]) }}">{{ $taskRemind->title }}</a>
                        </div>
                        <div class="reminder-sub-title {{ $statusView["class"] }}">
                            <div class="reminder-date-input">{{ date("d/m/Y", strtotime($taskRemind->due_date)) }}</div>
                            <div class="reminder-status">· {{ $statusView["text"] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="reminder-footer">
            <i data-feather="external-link"></i>
            <span class="reminder-footer-title">Open calendar</span>
        </div>
    </div>
</div>
