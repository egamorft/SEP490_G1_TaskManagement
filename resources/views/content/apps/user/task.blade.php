<!-- Task table -->
<div class="card">
	<div class="card-body border-bottom mb-0">
		<h4 class="card-title mb-0">Your Tasks</h4>
	</div>
	<div class="card-datatable table-responsive pt-0">
		<table class="table datatable-project project-list-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Creator/Reviewer</th>
                </tr>
            </thead>
            <tbody id="related-tasks">
                @forelse ($tasks as $key => $task)
					@php
						$creator = null;
						foreach ($allAccounts as $acc) {
                            if ($acc->id == $task->created_by) {
                                $creator = $acc;
                            }
                        }
					@endphp
                    <tr class="odd" id="task-row{{ $task->id }}">
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="more-info">
                                    <h6 class="mb-0 text-truncate" style="max-width: 300px; display: block;">
									<a onclick="TASK.showTaskDetail({{ $task->id }})">{{ $task->title }}</a>
                                    </h6>
                                    <small class="text-truncate"
                                        style="max-width: 300px; display: block;">{{ $task->description ? $task->description : 'No Description' }}</small>
                                </div>
                            </div>
                        </td>
                        @switch($task->status)
                            @case(1)
                                <td>
                                    <span class="badge rounded-pill badge-light-primary">Doing</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-primary">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : "No Info" }}</span>
                                </td>
                            @break

                            @case(2)
                                <td>
                                    <span class="badge rounded-pill badge-light-warning">Reviewing</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-warning">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : "No Info" }}</span>
                                </td>
                            @break

                            @case(3)
                                <td>
                                    <span class="badge rounded-pill badge-light-success">Done Ontime</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-success">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : "No Info" }}</span>
                                </td>
                            @break

                            @case(4)
                                <td>
                                    <span class="badge rounded-pill badge-light-secondary">Done Late</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-secondary">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : "No Info" }}</span>
                                </td>
                            @break

                            @case(5)
                                <td>
                                    <span class="badge rounded-pill badge-light-danger">Overdue</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-danger">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : "No Info" }}</span>
                                </td>
                            @break

                            @default
                                <td>
                                    <span class="badge rounded-pill badge-light-info">Todo</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill badge-light-info">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : "No Info" }}</span>
                                </td>
                        @endswitch
						<td>
							<div class="avatar float-start bg-white rounded">
								<a href="{{ "#" }}"
									class="avatar float-start bg-white rounded me-1">
									<img src="{{ asset('images/avatars/' . $creator->avatar) }}" alt="Avatar" width="33"
										height="33" />
								</a>
							</div>
							<div class="more-info pt-05">
								<h6 class="mt-0">{{ $creator->name ?? '' }}</h6>
							</div>
						</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            No data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<!-- /Task table -->
