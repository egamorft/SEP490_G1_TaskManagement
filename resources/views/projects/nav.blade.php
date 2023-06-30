<ul class="nav nav-pills mb-2">
	<!-- Task List -->
	<li class="nav-item">
	  <a class="nav-link {{ $page == '' ? 'active' : ''}}" href="/projects/{{ $project->slug }}">
		<i data-feather="list" class="font-medium-3 me-50"></i>
		<span class="fw-bold">Task List</span>
	  </a>
	</li>
	<!-- Gantt -->
	<li class="nav-item">
	  <a class="nav-link {{ $page == 'gantt' ? 'active' : ''}}" href="/projects/{{ $project->slug }}/gantt">
		<i data-feather="trending-up" class="font-medium-3 me-50"></i> 
		<span class="fw-bold">Gantt</span>
	  </a>
	</li>
	<!-- Calendar -->
	<li class="nav-item">
	  <a class="nav-link {{ $page == 'calendar' ? 'active' : ''}}" href="/projects/{{ $project->slug }}/calendar">
		<i data-feather="calendar" class="font-medium-3 me-50"></i>
		<span class="fw-bold">Calendar</span>
	  </a>
	</li>
	<!-- Kanban -->
	<li class="nav-item">
	  <a class="nav-link {{ $page == 'kanban' ? 'active' : ''}}" href="/projects/{{ $project->slug }}/kanban">
		<i data-feather="columns" class="font-medium-3 me-50"></i>
		<span class="fw-bold">Kanban</span>
	  </a>
	</li>
	<!-- Report -->
	<li class="nav-item">
	  <a class="nav-link {{ $page == 'report' ? 'active' : ''}}" href="/projects/{{ $project->slug }}/report">
		<i data-feather="pie-chart" class="font-medium-3 me-50"></i>
		<span class="fw-bold">Report</span>
	  </a>
	</li>
	<!-- Settings -->
	<li class="nav-item">
	  <a class="nav-link {{ $page == 'settings' ? 'active' : ''}}" href="/projects/{{ $project->slug }}/settings">
		<i data-feather="settings" class="font-medium-3 me-50"></i>
		<span class="fw-bold">Settings</span>
	  </a>
	</li>
  </ul>