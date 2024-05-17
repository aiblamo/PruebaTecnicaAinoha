@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto {{ $product->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .container { margin: 20px; }
        .card { border: 1px solid #ddd; padding: 20px; margin-bottom: 20px; }
        .card-body { padding: 10px; }
        .card-text { margin-bottom: 10px; }
        .label { display: inline-block; width: 150px; vertical-align: top; font-weight: bold; }
        .value { display: inline-block; width: calc(100% - 160px); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Información del Producto</h1>
        <div class="card">
            <div class="card-body">
                <div class="card-text">
                    <span class="label">ID:</span>
                    <span class="value">{{ $product->id }}</span>
                </div>
                <div class="card-text">
                    <span class="label">Nombre:</span>
                    <span class="value">{{ $product->name }}</span>
                </div>
                <div class="card-text">
                    <span class="label">Descripción:</span>
                    <span class="value">{{ $product->description }}</span>
                </div>
                <div class="card-text">
                    <span class="label">Precios:</span>
                </div>
                @if($product->prices->isNotEmpty())
                    <table>
                        <thead>
                            <tr>
                                <th>Precio</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->prices as $price)
                                <tr>
                                    <td>{{ $price->price }}</td>
                                    <td>{{ $price->start_date ? Carbon::parse($price->start_date)->format('d/m/Y') : 'N/A' }}</td>
                                    <td>{{ $price->end_date ? Carbon::parse($price->end_date)->format('d/m/Y') : 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>N/A</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
