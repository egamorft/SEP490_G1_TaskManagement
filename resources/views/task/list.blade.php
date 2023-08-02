<!-- Full calendar start -->
<section>
    <div class="app-calendar overflow-hidden border">
        <div class="row g-0">
            @include('task.filter')

            <!-- Task Table -->
            <div class="col bg-white card-datatable table-responsive" id="js-task-list-table">
                <table class="datatables-permissions table">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Task</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th>Task List</th>
                            <th>Assignee</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp

                        @foreach ($tasksInProject as $task)
                            @php
                                $task = (object) $task;
                                $count++;
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

                                $taskList = $taskLists[$task->taskList_id] ?? (object)[
									"title" => ""
								];
                                $account = null;
                                foreach ($accounts as $acc) {
                                    $acc = (object) $acc;
                                    if ($acc->id == $task->assign_to) {
                                        $account = $acc;
                                    }
                                }
                            @endphp
                            <tr data-id="{{ $task->id }}">
                                <td>{{ $count }}</td>
                                <td>
                                    {{-- <a
                                        href="{{ $_SERVER['REQUEST_URI'] }}?show=task&id={{ $task->id }}">{{ $task->title }}</a> --}}
                                    <a href="{{ route('task.modalsDetail', ['slug' => $project->slug, 'board_id' => $board->id, 'task_id' => $task->id]) }}">{{ $task->title }}</a>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill {{ $statusView['class'] }}" data-status='{{ $task->status }}'>{{ $statusView['text'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill {{ $statusView['class'] }}" data-time='{{ strtotime($task->due_date) }}'>{{ date('D, M d, Y', strtotime($task->due_date)) }}</span>
                                </td>
                                <td>{{ $taskList->title }}</td>
                                <td>
                                    @if ($account)
                                        <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}"
                                            data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="bottom" title="{{ $account->name }}"
                                            class="avatar pull-up">
                                            <img src="{{ asset('images/avatars/' . $account->avatar) }}" alt="Avatar"
                                                width="33" height="33" />
                                        </a>
                                    @else
                                        <div>Not assign yet</div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--/ Task Table -->
            <div class="body-content-overlay"></div>
            <input type="hidden" id="start" value="0">
            <input type="hidden" id="row-per-page" value="{{ $rowPerPage }}">
            <input type="hidden" id="total-records" value="{{ $totalRecords }}">
        </div>
    </div>

	<!-- Calendar task details Popup starts -->
    <div class="modal update-item-sidebar fade" id="modalCalendarTask" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-3 pt-50 task-wrapper">
                    Loading ... 
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Full calendar end -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $("#addTaskFormCalendar").attr("action", "{{ route("add.task.in.list.modal", ["slug" => $project->slug, "board_id" => $board->id]) }}");
	var tasks = @json($tasksInProject);

    checkWindowSize();

    function checkWindowSize() {
        if ($(window).height() >= $(document).height()) {
            fetchData();
        }
    }

    function fetchData() {
        var start = Number($('#start').val());
        var allCount = Number($('#total-records').val());
        var rowPerPage = Number($('#row-per-page').val());
        start = start + rowPerPage;

        if (start <= allCount) {
            $('#start').val(start);

            $.ajax({
                url: '{{ route('get.task.info', ["slug" => $project->slug, "board_id" => $board->id]) }}',
                data: {start: start},
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                }
            });
        }
    }

    $('#js-task-list-table').on("touchmove", onScroll);

    function onScroll() {
        if ($(window).scrollTop() > $(document).height() - $(window).height()-100) {
            fetchData();
        }

        $(window).scroll(function() {
            var position = $(window).scrollTop();
            var bottom = $(document).height() - $(window).height();

            if (position == bottom) {
                fetchData();
            }
        })
    }
</script>

<script src="{{ asset(mix('js/scripts/pages/task-in-list.js')) }}"></script>