<ul class="nav navbar-nav">
    @if (!Auth::user()->is_admin)
        <li><a href="{{ url('stats') }}">Stats</a></li>
        <li><a href="{{ url('admin/posts') }}">Posts</a></li>
    @endif
</ul>
