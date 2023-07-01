<!-- Collapse start -->


<!-- Collapse end -->

<!-- Full list start -->
<section>
	<div class="app-calendar overflow-hidden border">
		<div class="row g-0">
			@include('tasks.filter')

			<!-- Calendar -->
			<div class="col position-relative">
				<div class="card shadow-none border-0 mb-0 rounded-0">
					<div class="card-body pb-0">
						<div class="todo-app-list">
							<!-- Todo search starts -->
							<div class="app-fixed-search d-flex align-items-center">
								<div class="sidebar-toggle d-block d-lg-none ms-1">
									<i data-feather="menu" class="font-medium-5"></i>
								</div>
								<div class="d-flex align-content-center justify-content-between w-100">
									<div class="input-group input-group-merge">
										<span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
										<input type="text" class="form-control" id="todo-search" placeholder="Search task" aria-label="Search..." aria-describedby="todo-search" />
									</div>
								</div>
								<div class="dropdown">
									<a href="#" class="dropdown-toggle hide-arrow me-1" id="todoActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i data-feather="more-vertical" class="font-medium-2 text-body"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="todoActions">
										<a class="dropdown-item sort-asc" href="#">Sort A - Z</a>
										<a class="dropdown-item sort-desc" href="#">Sort Z - A</a>
										<a class="dropdown-item" href="#">Sort Assignee</a>
										<a class="dropdown-item" href="#">Sort Due Date</a>
										<a class="dropdown-item" href="#">Sort Today</a>
										<a class="dropdown-item" href="#">Sort 1 Week</a>
										<a class="dropdown-item" href="#">Sort 1 Month</a>
									</div>
								</div>
							</div>
							<!-- Todo search ends -->

							<!-- Todo List starts -->
							<div class="todo-task-list-wrapper list-group">
								<ul class="todo-task-list media-list" id="todo-task-list">

									<div class="task-list">
										<p class="mb-2 demo-inline-spacing">
											<a class="me-1" data-bs-toggle="collapse" href="#collapseUncategorized" role="button" aria-expanded="false" aria-controls="collapseUncategorized">
												Uncategorized
											</a>
										</p>
										<div class="collapse show" id="collapseUncategorized">
											<li class="todo-item">
												<a href="{{$project->slug}}/tasks/0" class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck5" />
																<label class="form-check-label" for="customCheck5"></label>
															</div>
															<span class="todo-title">Send PPT with real-time reports</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-warning">Medium</span> --}}
															{{-- <span class="badge rounded-pill badge-light-success">Low</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 22</small>
														<div class="avatar bg-light-danger">
															<div class="avatar-content">LM</div>
														</div>
													</div>
												</a>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck6" />
																<label class="form-check-label" for="customCheck6"></label>
															</div>
															<span class="todo-title">Submit quotation for Abid's ecommerce
																website and admin project
															</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
															{{-- <span class="badge rounded-pill badge-light-success">Low</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 24</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-11.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item completed">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck7" checked />
																<label class="form-check-label" for="customCheck7"></label>
															</div>
															<span class="todo-title">Reminder to mail clients for
																holidays</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
															{{-- <span class="badge rounded-pill badge-light-warning">Medium</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 27</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-4.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck8" />
																<label class="form-check-label" for="customCheck8"></label>
															</div>
															<span class="todo-title">Refactor Code and fix the bugs and test it
																on server </span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-success">Low</span> --}}
															{{-- <span class="badge rounded-pill badge-light-warning">Medium</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 27</small>
														<div class="avatar bg-light-success">
															<div class="avatar-content">KL</div>
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck9" />
																<label class="form-check-label" for="customCheck9"></label>
															</div>
															<span class="todo-title">List out all the SEO resources and send it
																to new SEO team.
															</span>
														</div>
													</div>
													<div class="todo-item-action">
														<small class="text-nowrap text-muted me-1">Sept 15</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-11.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck10" />
																<label class="form-check-label" for="customCheck10"></label>
															</div>
															<span class="todo-title">Finish documentation and make it
																live</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-success">Low</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 28</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item completed">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck11" checked />
																<label class="form-check-label" for="customCheck11"></label>
															</div>
															<span class="todo-title">Pick up Nats from her school and drop at
																dance class😁 </span>
														</div>
													</div>
													<div class="todo-item-action">
														<small class="text-nowrap text-muted me-1">Aug 17</small>
														<div class="avatar bg-light-primary">
															<div class="avatar-content">PK</div>
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck12" />
																<label class="form-check-label" for="customCheck12"></label>
															</div>
															<span class="todo-title">Plan new dashboard design with design team
																for Google app store.
															</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-info">Update</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Sept 02</small>
														<div class="avatar bg-light-danger">
															<div class="avatar-content">LO</div>
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck13" />
																<label class="form-check-label" for="customCheck13"></label>
															</div>
															<span class="todo-title">Conduct a mini awareness meeting regarding
																health care. </span>
														</div>
													</div>
													<div class="todo-item-action">
														<small class="text-nowrap text-muted me-1">Sept 05</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-17.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>

											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck1" />
																<label class="form-check-label" for="customCheck1"></label>
															</div>
															<span class="todo-title">Fix Responsiveness for new structure
																💻</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 08</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-4.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck2" />
																<label class="form-check-label" for="customCheck2"></label>
															</div>
															<span class="todo-title">Plan a party for development team
																🎁</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
															{{-- <span class="badge rounded-pill badge-light-danger">High</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 30</small>
														<div class="avatar bg-light-warning">
															<div class="avatar-content">MB</div>
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck3" />
																<label class="form-check-label" for="customCheck3"></label>
															</div>
															<span class="todo-title">Hire 5 new Fresher or Experienced,
																frontend and backend developers
															</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-info">Update</span> --}}
															{{-- <span class="badge rounded-pill badge-light-warning">Medium</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 28</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-5.jpg') }}" alt="user-avatar" height="32" width="32" />
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
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck1" />
																<label class="form-check-label" for="customCheck1"></label>
															</div>
															<span class="todo-title">Fix Responsiveness for new structure
																💻</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 08</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-4.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck2" />
																<label class="form-check-label" for="customCheck2"></label>
															</div>
															<span class="todo-title">Plan a party for development team
																🎁</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
															{{-- <span class="badge rounded-pill badge-light-danger">High</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 30</small>
														<div class="avatar bg-light-warning">
															<div class="avatar-content">MB</div>
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck3" />
																<label class="form-check-label" for="customCheck3"></label>
															</div>
															<span class="todo-title">Hire 5 new Fresher or Experienced,
																frontend and backend developers
															</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-info">Update</span> --}}
															{{-- <span class="badge rounded-pill badge-light-warning">Medium</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 28</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-5.jpg') }}" alt="user-avatar" height="32" width="32" />
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
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck1" />
																<label class="form-check-label" for="customCheck1"></label>
															</div>
															<span class="todo-title">Fix Responsiveness for new structure
																💻</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 08</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-4.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck2" />
																<label class="form-check-label" for="customCheck2"></label>
															</div>
															<span class="todo-title">Plan a party for development team
																🎁</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
															{{-- <span class="badge rounded-pill badge-light-danger">High</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 30</small>
														<div class="avatar bg-light-warning">
															<div class="avatar-content">MB</div>
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck3" />
																<label class="form-check-label" for="customCheck3"></label>
															</div>
															<span class="todo-title">Hire 5 new Fresher or Experienced,
																frontend and backend developers
															</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-info">Update</span> --}}
															{{-- <span class="badge rounded-pill badge-light-warning">Medium</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 28</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-5.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck1" />
																<label class="form-check-label" for="customCheck1"></label>
															</div>
															<span class="todo-title">Fix Responsiveness for new structure
																💻</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 08</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-4.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item completed">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck4" checked />
																<label class="form-check-label" for="customCheck4"></label>
															</div>
															<span class="todo-title">Skype Tommy for project status &
																report</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-danger">High</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 18</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-8.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item completed">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck14" checked />
																<label class="form-check-label" for="customCheck14"></label>
															</div>
															<span class="todo-title">Test functionality of apps developed by
																dev team for enhancements.
															</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-danger">High</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Sept 07</small>
														<div class="avatar bg-light-info">
															<div class="avatar-content">VB</div>
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck15" />
																<label class="form-check-label" for="customCheck15"></label>
															</div>
															<span class="todo-title">Answer the support tickets and close
																completed tickets. </span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-primary">Frontend</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Sept 12</small>
														<div class="avatar bg-light-success">
															<div class="avatar-content">SW</div>
														</div>
													</div>
												</div>
											</li>
											<li class="todo-item">
												<div class="todo-title-wrapper">
													<div class="todo-title-area">
														<div class="title-wrapper">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="customCheck16" />
																<label class="form-check-label" for="customCheck16"></label>
															</div>
															<span class="todo-title">Meet Jane and ask for coffee ❤️</span>
														</div>
													</div>
													<div class="todo-item-action">
														<div class="badge-wrapper me-1">
															{{-- <span class="badge rounded-pill badge-light-info">Update</span> --}}
															{{-- <span class="badge rounded-pill badge-light-warning">Medium</span> --}}
															{{-- <span class="badge rounded-pill badge-light-success">Low</span> --}}
														</div>
														<small class="text-nowrap text-muted me-1">Aug 10</small>
														<div class="avatar">
															<img src="{{ asset('images/portrait/small/avatar-s-2.jpg') }}" alt="user-avatar" height="32" width="32" />
														</div>
													</div>
												</div>
											</li>
										</div>
									</div>

								</ul>
								<div class="no-results">
									<h5>No Items Found</h5>
								</div>
							</div>
							<!-- Todo List ends -->
						</div>
					</div>
				</div>
			</div>
			<!-- /Calendar -->
			<div class="body-content-overlay"></div>
		</div>
	</div>
	<!-- Right Sidebar starts -->
	<div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
		<div class="modal-dialog sidebar-lg">
			<div class="modal-content p-0">
				<form id="form-modal-todo" class="todo-modal needs-validation" novalidate onsubmit="return false">
					<div class="modal-header align-items-center mb-1">
						<h5 class="modal-title">Add Task</h5>
						<div class="todo-item-action d-flex align-items-center justify-content-between ms-auto">
							<span class="todo-item-favorite cursor-pointer me-75"><i data-feather="star" class="font-medium-2"></i></span>
							<i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal" stroke-width="3"></i>
						</div>
					</div>
					<div class="modal-body flex-grow-1 pb-sm-0 pb-3">
						<div class="action-tags">
							<div class="mb-1">
								<label for="todoTitleAdd" class="form-label">Title</label>
								<input type="text" id="todoTitleAdd" name="todoTitleAdd" class="new-todo-item-title form-control" placeholder="Title" />
							</div>
							<div class="mb-1 position-relative">
								<label for="task-assigned" class="form-label d-block">Assignee</label>
								<select class="select2 form-select" id="task-assigned" name="task-assigned">
									<option data-img="{{ asset('images/portrait/small/avatar-s-3.jpg') }}" value="Phill Buffer" selected>
										Phill Buffer
									</option>
									<option data-img="{{ asset('images/portrait/small/avatar-s-1.jpg') }}" value="Chandler Bing">
										Chandler Bing
									</option>
									<option data-img="{{ asset('images/portrait/small/avatar-s-4.jpg') }}" value="Ross Geller">
										Ross Geller
									</option>
									<option data-img="{{ asset('images/portrait/small/avatar-s-6.jpg') }}" value="Monica Geller">
										Monica Geller
									</option>
									<option data-img="{{ asset('images/portrait/small/avatar-s-2.jpg') }}" value="Joey Tribbiani">
										Joey Tribbiani
									</option>
									<option data-img="{{ asset('images/portrait/small/avatar-s-11.jpg') }}" value="Rachel Green">
										Rachel Green
									</option>
								</select>
							</div>
							<div class="mb-1">
								<label for="task-due-date" class="form-label">Due Date</label>
								<input type="text" class="form-control task-due-date" id="task-due-date" name="task-due-date" />
							</div>
							<div class="mb-1">
								<label for="task-tag" class="form-label d-block">Tag</label>
								<select class="form-select task-tag" id="task-tag" name="task-tag" multiple="multiple">
									<option value="Team">Team</option>
									<option value="Low">Low</option>
									<option value="Medium">Medium</option>
									<option value="High">High</option>
									<option value="Update">Update</option>
								</select>
							</div>
							<div class="mb-1">
								<label class="form-label">Description</label>
								<div id="task-desc" class="border-bottom-0" data-placeholder="Write Your Description">
								</div>
								<div class="d-flex justify-content-end desc-toolbar border-top-0">
									<span class="ql-formats me-0">
										<button class="ql-bold"></button>
										<button class="ql-italic"></button>
										<button class="ql-underline"></button>
										<button class="ql-align"></button>
										<button class="ql-link"></button>
									</span>
								</div>
							</div>
						</div>
						<div class="my-1">
							<button type="submit" class="btn btn-primary d-none add-todo-item me-1">Add</button>
							<button type="button" class="btn btn-outline-secondary add-todo-item d-none" data-bs-dismiss="modal">
								Cancel
							</button>
							<button type="button" class="btn btn-primary d-none update-btn update-todo-item me-1">Update</button>
							<button type="button" class="btn btn-outline-danger update-btn d-none" data-bs-dismiss="modal">
								Delete
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Right Sidebar ends -->
</section>
<!-- Full list end -->