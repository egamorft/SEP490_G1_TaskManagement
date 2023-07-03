 <!-- Timeline Card -->
 <div class="col task-info bg-white">
 	<div class="card card-user-timeline">
 		<div class="card-header mb-0">
 			<div class="d-flex align-items-center">
 				<small>Task Detail</small>
 			</div>
 			<div class="d-flex align-items-center">
 				<div class="file-actions">
 					<div class="dropdown d-inline-block">
 						<i class="font-medium-2 cursor-pointer" data-feather="more-vertical" role="button" id="fileActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 						</i>
 						<div class="dropdown-menu dropdown-menu-end" aria-labelledby="fileActions">
 							<a class="dropdown-item" href="#">
 								<i data-feather="edit" class="cursor-pointer me-50"></i>
 								<span class="align-middle">Edit</span>
 							</a>
 							<a class="dropdown-item" href="#">
 								<i data-feather="trash" class="cursor-pointer me-50"></i>
 								<span class="align-middle">Remove</span>
 							</a>
 						</div>
 					</div>
 					<a class="text-dark" href="/projects/{{ $project->slug }}">
 						<i data-feather="x-circle" class="font-medium-2 cursor-pointer d-sm-inline-block d-none me-50"></i>
 					</a>
 				</div>
 			</div>
 		</div>
 		<div class="card-body mt-0">
 			<div class="mt-0">
 				<div class="more-info">
 					<h4 class="card-title">Send PPT with real-time reports</h4>
 				</div>
 			</div>
 			<div class="mt-0">
 				<div class="more-info">
 					<h6 class="mb-0 text-primary">Doing - Project: {{ $project->name }}</h6>
 					<h6 class="mt-1">From Sat, May 25, 2020 - To Sat, May 25, 2020</h6>
 				</div>
 			</div>

 			<hr />

 			<div class="row">
 				<div class=" col">
 					<div class="avatar float-start bg-warning rounded me-1">
 						<div class="avatar-content">
 							<i data-feather="square" class="avatar-icon font-medium-3"></i>
 						</div>
 					</div>
 					<div class="more-info">
 						<h6 class="mb-0 text-warning">Waiting for Review</h6>
 						<small>Click to change for Reviewer</small>
 					</div>
 				</div>
 				<div class=" col border-right">
 					<div class="avatar float-start bg-white rounded me-1">
 						<div class="avatar bg-light-danger">
 							<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar" width="33" height="33" />
 						</div>
 					</div>
 					<div class="more-info">
 						<small>Assignee</small>
 						<h6 class="mb-0">Tran Ngoc Hieu</h6>
 					</div>
 				</div>
 				<div class=" col">
 					<div class="avatar float-start bg-success rounded me-1">
 						<div class="avatar-content">
 							<i data-feather="square" class="avatar-icon font-medium-3"></i>
 						</div>
 					</div>
 					<div class="more-info">
 						<h6 class="mb-0 text-success">Done</h6>
 						<small>Click to mark as done</small>
 					</div>
 				</div>
 				<div class=" col">
 					<div class="avatar float-start bg-white rounded me-1">
 						<div class="avatar bg-light-danger">
 							<img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" alt="Avatar" width="33" height="33" />
 						</div>
 					</div>
 					<div class="more-info">
 						<small>Reviewer</small>
 						<h6 class="mb-0">Tran Ngoc Hieu</h6>
 					</div>
 				</div>
 			</div>

 			<hr />

 			<div class="mt-2">
 				<div class="more-info">
 					<h6 class="mb-2">Task Description</h6>
 					<small>FTask là dự án quản lý Task dành cho sinh viên chuyên ngành SE giúp cho sinh viên quản lý,
 						theo dõi, ....</small>
 				</div>
 			</div>

 			<hr />

 			<div class="mt-2">
 				<div class="more-info">
 					<h6 class="mb-2">Task Result</h6>
 					<small>FTask là dự án quản lý Task dành cho sinh viên chuyên ngành SE giúp cho sinh viên quản lý,
 						theo dõi, ....</small>
 				</div>
 			</div>

 			<hr />
 			<div class="mt-2 chat-application">
 				<h6 class="mb-2">Discussion</h6>
 				@include('tasks.comment')
 			</div>
 		</div>
 	</div>
 </div>
 <!--/ Timeline Card -->