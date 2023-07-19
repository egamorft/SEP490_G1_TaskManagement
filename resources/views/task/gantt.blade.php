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
<script>

	// Gantt Size
	var start_gantt = new Date('07/10/2023');
	var end_gantt = new Date('09/10/2023');

	// Project Info
	var today = new Date('07/20/2023');
	var start = new Date('07/12/2023');
	var end = new Date('07/28/2023');

	// Tasks Info
	var gantt_data = {
		data: [
			{id: 1, text: "My Project", start_date: "12-07-2023", duration: "10", open: true, type: "project"},
			{id: 2, text: "Task 1", start_date: "12-07-2023", duration: "2", parent: "1", progress: "1", status: "-1"},
			{id: 3, text: "Task 2", start_date: "14-07-2023", duration: "5", parent: "1", progress: "1", status: "0"},
			{id: 4, text: "Task 3", start_date: "16-07-2023", duration: "5", parent: "1", progress: "1", status: "1"},
			{id: 5, text: "Task 4", start_date: "18-07-2023", duration: "5", parent: "1", progress: "1", status: "2"},
			{id: 6, text: "Task 5", start_date: "20-07-2023", duration: "2", parent: "1", progress: "1", status: "3"},
			{id: 7, text: "Task 6", start_date: "21-07-2023", duration: "2", parent: "1", progress: "1", status: "4"},
			{id: 8, text: "Task 7", start_date: "22-07-2023", duration: "1", parent: "1", progress: "0", status: "3"},
			{id: 9, text: "Task 8", start_date: "23-07-2023", duration: "1", parent: "1", progress: "0", status: "4"},
		],
		links: [
			{id: "1", source: "3", target: "4", type: "0"},
			{id: "2", source: "4", target: "6", type: "0"},
			{id: "3", source: "2", target: "6", type: "0"},
			{id: "4", source: "4", target: "6", type: "0"},
			{id: "5", source: "5", target: "6", type: "0"},
			{id: "6", source: "6", target: "7", type: "0"},
			{id: "7", source: "7", target: "9", type: "0"},
			{id: "8", source: "8", target: "9", type: "0"},
		]
	}
</script>