@php
    use Illuminate\Support\Carbon;
@endphp
<!-- Project table -->

<!-- Change Password -->
<div class="card card-table">
    <h4 class="card-header">Change Password</h4>
    <div class="card-body">
        <form id="formChangePassword" method="POST" action="{{ route('edit.password.submit') }}">
            @csrf
            <div class="alert alert-warning mb-2" role="alert">
                <h6 class="alert-heading">Ensure that these requirements are met</h6>
                <div class="alert-body fw-normal">Minimum 8 characters long, uppercase & symbol</div>
            </div>

            <div class="row">
                <div class="mb-2 col-md-6 form-password-toggle">
                    <label class="form-label" for="oldPassword">Old password</label>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input class="form-control" type="password" id="oldPassword" name="oldPassword"
                            placeholder="Enter your old password" value="{{ old('oldPassword') }}" />
                        <span class="input-group-text cursor-pointer">
                            <i data-feather="eye"></i>
                        </span>
                    </div>
                    @error('oldPassword')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-2 col-md-6 form-password-toggle">
                    <label class="form-label" for="newPassword">New password</label>
                    <div class="input-group input-group-merge">
                        <input class="form-control" type="password" name="newPassword" id="newPassword"
                            placeholder="Enter your new password" value="{{ old('newPassword') }}" />
                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                    @error('newPassword')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    @if (!$social)
                        <button type="submit" class="btn btn-primary me-2">Change Password</button>
                    @else
                        <button type="button" class="btn btn-secondary me-2" disabled>You logged in with
                            {{ $social->provider }}</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
<!--/ Change Password -->
<div class="card col-12 card-table">
    <h4 class="card-header">Your Projects</h4>
    <div class="table-responsive text-nowrap">
        <table class="table datatable-project">
            <thead>
                <tr>
                    <th></th>
                    <th>Project</th>
                    <th>Status</th>
                    <th>Your Role</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($accountProjects as $key => $project)
                    @php
                        $supervisor = null;
                        $manager = $allAccounts[0];
                        $members = [];
                        $role = 'Project Member';
                        
                        foreach ($allAccountProjects as $accPro) {
                            if ($accPro->project_id == $project->id) {
                                foreach ($allAccounts as $acc) {
                                    if ($acc->id == $accPro->account_id && $accPro->role_id == 1) {
                                        $manager = $acc;
                                    }
                                    if ($acc->id == $accPro->account_id && $accPro->role_id == 2) {
                                        $supervisor = $acc;
                                    }
                                    if ($acc->id == $accPro->account_id && $accPro->role_id == 3) {
                                        $members[] = $acc;
                                    }
                                }
                            }
                        }
                        
                        if ($manager->id == $account->id) {
                            $role = 'Project Manager';
                        }
                        if ($supervisor) {
                            if ($supervisor->id == $account->id) {
                                $role = 'Project Supervisor';
                            }
                        }
                        
                        // Convert the project's start and end dates to Carbon objects
$start_date = Carbon::parse($project->start_date)->startOfDay();
$end_date = Carbon::parse($project->end_date)->endOfDay();
// Get the current date as a Carbon object
$current_date = Carbon::now();

$percent_completed = 0;
$days_left = 0;

if ($end_date > $start_date) {
    if ($current_date < $start_date) {
        // If the project is in the future, set percent_completed to 0
        $percent_completed = 0;
        $days_left = $start_date->diffInDays($current_date);
    } elseif ($current_date >= $end_date) {
        // If the project is completed, set percent_completed to 100
        $percent_completed = 100;
        $days_left = -1;
    } else {
        // Calculate the total duration of the project in days
        $total_days = $start_date->diffInDays($end_date) + 1;

        // Calculate the number of days that have already passed since the project started
        $days_passed = $start_date->diffInDays($current_date) + 1;

        // Calculate the percentage completed
        $percent_completed = round(($days_passed / $total_days) * 100, 2);

        // Calculate the number of days left
        $days_left = $total_days - $days_passed;
    }
}
// Make sure percent_completed is within the range of 0 to 100
$percent_completed = max(0, min(100, $percent_completed));

