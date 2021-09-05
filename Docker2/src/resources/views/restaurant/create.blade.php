@extends('layouts.main')
@section('content')
    @include('alerts.sucess')
    <div class="container py-3">
        <div class="card p-3">
            <div class="row">
                @isset($error)
                    <span>{{$error}}</span>
                @endisset
                {!! Form::open()->post()->route('restaurant.store') !!}
                <div class="form-group col-md-6">
                    <label for="inputName">Nome:</label>
                    <input type="text" name="name" class="form-control" id="inputName" placeholder="digite aqui...">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCNPJ">CNPJ:</label>
                    <input type="text" name="cnpj" class="form-control" id="inputCNPJ" placeholder="digite aqui...">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPhone">Telefone:</label>
                <input type="text" name="phone" class="form-control" id="inputPhone" placeholder=" +55(00) 00000-0000.">
            </div>
            <div class="form-group">
                <label for="inputAddress">Endereço:</label>
                <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Rua Lote Casa Bairro">
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Estado:</label>
                    <input type="text" name="state" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">CEP: </label>
                    <input type="text" name="zip_code" class="form-control" id="inputZip">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">País: </label>
                    <input type="text" name="location" class="form-control" id="inputZip">
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">

                </div>
            </div>
          
            <button type="submit" class="btn btn-primary">Enviar</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
