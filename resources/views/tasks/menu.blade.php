<!-- Right Sidebar starts -->
@include('tasks.form-create')
@include('tasks.form-create-list')
<!-- Right Sidebar ends -->
<!-- Sidebar -->
<div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column" id="app-calendar-sidebar">
	<div class="sidebar-wrapper">
		<div class="card-body add-task d-flex justify-content-center">
			<button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#new-task-modal">
				Add Task
			</button>
		</div>
		<div class="card-body pb-0 pt-0">
			<div class="list-group list-group-filters">
				<ul class="todo-task-list media-list" id="todo-task-list">
					<div class="d-flex align-content-center justify-content-between w-100">
						<div class="input-group input-group-merge">
						  <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
						  <input
							type="text"
							class="form-control"
							id="todo-search"
							placeholder="Search task"
							aria-label="Search..."
							aria-describedby="todo-search"
						  />
						</div>
					  </div>
					<div class="task-list">
						<p class="mb-2 demo-inline-spacing">
							<a class="me-1" data-bs-toggle="collapse" href="#collapseUncategorized" role="button" aria-expanded="false" aria-controls="collapseUncategorized">
								Uncategorized
							</a>
						</p>
						<div class="collapse show" id="collapseUncategorized">
							<li class="todo-item bg-light-primary">
								<a href="{{$project->slug}}/tasks/0" class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Send PPT with real-time reports</span>
										</div>
									</div>
								</a>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Submit quotation for Abid's ecommerce
												website and admin project
											</span>
										</div>
									</div>
								</div>
							</li>
							<li class="todo-item completed">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Reminder to mail clients for
												holidays</span>
										</div>
									</div>
								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Refactor Code and fix the bugs and test it
												on server </span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">List out all the SEO resources and send it
												to new SEO team.
											</span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Finish documentation and make it
												live</span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item completed">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Pick up Nats from her school and drop at
												dance class😁 </span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Plan new dashboard design with design team
												for Google app store.
											</span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Conduct a mini awareness meeting regarding
												health care. </span>
										</div>
									</div>

								</div>
							</li>

							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Fix Responsiveness for new structure
												💻</span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Plan a party for development team
												🎁</span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Hire 5 new Fresher or Experienced,
												frontend and backend developers
											</span>
										</div>
									</div>

								</div>
							</li>
						</div>
					</div>
					<div class="task-list">
						<p class="mb-2 demo-inline-spacing">
							<a class="me-1" data-bs-toggle="collapse" href="#collapseList1" role="button" aria-expanded="false" aria-controls="collapseList1">
								List Bug UI
							</a>
						</p>
						<div class="collapse show" id="collapseList1">
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Fix Responsiveness for new structure
												💻</span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Plan a party for development team
												🎁</span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Hire 5 new Fresher or Experienced,
												frontend and backend developers
											</span>
										</div>
									</div>

								</div>
							</li>
						</div>
					</div>
					<div class="task-list">
						<p class="mb-2 demo-inline-spacing">
							<a class="me-1" data-bs-toggle="collapse" href="#collapseList2" role="button" aria-expanded="false" aria-controls="collapseList2">
								List Task for tester
							</a>
						</p>
						<div class="collapse show" id="collapseList2">
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Fix Responsiveness for new structure
												💻</span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Plan a party for development team
												🎁</span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Hire 5 new Fresher or Experienced,
												frontend and backend developers
											</span>
										</div>
									</div>

								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Fix Responsiveness for new structure
												💻</span>
										</div>
									</div>
								</div>
							</li>
							<li class="todo-item completed">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Skype Tommy for project status &
												report</span>
										</div>
									</div>
								</div>
							</li>
							<li class="todo-item completed">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Test functionality of apps developed by
												dev team for enhancements.
											</span>
										</div>
									</div>
								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Answer the support tickets and close
												completed tickets. </span>
										</div>
									</div>
								</div>
							</li>
							<li class="todo-item">
								<div class="todo-title-wrapper">
									<div class="todo-title-area">
										<div class="title-wrapper">
											<i class="text-success" data-feather='check-circle'></i>
											<span class="todo-title d-inline-block text-truncate" style="max-width: 150px;">Meet Jane and ask for coffee ❤️</span>
										</div>
									</div>
								</div>
							</li>
						</div>
					</div>

				</ul>
			</div>
		</div>
	</div>
	<div class="mt-auto">
		<img src="{{ asset('images/pages/calendar-illustration.png') }}" alt="Calendar illustration" class="img-fluid" />
	</div>
</div>
<!-- /Sidebar -->