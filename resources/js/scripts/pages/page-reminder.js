$(window).on("load", function () {
	var reminderButton = $('.reminder-button-wrapper'),
		reminderSection = $('#reminder-canvas'),
		removeReminderSection = $('#reminder-canvas .reminder-close');


	reminderButton.on("click", function () {
		if (reminderSection.hasClass("hidden")) {
			reminderSection.removeClass("hidden");
		} else {
			reminderSection.addClass("hidden");
		}
	});

	$('.tabs .reminder-tab').on("click", function () {
		$('.reminder-tab.active').removeClass("active");
		$('.reminder-body .tab.active').removeClass("active");

		$(this).addClass("active");
		var dataTab = $(this).attr("data-tab");
		$(`.reminder-body .tab-${dataTab}`).addClass("active");
	});

	removeReminderSection.on("click", function () {
		$(this).closest("#reminder-canvas").addClass("hidden");
	});

	const targetTaskModal = $('#reminderTaskModal');
	var sidebar = $(".reminder-update-item-sidebar");
	$(".reminder-content .reminder-title a").on("click", function () {
        var el = $(this);

            if (el.find(".kanban-item-avatar").length) {
                el.find(".kanban-item-avatar").on("click", function (e) {
                    e.stopPropagation();
                });
            }

            var elementId = el.attr("data-id");
			var projectSlug = el.attr("data-project");
			var boardId = el.attr("data-board");
            var url = "?show=task&task_id=" + elementId;
            var currentUrl = window.location.href.split("?", (window.location.href).length)[0];
			if (currentUrl !== window.location.origin + `/project/${projectSlug}/board/${boardId}/kanban`) {
			// if (currentUrl === window.location.origin || currentUrl === window.location.origin + '/') {
				window.location.href = window.location.origin + `/project/${projectSlug}/board/${boardId}/kanban` + url;
				return;
			} else {
				history.replaceState(null, null, window.location.pathname + url);
			}
            currentUrl = window.location.href.substring(currentUrl.toString().length, (window.location.href).toString().length);
            sidebar.modal("show");

            const urlParams = new URLSearchParams(window.location.search);
            const taskId = urlParams.get('task_id');
			
            var taskRoute = taskRoutes.replace(':taskId', taskId);
            const response = fetch(taskRoute);
            response.then(res => {
                if (res.ok) {
                    return res.text();
                } else {
                    throw new Error('Something went wrong here');
                }
            }).then(html => {
				console.log(targetTaskModal.find('.task-wrapper'))
                targetTaskModal.find('.task-wrapper').html(html);
            }).catch(error => {
                targetTaskModal.find('.task-wrapper').html(error);
            });

    })
});