<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>Laravel</title>

</head>
@extends('layouts.main')
@section('content')
@include('alerts.error')
@include('alerts.sucess')

    <!-- Topic Cards -->
    <div id="cards_landscape_wrap-2">
        <div class="container">
            <div class="row">
                @forelse($data['data'] as $item)
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <a href="{{ route('restaurant.show', ['restaurant' => (int) $item['id']]) }}">
                            <div class="card-flyer">
                                <div class="text-box">
                                    <div class="image-box">
                                        <img src="https://cdn.pixabay.com/photo/2018/03/30/15/11/deer-3275594_960_720.jpg"
                                            alt="" />
                                    </div>
                                    <div class="text-container">
                                        <h6>{{ $item['name'] }}</h6>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <span> Não há restaurantes disponiveis no momento</span>
                @endforelse
            </div>
        </div>
    </div>
@endsection
