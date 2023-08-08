<!-- BEGIN: Vendor JS-->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        console.log(JSON.stringify(data));
        $.ajax({
            type: 'GET',
            url: '/updateUnseenMsg',
            data: {

            },
            success: function(data) {
                console.log(data.unseenCounter);
                $('.pending-div').empty();
                html = ``;
                if (data.unseenCounter > 0) {
                    html +=
                        `<span class="badge rounded-pill bg-danger badge-up">${data.unseenCounter}</span>`
                }
                $('.pending-div').html(html);
            }
        });
    });

    var noti = pusher.subscribe('my-noti');
    noti.bind('my-noti-event', function(data) {
        $.ajax({
            type: 'GET',
            url: '/updateUnseenNoti',
            data: {

            },
            success: function(data) {
                $('.pending-div-noti').empty();
                html = ``;
                if (data.unseenCounter > 0) {
                    html +=
                        `<span class="badge rounded-pill bg-danger badge-up">${data.unseenCounter}</span>`
                }
                $('.pending-div-noti').html(html);

                $('.pending-div-noti-badge').empty();
                html = ``;
                if (data.unseenCounter > 0) {
                    html +=
                        `<span class="badge rounded-pill badge-light-primary">${data.unseenCounter} new</span>`
                }
                $('.pending-div-noti-badge').html(html);
            }
        });

        //Content noti
        var sender_id = data.sender;
        $.ajax({
            url: '/user/get-specific-user', // Replace with your server route
            method: 'GET',
            data: {
                id: sender_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var dataUser = response.data;

                    var newItem = `<li class="scrollable-container media-list">
                        <a class="d-flex" href="${data.target_url}">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar">
                                        <img src="{{ asset('images/avatars/${dataUser.avatar}') }}"
                                            alt="avatar" width="32" height="32">
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">${data.title}</span></p>
                                    <small class="notification-text">${data.desc}.</small>
                                </div>
                            </div>
                        </a>
                    </li>`;

                    $("#startNoti").append(newItem);
                }
            },
            error: function() {
                console.log("err get user");
            }
        });

    });
</script>


<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset(mix('vendors/js/ui/jquery.sticky.js')) }}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
<!-- Date picker -->
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/page-reminder.js')) }}"></script>
<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

@if ($configData['blankPage'] === false)
    <script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
