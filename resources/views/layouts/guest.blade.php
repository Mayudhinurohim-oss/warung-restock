<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Restock Warung</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
style="
background: linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)),
url('{{ asset('image/background.jpeg') }}');
background-size: cover;
background-position: center;
background-repeat: no-repeat;
background-attachment: fixed;
min-height:100vh;
">

        <div class="container-fluid">

        @yield('content')

    </div>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <script>
document.addEventListener('DOMContentLoaded', function () {

    const password = document.getElementById('password');
    const showPassword = document.getElementById('showPassword');

    if (password && showPassword) {
        showPassword.addEventListener('change', function () {
            password.type = this.checked ? 'text' : 'password';
        });
    }

});
</script>

</body>
</html>