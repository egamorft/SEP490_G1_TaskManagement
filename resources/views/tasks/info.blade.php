 <!-- Timeline Card -->
 <div class="col task-info bg-white">
     <div class="card card-user-timeline">
         <div class="card-header mb-0">
             <div class="d-flex align-items-center">
                 <small>Task Detail</small>
             </div>
             <div class="d-flex align-items-center">
                 <div class="file-actions">
                     <div class="dropdown d-inline-block">
                         <i class="font-medium-2 cursor-pointer" data-feather="more-vertical" role="button"
                             id="fileActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         </i>
                         <div class="dropdown-menu dropdown-menu-end" aria-labelledby="fileActions">
                             <a class="dropdown-item" href="#">
                                 <i data-feather="edit" class="cursor-pointer me-50"></i>
                                 <span class="align-middle">Edit</span>
                             </a>
                             <a class="dropdown-item" href="#">
                                 <i data-feather="trash" class="cursor-pointer me-50"></i>
                                 <span class="align-middle">Remove</span>
                             </a>
                         </div>
                     </div>
                     <a class="text-dark" href="/projects/{{ $project->slug }}">
                         <i data-feather="x-circle"
                             class="font-medium-2 cursor-pointer d-sm-inline-block d-none me-50"></i>
                     </a>
                 </div>
             </div>
         </div>
         <div class="card-body mt-0">
             <div class="mt-0">
                 <div class="more-info">
                     <h4 class="card-title">Send PPT with real-time reports</h4>
                 </div>
             </div>
             <div class="mt-0">
                 <div class="more-info">
                     <h6 class="mb-0 text-primary">Doing - Project: {{ $project->name }}</h6>
                     <h6 class="mt-1">From Sat, May 25, 2020 - To Sat, May 25, 2020</h6>
                 </div>
             </div>

             <hr />

			 <div class="row">
				 <div class=" col">
					 <div class="avatar float-start bg-warning rounded me-1">
						 <div class="avatar-content">
							 <i data-feather="square" class="avatar-icon font-medium-3"></i>
						 </div>
					 </div>
					 <div class="more-info">
						 <h6 class="mb-0 text-warning">Waiting for Review</h6>
						 <small>Click to change for Reviewer</small>
					 </div>
				 </div>
				 <div class=" col border-right">
					<div class="avatar float-start bg-white rounded me-1">
						<div class="avatar bg-light-danger">
							<img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar" width="33"
								height="33" />
						</div>
					</div>
					<div class="more-info">
						<small>Assignee</small>
						<h6 class="mb-0">Tran Ngoc Hieu</h6>
					</div>
				</div>
				<div class=" col">
					<div class="avatar float-start bg-success rounded me-1">
						<div class="avatar-content">
							<i data-feather="square" class="avatar-icon font-medium-3"></i>
						</div>
					</div>
					<div class="more-info">
						<h6 class="mb-0 text-success">Done</h6>
						<small>Click to mark as done</small>
					</div>
				</div>
				<div class=" col">
					<div class="avatar float-start bg-white rounded me-1">
						<div class="avatar bg-light-danger">
							<img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" alt="Avatar" width="33"
								height="33" />
						</div>
					</div>
					<div class="more-info">
						<small>Reviewer</small>
						<h6 class="mb-0">Tran Ngoc Hieu</h6>
					</div>
				</div>
			 </div>

             <hr />

             <div class="mt-2">
                 <div class="more-info">
                     <h6 class="mb-2">Task Description</h6>
                     <small>FTask là dự án quản lý Task dành cho sinh viên chuyên ngành SE giúp cho sinh viên quản lý,
                         theo dõi, ....</small>
                 </div>
             </div>

             <hr />

			 <div class="mt-2">
				<div class="more-info">
					<h6 class="mb-2">Task Result</h6>
					<small>FTask là dự án quản lý Task dành cho sinh viên chuyên ngành SE giúp cho sinh viên quản lý,
						theo dõi, ....</small>
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
                                     <img src="{{ asset('images/portrait/small/avatar-s-11.jpg') }}" alt="avatar"
                                         height="36" width="36" />
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
                                     <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" alt="avatar"
                                         height="36" width="36" />
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
                                     <img src="{{ asset('images/portrait/small/avatar-s-11.jpg') }}" alt="avatar"
                                         height="36" width="36" />
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
                                     <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" alt="avatar"
                                         height="36" width="36" />
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
                                     <img src="{{ asset('images/portrait/small/avatar-s-11.jpg') }}" alt="avatar"
                                         height="36" width="36" />
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
                                     <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" alt="avatar"
                                         height="36" width="36" />
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
                                     <img src="{{ asset('images/portrait/small/avatar-s-11.jpg') }}" alt="avatar"
                                         height="36" width="36" />
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
                         <span class="speech-to-text input-group-text"><i data-feather="mic"
                                 class="cursor-pointer"></i></span>
                         <input type="text" class="form-control message"
                             placeholder="Type your message or use speech to text" />
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
