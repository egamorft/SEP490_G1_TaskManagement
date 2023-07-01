 <!-- Timeline Card -->
 <div class="col task-info">
 	<div class="card card-user-timeline">
 		<div class="card-header">
 			<div class="d-flex align-items-center">
 				<h4 class="card-title">Task Information</h4>
 			</div>
 		</div>
 		<div class="card-body">

 			<div class="mt-0">
 				<div class="avatar float-start bg-light-primary rounded me-1">
 					<div class="avatar-content">
 						<i data-feather="fast-forward" class="avatar-icon font-medium-3"></i>
 					</div>
 				</div>
 				<div class="more-info">
 					<h6 class="mb-0 text-primary">Doing</h6>
 					<small>The project is in progress</small>
 				</div>
 			</div>

 			<div class="mt-2">
 				<div class="avatar float-start bg-success rounded me-1">
 					<div class="avatar-content">
 						<i data-feather="user-check" class="avatar-icon font-medium-3"></i>
 					</div>
 				</div>
 				<div class="more-info">
 					<h6 class="mb-0 text-success">Completed</h6>
 					<small>The project is marked as complete</small>
 				</div>
 			</div>

 			<div class="mt-2">
 				<div class="avatar float-start bg-danger rounded me-1">
 					<div class="avatar-content">
 						<i data-feather="user-x" class="avatar-icon font-medium-3"></i>
 					</div>
 				</div>
 				<div class="more-info">
 					<h6 class="mb-0 text-danger">Rejected</h6>
 					<small>The project has been rejected: Sai định hướng, trượt deadline ...</small>
 				</div>
 			</div>

 			<hr />

 			<div class="mt-2">
 				<div class="avatar float-start bg-light-primary rounded me-1">
 					<div class="avatar-content">
 						<i data-feather="activity" class="avatar-icon font-medium-3"></i>
 					</div>
 				</div>
 				<div class="more-info">
 					<p class="mb-50">Duration: 90%</p>
 					<div class="progress progress-bar-success" style="height: 6px">
 						<div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90" aria-valuemax="100" style="width: 90%"></div>
 					</div>
 				</div>
 			</div>

 			<div class="mt-2">
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

 			<hr />
 			<div class="mt-2">
 				<div class="avatar float-start bg-white rounded me-1">
 					<div class="avatar bg-light-danger">
 						<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar" width="33" height="33" />
 					</div>
 				</div>
 				<div class="more-info">
 					<small>Project Manager</small>
 					<h6 class="mb-0">Tran Ngoc Hieu</h6>
 				</div>
 			</div>
 			<div class="mt-2">
 				<div class="avatar float-start bg-white rounded me-1">
 					<div class="avatar bg-light-danger">
 						<img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" alt="Avatar" width="33" height="33" />
 					</div>
 				</div>
 				<div class="more-info">
 					<small>Project Supervisor</small>
 					<h6 class="mb-0">Tran Ngoc Hieu</h6>
 				</div>
 			</div>
 			<div class="mt-1 pl-5">
 				<div class="more-info">
 					<small>Other Members</small>
 				</div>
 				<div class="avatar-group">
 					<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Billy Hopkins" class="avatar pull-up">
 						<img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" alt="Avatar" width="33" height="33" />
 					</div>
 					<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Amy Carson" class="avatar pull-up">
 						<img src="{{ asset('images/portrait/small/avatar-s-6.jpg') }}" alt="Avatar" width="33" height="33" />
 					</div>
 					<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Brandon Miles" class="avatar pull-up">
 						<img src="{{ asset('images/portrait/small/avatar-s-8.jpg') }}" alt="Avatar" width="33" height="33" />
 					</div>
 					<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Daisy Weber" class="avatar pull-up">
 						<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar" width="33" height="33" />
 					</div>
 					<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Jenny Looper" class="avatar pull-up">
 						<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar" width="33" height="33" />
 					</div>
 					<h6 class="align-self-center cursor-pointer ms-50 mb-0">+2</h6>
 				</div>
 			</div>
 			<hr />

 			<div class="mt-2">
 				<div class="avatar float-start bg-light-primary rounded me-1">
 					<div class="avatar-content">
 						<i data-feather="file-text" class="avatar-icon font-medium-3"></i>
 					</div>
 				</div>
 				<div class="more-info">
 					<h6 class="mb-0">Description</h6>
 					<small>FTask là dự án quản lý Task dành cho sinh viên chuyên ngành SE giúp cho sinh viên quản lý, theo dõi, ....</small>
 				</div>
 			</div>

 			<hr />

 			<div class="mt-2">
 				<!-- User Chat messages -->
 				<div class="user-chats">
 					<div class="chats">
 						<div class="chat">
 							<div class="chat-avatar">
 								<span class="avatar box-shadow-1 cursor-pointer">
 									<img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="36" width="36" />
 								</span>
 							</div>
 							<div class="chat-body">
 								<div class="chat-content">
 									<p>How can we help? We're here for you! 😄</p>
 								</div>
 							</div>
 						</div>
 						<div class="chat chat-left">
 							<div class="chat-avatar">
 								<span class="avatar box-shadow-1 cursor-pointer">
 									<img src="{{asset('images/portrait/small/avatar-s-7.jpg')}}" alt="avatar" height="36" width="36" />
 								</span>
 							</div>
 							<div class="chat-body">
 								<div class="chat-content">
 									<p>Hey John, I am looking for the best admin template.</p>
 									<p>Could you please help me to find it out? 🤔</p>
 								</div>
 								<div class="chat-content">
 									<p>It should be Bootstrap 4 compatible.</p>
 								</div>
 							</div>
 						</div>
 						<div class="divider">
 							<div class="divider-text">Yesterday</div>
 						</div>
 						<div class="chat">
 							<div class="chat-avatar">
 								<span class="avatar box-shadow-1 cursor-pointer">
 									<img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="36" width="36" />
 								</span>
 							</div>
 							<div class="chat-body">
 								<div class="chat-content">
 									<p>Absolutely!</p>
 								</div>
 								<div class="chat-content">
 									<p>Vuexy admin is the responsive bootstrap 4 admin template.</p>
 								</div>
 							</div>
 						</div>
 						<div class="chat chat-left">
 							<div class="chat-avatar">
 								<span class="avatar box-shadow-1 cursor-pointer">
 									<img src="{{asset('images/portrait/small/avatar-s-7.jpg')}}" alt="avatar" height="36" width="36" />
 								</span>
 							</div>
 							<div class="chat-body">
 								<div class="chat-content">
 									<p>Looks clean and fresh UI. 😃</p>
 								</div>
 								<div class="chat-content">
 									<p>It's perfect for my next project.</p>
 								</div>
 								<div class="chat-content">
 									<p>How can I purchase it?</p>
 								</div>
 							</div>
 						</div>
 						<div class="chat">
 							<div class="chat-avatar">
 								<span class="avatar box-shadow-1 cursor-pointer">
 									<img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="36" width="36" />
 								</span>
 							</div>
 							<div class="chat-body">
 								<div class="chat-content">
 									<p>Thanks, from ThemeForest.</p>
 								</div>
 							</div>
 						</div>
 						<div class="chat chat-left">
 							<div class="chat-avatar">
 								<span class="avatar box-shadow-1 cursor-pointer">
 									<img src="{{asset('images/portrait/small/avatar-s-7.jpg')}}" alt="avatar" height="36" width="36" />
 								</span>
 							</div>
 							<div class="chat-body">
 								<div class="chat-content">
 									<p>I will purchase it for sure. 👍</p>
 								</div>
 								<div class="chat-content">
 									<p>Thanks.</p>
 								</div>
 							</div>
 						</div>
 						<div class="chat">
 							<div class="chat-avatar">
 								<span class="avatar box-shadow-1 cursor-pointer">
 									<img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="36" width="36" />
 								</span>
 							</div>
 							<div class="chat-body">
 								<div class="chat-content">
 									<p>Great, Feel free to get in touch on</p>
 								</div>
 								<div class="chat-content">
 									<p>https://pixinvent.ticksy.com/</p>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 				<!-- User Chat messages -->
 				<!-- Submit Chat form -->
 				<form class="chat-app-form" action="javascript:void(0);" onsubmit="enterChat();">
 					<div class="input-group input-group-merge me-1 form-send-message">
 						<span class="speech-to-text input-group-text"><i data-feather="mic" class="cursor-pointer"></i></span>
 						<input type="text" class="form-control message" placeholder="Type your message or use speech to text" />
 						<span class="input-group-text">
 							<label for="attach-doc" class="attachment-icon form-label mb-0">
 								<i data-feather="image" class="cursor-pointer text-secondary"></i>
 								<input type="file" id="attach-doc" hidden /> </label></span>
 					</div>
 					<button type="button" class="btn btn-primary send" onclick="enterChat();">
 						<i data-feather="send" class="d-lg-none"></i>
 						<span class="d-none d-lg-block">Send</span>
 					</button>
 				</form>
 				<!--/ Submit Chat form -->
 			</div>
 		</div>
 	</div>
 </div>
 <!--/ Timeline Card -->