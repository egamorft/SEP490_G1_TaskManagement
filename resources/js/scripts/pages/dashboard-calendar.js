$(document).ready(function () {

    // Add a getWeek() method to the Date prototype to calculate the week number
    Date.prototype.getWeek = function () {
        var firstDayOfYear = new Date(this.getFullYear(), 0, 1);
        var daysOffset = firstDayOfYear.getDay();
        var firstWeekDay = new Date(
            this.getFullYear(),
            0,
            1 + (daysOffset > 0 ? 7 - daysOffset : 0)
        );
        var diff = this - firstWeekDay;
        var daysSinceYearStart = diff / 86400000; // 86400000 ms in a day
        var weekNumber = 1 + Math.floor(daysSinceYearStart / 7);

        return weekNumber;
    };

	function renderTaskList(week) {
		var newTasks = [];
		function isTaskInWeek(taskDate, weekNumber) {
			var currentDate = new Date();
			var taskDateObj = new Date(taskDate);

			// Get the current week number
			var currentWeekNumber =
				currentDate.getFullYear() * 100 + currentDate.getWeek();

			// Get the week number of the given task date
			var taskWeekNumber =
				taskDateObj.getFullYear() * 100 + taskDateObj.getWeek();

			// Compare the week numbers to see if the task is within the desired week
			return taskWeekNumber === currentWeekNumber + weekNumber;
		}

		var count = 0;
		tasks.forEach(function(task, index) {
			// Define the task dates
			var taskDate = task.due_date;
			// Check if tasks are in this week and next week
			var isInWeek = isTaskInWeek(taskDate, week);
			if (isInWeek) {
				count++;
				newTasks.push(task);
				$('#task-row' + task.id).removeClass("d-none");
				$('#task-row' + task.id).find('td:first-child').html(count);
			} else {
				$('#task-row' + task.id).addClass("d-none");
			}
		});
	}

    $(".show-task-by-this-week").on("click", function () {
        $(this).addClass("d-none");
        $(".show-task-by-next-week").removeClass("d-none");
        $(".task-list .title").html("Your Task in this week");
		renderTaskList(0);
    });

    $(".show-task-by-next-week").on("click", function () {
        $(this).addClass("d-none");
        $(".show-task-by-this-week").removeClass("d-none");
        $(".task-list .title").html("Your Task in next week");
		renderTaskList(1);
    });
	renderTaskList(0);
});
