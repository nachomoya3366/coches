<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\Http\Request;

class CocheController extends Controller
{
    public function index(Request $request)
    {
        $query = Coche::query();

        // Filtro por estado (por defecto solo mostramos stock si no se filtra)
        if ($request->has('estado')) {
            $query->whereIn('estado', (array) $request->estado);
        } else {
            $query->where('estado', 'stock');
        }

        // Filtro por Marca
        if ($request->filled('marca')) {
            $query->whereIn('marca', (array) $request->marca);
        }

        // Filtro por Precio (ajustado al 10% de margen que muestras en la vista)
        if ($request->filled('min_price')) {
            $query->whereRaw('precio_compra * 1.10 >= ?', [$request->min_price]);
        }
        if ($request->filled('max_price')) {
            $query->whereRaw('precio_compra * 1.10 <= ?', [$request->max_price]);
        }

        // Filtro por Kilometraje
        if ($request->filled('max_km')) {
            $query->where('kilometros', '<=', $request->max_km);
        }

        // Filtro por Año
        if ($request->filled('min_year')) {
            $query->where('año', '>=', $request->min_year);
        }
        if ($request->filled('max_year')) {
            $query->where('año', '<=', $request->max_year);
        }

        // Filtro por Combustible
        if ($request->filled('combustible')) {
            $query->whereIn('combustible', (array) $request->combustible);
        }

        // Filtro por Color
        if ($request->filled('color')) {
            $query->whereIn('color', (array) $request->color);
        }

        // Ordenar recientemente (default) o antigüedad
        if ($request->input('sort') === 'antiguedad') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $coches = $query->paginate(9)->withQueryString();

        // Detectamos si se ha aplicado algún filtro de búsqueda (incluyendo el estado)
        $filtrosActivos = $request->anyFilled(['marca', 'min_price', 'max_price', 'max_km', 'min_year', 'max_year', 'combustible', 'color', 'sort']) || $request->has('estado');

        return view('welcome', compact('coches', 'filtrosActivos'));
    }
}
