@extends('layouts.main')

@section('content')
@include('alerts.error')
@include('alerts.sucess')
<div class="container py-3">
    <div class="card p-3">
        <div class="row">
            @isset($error)
            <span>{{$error}}</span>
            @endisset
            {!! Form::open()->post()->route('dishe.store') !!}
            @include('dishes._forms')
            
            <button type="submit" class="btn btn-primary">Enviar</button>
            {!! Form::close() !!}
        </div>
    </div>
    @endsection