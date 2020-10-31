@extends('layouts.admin')


@section('title')
@if ($item->exist)
    Редактирование "{{$item->title}}"
@else 
    Создание товара
@endif
    
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        @if ($errors->any())

        <div class="alert alert-danger" role="alert">
            {{$errors->first()}}
          </div>
            
        @endif


        @if (session('success'))

        <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
            
        @endif

        <form method="post" action="{{ $item->exists ? route('items.update', $item->id) : route('items.store') }}" enctype="multipart/form-data">
            @if ($item->exists)
            @method('PATCH')
            @endif
            
            @csrf
            <div class="container">


                <div class="form-group">
                    <p>Изображение</p>
                    <div>
                        <img src="{{$item->image_uri}}" alt="" width="70px">
                    </div>
                    
                    <input type="file" name="image"/>
                </div>

                <div class="form-group">
                    <label>Название</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $item->title) }}" >
                </div>

                <div class="form-group">
                    <label>Цена</label>
                    <input type="text" class="form-control" name="price" value="{{ old('price', $item->price) }}" >
                </div>


                <p> Выберите свойства </p>
                <div class="row">
                    @foreach ($groups as $group)
                        
                    <div class="col-md-4 ">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$group['title']}}</h5>
    
                            @foreach ($group['attrs'] as $attr)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="attrs[{{$group['id']}}]" id="radio-{{$attr['slug']}}" value="{{$attr['id']}}" {{ (is_array($current_attrs) && isset($current_attrs[$group['slug']]) && $current_attrs[$group['slug']] === $attr['slug']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="radio-{{$attr['slug']}}">
                                    {{$attr['title']}}
                                </label>
                            </div>
                            @endforeach
                            </div>
                        </div>
                    </div>

                    @endforeach
                    
                </div>
                
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection