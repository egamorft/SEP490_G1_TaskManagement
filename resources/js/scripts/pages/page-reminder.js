$(window).on("load", function() {
        var reminderButton = $('#reminder-canvas-wrapper'),
            reminderSection = $('#reminder-canvas'),
            removeReminderSection = $('.reminder-close');

        
        reminderButton.on("click", function() {
            if(reminderSection.hasClass("hidden")) {
                reminderSection.removeClass("hidden");
            } else {
                reminderSection.addClass("hidden");
            }
        });

        $('.tabs .reminder-tab').on("click", function() {
            $('.reminder-tab.active').removeClass("active");
            $('.reminder-body .tab.active').removeClass("active");

            $(this).addClass("active");
            var dataTab = $(this).attr("data-tab");
            $(`.reminder-body .tab-${dataTab}`).addClass("active");
        });

        removeReminderSection.on("click", function() {
            $(this).closest("#reminder-canvas").addClass("hidden");
        });
});