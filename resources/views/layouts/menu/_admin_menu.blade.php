<ul class="nav navbar-nav">
    @if (Auth::user()->is_admin)
        <li><a href="{{ url('admin/stats') }}">Stats</a></li>
        <li><a href="{{ url('admin/posts') }}">Posts</a></li>
        <li><a href="{{ url('admin/categories') }}">Categories</a></li>
        <li><a href="{{ url('admin/comments') }}">Comments</a></li>
        <li><a href="{{ url('admin/tags') }}">Tags</a></li>
        <li><a href="{{ url('admin/users') }}">Users</a></li>
    @endif
</ul>
