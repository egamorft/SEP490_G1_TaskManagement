<div class="gantt_control d-flex justify-content-between">
    <div class="">
        <button onclick="updateCriticalPath(this)">Show Critical Path</button>
        <input type=button value="Zoom In" onclick="gantt.ext.zoom.zoomIn();">
        <input type=button value="Zoom Out" onclick="gantt.ext.zoom.zoomOut();">
        <input type='button' value='Create task' onclick="gantt.createTask()">
    </div>
    <div class="me-3">
        <h4 class="text-danger fw-bold"><strong><u>Your tasks & project below just give an overview of project real
                    work</u></strong>
        </h4>
    </div>
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

    //Config zoom
    var zoomConfig = {
        levels: [{
                name: "hour",
                scale_height: 27,
                min_column_width: 15,
                scales: [{
                        unit: "day",
                        format: "%d"
                    },
                    {
                        unit: "hour",
                        format: "%H"
                    },
                ]
            },
            {
                name: "day",
                scale_height: 27,
                min_column_width: 80,
                scales: [{
                    unit: "day",
                    step: 1,
                    format: "%d %M"
                }]
            },
            {
                name: "week",
                scale_height: 50,
                min_column_width: 50,
                scales: [{
                        unit: "week",
                        step: 1,
                        format: function(date) {
                            var dateToStr = gantt.date.date_to_str("%d %M");
                            var endDate = gantt.date.add(date, -6, "day");
                            var weekNum = gantt.date.date_to_str("%W")(date);
                            return "#" + weekNum + ", " + dateToStr(date) + " - " + dateToStr(endDate);
                        }
                    },
                    {
                        unit: "day",
                        step: 1,
                        format: "%j %D"
                    }
                ]
            },
            {
                name: "month",
                scale_height: 50,
                min_column_width: 120,
                scales: [{
                        unit: "month",
                        format: "%F, %Y"
                    },
                    {
                        unit: "week",
                        format: "Week #%W"
                    }
                ]
            },
            {
                name: "quarter",
                height: 50,
                min_column_width: 90,
                scales: [{
                        unit: "quarter",
                        step: 1,
                        format: function(date) {
                            var dateToStr = gantt.date.date_to_str("%M");
                            var endDate = gantt.date.add(gantt.date.add(date, 3, "month"), -1, "day");
                            return dateToStr(date) + " - " + dateToStr(endDate);
                        }
                    },
                    {
                        unit: "month",
                        step: 1,
                        format: "%M"
                    },
                ]
            },
            {
                name: "year",
                scale_height: 50,
                min_column_width: 30,
                scales: [{
                    unit: "year",
                    step: 1,
                    format: "%Y"
                }]
            }
        ],
        useKey: "ctrlKey",
        trigger: "wheel",
        element: function() {
            return gantt.$root.querySelector(".gantt_task");
        }
    };

    gantt.ext.zoom.init(zoomConfig);
    gantt.ext.zoom.setLevel("week");
    //Config zoom

    gantt.plugins({
        overlay: true,
        auto_scheduling: true,
        marker: true,
        critical_path: true
    });

    //Zoom overlay & scale
    var overlayControl = gantt.ext.overlay;

    function toggleOverlay() {
        if (overlayControl.isOverlayVisible(lineOverlay)) {
            gantt.config.readonly = false;
            overlayControl.hideOverlay(lineOverlay);
            gantt.$root.classList.remove("overlay_visible");
        } else {
            gantt.config.readonly = true;
            overlayControl.showOverlay(lineOverlay);
            gantt.$root.classList.add("overlay_visible");
        }
    }

    function getChartScaleRange() {
        var tasksRange = gantt.getSubtaskDates();
        var cells = [];
        var scale = gantt.getScale();
        if (!tasksRange.start_date) {
            return scale.trace_x;
        }

        scale.trace_x.forEach(function(date, index) {
            var within = +tasksRange.start_date <= +date && +date <= +tasksRange.end_date;
            var left = false,
                right = false;
            if (index != scale.trace_x.length - 1) {
                left = +date < +tasksRange.start_date && +tasksRange.start_date < +scale.trace_x[index + 1];
            }
            if (index > 0) {
                right = +scale.trace_x[index - 1] < +tasksRange.end_date && +tasksRange.end_date < +date;
            }

            if (within || left || right) {
                cells.push(date);
            }
        });
        return cells;
    }
    //Zoom overlay & scale

    //Critical path
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
    //Critical path

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

    //Header columns config
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
    //Header columns config

    //Msg on first run
    gantt.message({
        text: "Click any task to highlight the connected group",
        expire: -1
    });
    //Msg on first run

    gantt.init("gantt_here");
    gantt.load("/api/data/{{ $project->id }}");

    //Handle with api restful

    // var dp = new gantt.dataProcessor("/api");
    // dp.init(gantt);
    // dp.setTransactionMode("REST");
    // dp.deleteAfterConfirmation = true;

    //Handle with ajax (customizable data value)
    var dp = gantt.createDataProcessor(function(entity, action, data, id) {
        var _token = $('meta[name="csrf-token"]').attr('content');
        data.parent = "{{ $project->id }}";
        if (entity == "task") {
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
        }else if(entity == "link"){
            switch (action) {
                case "create":
                    return gantt.ajax.post({
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': _token
                        },
                        url: "/link-store",
                        data: JSON.stringify(data)
                    });
                    break;

                case "delete":
                    return gantt.ajax.del({
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': _token
                        },
                        url: "/link-delete/" + data.source + "/" + data.target,
                        data: JSON.stringify(data)
                    });
                    break;
            }
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

    //Set drag with has parent tasks
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


    // Gantt Size customizing
    // var start_gantt = "{{ $ganttStartDate }}";
    // var end_gantt = "{{ $ganttEndDate }}";

    // // Project Info
    // var today = new Date('{{ $today }}');
    // var start = new Date('{{ $projectStartDateFormatted }}');
    // var end = new Date('{{ $projectEndDateFormatted }}');
</script>
