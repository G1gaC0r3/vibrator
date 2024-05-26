<link rel="stylesheet" href="{{asset('css/style.css')}}">
<form id="logout-form" method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn-logout">Logout</button>
</form>
<script>
    document.getElementById('logout-form').onsubmit = function(event) {
        event.preventDefault();
        axios.post('{{ route('logout') }}').then(function () {
            window.location.href = '{{ url('welcome.blade.php') }}'; 
        }).catch(function (error) {
            console.error('Logout failed:', error);
        });
    };
</script>
