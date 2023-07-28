<table class="table datatable-project project-list-table">
    <thead>
        <tr>
            <th></th>
            <th>Project</th>
            <th>Status</th>
            <th>Mamager</th>
            <th>Supervisor</th>
            <th>Members</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($allProjects as $key => $project)
            @php
                $supervisor = null;
                $manager = $allAccounts[0];
                $members = [];
                
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
            @endphp
            <tr class="odd" id="row{{ $project->id }}">
                <td>{{ $key + 1 }}</td>
                <td>
                    <div class="d-flex justify-content-left align-items-center">
                        <div class="more-info">
                            <h6 class="mb-0 text-truncate" style="max-width: 300px; display: block;"><a
                                    href="{{ route('view.project.board', ['slug' => $project->slug]) }}">{{ $project->name }}</a>
                            </h6>
                            <small class="text-truncate"
                                style="max-width: 300px; display: block;">{{ $project->description ? $project->description : 'No Description' }}</small>
                        </div>
                    </div>
                </td>
                <td>
                    @switch($project->project_status)
                        @case(-1)
                            <span class="badge rounded-pill badge-light-danger">
								Fail
                            </span>
                        @break

                        @case(0)
                            <span class="badge rounded-pill badge-light-danger">
								Todo
                            </span>
                        @break

                        @case(1)
                            <span class="badge rounded-pill badge-light-danger">
								Doing
                            </span>
                        @break

                        @case(2)
                            <span class="badge rounded-pill badge-light-danger">
								Done
                            </span>
                        @break

                        @default
                            <span class="badge rounded-pill badge-light-danger">
								Done
                            </span>
                    @endswitch
                </td>

                <td>
                    <div class="avatar float-start bg-white rounded">
                        <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => $manager->id]) }}"
                            class="avatar float-start bg-white rounded me-1">
                            <img src="{{ asset('images/avatars/' . $manager->avatar) }}" alt="Avatar" width="33"
                                height="33" />
                        </a>
                    </div>
                    <div class="more-info pt-05">
                        <h6 class="mt-0">{{ $manager->fullname ?? '' }}</h6>
                    </div>
                </td>
                <td>
                    <div class="avatar float-start bg-white rounded">
                        <a href="{{ $supervisor ? route('view.project.member', ['slug' => $project->slug, 'user_id' => $supervisor->id]) : '#' }}"
                            class="avatar float-start bg-white rounded me-1">
                            <img src="{{ isset($supervisor->avatar) ? asset('images/avatars/' . $supervisor->avatar) : asset('images/avatars/default.png') }}"
                                alt="Avatar" width="33" height="33" />
                        </a>
                    </div>
                    <div class="more-info pt-05">
                        <h6 class="mt-0">
                            {{ $supervisor->fullname ?? 'Waiting ...' }}
                        </h6>
                    </div>
                </td>
                <td>
                    <div class="avatar-group">
                        @forelse ($members as $acc)
                            <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => $acc->id]) }}"
                                data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom"
                                title="{{ $acc->fullname }}" class="avatar pull-up">
                                <img src="{{ asset('images/avatars/' . $acc->avatar) }}" alt="Avatar" width="33"
                                    height="33" />
                            </a>
                        @empty
                            <div class="d-flex align-items-center me-2">
                                <strong>Waiting ...</strong>
                            </div>
                        @endforelse
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
