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
    $projectStartDateFormatted = $projectStartDate->format('Y-m-d H:i:s');
    $projectStartDate->modify('-1 month');
    $ganttStartDate = $projectStartDate->format('Y-m-d H:i:s');
    
    $projectEndDate = new DateTime($project->end_date);
    $projectEndDateFormatted = $projectEndDate->format('Y-m-d H:i:s');
    $projectEndDate->modify('+1 month');
    $ganttEndDate = $projectEndDate->format('Y-m-d H:i:s');
    // dd($ganttStartDate, $ganttEndDate);
    $today = date('Y-m-d');
    // dd($today);
@endphp
<script type="text/javascript">
    gantt.config.date_format = "%Y-%m-%d %H:%i:%s";
    gantt.config.duration_unit = "day";
    gantt.config.step = 1;

    // gantt.config.order_branch = true; /*!*/
    // gantt.config.order_branch_free = true; /*!*/

    gantt.plugins({
		auto_scheduling: true,
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
</script>
