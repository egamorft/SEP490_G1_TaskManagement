<div class="gantt_control">
    <button class="show-critical">Show Critical Path</button>
    <button class="show-progress">Toggle Progress Line</button>
    <button onclick="gantt.ext.zoom.zoomIn();">+ Zoom In</button>
    <button onclick="gantt.ext.zoom.zoomOut();">- Zoom Out</button>
    <button class="undo-btn" onclick='gantt.undo()'>Undo</button>
    <button class="redo-btn" onclick='gantt.redo()'>Redo</button>
    <button class="btn btn-primary save-btn">Save All Change</button>
    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
</div>

<div id="gantt_here" style='width:100%; height:calc(100vh - 282px);'></div>
@php
    $projectStartDate = new DateTime($project->start_date);
    $projectStartDateFormatted = $projectStartDate->format('Y-m-d');
    $projectStartDate->modify('-2 months');
    $ganttStartDate = $projectStartDate->format('Y-m-d');

    $projectEndDate = new DateTime($project->end_date);
    $projectEndDateFormatted = $projectEndDate->format('Y-m-d');
    $projectEndDate->modify('+2 months');
    $ganttEndDate = $projectEndDate->format('Y-m-d');
	// dd($ganttStartDate, $ganttEndDate);
	$today = date('Y-m-d');
	// dd($today);
@endphp
<script type="text/javascript">
    gantt.config.date_format = "%Y-%m-%d";
    gantt.config.order_branch = true;/*!*/
    gantt.config.order_branch_free = true;/*!*/
	
	gantt.plugins({
		marker: true
	});
	var dateToStr = gantt.date.date_to_str(gantt.config.task_date);
	var today = new Date('{{ $today }}');
	gantt.addMarker({
		start_date: today,
		css: "today",
		text: "Today",
		title: "Today: " + dateToStr(today)
	});

	var start = new Date('{{ $projectStartDateFormatted }}');
	gantt.addMarker({
		start_date: start,
		css: "status_line",
		text: "Start project",
		title: "Start project: " + dateToStr(start)
	});
	
    gantt.init("gantt_here");
    gantt.load("/api/data/{{ $project->id }}");

    // // Gantt Size
    // var start_gantt = "{{ $ganttStartDate }}";
    // var end_gantt = "{{ $ganttEndDate }}";

    // // Project Info
    // var today = new Date('{{ $today }}');
    // var start = new Date('{{ $projectStartDateFormatted }}');
    // var end = new Date('{{ $projectEndDateFormatted }}');

	// Tasks Info
	// var gantt_data = {
	// 	data: [
	// 		{id: 1, text: "My Project", "readonly": true, start_date: "12-07-2023", duration: "10", open: true, type: "project"},
	// 		{id: 2, text: "Task 1", start_date: "12-07-2023", duration: "2", parent: "1", progress: "1", status: "-1"},
	// 		{id: 3, text: "Task 2", start_date: "14-07-2023", duration: "5", parent: "1", progress: "1", status: "0"},
	// 		{id: 4, text: "Task 3", start_date: "16-07-2023", duration: "5", parent: "1", progress: "1", status: "1"},
	// 		{id: 5, text: "Task 4", start_date: "18-07-2023", duration: "5", parent: "1", progress: "1", status: "2"},
	// 		{id: 6, text: "Task 5", start_date: "20-07-2023", duration: "2", parent: "1", progress: "1", status: "3"},
	// 		{id: 7, text: "Task 6", start_date: "21-07-2023", duration: "2", parent: "1", progress: "1", status: "4"},
	// 		{id: 8, text: "Task 7", start_date: "22-07-2023", duration: "1", parent: "1", progress: "0", status: "3"},
	// 		{id: 119, text: "Task 8", start_date: "23-07-2023", duration: "1", parent: "1", progress: "0", status: "4"},
	// 	],
	// 	links: [
	// 		{id: "1", source: "3", target: "4", type: "0"},
	// 		{id: "2", source: "4", target: "6", type: "0"},
	// 		{id: "3", source: "2", target: "6", type: "0"},
	// 		{id: "4", source: "4", target: "6", type: "0"},
	// 		{id: "5", source: "5", target: "6", type: "0"},
	// 		{id: "6", source: "6", target: "7", type: "0"},
	// 		{id: "7", source: "7", target: "9", type: "0"},
	// 		{id: "8", source: "8", target: "9", type: "0"},
	// 	]
	// }
</script>
