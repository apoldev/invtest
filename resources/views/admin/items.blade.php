@extends('layouts.admin')


@section('title')
    Товары
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        @if (session('success'))

        <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
            
        @endif

        <table class="table">
            @forelse ($items as $item)
                <tr>
                    {{-- <td>{{$item->id}}</td> --}}
                    <td> 
                        <img src="{{$item->image_uri}}" alt="" width="60px">
                    </td>
                    <td>{{$item->title}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('items.edit', $item->id) }}">Изменить</a>
                        
                        <form method="POST" action=" {{ route('items.destroy', $item->id) }} ">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger mt-2" type="submit" value="Удалить"/>
                        </form>
                        
                    </td>
                </td>
            @empty
                <h1>Нет товаров</h1>
            @endforelse
               
        </table>
    </div>
</div>


<div class="d-flex justify-content-center">
    {!! $items->links("pagination::bootstrap-4") !!}
</div>
@endsection