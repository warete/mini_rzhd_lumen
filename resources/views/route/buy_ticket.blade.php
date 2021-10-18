@extends('layouts.main')

@section('title', 'Покупка билета на рейс #'.$route->id)

@section('content')
    @if($isFormSubmitted)
        @if ($hasErrors)
            <div class="alert alert-danger">
                Произошла ошибка. Проверьте правильность указанных данных и попробуйте еще раз
            </div>
        @else
            <div class="alert alert-success">
                Билеты успешно приобретены
            </div>
        @endif
    @endif
    @if($route->trains_sum_max_seats_cnt - $route->tickets->count() == 0)
        Места на данный маршрут закончились
    @elseif(!$canBuy)
        К сожалению, покупка билета на данный маршрут сейчас недоступна
    @else
        <form action="" method="POST">
            <div class="form-group row">
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
            </div>
            <div class="form-group row">
                <label class="col-3">Пассажир</label>
                <div class="col">
                    <input type="text" class="form-control" readonly value="{{ auth()->user()->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3">Стоимость билета</label>
                <div class="col">
                    <input type="text" class="form-control" readonly value="{{ $route->price }} руб.">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3">Количество мест</label>
                <div class="col">
                    <input type="number" name="cnt" class="form-control" value="1" min="1">
                </div>
            </div>
            <div class="col-3">
                <button class="btn btn-block btn-info">Купить</button>
            </div>
        </form>
    @endif
@endsection
