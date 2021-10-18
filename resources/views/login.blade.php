@extends('layouts.main')

@section('title', 'Выберите пользователя для начала работы с системой')

@section('content')
    <form action="">
        <div class="row justify-content-center">
            <div class="col-7">
                <div class="form-group">
                    <input type="hidden" name="simple_auth" value="Y">
                    <select class="form-control" id="user" name="user">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">[{{ $user->email }}] {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-info">Продолжить</button>
                </div>
            </div>
        </div>
    </form>
@endsection
