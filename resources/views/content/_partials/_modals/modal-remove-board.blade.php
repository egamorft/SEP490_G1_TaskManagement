<!-- Edit Board Modal -->
<div class="modal fade" id="removeBoardModal{{ $board->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-add-new-board">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 pt-0">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Remove Board! </h1>
                    <p>Remove board <b> {{ $board->title }} </b>as per your requirements.</p>
                </div>

                <div class="alert alert-danger" role="alert">
                    <h6 class="alert-heading">Danger!</h6>
                    <div class="alert-body">
                        Remove Board and remove all the task in board!
                    </div>
                </div>
                @php
                    $status = [0, 1, 2]; // Todo, doing, reviewing
                    $tasksCount = $board->tasks->whereIn('status', $status)->count();
                @endphp
                @if ($tasksCount > 0)
                    <div class="alert alert-warning" role="alert">
                        <div class="alert-body">
                            @foreach ($board->tasks as $task)
                                @if (in_array($task->status, $status))
                                    @switch($task->status)
                                        @case(0)
                                            <li>{{ $tasksCount }} tasks are waiting for TODO</li>
                                        @break

                                        @case(1)
                                            <li>{{ $tasksCount }} tasks are waiting for DOING</li>
                                        @break

                                        @case(2)
                                            <li>{{ $tasksCount }} tasks are waiting for REVIEWING</li>
                                        @break
                                    @endswitch
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($tasksCount > 0)
                    <div class="text-center mt-2">
                        <a href="{{ route('view.board.kanban', ['slug' => $project->slug, 'board_id' => $board->id]) }}"
                            type="button" class="btn btn-primary">Check it out!!</a>
                    </div>
                @else
                    <form id="removeMemberForm" class="row" method="POST"
                        action="{{ route('remove.board', ['slug' => $project->slug, 'id' => $board->id]) }}">
                        @csrf
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary">I'm sure!!</button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
</div>
<!--/ Edit Board Modal -->