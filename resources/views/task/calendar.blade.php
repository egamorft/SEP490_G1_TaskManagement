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
	<!-- Calendar task details Popup starts -->
    <div class="modal update-item-sidebar fade" id="modalCalendarTask" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-3 pt-50 task-wrapper">
                    Loading ... 
                </div>
            </div>
        </div>
    </div>
    <!-- Calendar task details Popup ends -->

  </section>
  <!-- Full calendar end -->