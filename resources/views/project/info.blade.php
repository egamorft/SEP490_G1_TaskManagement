 <!-- Timeline Card -->
 <div class="">
	<div class="card card-user-timeline">
		<div class="card-header">
			<div class="d-flex align-items-center">
				<h4 class="card-title">Project Information</h4>
			</div>
		</div>
		<div class="card-body">

			<div class="mt-0">
				<div class="avatar float-start bg-light-primary rounded me-1">
					<div class="avatar-content">
						<i data-feather="fast-forward" class="avatar-icon font-medium-3"></i>
					</div>
				</div>
				<div class="more-info">
					<h6 class="mb-0 text-primary">Doing</h6>
					<small>The project is in progress</small>
				</div>
			</div>

			{{-- <div class="mt-2">
				<div class="avatar float-start bg-success rounded me-1">
					<div class="avatar-content">
						<i data-feather="user-check" class="avatar-icon font-medium-3"></i>
					</div>
				</div>
				<div class="more-info">
					<h6 class="mb-0 text-success">Completed</h6>
					<small>The project is marked as complete</small>
				</div>
			</div>

			<div class="mt-2">
				<div class="avatar float-start bg-danger rounded me-1">
					<div class="avatar-content">
						<i data-feather="user-x" class="avatar-icon font-medium-3"></i>
					</div>
				</div>
				<div class="more-info">
					<h6 class="mb-0 text-danger">Rejected</h6>
					<small>The project has been rejected</small>
				</div>
			</div> --}}

			<hr />

			<div class="mt-2">
				<div class="avatar float-start bg-light-primary rounded me-1">
					<div class="avatar-content">
						<i data-feather="activity" class="avatar-icon font-medium-3"></i>
					</div>
				</div>
				<div class="more-info">
					<p class="mb-50">Duration: 90%</p>
					<div class="progress progress-bar-success" style="height: 6px">
						<div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90" aria-valuemax="100" style="width: 90%"></div>
					</div>
				</div>
			</div>

			<div class="mt-2">
				<div class="avatar float-start bg-light-primary rounded me-1">
					<div class="avatar-content">
						<i data-feather="calendar" class="avatar-icon font-medium-3"></i>
					</div>
				</div>
				<div class="more-info">
					<small>From {{ date('D, M d, Y', strtotime($project->start_date)) }}</small>
					<h6 class="mb-0">To {{ date('D, M d, Y', strtotime($project->end_date)) }}</h6>
				</div>
			</div>

			<hr />
			<div class="mt-2">
				<div class="avatar float-start bg-white rounded me-1">
					<div class="avatar bg-light-danger">
						<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar" width="33" height="33" />
					</div>
				</div>
				<div class="more-info">
					<small>Project Manager</small>
					<h6 class="mb-0">{{ $pmAccount->fullname }}</h6>
				</div>
			</div>
			<div class="mt-2">
				<div class="avatar float-start bg-white rounded me-1">
					<div class="avatar bg-light-danger">
						<img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" alt="Avatar" width="33" height="33" />
					</div>
				</div>
				<div class="more-info">
					<small>Project Supervisor</small>
					<h6 class="mb-0">{{ $supervisorAccount->fullname }}</h6>
				</div>
			</div>
			<div class="mt-1 pl-5">
				<div class="more-info">
					<small>Other Members</small>
				</div>
				<div class="avatar-group">
					<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Billy Hopkins" class="avatar pull-up">
						<img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" alt="Avatar" width="33" height="33" />
					</div>
				   @php
					   $limitCount = 0;
					   $moreMember = 0;
				   @endphp
				   @foreach ($memberAccounts as $acc)
					   @php
						   $limitCount++;
						   if ($limitCount > 2) {
							   $moreMember++;
							   continue;
						   }
					   @endphp
					   <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="{{ $acc->fullname }}" class="avatar pull-up">
						   <img src="{{ asset('images/portrait/small/' . $acc->avatar) }}" alt="Avatar" width="33" height="33" />
					   </div>
				   @endforeach
					<h6 class="align-self-center cursor-pointer ms-50 mb-0">+{{ $moreMember }}</h6>
				</div>
			</div>
			<hr />

			<div class="mt-2">
				<div class="avatar float-start bg-light-primary rounded me-1">
					<div class="avatar-content">
						<i data-feather="file-text" class="avatar-icon font-medium-3"></i>
					</div>
				</div>
				<div class="more-info">
					<h6 class="mb-0">Description</h6>
					<small>{{ $project->description ? $project->description : "---" }}</small>
				</div>
			</div>

		</div>
	</div>
</div>
<!--/ Timeline Card -->

<!-- Task Overview Card -->
<div class="">
	<div class="card card-browser-states">
		<div class="card-header">
			<div>
				<h4 class="card-title">Task Overview</h4>
			</div>
		</div>

		<div class="card-body">
		<div class="browser-states">
				<div class="d-flex">
					<div class="avatar rounded me-1 bg-light-info rounded float-start">
						<div class="avatar-content">
							<i data-feather="check-square" class="avatar-icon font-medium-3"></i>
						</div>
					</div>
					<h6 class="align-self-center mb-0">Todo</h6>
				</div>
				<div class="d-flex align-items-center">
					<div class="fw-bold text-body-heading me-1">{{ $subTaskStatusesPercent["todo"] }}%</div>
					<div id="browser-state-chart-info"></div>
				</div>
			</div>
			<div class="browser-states">
				<div class="d-flex ">
					<div class="avatar rounded me-1 bg-light-primary rounded float-start">
						<div class="avatar-content">
							<i data-feather="check-square" class="avatar-icon font-medium-3"></i>
						</div>
					</div>
					<h6 class="align-self-center mb-0 ml-2">Doing</h6>
				</div>
				<div class="d-flex align-items-center">
					<div class="fw-bold text-body-heading me-1">{{ $subTaskStatusesPercent["doing"] }}%</div>
					<div id="browser-state-chart-primary"></div>
				</div>
			</div>
			<div class="browser-states">
				<div class="d-flex">
					<div class="avatar rounded me-1 bg-light-warning rounded float-start">
						<div class="avatar-content">
							<i data-feather="check-square" class="avatar-icon font-medium-3"></i>
						</div>
					</div>
					<h6 class="align-self-center mb-0">Reviewing</h6>
				</div>
				<div class="d-flex align-items-center">
					<div class="fw-bold text-body-heading me-1">{{ $subTaskStatusesPercent["reviewing"] }}%</div>
					<div id="browser-state-chart-warning"></div>
				</div>
			</div>
			<div class="browser-states">
				<div class="d-flex">
					<div class="avatar rounded me-1 bg-light-success rounded float-start">
						<div class="avatar-content">
							<i data-feather="check-square" class="avatar-icon font-medium-3"></i>
						</div>
					</div>
					<h6 class="align-self-center mb-0">Done Ontime</h6>
				</div>
				<div class="d-flex align-items-center">
					<div class="fw-bold text-body-heading me-1">{{ $subTaskStatusesPercent["doneOntime"] }}%</div>
					<div id="browser-state-chart-success"></div>
				</div>
			</div>

			<div class="browser-states">
				<div class="d-flex">
					<div class="avatar rounded me-1 bg-light-secondary rounded float-start">
						<div class="avatar-content">
							<i data-feather="check-square" class="avatar-icon font-medium-3"></i>
						</div>
					</div>
					<h6 class="align-self-center mb-0">Done Late</h6>
				</div>
				<div class="d-flex align-items-center">
					<div class="fw-bold text-body-heading me-1">{{ $subTaskStatusesPercent["doneLate"] }}%</div>
					<div id="browser-state-chart-secondary"></div>
				</div>
			</div>
			<div class="browser-states">
				<div class="d-flex">
					<div class="avatar rounded me-1 bg-light-danger rounded float-start">
						<div class="avatar-content">
							<i data-feather="check-square" class="avatar-icon font-medium-3"></i>
						</div>
					</div>
					<h6 class="align-self-center mb-0">Overdue</h6>
				</div>
				<div class="d-flex align-items-center">
					<div class="fw-bold text-body-heading me-1">{{ $subTaskStatusesPercent["overdue"] }}%</div>
					<div id="browser-state-chart-danger"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/ Task Overview Card -->