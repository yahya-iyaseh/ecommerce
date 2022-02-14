<li class="nav-item dropdown">
  <a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span class="badge badge-warning navbar-badge">{{ $unread }}</span>
  </a>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-header">{{ $notifications->count() }} Notifications</span>
    @if ($notifications->count() > 0)
      @foreach ($notifications as $notification)
        <div class="dropdown-divider"></div>
        <a href="{{ route('notifications.read', $notification->id)}}" class="dropdown-item">
          <i class="fas {{ $notification->read() ? 'fa-envelope-open' : 'fa-envelope' }} mr-2"></i> {{ $notification->data['title'] }}
          <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans(null, false, true) }}</span>
        </a>
      @endforeach

    @else

    @endif
    <div class="dropdown-divider"></div>
    <a href="{{ route('notifications') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
  </div>
</li>
