{{-- <!-- Main chat area -->
<section class="chat-app-window">
  <!-- To load Conversation -->
  <div class="start-chat-area d-none">
    <div class="mb-1 start-chat-icon">
      <i data-feather="message-square"></i>
    </div>
    <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
  </div>
  <!--/ To load Conversation -->

  <!-- Active Chat -->
  <div class="active-chat d-block">
    <!-- User Chat messages -->
    <div class="user-chats">
      <div class="chats">
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
        <div class="chat">
          <div class="chat-avatar">
            <span class="avatar box-shadow-1 cursor-pointer">
              <img
                src="{{asset('images/portrait/small/avatar-s-11.jpg')}}"
                alt="avatar"
                height="36"
                width="36"
              />
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
              <img
                src="{{asset('images/portrait/small/avatar-s-11.jpg')}}"
                alt="avatar"
                height="36"
                width="36"
              />
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
              <img
                src="{{asset('images/portrait/small/avatar-s-11.jpg')}}"
                alt="avatar"
                height="36"
                width="36"
              />
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
    <form class="chat-app-form row" action="javascript:void(0);" onsubmit="enterChat();">
      <div class="col input-group input-group-merge me-1 form-send-message">
        <span class="speech-to-text input-group-text"><i data-feather="mic" class="cursor-pointer"></i></span>
        <input type="text" class="form-control message" placeholder="Type your message or use speech to text" />
        <span class="input-group-text">
          <label for="attach-doc" class="attachment-icon form-label mb-0">
            <i data-feather="image" class="cursor-pointer text-secondary"></i>
            <input type="file" id="attach-doc" hidden /> </label
        ></span>
      </div>
      <button type="button" class="col-2 btn btn-primary send" onclick="enterChat();">
        <i data-feather="send" class="d-lg-none"></i>
        <span class="d-none d-lg-block">Send</span>
      </button>
    </form>
    <!--/ Submit Chat form -->
  </div>
  <!--/ Active Chat -->
</section>
<!--/ Main chat area --> --}}