<!-- Full calendar start -->
<section>
	<div class="app-calendar overflow-hidden border" id="section-block">
	  <div class="row g-0">
		@include('task.filter')

		<!-- Calendar -->
		<div class="col position-relative">
		  <div class="card shadow-none border-0 mb-0 rounded-0">
			<div class="card-body pb-0">
				<input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
			  <div id="calendar"></div>
			</div>
		  </div>
		</div>
		<!-- /Calendar -->
		<div class="body-content-overlay"></div>
	  </div>
	</div>

  </section>
  <!-- Full calendar end -->