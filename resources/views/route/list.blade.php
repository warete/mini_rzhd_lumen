@extends('layouts.main')

@section('title', 'Поиск билетов')

@section('content')
    <form action="{{ route('main') }}" class="mb-3">
        <input type="hidden" name="q" value="y">
        <div class="row">
            <div class="col">
                <select name="station_from" id="station_from" class="form-control" required>
                    <option value="" disabled selected>Откуда</option>
                    @foreach($stations as $station)
                        <option value="{{ $station->id }}"{{ $searchValues['station_from'] == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="station_to" id="station_to" class="form-control" required>
                    <option value="" disabled selected>Куда</option>
                    @foreach($stations as $station)
                        <option value="{{ $station->id }}"{{ $searchValues['station_to'] == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input
                    type="date"
                    name="date_start"
                    class="form-control"
                    placeholder="Дата отправления"
                    value="{{ $searchValues['date_start'] }}"
                    required>
            </div>
            <div class="col">
                <input
                    type="date"
                    name="date_end"
                    class="form-control"
                    placeholder="Дата прибытия"
                    value="{{ $searchValues['date_end'] }}"
                    required>
            </div>
            <div class="col">
                <button class="btn btn-block btn-primary">Найти</button>
            </div>
        </div>
    </form>
    @forelse ($routes as $route)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h3>Рейс №{{ $route->id }}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <strong>{{ $route->stationFrom->name }}</strong>
                        <br>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                            <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                            <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>
                        {{ $route->date_start }}
                    </div>
                    <div class="col">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="40" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </div>
                    <div class="col">
                        <strong>{{ $route->stationTo->name }}</strong>
                        <br>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                            <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                            <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>
                        {{ $route->date_end }}
                    </div>
                    <div class="col-3">
                        Свободно мест <span class="{{ $route->trains_sum_max_seats_cnt - $route->tickets->count() ? 'text-success' : 'text-danger' }}">
                            <strong>{{ $route->trains_sum_max_seats_cnt - $route->tickets->count() }}</strong> из <strong>{{ $route->trains_sum_max_seats_cnt }}</strong>
                        </span>
                    </div>
                    <div class="col">
                        @if($route->trains_sum_max_seats_cnt - $route->tickets->count())
                            <a href="{{ route('route.buy', ['routeId' => $route->id], false) }}" class="btn btn-primary flex-right">Купить билет</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        @if($isSearchStart)
            <h3>Нет рейсов с указанными параметрами</h3>
        @else
            <h3>Выберите параметры для поиска рейсов</h3>
        @endif
    @endforelse
@endsection
