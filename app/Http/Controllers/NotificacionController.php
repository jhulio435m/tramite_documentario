<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;

class NotificacionController extends Controller
{
    // Mostrar lista de notificaciones listas para entrega
    public function entregaLista()
    {
        $notificaciones = Notificacion::where('estado', 'Lista para entrega')->get();
        return view('mesadepartes-entrega-lista', compact('notificaciones'));
    }
    // HU01: Guardar una solicitud de notificación
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tramite_id' => 'required',
            'fecha_solicitud' => 'required|date',
            'documento' => 'required',
            'tipo' => 'required',
            'destinatario_nombre' => 'required',
            'destinatario_direccion' => 'required',
            'destinatario_contacto' => 'required|email',
            'funcionario' => 'required',
        ]);

        Notificacion::create([
            ...$validated,
            'estado' => 'Pendiente',
        ]);

        return redirect()->back()->with('success', 'La solicitud ha sido enviada correctamente.');
    }

    // HU02: Mostrar la bandeja de notificaciones
    public function bandeja()
    {
        $pendientes = Notificacion::where('estado', 'Pendiente')->get();
        $finalizadas = Notificacion::where('estado', 'Finalizado')->get();

        return view('mesadepartes-bandeja', compact('pendientes', 'finalizadas'));
    }

    public function elaborar($id)
    {
        $notificacion = Notificacion::findOrFail($id); // Busca por ID o lanza error 404
        return view('mesadepartes-elaboracion', compact('notificacion'));
    }

    public function finalizar(Request $request, $id)
    {
        $notificacion = Notificacion::findOrFail($id);
        if ($notificacion->estado !== 'Pendiente') {
            return redirect()->back()->with('error', 'La notificación ya fue finalizada.');
        }

        $request->validate([
            'mensaje' => 'required|string',
            'archivo' => 'nullable|file|mimes:pdf|max:5120', // 5MB máximo, ahora opcional
        ]);

        // Guardar archivo PDF si se adjunta
        $archivoPath = null;
        if ($request->hasFile('archivo')) {
            $archivoPath = $request->file('archivo')->store('notificaciones', 'public');
        }

        // Guardar mensaje y archivo en la notificación
        $notificacion->mensaje = $request->input('mensaje');
        $notificacion->archivo = $archivoPath;
        $notificacion->estado = 'Lista para entrega';
        $notificacion->save();

        return redirect()->route('notificaciones.mesadepartes.bandeja')->with('success', '✅ Notificación finalizada correctamente.');
    }

    // HU04: Entregar notificación
    public function entregar($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        if ($notificacion->estado !== 'Lista para entrega') {
            return redirect()->back()->with('error', 'Solo se pueden entregar notificaciones que estén listas para entrega.');
        }
        $notificacion->estado = 'Finalizado';
        $notificacion->save();
        // Aquí puedes agregar lógica para enviar correo o notificación al usuario
        return redirect()->route('notificaciones.mesadepartes.bandeja')->with('success', '✅ Notificación entregada y finalizada con éxito.');
    }
public function vistaArchivo(Request $request)
{
    $expedientesActivos = Notificacion::where('estado', 'Finalizado')->get();

    $query = Notificacion::where('estado', 'Archivado');

    // Filtros
    if ($request->filled('buscar')) {
        $query->where('numero_expediente', 'like', '%' . $request->buscar . '%');
    }
    if ($request->filled('fecha')) {
        $query->whereDate('fecha_archivo', '=', $request->fecha);
    }

    $expedientesArchivados = $query->get();

    return view('mesadepartes-archivar', compact('expedientesActivos', 'expedientesArchivados'));
}
public function archivar($id)
{
    $notificacion = Notificacion::findOrFail($id);

    $notificacion->update([
        'estado'        => 'Archivado',
        'fecha_archivo' => now(),
        'archivado_por' => auth()->user()->name ?? 'Operador',
    ]);

    return back()->with('success', '📁 Notificación archivada correctamente.');
    if ($notificacion->estado !== 'Finalizado') {
    return back()->with('error', 'Solo se pueden archivar notificaciones finalizadas.');
}
}
}
