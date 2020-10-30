@extends('layouts.main')


@section('title')
    Главная
@endsection

@section('content')
    <a href="{{ route('catalog') }}">Перейти в каталог</a>
@endsection