<!-- Remove member Modal -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="removeMemberModal{{ $mem->id }}"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 pt-0">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Remove member</h1>
                    <p>Remove member as per your requirements.</p>
                </div>

                <div class="alert alert-danger" role="alert">
                    <h6 class="alert-heading">Danger! <strong>{{ $mem->email }}</strong></h6>
                    <div class="alert-body">
                        Make sure you have fully handed over this person's work
                    </div>
                </div>
                @php
                    $checkHasTasks = false;
                @endphp
                @foreach ($tasksInProject as $memTasks)
                    @if ($memTasks->created_by == $mem->id || $memTasks->assign_to == $mem->id)
                        @if ($memTasks->status == 1 || $memTasks->status == 2)
                            @php
                                $checkHasTasks = true;
                            @endphp
                        @endif
                    @endif
                @endforeach
                @if ($checkHasTasks)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Assignee</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasksInProject as $memTasks)
                                    @if ($memTasks->created_by == $mem->id || $memTasks->assign_to == $mem->id)
                                        @if ($memTasks->status == 1 || $memTasks->status == 2)
                                            <tr>
                                                <td>
                                                    <span class="fw-bold">{{ $memTasks->title }}</span>
                                                </td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($memTasks->start_date)) }}
                                                </td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($memTasks->due_date)) }}
                                                </td>
                                                <td>
                                                    @if (isset($memTasks->assignTo->avatar))
                                                        <div class="avatar-group">
                                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                                data-bs-placement="top" class="avatar pull-up my-0"
                                                                title=""
                                                                data-bs-original-title="{{ $memTasks->assignTo->name }}">
                                                                <img src="{{ asset('images/avatars/' . $memTasks->assignTo->avatar) }}"
                                                                    alt="Avatar" height="26" width="26">
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="avatar-group">
                                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                                data-bs-placement="top" class="avatar pull-up my-0"
                                                                title=""
                                                                data-bs-original-title="No assign to anyone yet">
                                                                <img src="{{ asset('images/avatars/default.png') }}"
                                                                    alt="Avatar" height="26" width="26">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $badgeStt = '';
                                                        $statusNote = '';
                                                    @endphp
                                                    @switch($memTasks->status)
                                                        @case(1)
                                                            @php
                                                                $badgeStt = 'primary';
                                                                $statusNote = 'Doing';
                                                            @endphp
                                                        @break

                                                        @case(2)
                                                            @php
                                                                $badgeStt = 'warning';
                                                                $statusNote = 'Reviewing';
                                                            @endphp
                                                        @break

                                                        @default
                                                    @endswitch
                                                    <span
                                                        class="badge rounded-pill badge-light-{{ $badgeStt }} me-1">{{ $statusNote }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if ($checkHasTasks)
                        <div class="text-center mt-2">
                            <a href="{{ route('view.project.board', ['slug' => $project->slug]) }}" role="button"
                                class="btn btn-primary">Check it out!!</a>
                        </div>
                    @else
                        <form id="removeMemberForm" class="row" method="POST"
                            action="{{ route('remove.member', ['slug' => $project->slug]) }}">
                            @csrf
                            <div class="text-center mt-2">
                                <input type="hidden" name="account" value="{{ $mem->id }}">
                                <input type="hidden" name="project" value="{{ $project->id }}">
                                <button type="submit" class="btn btn-primary">I'm sure!!</button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!--/ Remove member Modal -->
