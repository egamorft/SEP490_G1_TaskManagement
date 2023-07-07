@include('content._partials._modals.modal-edit-task')
@include('content._partials._modals.modal-delete-task')
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
                        <i class="font-medium-2 cursor-pointer" data-feather="more-vertical" role="button"
                            id="fileActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </i>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="fileActions">
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTask">
                                <i data-feather="edit" class="cursor-pointer me-50"></i>
                                <span class="align-middle">Edit</span>
                            </a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#removeTask">
                                <i data-feather="trash" class="cursor-pointer me-50"></i>
                                <span class="align-middle">Remove</span>
                            </a>
                        </div>
                    </div>
                    <a class="text-dark" href="/project/{{ $project->slug }}">
                        <i data-feather="x-circle"
                            class="font-medium-2 cursor-pointer d-sm-inline-block d-none me-50"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-0">
            <div class="mt-0">
                <div class="more-info">
                    <h4 class="card-title">{{ $subTask->name }}</h4>
                </div>
            </div>
            <div class="mt-0">
                <div class="more-info">
                    <h6 class="mb-0 text-primary">Project: {{ $project->name }}</h6>
                    <h6 class="mt-1">From {{ date('D, M d, Y', strtotime($subTask->created_at)) }} - To
                        {{ date('D, M d, Y', strtotime($subTask->due_date)) }}</h6>
                </div>
            </div>

            {{-- todo-status --}}
            <hr class="mb-0" />
            <div class="row m-0">
                <button type="button" style="padding: 15px;"
                    class="task-status d-inline-flex col btn btn-info dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i data-feather='circle' class="cursor-pointer me-50"></i>
                    <span class="align-middle">Todo</span>
                </button>
                <ul class="dropdown-menu" style="width: 250px;"">
                    <li>
                        <div class="select-header border-bottom">Change Task Status</div>
                    </li>
                    <li><a class="dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#changeTaskStatus">
                            <i data-feather='circle' class="cursor-pointer me-50"></i>Doing</a></li>
                    <li><a class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#changeTaskStatus">
                            <i data-feather='circle' class="cursor-pointer me-50"></i>Waiting for Review</a></li>
                    <li><a class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#changeTaskStatus">
                            <i data-feather='check-circle' class="cursor-pointer me-50"></i>Mark as Done</a></li>
                </ul>

                <button type="button" style="padding: 15px;"
                    class="task-member d-inline-flex col btn btn-light border-left dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i data-feather='user-plus' class="cursor-pointer me-50"></i>
                    <span class="align-middle">Assign Task</span>
                </button>
                <ul class="dropdown-menu" style="width: 250px;"">
                    <li>
                        <div class="select-header border-bottom">Assign To</div>
                    </li>
                    <li><a class="dropdown-item text-primary" data-bs-toggle="modal"
                            data-bs-target="#changeTaskReviewer">
                            <div class="avatar float-start bg-white rounded me-1">
                                <div class="avatar bg-light-danger">
                                    <img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
                                        width="33" height="33" />
                                </div>
                            </div>
                            <div class="more-info">
                                <small>@hieutran</small>
                                <h6 class="mb-0">Tran Ngoc Hieu</h6>
                            </div>
                        </a></li>
                    <li><a class="dropdown-item text-primary" data-bs-toggle="modal"
                            data-bs-target="#changeTaskReviewer">
                            <div class="avatar float-start bg-white rounded me-1">
                                <div class="avatar bg-light-danger">
                                    <img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
                                        width="33" height="33" />
                                </div>
                            </div>
                            <div class="more-info">
                                <small>@hieutran</small>
                                <h6 class="mb-0">Tran Ngoc Hieu</h6>
                            </div>
                        </a></li>
                    <li><a class="dropdown-item text-primary" data-bs-toggle="modal"
                            data-bs-target="#changeTaskReviewer">
                            <div class="avatar float-start bg-white rounded me-1">
                                <div class="avatar bg-light-danger">
                                    <img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
                                        width="33" height="33" />
                                </div>
                            </div>
                            <div class="more-info">
                                <small>@hieutran</small>
                                <h6 class="mb-0">Tran Ngoc Hieu</h6>
                            </div>
                        </a></li>
                    <li><a class="dropdown-item border-top" data-bs-toggle="modal"
                            data-bs-target="#removeTaskReviewer">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-info">
                                    <h6 class=" text-danger" style="margin-top: 7px;">Remove Assignee</h6>
                                </div>
                            </div>
                        </a></li>
                </ul>

                <button type="button" style="padding: 15px;"
                    class="task-member d-inline-flex col btn btn-light border-left dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i data-feather='user-plus' class="cursor-pointer me-50"></i>
                    <span class="align-middle">Add Reviewer</span>
                </button>
                <ul class="dropdown-menu" style="width: 250px;"">
                    <li>
                        <div class="select-header border-bottom">Select Reviewer</div>
                    </li>
                    <li><a class="dropdown-item text-primary" data-bs-toggle="modal"
                            data-bs-target="#changeTaskReviewer">
                            <div class="avatar float-start bg-white rounded me-1">
                                <div class="avatar bg-light-danger">
                                    <img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
                                        width="33" height="33" />
                                </div>
                            </div>
                            <div class="more-info">
                                <small>@hieutran</small>
                                <h6 class="mb-0">Tran Ngoc Hieu</h6>
                            </div>
                        </a></li>
                    <li><a class="dropdown-item text-primary" data-bs-toggle="modal"
                            data-bs-target="#changeTaskReviewer">
                            <div class="avatar float-start bg-white rounded me-1">
                                <div class="avatar bg-light-danger">
                                    <img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
                                        width="33" height="33" />
                                </div>
                            </div>
                            <div class="more-info">
                                <small>@hieutran</small>
                                <h6 class="mb-0">Tran Ngoc Hieu</h6>
                            </div>
                        </a></li>
                    <li><a class="dropdown-item text-primary" data-bs-toggle="modal"
                            data-bs-target="#changeTaskReviewer">
                            <div class="avatar float-start bg-white rounded me-1">
                                <div class="avatar bg-light-danger">
                                    <img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
                                        width="33" height="33" />
                                </div>
                            </div>
                            <div class="more-info">
                                <small>@hieutran</small>
                                <h6 class="mb-0">Tran Ngoc Hieu</h6>
                            </div>
                        </a></li>
                    <li><a class="dropdown-item border-top" data-bs-toggle="modal"
                            data-bs-target="#removeTaskReviewer">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-info">
                                    <h6 class=" text-danger" style="margin-top: 7px;">Remove Reviewer</h6>
                                </div>
                            </div>
                        </a></li>
                </ul>
            </div>
            <hr class="mt-0" />

			{{-- doing-status --}}
            <hr class="mb-0" />
            <div class="row m-0">
                <button type="button" style="padding: 15px;"
                    class="task-status d-inline-flex col btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i data-feather='circle' class="cursor-pointer me-50"></i>
                    <span class="align-middle">Doing</span>
                </button>
                <ul class="dropdown-menu" style="width: 250px;"">
                    <li>
                        <div class="select-header border-bottom">Change Task Status</div>
                    </li>
                    <li><a class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#changeTaskStatus">
                            <i data-feather='circle' class="cursor-pointer me-50"></i>Waiting for Review</a></li>
                    <li><a class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#changeTaskStatus">
                            <i data-feather='check-circle' class="cursor-pointer me-50"></i>Mark as Done</a></li>
                </ul>

				<div class="btn-group col row">
					<div class=" col-10 border-right">
						<div class="avatar float-start bg-white rounded me-1">
							<div class="avatar bg-light-danger">
								<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
									width="33" height="33" />
							</div>
						</div>
						<div class="more-info">
							<small>Assignee</small>
							<h6 class="mb-0">Tran Ngoc Hieu</h6>
						</div>
					</div>
					<button type="button" style="padding: 15px;"
						class="task-member d-inline-flex col-2 btn btn-light border-left dropdown-toggle dropdown-toggle-split"
						data-bs-toggle="dropdown" aria-expanded="false">
						<i data-feather='chevrons-down' class="d-flex justify-content-center cursor-pointer me-50"></i>
					</button>
					<ul class="dropdown-menu" style="width: 250px;"">
						<li>
							<div class="select-header border-bottom">Assign To</div>
						</li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item border-top" data-bs-toggle="modal"
								data-bs-target="#removeTaskReviewer">
								<div class="list-item d-flex align-items-start">
									<div class="me-1">
										<div class="avatar bg-light-danger">
											<div class="avatar-content"><i class="avatar-icon" data-feather="x"></i>
											</div>
										</div>
									</div>
									<div class="more-info">
										<h6 class=" text-danger" style="margin-top: 7px;">Remove Assignee</h6>
									</div>
								</div>
							</a></li>
					</ul>
				</div>

				<div class="btn-group col row">
					<div class=" col-10 border-right">
						<div class="avatar float-start bg-white rounded me-1">
							<div class="avatar bg-light-danger">
								<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
									width="33" height="33" />
							</div>
						</div>
						<div class="more-info">
							<small>Reviewer</small>
							<h6 class="mb-0">Tran Ngoc Hieu</h6>
						</div>
					</div>
					<button type="button" style="padding: 15px;"
						class="task-member d-inline-flex col-2 btn btn-light border-left dropdown-toggle dropdown-toggle-split"
						data-bs-toggle="dropdown" aria-expanded="false">
						<i data-feather='chevrons-down' class="d-flex justify-content-center cursor-pointer me-50"></i>
					</button>
					<ul class="dropdown-menu" style="width: 250px;"">
						<li>
							<div class="select-header border-bottom">Select Reviewer</div>
						</li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item border-top" data-bs-toggle="modal"
								data-bs-target="#removeTaskReviewer">
								<div class="list-item d-flex align-items-start">
									<div class="me-1">
										<div class="avatar bg-light-danger">
											<div class="avatar-content"><i class="avatar-icon" data-feather="x"></i>
											</div>
										</div>
									</div>
									<div class="more-info">
										<h6 class=" text-danger" style="margin-top: 7px;">Remove Reviewer</h6>
									</div>
								</div>
							</a></li>
					</ul>
				</div>
            </div>
            <hr class="mt-0" />

			{{-- reviewing-status --}}
            <hr class="mb-0" />
            <div class="row m-0">
                <button type="button" style="padding: 15px;"
                    class="task-status d-inline-flex col btn btn-warning dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i data-feather='circle' class="cursor-pointer me-50"></i>
                    <span class="align-middle">Waiting for Review</span>
                </button>
                <ul class="dropdown-menu" style="width: 250px;"">
                    <li>
                        <div class="select-header border-bottom">Waiting for Review</div>
                    </li>
                    <li><a class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#changeTaskStatus">
                            <i data-feather='circle' class="cursor-pointer me-50"></i>Waiting for Review</a></li>
                    <li><a class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#changeTaskStatus">
                            <i data-feather='check-circle' class="cursor-pointer me-50"></i>Mark as Done</a></li>
                </ul>

				<div class="btn-group col row">
					<div class=" col-10 border-right">
						<div class="avatar float-start bg-white rounded me-1">
							<div class="avatar bg-light-danger">
								<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
									width="33" height="33" />
							</div>
						</div>
						<div class="more-info">
							<small>Assignee</small>
							<h6 class="mb-0">Tran Ngoc Hieu</h6>
						</div>
					</div>
					<button type="button" style="padding: 15px;"
						class="task-member d-inline-flex col-2 btn btn-light border-left dropdown-toggle dropdown-toggle-split"
						data-bs-toggle="dropdown" aria-expanded="false">
						<i data-feather='chevrons-down' class="d-flex justify-content-center cursor-pointer me-50"></i>
					</button>
					<ul class="dropdown-menu" style="width: 250px;"">
						<li>
							<div class="select-header border-bottom">Assign To</div>
						</li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item border-top" data-bs-toggle="modal"
								data-bs-target="#removeTaskReviewer">
								<div class="list-item d-flex align-items-start">
									<div class="me-1">
										<div class="avatar bg-light-danger">
											<div class="avatar-content"><i class="avatar-icon" data-feather="x"></i>
											</div>
										</div>
									</div>
									<div class="more-info">
										<h6 class=" text-danger" style="margin-top: 7px;">Remove Assignee</h6>
									</div>
								</div>
							</a></li>
					</ul>
				</div>

				<div class="btn-group col row">
					<div class=" col-10 border-right">
						<div class="avatar float-start bg-white rounded me-1">
							<div class="avatar bg-light-danger">
								<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
									width="33" height="33" />
							</div>
						</div>
						<div class="more-info">
							<small>Reviewer</small>
							<h6 class="mb-0">Tran Ngoc Hieu</h6>
						</div>
					</div>
					<button type="button" style="padding: 15px;"
						class="task-member d-inline-flex col-2 btn btn-light border-left dropdown-toggle dropdown-toggle-split"
						data-bs-toggle="dropdown" aria-expanded="false">
						<i data-feather='chevrons-down' class="d-flex justify-content-center cursor-pointer me-50"></i>
					</button>
					<ul class="dropdown-menu" style="width: 250px;"">
						<li>
							<div class="select-header border-bottom">Select Reviewer</div>
						</li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item text-primary" data-bs-toggle="modal"
								data-bs-target="#changeTaskReviewer">
								<div class="avatar float-start bg-white rounded me-1">
									<div class="avatar bg-light-danger">
										<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
											width="33" height="33" />
									</div>
								</div>
								<div class="more-info">
									<small>@hieutran</small>
									<h6 class="mb-0">Tran Ngoc Hieu</h6>
								</div>
							</a></li>
						<li><a class="dropdown-item border-top" data-bs-toggle="modal"
								data-bs-target="#removeTaskReviewer">
								<div class="list-item d-flex align-items-start">
									<div class="me-1">
										<div class="avatar bg-light-danger">
											<div class="avatar-content"><i class="avatar-icon" data-feather="x"></i>
											</div>
										</div>
									</div>
									<div class="more-info">
										<h6 class=" text-danger" style="margin-top: 7px;">Remove Reviewer</h6>
									</div>
								</div>
							</a></li>
					</ul>
				</div>
            </div>
            <hr class="mt-0" />

			{{-- Done-status --}}
            <hr class="mb-0" />
            <div class="row m-0">
                <button type="button" style="padding: 15px;"
                    class="task-status d-inline-flex col btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i data-feather='check-circle' class="cursor-pointer me-50"></i>
                    <span class="align-middle">Done</span>
                </button>
                <ul class="dropdown-menu" style="width: 250px;"">
                    <li>
                        <div class="select-header border-bottom">Waiting for Review</div>
                    </li>
                    <li><a class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#changeTaskStatus">
                            <i data-feather='circle' class="cursor-pointer me-50"></i>Waiting for Review</a></li>
                    <li><a class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#changeTaskStatus">
                            <i data-feather='check-circle' class="cursor-pointer me-50"></i>Mark as Done</a></li>
                </ul>

				<div class="btn-group col row">
					<div class=" col-12 border-right">
						<div class="avatar float-start bg-white rounded me-1">
							<div class="avatar bg-light-danger">
								<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
									width="33" height="33" />
							</div>
						</div>
						<div class="more-info">
							<small>Assignee</small>
							<h6 class="mb-0">Tran Ngoc Hieu</h6>
						</div>
					</div>
				</div>

				<div class="btn-group col row">
					<div class=" col-12 border-right">
						<div class="avatar float-start bg-white rounded me-1">
							<div class="avatar bg-light-danger">
								<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
									width="33" height="33" />
							</div>
						</div>
						<div class="more-info">
							<small>Reviewer</small>
							<h6 class="mb-0">Tran Ngoc Hieu</h6>
						</div>
					</div>
				</div>
            </div>
            <hr class="mt-0" />

            <div class="mt-2">
                <div class="more-info">
                    <h6 class="mb-2">Task Description</h6>
                    <img src="{{ asset('uploads/' . $subTask->attachment) }}">
                    <small>{{ $subTask->description }}</small>
                </div>
            </div>

            <hr />

            <div class="mt-2 chat-application">
                <h6 class="mb-2">Discussion</h6>
                @include('task.comment')
            </div>
        </div>
    </div>
</div>
<!--/ Timeline Card -->
