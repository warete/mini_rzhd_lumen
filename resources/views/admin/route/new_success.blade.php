@extends('layouts.main')

@section('title', 'Новый рейс успшено добавлен')

@section('content')
    <div class="alert alert-success">
        Новый рейс успешно добавлен. <a href="{{ route('route.buy', ['routeId' => $route->id]) }}"></a>
    </div>
@endsection
