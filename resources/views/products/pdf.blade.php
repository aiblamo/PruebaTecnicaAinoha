<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <!-- Agrega los enlaces a los estilos de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Información del Producto</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>ID:</strong> {{ $product->id }}</p>
                <p class="card-text"><strong>Nombre:</strong> {{ $product->name }}</p>
                <p class="card-text"><strong>Descripción:</strong> {{ $product->description }}</p>
                <p class="card-text"><strong>Precio:</strong> {{ $product->price->price }}</p>
                <!-- Agrega más detalles del producto según tu modelo -->
            </div>
        </div>
    </div>

    <!-- Agrega los scripts de Bootstrap (jQuery primero, luego Popper.js y finalmente Bootstrap.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
