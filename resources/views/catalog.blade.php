@extends('layouts.main')


@section('title')
    Контент
@endsection

@section('content')
<div class="columns">
    <div class="column col-3">
        @include('filter')
    </div>
    <div class="column col-9">
        <div class="columns">
            @forelse ($items as $item)
                @include('item', ['item' => $item])  
            @empty
                <h1>Нет товаров</h1>
            @endforelse
               
        </div>
    </div>
</div>
@endsection