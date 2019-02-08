<div class="one-notif {{ $notification->read() ? "read-notification" : "unread-notification" }}">
	<div class="cause">
	    Вас пригласили на мероприятие "{{ $notification->data["event"]["title"] }}"
	</div>
</div>