$colorProgressState = '';
if (0 <= $percent_completed && $percent_completed <= 40) {
    $colorProgressState = '#45ba30';
} elseif (40 < $percent_completed && $percent_completed <= 60) {
    $colorProgressState = '#c4bc21';
} elseif (60 < $percent_completed && $percent_completed <= 80) {
    $colorProgressState = '#db8223';
} elseif (80 < $percent_completed && $percent_completed <= 100) {
    $colorProgressState = '#e63217';
} else {
    $colorProgressState = '';
                        }
                    @endphp
                    <tr class="odd" id="row{{ $project->id }}">
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="more-info">
                                    <h6 class="mb-0 text-truncate" style="max-width: 300px; display: block;"><a
                                            href="{{ route('view.project.board', ['slug' => $project->slug]) }}">{{ $project->name }}</a>
                                    </h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            @switch($project->project_status)
                                @case(-1)
                                    <div class="col mt-0">
                                        <div class="avatar float-start bg-light-danger rounded me-1">
                                            <div class="avatar-content">
                                                <i data-feather="alert-triangle" class="avatar-icon font-medium-3"></i>
                                            </div>
                                        </div>
                                        <div class="more-info pt-05">
                                            <h6 class="mt-0 text-danger" style="min-width: 100px;">Fail</h6>
                                        </div>
                                    </div>
                                @break

                                @case(0)
                                    <div class="col mt-0">
                                        <div class="avatar float-start bg-light-warning rounded me-1">
                                            <div class="avatar-content">
                                                <i data-feather="pause-circle" class="avatar-icon font-medium-3"></i>
                                            </div>
                                        </div>
                                        <div class="more-info pt-05">
                                            <h6 class="mt-0 text-warning">Todo</h6>
                                        </div>
                                    </div>
                                @break

                                @case(1)
                                    <div class="col mt-0" style="width: 100px;">
                                        <div class="avatar float-start bg-light-primary rounded me-1">
                                            <div class="avatar-content">
                                                <i data-feather="fast-forward" class="avatar-icon font-medium-3"></i>
                                            </div>
                                        </div>
                                        <div class="more-info pt-05">
                                            <h6 class="mt-0 text-primary">Doing</h6>
                                        </div>
                                    </div>
                                @break

                                @case(2)
                                    <div class="col mt-0">
                                        <div class="avatar float-start bg-light-success rounded me-1">
                                            <div class="avatar-content">
                                                <i data-feather="check" class="avatar-icon font-medium-3"></i>
                                            </div>
                                        </div>
                                        <div class="more-info pt-05">
                                            <h6 class="mt-0 text-success">Done</h6>
                                        </div>
                                    </div>
                                @break

                                @default
                                    <div class="col mt-0">
                                        <div class="avatar float-start bg-light-warning rounded me-1">
                                            <div class="avatar-content">
                                                <i data-feather="help-circle" class="avatar-icon font-medium-3"></i>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0 text-warning">Done</h6>
                                        </div>
                                    </div>
                            @endswitch
                        </td>

                        <td>{{ $role }}</td>

                        <td>
                            <div class="avatar float-start bg-light-primary rounded me-1">
                                <div class="avatar-content">
                                    <i data-feather="activity" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>

                            <div class="more-info">
                                <p class="mb-50">Duration: {{ $percent_completed }}% @if ($days_left > 0)
                                        ({{ $days_left }} days remaining)
                                    @endif
                                    @if ($days_left == 0)
                                        (last day in the project)
                                    @endif
                                </p>
                                <div class="progress progress-bar-secondary" style="height: 6px">
                                    <div class="progress-bar progress-bar-striped" role="progressbar"
                                        aria-valuenow="{{ $percent_completed }}"
                                        aria-valuemin="{{ $percent_completed }}" aria-valuemax="100"
                                        style="width: {{ $percent_completed }}%; ; background-color: {{ $colorProgressState }}!important">
                                    </div>
                                </div>
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
    <!-- /Project table -->
