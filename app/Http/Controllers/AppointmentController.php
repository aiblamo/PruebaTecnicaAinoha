<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Product;
use App\Models\ProductPrice;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las citas y pasarlas a la vista appointments.index
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Obtener la fecha del pedido del request
        $fecha_pedido = $request->query('fecha_pedido');
    
        // Obtener todos los productos
        $products = Product::all();
    
        // Inicializar el precio del producto como null
        $product_price = null;
    
        // Si hay una fecha de pedido especificada, obtener el precio del producto para esa fecha
        if ($fecha_pedido) {
            $product_price = ProductPrice::where('product_id', $request->product_id)
                ->whereDate('start_date', '<=', $fecha_pedido)
                ->whereDate('end_date', '>=', $fecha_pedido)
                ->first();
        }
    
        // Retornar la vista con los productos, la fecha de pedido y el precio del producto
        return view('appointments.create', compact('products', 'fecha_pedido', 'product_price'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha_pedido' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'unidades_comprar' => 'required|integer|min:1',
        ]);

        // Obtener el precio del producto para la fecha del pedido
        $product_price = ProductPrice::where('product_id', $request->product_id)
            ->whereDate('start_date', '<=', $request->fecha_pedido)
            ->whereDate('end_date', '>=', $request->fecha_pedido)
            ->first();

        // Si no se encuentra el precio del producto, redireccionar de vuelta con un mensaje de error
        if (!$product_price) {
            return redirect()->back()->withErrors(['No se encontró precio para el producto seleccionado en la fecha especificada.']);
        }

        // Calcular el costo total de la cita
        $total = $product_price->price * $request->unidades_comprar;

        // Crear una nueva cita
        $appointment = new Appointment();
        $appointment->fecha_pedido = $request->fecha_pedido;
        $appointment->product_id = $request->product_id;
        $appointment->unidades_comprar = $request->unidades_comprar;
        $appointment->total = $total;
        $appointment->save();

        // Redirigir a la página de índice de citas
        return redirect()->route('appointments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        // Mostrar los detalles de la cita
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment, Request $request)
    {
        // Obtener el ID del producto seleccionado
        $productId = $appointment->product_id;
    
        // Obtener la fecha del pedido del request
        $fecha_pedido = $appointment->fecha_pedido;
    
        $products = Product::whereHas('prices', function ($query) use ($fecha_pedido) {
            $query->whereDate('start_date', '<=', $fecha_pedido)
                ->whereDate('end_date', '>=', $fecha_pedido);
        })->get();
        // Obtener el precio del producto para la fecha del pedido
        $product_price = ProductPrice::where('product_id', $productId)
            ->whereDate('start_date', '<=', $fecha_pedido)
            ->whereDate('end_date', '>=', $fecha_pedido)
            ->first();
    
        // Retornar la vista de edición con la cita y los productos
        return view('appointments.edit', compact('appointment', 'products', 'fecha_pedido', 'product_price'));
    }
   

    
   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha_pedido' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'unidades_comprar' => 'required|integer|min:1',
        ]);

        // Obtener el ID del producto seleccionado
        $productId = $request->input('product_id');

        // Buscar el precio del producto para la fecha seleccionada
        $product_price = ProductPrice::where('product_id', $productId)
            ->whereDate('start_date', '<=', $request->fecha_pedido)
            ->whereDate('end_date', '>=', $request->fecha_pedido)
            ->first();

        // Verificar si se encontró un precio para el producto y la fecha seleccionada
        if (!$product_price) {
            return redirect()->back()->withErrors(['No hay tarifa disponible para la fecha seleccionada.']);
        }

        // Calcular el total
        $total = $product_price->price * $request->unidades_comprar;

        // Actualizar el Appointment con los datos del formulario y el total calculado
        $appointment->fecha_pedido = $request->fecha_pedido;
        $appointment->product_id = $productId;
        $appointment->unidades_comprar = $request->unidades_comprar;
        $appointment->total = $total;
        $appointment->save();

        return redirect()->route('appointments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        // Eliminar la cita
        $appointment->delete();

        // Retornar una respuesta JSON
        return response()->json(['message' => 'Cita eliminada correctamente']);
    }
}
