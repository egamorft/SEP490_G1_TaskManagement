<!-- Task Table -->
<div class="card">
    <div class="card-datatable table-responsive">
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
                    $tasks = [1, 2, 3, 4, 5, 6];
                @endphp
                @foreach ($tasks as $task)
                    <tr id="task_{{ $task }}">
                        <td>{{ $task }}</td>
                        <td>{{ 'Task Name' }}</td>
                        @switch($task)
                            @case(1)
                                <td>
                                    <span class="badge rounded-pill badge-light-primary">Doing</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-primary">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                </td>
                            @break

                            @case(2)
                                <td>
                                    <span class="badge rounded-pill badge-light-warning">Reviewing</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-warning">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                </td>
                            @break

                            @case(3)
                                <td>
                                    <span class="badge rounded-pill badge-light-success">Done Ontime</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-success">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                </td>
                            @break

                            @case(4)
                                <td>
                                    <span class="badge rounded-pill badge-light-secondary">Done Late</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-secondary">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                </td>
                            @break

                            @case(5)
                                <td>
                                    <span class="badge rounded-pill badge-light-danger">Overdue</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-danger">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                </td>
                            @break

                            @default
                                <td>
                                    <span class="badge rounded-pill badge-light-info">Todo</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-info">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                </td>
                        @endswitch
                        <td>{{ 'Task List Name' }}</td>
                        <td>
                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom"
                                title="{{ 'User Name' }}" class="avatar pull-up">
                                <img src="{{ asset('images/avatars/H.png') }}" alt="Avatar" width="33"
                                    height="33" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--/ Task Table -->
