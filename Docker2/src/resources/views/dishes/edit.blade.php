@extends('layouts.main')

@section('content')
    
<div class="container py-3">
    <div class="card p-3">
        <div class="row">
            @isset($error)
            <span>{{$error}}</span>
            @endisset
           
            <form action="{{ route('dishe.update', $item['id']) }}" method="POST">
                @method('PUT')
                @csrf
                @include('dishes._forms')
                
                <button type="submit" class="btn btn-primary"> enviar</button>
            </form>
            </form>
        </div>
    </div>
    @endsection