<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn-logout">Logout</button>
</form>