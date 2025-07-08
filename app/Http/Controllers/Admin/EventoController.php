<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::orderBy('fecha_evento', 'desc')->paginate(10);
        return view('admin.eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('admin.eventos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_evento' => 'required|date',
            'hora_evento' => 'nullable',
        ]);

        Evento::create($request->all());

        return redirect()->route('admin.eventos.index')->with('success', 'Evento creado correctamente.');
    }

    public function edit(Evento $evento)
    {
        return view('admin.eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_evento' => 'required|date',
            'hora_evento' => 'nullable',
        ]);

        $evento->update($request->all());

        return redirect()->route('admin.eventos.index')->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Evento $evento)
    {
        $evento->delete();

        return redirect()->route('admin.eventos.index')->with('success', 'Evento eliminado correctamente.');
    }
}
