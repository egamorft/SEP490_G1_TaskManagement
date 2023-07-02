<!-- Change project manager Modal -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="setNewPMModal{{ $mem->id }}"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 pt-0">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Role transfer</h1>
                    <p>Change project manager as per your requirements.</p>
                </div>

                <div class="alert alert-danger" role="alert">
                    <h6 class="alert-heading">Danger! <strong>{{ $mem->email }}</strong></h6>
                    <div class="alert-body">
                        Please ensure you're absolutely certain before proceeding.
                    </div>
                </div>

                <form id="setNewPMForm" class="row" method="POST" action="{{ route('set.pm') }}">
                    @csrf
                    <div class="text-center mt-2">
                        <input type="hidden" name="account" value="{{ $mem->id }}">
                        <input type="hidden" name="project" value="{{ $project->id }}">
                        <button type="submit" class="btn btn-primary">I'm sure!!</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!--/ Change project manager Modal -->
