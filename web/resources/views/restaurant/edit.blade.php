@extends('layouts.main')

@section('content')
@include('alerts.error')
@include('alerts.sucess')
<div class="container py-3">
    <div class="card p-3">
        <div class="row">
            <form action="{{ route('restaurant.update', $item['id']) }}" method="POST">
                @method('PUT')
                @csrf
                @include('restaurant._forms')
                
                <button type="submit" class="btn btn-primary"> enviar</button>
            </form>
        </div>
    </div>
    @endsection