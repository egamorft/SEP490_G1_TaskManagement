 <!-- Timeline Card -->
 <div class="">
     <div class="card card-user-timeline">
         <div class="card-header">
             <div class="d-flex align-items-center">
                 <i data-feather="trello" class="user-timeline-title-icon"></i>
                 <h4 class="card-title">Project Information</h4>
             </div>
         </div>
         <div class="card-body">
             
			 <div class="mt-0">
				<div class="avatar float-start bg-light-primary rounded me-1">
					<div class="avatar-content">
						<i data-feather="calendar" class="avatar-icon font-medium-3"></i>
					</div>
				</div>
				<div class="more-info">
					<small>From Sat, May 25, 2020</small>
					<h6 class="mb-0">To Sat, May 25, 2020</h6>
				</div>
			</div>
             <div class="mt-2">
                 <div class="avatar float-start bg-light-primary rounded me-1">
                     <div class="avatar-content">
                         <i data-feather="map-pin" class="avatar-icon font-medium-3"></i>
                     </div>
                 </div>
                 <div class="more-info">
                     <h6 class="mb-0">Central Park</h6>
                     <small>Manhattan, New york City</small>
                 </div>
             </div>
			 <div class="mt-2">
				<div class="avatar float-start bg-light-primary rounded me-1">
				   <div class="avatar bg-light-danger">
					   <div class="avatar-content">LO</div>
				   </div>
				</div>
				<div class="more-info">
					<small>Project Manager</small>
					<h6 class="mb-0">Tran Ngoc Hieu</h6>
				</div>
			</div>
			<div class="mt-1 pl-5">
				<div class="more-info">
					<small>Other Members</small>
				</div>
				<div class="avatar-group">
					<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom"
						title="Billy Hopkins" class="avatar pull-up">
						<img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" alt="Avatar" width="33"
							height="33" />
					</div>
					<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Amy Carson"
						class="avatar pull-up">
						<img src="{{ asset('images/portrait/small/avatar-s-6.jpg') }}" alt="Avatar" width="33"
							height="33" />
					</div>
					<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom"
						title="Brandon Miles" class="avatar pull-up">
						<img src="{{ asset('images/portrait/small/avatar-s-8.jpg') }}" alt="Avatar" width="33"
							height="33" />
					</div>
					<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom"
						title="Daisy Weber" class="avatar pull-up">
						<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar" width="33"
							height="33" />
					</div>
					<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom"
						title="Jenny Looper" class="avatar pull-up">
						<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar" width="33"
							height="33" />
					</div>
					<h6 class="align-self-center cursor-pointer ms-50 mb-0">+2</h6>
				</div>
			</div>
             <div class="">
                 <p class="mb-50">Duration: 1yr</p>
                 <div class="progress progress-bar-success" style="height: 6px">
                     <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90"
                         aria-valuemax="100" style="width: 90%"></div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!--/ Timeline Card -->

 <!-- Goal Overview Card -->
 <div class="">
     <div class="card">
         <div class="card-header d-flex justify-content-between align-items-center">
             <h4 class="card-title">Goal Overview</h4>
             <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
         </div>
         <div class="card-body p-0">
             <div id="goal-overview-radial-bar-chart" class="my-2"></div>
             <div class="row border-top text-center mx-0">
                 <div class="col-6 border-end py-1">
                     <p class="card-text text-muted mb-0">Completed</p>
                     <h3 class="fw-bolder mb-0">786,617</h3>
                 </div>
                 <div class="col-6 py-1">
                     <p class="card-text text-muted mb-0">In Progress</p>
                     <h3 class="fw-bolder mb-0">13,561</h3>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!--/ Goal Overview Card -->
