'use strict';
$(function () {
    //Save data
    $(document).ready(function () {
        //Modal add board
        $('#addBoardForm1').submit(function (event) {
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var _token = form.serialize();
            $.ajax({
                url: url,
                method: method,
                data: _token,
                dataType: 'json',
                success: function (response) {
                    // handle success
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function (response) {
                    if (response.status == 422) {
                        var errors = response.responseJSON.errors;
                        for (var key in errors) {
                            $('#' + key).addClass(' is-invalid');
                            $('#error-' + key).show();
                            $('#error-' + key).text(errors[key][0])
                        }
                    }
                }
            });
        });

        //Modal edit board
        $('#editBoardForm').submit(function (event) {
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var _token = form.serialize();
            $.ajax({
                url: url,
                method: method,
                data: _token,
                dataType: 'json',
                success: function (response) {
                    // handle success
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function (response) {
                    if (response.status == 422) {
                        var errors = response.responseJSON.errors;
                        for (var key in errors) {
                            $('#' + key).addClass(' is-invalid');
                            $('#error-' + key).show();
                            $('#error-' + key).text(errors[key][0])
                        }
                    }
                }
            });
        });

        //Modal remove board
        $('#removeMemberForm').submit(function (event) {
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var _token = form.serialize();
            $.ajax({
                url: url,
                method: method,
                data: _token,
                dataType: 'json',
                success: function (response) {
                    // handle success
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function (response) {
                    if (response.status == 422) {
                        var errors = response.responseJSON.errors;
                        for (var key in errors) {
                            $('#' + key).addClass(' is-invalid');
                            $('#error-' + key).show();
                            $('#error-' + key).text(errors[key][0])
                        }
                    }
                }
            });
        });
    });
});