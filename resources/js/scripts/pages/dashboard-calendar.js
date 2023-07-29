$(document).ready(function () {
	var select_task = $(".show-task-by-week");
	console.log($(".show-task-by-week"));
	$(".show-task-by-week").on('click', function() {
		console.log($(this).find('span').html());
		if ($(this).find('span').html() == 'This Week') {
			$(this).html(`
				<i data-feather="skip-back"></i>
				<span> Next Week </span>
			`);
			$('.task-list .title').html("Your Task in this week");
		} else {
			$(this).html(`
				<i data-feather="skip-back"></i>
				<span> This Week </span>
			`);
			$('.task-list .title').html("Your Task in the next week");
		}
	});
});