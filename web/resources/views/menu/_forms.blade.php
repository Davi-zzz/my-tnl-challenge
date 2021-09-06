@if(isset($item['data']['name']))
<input type="hidden" name="restaurant_id" value="{{$item['data']['restaurant_id']}}"/>
<div class="form-group col-md-6">
    {!! Form::text('name', 'Nome')->required()->placeholder($item['data']['name']) !!}
</div>
<div class="form-group col-md-6">
    {!!Form::select('status', "Status: {$item['data']['status_desc']}", ['' => 'Selecione...', 0 => 'Desabilitado',
    1 => 'Habilitado'])
    !!}
</div>
@else
<input type="hidden" name="restaurant_id" value="{{$item['data']['restaurant_id']}}"/>
<div class="form-group col-md-6">
    {!! Form::text('name', 'Nome')->required()->placeholder('digite aqui...') !!}
</div>
<div class="form-group col-md-6">
    {!!Form::select('status', "Status", ['' => 'Selecione...', 0 => 'Desabilitado',
    1 => 'Habilitado'])
    !!}
@endif