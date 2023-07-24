<table class="table datatable-project">
    <thead>
        <tr>
            <th>Project</th>
            <th>Status</th>
            <th>Project Mamager</th>
            <th>Project Supervisor</th>
            <th>Project Members</th>
        </tr>
    </thead>
    <tbody>
        <tr class="odd">
            <td>
                <div class="d-flex justify-content-left align-items-center">
                    <div class="more-info">
                        <h6 class="mb-0 text-danger"><a href="{{ route('view.project.board', ['slug' => 'mine']) }}">Project
                                1</a></h6>
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
            <td>Project Manager</td>
            <td>120/200</td>
        </tr>
    </tbody>
</table>
