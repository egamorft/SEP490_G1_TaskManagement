<!-- Full calendar start -->
<section>
	<div class="app-calendar overflow-hidden border">
	  <div class="row g-0">
		@include('task.filter')

		<!-- Calendar -->
		<div class="col position-relative">
		  <div class="card shadow-none border-0 mb-0 rounded-0">
			<div class="card-body pb-0">
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