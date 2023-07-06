<!-- refer and earn modal -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="inviteToProject" tabindex="-1"
    aria-labelledby="referEarnTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-refer-earn">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-0">
                <div class="px-sm-4 mx-50">
                    <h1 class="text-center mb-1" id="referEarnTitle">Invite member to your project</h1>
                    <p class="text-center mb-5">
                        In order to size up your team,
                        <br />
                        make invitation to your member
                    </p>

                    <div class="row mb-4">
                        <div class="col-12 col-lg-4">
                            <div class="d-flex justify-content-center mb-1">
                                <div
                                    class="
                    modal-refer-earn-step
                    d-flex
                    width-100
                    height-100
                    rounded-circle
                    justify-content-center
                    align-items-center
                    bg-light-primary
                  ">
                                    <i data-feather="message-square"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h6 class="fw-bolder mb-1">Send Invitation 🤟🏻</h6>
                                <p>Send your referral link to your member</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="d-flex justify-content-center mb-1">
                                <div
                                    class="
                    modal-refer-earn-step
                    d-flex
                    width-100
                    height-100
                    rounded-circle
                    justify-content-center
                    align-items-center
                    bg-light-primary
                  ">
                                    <i data-feather="clipboard"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h6 class="fw-bolder mb-1">Registration 👩🏻‍💻</h6>
                                <p>Let them register to our services</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="d-flex justify-content-center mb-1">
                                <div
                                    class="
                    modal-refer-earn-step
                    d-flex
                    width-100
                    height-100
                    rounded-circle
                    justify-content-center
                    align-items-center
                    bg-light-primary
                  ">
                                    <i data-feather="award"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h6 class="fw-bolder mb-1">Joining team 🎉</h6>
                                <p>Your teammate will accept/ decline the invitation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="px-sm-5 mx-50">
                    <h4 class="fw-bolder mt-5 mb-1">Invite your teammate</h4>
                    <form id="modalInviteForm" class="row g-1" action="{{ route('invite.member') }}" method="POST">
                        @csrf
                        <div class="col-lg-10">
                            <label class="form-label" for="modalInviteEmail">
                                Enter your teammate email address and invite them to join FTask 😍
                            </label>
                            <input type="hidden" name="modalInviteToken" value="{{ $project->token }}">
                            <input type="hidden" name="modalInviteSlug" value="{{ $project->slug }}">
                            <input {{ $checkLimitation >= 4 ? 'disabled' : '' }} type="text" id="modalInviteEmail"
                                class="form-control" name="modalInviteEmail"
                                placeholder="{{ $checkLimitation >= 4 ? 'Your team have reached limitation of invitation' : 'Enter your teammate email' }}"
                                aria-label="example@domain.com" />
                            <span id="error-modalInviteEmail" style="color: red; display: none"></span>
                        </div>
                        <div class="col-lg-2 d-flex align-items-end">
                            <button style="display: none" id="spinnerBtnInvite"
                                class="btn btn-outline-primary waves-effect w-100" type="button" disabled="">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="visually-hidden">Loading...</span>
                            </button>
                            <button {{ $checkLimitation >= 4 ? 'disabled' : '' }} type="submit" id="submitBtnInvite" class="btn btn-primary w-100">{{ $checkLimitation >= 4 ? 'Limited' : 'Send' }}</button>
                        </div>
                    </form>

                    <h4 class="fw-bolder mt-4 mb-1">Share the referral link</h4>
                    <form class="row g-1" onsubmit="return false">
                        <div class="col-lg-9">
                            <label class="form-label" for="modalRnFLink">
                                You can also copy and send it or share it on your social media. 🥳
                            </label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="copy-to-clipboard-input" class="form-control"
                                    value="{{ url('project/invite/' . $project->slug . '/' . $project->token) }}" />
                                <button class="btn btn-outline-primary" id="btn-copy">Copy!</button>
                            </div>
                        </div>
                        <div class="col-lg-3 d-flex align-items-end">
                            <div class="social-btns">
                                <button type="button" class="btn btn-icon btn-facebook me-50">
                                    <a style="color: white" target="_blank"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ url('project/invite/' . $project->token) }}&amp;src=sdkpreparse"
                                        class="fb-xfbml-parse-ignore">
                                        <i data-feather="facebook" class="font-medium-2"></i>
                                        <div class="fb-share-button"
                                            data-href="{{ url('project/invite/' . $project->slug . '/' . $project->token) }}" data-layout=""
                                            data-size=""></div>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / refer and earn modal -->
