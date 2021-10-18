@extends('layouts.main')

@section('title', 'Новый рейс')

@section('content')
    <form action="" method="POST">
        @if ($hasErrors)
            <div class="form-group row">
                <div class="alert alert-danger">
                    Произошла ошибка. Проверьте введенные данные и попробуйте позже
                </div>
            </div>
        @endif
        <div class="form-group row">
            <div class="col-3"><label class="col-3">Откуда</label></div>
            <div class="col">
                <select name="station_from" class="form-control" required>
                    @foreach($stations as $station)
                        <option value="{{ $station->id }}">{{ $station->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-3"><label class="col-3">Куда</label></div>
            <div class="col">
                <select name="station_to" class="form-control" required>
                    @foreach($stations as $station)
                        <option value="{{ $station->id }}">{{ $station->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-3"><label class="col-3">Дата отправления</label></div>
            <div class="col">
                <input
                    type="datetime-local"
                    name="date_start"
                    class="form-control"
                    placeholder="Дата отправления"
                    value=""
                    required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-3"><label class="col-3">Дата прибытия</label></div>
            <div class="col">
                <input
                    type="datetime-local"
                    name="date_end"
                    class="form-control"
                    placeholder="Дата прибытия"
                    value=""
                    required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-3"><label class="col-3">Стоимость билета</label></div>
            <div class="col">
                <input
                    type="text"
                    name="price"
                    class="form-control"
                    placeholder="Стоимость билета"
                    value=""
                    required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-3"><label class="col-3">Вагоны</label></div>
            <div class="col">
                <select name="trains[]" class="form-control" required multiple size="10">
                    @foreach($trains as $train)
                        <option value="{{ $train->id }}">{{ $train->number }} ({{ $train->max_seats_cnt }} мест)</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row justify-content-center">
            <div class="col-4"><button class="btn btn-block btn-info">Сохранить</button></div>
        </div>
    </form>
@endsection
