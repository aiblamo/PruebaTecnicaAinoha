<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba Tecnica</title>

    <!-- Incluye el archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container px-4 mx-auto">
        <header class="d-flex justify-content-between align-items-center py-4">
            <div class="d-flex align-items-center gap-4">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid" style="height: 3rem;">
                </a>
                <form action="{{ route('home') }}" method="GET" class="flex-grow">
                    <input type="text" name="search" placeholder="Buscar" value="{{ request('search') }}"
                    class="form-control">
                </form>
            </div>

            @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
        
            @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>  
            @endauth

        </header>

        


        @yield('content')

    </div>

    <!-- Incluye el archivo JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
