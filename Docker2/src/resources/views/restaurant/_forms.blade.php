@if(isset($item))
<div class="form-group col-md-6">
    {!! Form::text('name', 'Nome')->required()->placeholder($item['name']) !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('cnpj', 'CNPJ')->required()->placeholder($item['cnpj'])->max(18) !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('phone', 'Telefone')->required()->placeholder($item['phone']) !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('address', 'Endereço')->required()->placeholder($item['address']) !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('zip_code', 'CEP')->required()->placeholder($item['zip_code']) !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('location', 'País')->required()->placeholder($item['location']) !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('state', 'Estado')->required()->placeholder($item['state']) !!}
</div>
<div class="form-group col-md-6">
    {!!Form::select('status', "Status: {$item['status_desc']}", ['' => 'Selecione...', 0 => 'Desabilitado',
    1 => 'Habilitado'])
    !!}
</div>
@else
<div class="form-group col-md-6">
    {!! Form::text('name', 'Nome')->required()->placeholder('digite aqui...') !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('cnpj', 'CNPJ')->required()->placeholder('digite aqui...') !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('phone', 'Telefone')->required()->placeholder('digite aqui...') !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('address', 'Endereço')->required()->placeholder('digite aqui...') !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('zip_code', 'CEP')->required()->placeholder('digite aqui...') !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('location', 'País')->required()->placeholder('digite aqui...') !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('state', 'Estado')->required()->placeholder('digite aqui...') !!}
</div>
<div class="form-group col-md-6">
    {!!Form::select('status', "Status", ['' => 'Selecione...', 0 => 'Desabilitado',
    1 => 'Habilitado'])
    !!}
</div>
@endif
