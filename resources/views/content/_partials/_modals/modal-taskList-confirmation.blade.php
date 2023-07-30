@php
    use App\Enums\TaskStatus;
@endphp
<!-- Remove Task List Modal -->
<div class="text-center mb-2">
    <h1 class="mb-1">Remove Task List! </h1>
    <p>Remove task list <b> {{ $taskLists->title }} </b>as per your requirements.</p>
</div>

@if (count($tasks) > 0)
    <div class="alert alert-danger" role="alert">
        <h6 class="alert-heading">Danger!</h6>
        <div class="alert-body">
            Remove task list and remove all the task in that task list!
        </div>
        <div class="alert-body">
            You must move or delete it first !!
        </div>
    </div>
    <div class="alert alert-warning" role="alert">
        <div class="alert-body">
            @foreach ($tasks as $task)
                <li> <strong>{{ $task->title }}</strong> tasks with status of <span
                        class="text-uppercase">{{ TaskStatus::getKey($task->status) }}</span></li>
            @endforeach
        </div>
    </div>
@endif
@if (count($tasks) > 0)
    <div class="text-center mt-2">
        <a data-bs-dismiss="modal" aria-label="Close" type="button" class="btn btn-primary">Check it out!!</a>
    </div>
@else
    <form class="row" method="POST" action="{{ route('remove.taskList', ['slug' => $project->slug, 'id' => $taskLists->id]) }}">
        @csrf
        <div class="text-center mt-2">
            <button type="submit" class="btn btn-primary">Go for it!!</button>
        </div>
    </form>
@endif

<!--/ Remove Task List Modal -->
