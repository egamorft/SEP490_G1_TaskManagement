{{-- user info and avatar --}}
<div class="avatar av-l chatify-d-flex" style="background-image: url('{{ Auth::user()->avatar }}');"></div>
{{-- <p class="info-name">{{ config('chatify.name') }}</p> --}}
<p class="info-name">Hello {{ Auth::user()->name }}</p>
<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">Delete Conversation</a>
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Shared Photos</span></p>
    <div class="shared-photos-list"></div>
</div>
