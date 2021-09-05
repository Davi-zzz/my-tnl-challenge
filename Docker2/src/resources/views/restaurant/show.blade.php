<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <title>Laravel</title>

</head>
@extends('layouts.main')
@section('content')



    <div class="container py-3">
        @isset($error)
            <span>{{$error, 'asdkasdaskdask'}}</span>
           
        @endisset
        @isset($sucess)
        <span>{{$sucess}}</span>
        @endisset
        <div class="title h1 text-center">Restaurante {{ $item['data']['name'] }}</div>
        <!-- Card Start -->
        <div class="card">
            <div class="row ">

                <div class="col-md-7 px-3">
                    <div class="card-block px-6">
                        <div class="row">

                            <p class="card-text">
                                <span>CNPJ: {{ $item['data']['cnpj'] }}</span>
                            </p>
                        </div>
                        <div class="row">

                            <p class="card-text">
                                <span>ESTADO: {{ $item['data']['state'] }}</span>
                            </p>
                        </div>
                        <div class="row">

                            <p class="card-text">
                                <span>TELEFONE: {{ $item['data']['phone'] }}</span>
                            </p>
                        </div>
                        <div class="row">

                            <p class="card-text">
                                <span>ENDEREÇO: {{ $item['data']['address'] }}</span>
                            </p>
                        </div>
                        <div class="row">

                            <p class="card-text">
                                <span>CEP: {{ $item['data']['zip_code'] }}</span>
                            </p>
                        </div>
                        <div class="row">

                            <p class="card-text">
                                <span>LOCATION: {{ $item['data']['location'] }}</span>
                            </p>
                        </div>
                        <br>
                        @if (session()->has('token'))
                            <a href="#" class="mt-auto btn btn-primary">Read More</a>
                        @endif
                    </div>
                </div>
                <!-- Carousel start -->
                <div class="col-md-5">
                    <div id="CarouselTest" class="carousel slide" data-ride="carousel">
                        <img style="display:flex; justify-content: center; align-items: center" class="d-block width=100%" src="https://picsum.photos/150?image=380" alt="">
                        </div>
                    </div>
                </div>
                <!-- End of carousel -->
            </div>
        </div>
        <!-- End of card -->

    </div>
    @forelse ($item['data']['menus'] as $menu)
    <div class="title h1 text-center">MENU {{$menu['name']}}</div>
        <div class="container">
            <div class="card float-right">
                <div class="row ">
                    @forelse ($menu['dishes'] as $item)
                    
                        <div class="col-md-7">
                            <div class="card-block" style="border-style: solid">
                                <ul>
                                    <li>
                                        <p>NAME: {{ $item['name'] }}
                                    </li>
                                    <li>
                                        <p>DESCRIÇÃO: {{ $item['description'] }}
                                    </li>
                                    <li>
                                        <p>TIPO: {{ $item['description'] }}</p>
                                    </li>
                                    <li>
                                        <p>CATEGORIA: {{ $item['description'] }}</p>
                                    </li>
                                </ul>
                                <div class="row">
                                    {!! Form::open()->get()->route('dishe.edit', [$item['id']]) !!}
                                    <button class="btn btn-primary" type="submit">Editar</button>
                                    {!! Form::close() !!}
                                    {!! Form::open()->delete()->route('dishe.destroy', [$item['id']]) !!}
                                    <button class="btn btn-danger" type="submit">Deletar</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <img style="display:flex; justify-content: center; align-items: center" class="d-block width=100%" src="https://picsum.photos/200?v={{$item['id']}}" alt="">
                        </div>
                        @empty
                        <div class="col-sm-7">
                            <span>Este Menu Não tem Pratos Ainda !</span>
                            </div>
                        </div>
                    @endforelse

                    
                </div>
            </div>
            
            <br>
            <br>
            @empty
            <h3 style="align-items: center; display: flex; justify-content: center">Este Restaurante não tem menus ainda!</h3>
    @endforelse

@endsection
