
			<table class="table datatable-project">
				<thead>
					<tr>
						<th>Project</th>
						<th>Status</th>
						<th>Progress</th>
						<th>Your Role</th>
						<th>Your Task</th>
					</tr>
				</thead>
				<tbody>
					<tr class="odd">
						<td>
							<div class="d-flex justify-content-left align-items-center">
								<div class="more-info">
									<h6 class="mb-0 text-danger"><a href="{{ route('view.project.board', ['slug'=>'mine']) }}">Project 1</a></h6>
									<small>Project desc ...</small>
								</div>
							</div>
						</td>
						<td>
							<div class="d-flex justify-content-left align-items-center">
								<div class="avatar float-start bg-light-danger rounded me-1">
									<div class="avatar-content">
										<i data-feather="alert-triangle" class="avatar-icon font-medium-3"></i>
									</div>
								</div>
								<div class="more-info">
									<h6 class="mb-0 text-danger">False</h6>
									<small>You have fail this project according to supervisor proposed</small>
								</div>
							</div>
						</td>
						<td>
							<div class="more-info">
								<p class="mb-50">Duration: {{ 20 }}% @if (10 > 0)
									({{ 10 }} days remaining) 
									@endif
									@if (10 == 0)
									(last day in the project) 
									@endif
								</p>
								<div class="progress progress-bar-secondary" style="height: 6px">
									<div class="progress-bar progress-bar-striped" role="progressbar"
										aria-valuenow="{{ 20 }}" aria-valuemin="{{ 20 }}"
										aria-valuemax="100"
										style="width: {{ 20 }}%; ; background-color: {{ '#45ba30' }}!important">
									</div>
								</div>
							</div>
						</td>
						<td>Project Manager</td>
						<td>120/200</td>
					</tr>
					<tr class="even">
						<td>
							<div class="d-flex justify-content-left align-items-center">
								<div class="more-info">
									<h6 class="mb-0 text-danger"><a href="{{ route('view.project.board', ['slug'=>'mine']) }}">Project 2</a></h6>
									<small>Project desc ...</small>
								</div>
							</div>
						</td>
						<td>
							<div class="d-flex justify-content-left align-items-center">
								<div class="avatar float-start bg-light-warning rounded me-1">
									<div class="avatar-content">
										<i data-feather="pause-circle" class="avatar-icon font-medium-3"></i>
									</div>
								</div>
								<div class="more-info">
									<h6 class="mb-0 text-warning">Todo</h6>
									<small>The project is not have supervisor</small>
								</div>
							</div>
						</td>
						<td>
							<div class="more-info">
								<p class="mb-50">Duration: {{ 20 }}% @if (10 > 0)
									({{ 10 }} days remaining) 
									@endif
									@if (10 == 0)
									(last day in the project) 
									@endif
								</p>
								<div class="progress progress-bar-secondary" style="height: 6px">
									<div class="progress-bar progress-bar-striped" role="progressbar"
										aria-valuenow="{{ 20 }}" aria-valuemin="{{ 20 }}"
										aria-valuemax="100"
										style="width: {{ 20 }}%; ; background-color: {{ '#45ba30' }}!important">
									</div>
								</div>
							</div>
						</td>
						<td>Project Supervisor</td>
						<td>120/200</td>
					</tr>
					<tr class="odd">
						<td>
							<div class="d-flex justify-content-left align-items-center">
								<div class="more-info">
									<h6 class="mb-0 text-danger"><a href="{{ route('view.project.board', ['slug'=>'mine']) }}">Project 3</a></h6>
									<small>Project desc ...</small>
								</div>
							</div>
						</td>
						<td>
							<div class="d-flex justify-content-left align-items-center">
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
						</td>
						<td>
							<div class="more-info">
								<p class="mb-50">Duration: {{ 20 }}% @if (10 > 0)
									({{ 10 }} days remaining) 
									@endif
									@if (10 == 0)
									(last day in the project) 
									@endif
								</p>
								<div class="progress progress-bar-secondary" style="height: 6px">
									<div class="progress-bar progress-bar-striped" role="progressbar"
										aria-valuenow="{{ 20 }}" aria-valuemin="{{ 20 }}"
										aria-valuemax="100"
										style="width: {{ 20 }}%; ; background-color: {{ '#db8223' }}!important">
									</div>
								</div>
							</div>
						</td>
						<td>Project Member</td>
						<td>120/200</td>
					</tr>
					<tr class="odd">
						<td>
							<div class="d-flex justify-content-left align-items-center">
								<div class="more-info">
									<h6 class="mb-0 text-danger"><a href="{{ route('view.project.board', ['slug'=>'mine']) }}">Project 4</a></h6>
									<small>Project desc ...</small>
								</div>
							</div>
						</td>
						<td>
							<div class="d-flex justify-content-left align-items-center">
								<div class="avatar float-start bg-light-success rounded me-1">
									<div class="avatar-content">
										<i data-feather="check" class="avatar-icon font-medium-3"></i>
									</div>
								</div>
								<div class="more-info">
									<h6 class="mb-0 text-success">Done</h6>
									<small>Congratulations!! You have done this project</small>
								</div>
							</div>
						</td>
						<td>
							<div class="more-info">
								<p class="mb-50">Duration: {{ 20 }}% @if (10 > 0)
									({{ 10 }} days remaining) 
									@endif
									@if (10 == 0)
									(last day in the project) 
									@endif
								</p>
								<div class="progress progress-bar-secondary" style="height: 6px">
									<div class="progress-bar progress-bar-striped" role="progressbar"
										aria-valuenow="{{ 20 }}" aria-valuemin="{{ 20 }}"
										aria-valuemax="100"
										style="width: {{ 20 }}%; ; background-color: {{ '#c4bc21' }}!important">
									</div>
								</div>
							</div>
						</td>
						<td>Project Manager</td>
						<td>120/200</td>
					</tr>
				</tbody>
			</table>

