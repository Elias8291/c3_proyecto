@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Notificaciones</h1>
    <ul class="list-group">
        @forelse ($notificaciones as $notificacion)
        <li class="list-group-item {{ $notificacion->read_at ? '' : 'font-weight-bold' }}">
            {{ $notificacion->data['mensaje'] }}
            <small class="text-muted d-block">{{ $notificacion->created_at->diffForHumans() }}</small>
            @if(!$notificacion->read_at)
            <a href="{{ route('notificaciones.marcarComoLeida', $notificacion->id) }}" class="btn btn-sm btn-primary">Marcar como leída</a>
            @endif
        </li>
        @empty
        <p>No tienes notificaciones.</p>
        @endforelse
    </ul>
</div>
@endsection
