@csrf
<div class="mb-3">
    <label for="fecha_pedido" class="form-label">Fecha del Pedido:</label>
    <input type="text" id="fecha_pedido" name="fecha_pedido" class="form-control" value="{{ $fecha_pedido ?? '' }}" required>
</div>




<div class="mb-3">
    <label for="product_id" class="form-label">Producto a Comprar:</label>
    <span class="text-danger">@error('product_id'){{ $message }} @enderror</span>
    <select id="product_id" name="product_id" onchange="handleProductChange()" class="form-select" required>
        <option value="">Seleccione un Producto</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}" data-price="{{ $product->getLatestPriceForDate($fecha_pedido) }}"
                {{ isset($appointment) && $appointment->product_id == $product->id ? 'selected' : '' }}>
                {{ $product->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="product_price" class="form-label">Precio del Producto:</label>
    <input type="number" id="product_price" name="product_price" value="{{ $product_price ? $product_price->price : '' }}" class="form-control" readonly>
    <span id="product_price_error" class="text-danger error-message"></span> <!-- Aquí se mostrará el mensaje de error -->
</div>

<div class="mb-3">
    <label for="unidades_comprar" class="form-label">Unidades a Comprar:</label>
    <input type="number" id="unidades_comprar" name="unidades_comprar" min="1" required value="{{ $appointment->unidades_comprar ?? '' }}" onchange="calculateTotal()" class="form-control">
</div>

<div class="mb-3">
    <label for="total" class="form-label">Total:</label>
    <input type="text" id="total" name="total" value="{{ $appointment->total ?? '' }}" class="form-control" readonly>
</div>


<div class="d-flex justify-content-between align-items-center">
    <a href="{{ route('appointments.index') }}" class="text-indigo-600">Volver</a>
   
    <button type="submit" class="btn btn-primary">Enviar</button>
    
</div>





<script>
   



    function handleProductChange() {
        var product_id = document.getElementById('product_id').value;
        var selectedOption = document.querySelector('#product_id option:checked');
        var product_price = selectedOption.getAttribute('data-price');
        var product_price_input = document.getElementById('product_price');
        var product_price_error = document.getElementById('product_price_error');

        // Verificar si el producto seleccionado tiene un precio para la fecha seleccionada
        if (product_price === null || product_price === '') {
            // Mostrar el mensaje de error
            product_price_error.textContent = 'El producto seleccionado no tiene tarifa para la fecha seleccionada';
            // Limpiar el valor del precio del producto
            product_price_input.value = '';
        } else {
            // Limpiar el mensaje de error
            product_price_error.textContent = '';
            // Establecer el valor del precio del producto
            product_price_input.value = product_price;
            // Calcular el total
            calculateTotal();
        }
    }

    function calculateTotal() {
        var unidades_comprar = document.getElementById('unidades_comprar').value;
        var product_price = document.getElementById('product_price').value;

        // Calcular el total
        var total = parseFloat(unidades_comprar) * parseFloat(product_price);

        // Actualizar el campo de total
        document.getElementById('total').value = total.toFixed(2);
        console.log('Total', total);
    }
</script>
