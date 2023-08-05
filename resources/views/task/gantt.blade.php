<div class="gantt_control">
	<button onclick="updateCriticalPath(this)">Show Critical Path</button>
    <input type='button' onclick="toggleOverlay()" value="Toggle Progress Line">
    <input type=button value="Zoom In" onclick="gantt.ext.zoom.zoomIn();">
    <input type=button value="Zoom Out" onclick="gantt.ext.zoom.zoomOut();">
    <input type='button' value='Create task' onclick="gantt.createTask()">
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
        marker: true,
		critical_path: true
    });

    function updateCriticalPath(toggle) {
        console.log(toggle);
		toggle.enabled = !toggle.enabled;
		if (toggle.enabled) {
			toggle.innerHTML = "Hide Critical Path";
			gantt.config.highlight_critical_path = true;
		} else {
			toggle.innerHTML = "Show Critical Path";
			gantt.config.highlight_critical_path = false;
		}
		gantt.render();
	}

    var dateToStr = gantt.date.date_to_str(gantt.config.task_date);
    var today = new Date('{{ $today }}');
    gantt.addMarker({
        start_date: today,
        css: "today",
        text: "Today",
        title: "Today: " + dateToStr(today)
    });

    gantt.config.sort = true;
    gantt.config.auto_scheduling = true;
    gantt.config.auto_scheduling_strict = true;

    (function() {
        var highlightTasks = [],
            highlightSearch = {};

        function reset(value) {
            if (value) {
                if (value.join() === highlightTasks.join()) {
                    return;
                }
                highlightTasks = value;
                highlightSearch = {};
                highlightTasks.forEach(function(id) {
                    highlightSearch[id] = true;
                });
                gantt.render();
            } else if (highlightTasks.length) {
                highlightTasks = [];
                highlightSearch = {};
                gantt.render();
            }
        }

        gantt.templates.task_class = function(start, end, task) {
            if (highlightSearch[task.id])
                return "task_groups";
            return "";
        };

        gantt.attachEvent("onTaskClick", function(id) {
            var task = gantt.getTask(id);
            var group = gantt.getConnectedGroup(id);
            if (!group.tasks.length) {
                reset();
            } else {
                reset(group.tasks);
                gantt.message({
                    text: "<strong>Selected task:</strong> " + task.text +
                        "<br><strong>Connected Group:</strong><br> " +
                        group.tasks.map(function(t) {
                            return gantt.getTask(t).text
                        }).join("<br>"),
                    expire: 5000
                });
            }

            return true;
        });

        gantt.attachEvent("onEmptyClick", function() {
            reset();
            return true;
        });

    })();

    var colHeader;
    var colContent = function(task) {};
    gantt.config.columns = [{
            name: "text",
            tree: true,
            width: '*',
            resize: true
        },
        {
            name: "start_date",
            align: "center",
            resize: true
        },
        {
            name: "duration",
            align: "center"
        }
    ];

    gantt.message({
        text: "Click any task to highlight the connected group",
        expire: -1
    });

    gantt.init("gantt_here");
    gantt.load("/api/data/{{ $project->id }}");

    // var dp = new gantt.dataProcessor("/api");
    // dp.init(gantt);
    // dp.setTransactionMode("REST");
    // dp.deleteAfterConfirmation = true;

    var dp = gantt.createDataProcessor(function(entity, action, data, id) {
        var _token = $('meta[name="csrf-token"]').attr('content');
        data.parent = "{{ $project->id }}";
        switch (action) {
            case "create":
                return gantt.ajax.post({
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': _token
                    },
                    url: "/task-store",
                    data: JSON.stringify(data)
                });
                break;

            case "update":
                return gantt.ajax.put({
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': _token
                    },
                    url: "/task-update/" + id,
                    data: JSON.stringify(data)
                });
                break;

            case "delete":
                return gantt.ajax.del({
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': _token
                    },
                    url: "/task-delete/" + id,
                    data: JSON.stringify(data)
                });
                break;
        }
    });
    dp.attachEvent("onAfterUpdate", function(id, action, tid, response) {
        console.log(action);
        switch (action) {
            case "inserted":
                var parsedResponse = JSON.parse(response.responseText);
                var msg = parsedResponse.msg;
                if (parsedResponse.action == "error") {
                    gantt.message({
                        text: msg,
                        expire: -1
                    });
                } else if (parsedResponse.action == "inserted") {
                    gantt.message({
                        text: msg,
                        expire: -1
                    });
                }
                gantt.clearAll();
                gantt.load("/api/data/{{ $project->id }}");
                break;

            case "updated":
                var parsedResponse = JSON.parse(response.responseText);
                var msg = parsedResponse.msg;
                if (parsedResponse.action == "error") {
                    gantt.message({
                        text: msg,
                        expire: -1
                    });
                } else if (parsedResponse.action == "updated") {
                    gantt.message({
                        text: msg,
                        expire: -1
                    });
                }
                gantt.clearAll();
                gantt.load("/api/data/{{ $project->id }}");
                break;

            case "deleted":
                var parsedResponse = JSON.parse(response.responseText);
                var msg = parsedResponse.msg;
                if (parsedResponse.action == "error") {
                    gantt.message({
                        text: msg,
                        expire: -1
                    });
                } else if (parsedResponse.action == "deleted") {
                    gantt.message({
                        text: msg,
                        expire: -1
                    });
                }
                gantt.clearAll();
                gantt.load("/api/data/{{ $project->id }}");
                break;
        }
    });

    function limitMoveLeft(task, limit) {
        var dur = task.end_date - task.start_date;
        task.end_date = new Date(limit.end_date);
        task.start_date = new Date(+task.end_date - dur);
    }

    function limitMoveRight(task, limit) {
        var dur = task.end_date - task.start_date;
        task.start_date = new Date(limit.start_date);
        task.end_date = new Date(+task.start_date + dur);
    }

    function limitResizeLeft(task, limit) {
        task.end_date = new Date(limit.end_date);
    }

    function limitResizeRight(task, limit) {
        task.start_date = new Date(limit.start_date)
    }
    gantt.attachEvent("onTaskDrag", function(id, mode, task, original, e) {
        var parent = task.parent ? gantt.getTask(task.parent) : null,
            children = gantt.getChildren(id),
            modes = gantt.config.drag_mode;

        var limitLeft = null,
            limitRight = null;

        if (!(mode == modes.move || mode == modes.resize)) return;

        if (mode == modes.move) {
            limitLeft = limitMoveLeft;
            limitRight = limitMoveRight;
        } else if (mode == modes.resize) {
            limitLeft = limitResizeLeft;
            limitRight = limitResizeRight;
        }

        //check parents constraints
        if (parent && +parent.end_date < +task.end_date) {
            limitLeft(task, parent);
        }
        if (parent && +parent.start_date > +task.start_date) {
            limitRight(task, parent);
        }

        //check children constraints
        for (var i = 0; i < children.length; i++) {
            var child = gantt.getTask(children[i]);
            if (+task.end_date < +child.end_date) {
                limitLeft(task, child);
            } else if (+task.start_date > +child.start_date) {
                limitRight(task, child)
            }
        }


    });
    // // Gantt Size
    // var start_gantt = "{{ $ganttStartDate }}";
    // var end_gantt = "{{ $ganttEndDate }}";

    // // Project Info
    // var today = new Date('{{ $today }}');
    // var start = new Date('{{ $projectStartDateFormatted }}');
    // var end = new Date('{{ $projectEndDateFormatted }}');
</script>
