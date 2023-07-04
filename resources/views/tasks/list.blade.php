<!-- Collapse start -->


<!-- Collapse end -->

<!-- Full list start -->
<section>
    <div class="app-calendar overflow-hidden border">
        <div class="row g-0">
            @include('tasks.filter')

            <!-- Calendar -->
            <div class="col position-relative bg-white">
                <div class="card shadow-none border-0 mb-0 rounded-0">
                    <div class="card-body pb-0">
                        <div class="todo-app-list">
                            <!-- Todo List starts -->
                            <div class="todo-task-list-wrapper list-group">
                                <ul class="todo-task-list media-list" id="todo-task-list">

                                    <div class="task-list card mb-0">
                                        <div class="card-header pl-0 mb-0 demo-inline-spacing">
                                            <a class="me-1 mt-0" data-bs-toggle="collapse" href="#collapseUncategorized"
                                                role="button" aria-expanded="false"
                                                aria-controls="collapseUncategorized">
                                                Uncategorized
                                            </a>
											<div class="d-inline-block mt-0 mr-0">
												<a class="mt-0 mr-0 text-dark">
													<i data-feather="edit" class="font-medium-2 cursor-pointer d-sm-inline-block d-none me-50"></i>
												</a>
												<a class="mt-0 mr-0 text-dark">
													<i data-feather="trash" class="font-medium-2 cursor-pointer d-sm-inline-block d-none me-50"></i>
												</a>
											</div>
                                        </div>
                                        <div class="collapse show" id="collapseUncategorized">
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Send PPT with real-time
                                                                reports</span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <small class="text-nowrap text-muted me-1">---</small>
                                                        <div class="avatar bg-light-danger">
                                                            <div class="avatar-content">---</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-primary" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Send PPT with real-time
                                                                reports</span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <small class="text-nowrap text-muted me-1">Aug 22</small>
                                                        <div class="avatar bg-light-danger">
                                                            <div class="avatar-content">LM</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-warning" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Submit quotation for
                                                                Abid's
                                                                ecommerce
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
                                                            <img src="{{ asset('images/portrait/small/avatar-s-11.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item completed">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-success" data-feather='check-circle'></i>
                                                            <span class="text-dark todo-title">Reminder to mail clients
                                                                for
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
                                                            <img src="{{ asset('images/portrait/small/avatar-s-4.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-secondary" data-feather='check-circle'></i>
                                                            <span class="text-dark todo-title">Refactor Code and fix the
                                                                bugs and
                                                                test it
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
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-danger" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">List out all the SEO
                                                                resources and
                                                                send it
                                                                to new SEO team.
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <small class="text-nowrap text-muted me-1">Sept 15</small>
                                                        <div class="avatar">
                                                            <img src="{{ asset('images/portrait/small/avatar-s-11.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Finish documentation and
                                                                make it
                                                                live</span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <div class="badge-wrapper me-1">
                                                            {{-- <span class="badge rounded-pill badge-light-success">Low</span> --}}
                                                        </div>
                                                        <small class="text-nowrap text-muted me-1">Aug 28</small>
                                                        <div class="avatar">
                                                            <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item completed">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Pick up Nats from her
                                                                school and
                                                                drop at
                                                                dance class😁 </span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <small class="text-nowrap text-muted me-1">Aug 17</small>
                                                        <div class="avatar bg-light-primary">
                                                            <div class="avatar-content">PK</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Plan new dashboard
                                                                design with
                                                                design team
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
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Conduct a mini awareness
                                                                meeting
                                                                regarding
                                                                health care. </span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <small class="text-nowrap text-muted me-1">Sept 05</small>
                                                        <div class="avatar">
                                                            <img src="{{ asset('images/portrait/small/avatar-s-17.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-secondary" data-feather='check-circle'></i>

                                                            <span class="text-dark todo-title">Fix Responsiveness for
                                                                new
                                                                structure
                                                                💻</span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <div class="badge-wrapper me-1">
                                                            {{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
                                                        </div>
                                                        <small class="text-nowrap text-muted me-1">Aug 08</small>
                                                        <div class="avatar">
                                                            <img src="{{ asset('images/portrait/small/avatar-s-4.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-secondary" data-feather='check-circle'></i>

                                                            <span class="text-dark todo-title">Plan a party for
                                                                development team
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
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-secondary" data-feather='check-circle'></i>

                                                            <span class="text-dark todo-title">Hire 5 new Fresher or
                                                                Experienced,
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
                                                            <img src="{{ asset('images/portrait/small/avatar-s-5.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="task-list">
                                        <div class="mb-2 demo-inline-spacing">
                                            <a class="me-1" data-bs-toggle="collapse" href="#collapseList1"
                                                role="button" aria-expanded="false" aria-controls="collapseList1">
                                                List Bug UI
                                            </a>
                                        </div>
                                        <div class="collapse show" id="collapseList1">
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Fix Responsiveness for
                                                                new
                                                                structure
                                                                💻</span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <div class="badge-wrapper me-1">
                                                            {{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
                                                        </div>
                                                        <small class="text-nowrap text-muted me-1">Aug 08</small>
                                                        <div class="avatar">
                                                            <img src="{{ asset('images/portrait/small/avatar-s-4.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Plan a party for
                                                                development team
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
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Hire 5 new Fresher or
                                                                Experienced,
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
                                                            <img src="{{ asset('images/portrait/small/avatar-s-5.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="task-list">
                                        <div class="mb-2 demo-inline-spacing">
                                            <a class="me-1" data-bs-toggle="collapse" href="#collapseList2"
                                                role="button" aria-expanded="false" aria-controls="collapseList2">
                                                List Task for tester
                                            </a>
                                        </div>
                                        <div class="collapse show" id="collapseList2">
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Fix Responsiveness for
                                                                new
                                                                structure
                                                                💻</span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <div class="badge-wrapper me-1">
                                                            {{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
                                                        </div>
                                                        <small class="text-nowrap text-muted me-1">Aug 08</small>
                                                        <div class="avatar">
                                                            <img src="{{ asset('images/portrait/small/avatar-s-4.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Plan a party for
                                                                development team
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
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Hire 5 new Fresher or
                                                                Experienced,
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
                                                            <img src="{{ asset('images/portrait/small/avatar-s-5.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Fix Responsiveness for
                                                                new
                                                                structure
                                                                💻</span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <div class="badge-wrapper me-1">
                                                            {{-- <span class="badge rounded-pill badge-light-primary">Team</span> --}}
                                                        </div>
                                                        <small class="text-nowrap text-muted me-1">Aug 08</small>
                                                        <div class="avatar">
                                                            <img src="{{ asset('images/portrait/small/avatar-s-4.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item completed">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Skype Tommy for project
                                                                status &
                                                                report</span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <div class="badge-wrapper me-1">
                                                            {{-- <span class="badge rounded-pill badge-light-danger">High</span> --}}
                                                        </div>
                                                        <small class="text-nowrap text-muted me-1">Aug 18</small>
                                                        <div class="avatar">
                                                            <img src="{{ asset('images/portrait/small/avatar-s-8.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="todo-item completed">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Test functionality of
                                                                apps
                                                                developed by
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
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Answer the support
                                                                tickets and
                                                                close
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
                                                </a>
                                            </li>
                                            <li class="todo-item">
                                                <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <div class="title-wrapper">
                                                            <i class="text-info" data-feather='circle'></i>
                                                            <span class="text-dark todo-title">Meet Jane and ask for
                                                                coffee
                                                                ❤️</span>
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
                                                            <img src="{{ asset('images/portrait/small/avatar-s-2.jpg') }}"
                                                                alt="user-avatar" height="32" width="32" />
                                                        </div>
                                                    </div>
                                                </a>
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
</section>
<!-- Full list end -->
