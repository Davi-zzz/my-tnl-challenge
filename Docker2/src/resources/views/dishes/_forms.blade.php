@if(isset($item))
<input type="hidden" name="menu_id" value="{{$item['menu_id']}}"/>
<div class="form-group col-md-6">
    {!! Form::text('name', 'Nome')->required()->placeholder($item['name']) !!}
</div>
<div class="form-group col-md-6">
    {!! Form::textarea('description', 'Description')->required()->placeholder($item['description']) !!}
</div>
<div class="form-group col-md-6">
    {!!Form::select('type', "Tipo: {$item['type_desc']}", [  '' => 'Selecione...',0 => 'Fritura',
    1 => 'Assado',
    2 => 'Cozido',
    3 => 'Grelhado',
    4 => 'Defumado',
    5 => 'Bebida',
    6 => 'Caldo',])
    ->required()
    !!}

</div>
<div class="form-group col-md-6">
    {!!Form::select('category', "Categoria: {$item['category_desc']}",[  '' => 'Selecione...', 0 => 'Fast Food',
    1 => 'Caseiro',
    2 => 'Executivo',
    3 => 'Grelhado',
    4 => 'Sanduíche',
    5 => 'Sobremesa',
    6 => 'Natural',
    7 => 'Industrializado',])
    ->required()
    !!}
</div>
<div class="form-group col-md-6">
    {!!Form::select('status', "Status: {$item['status_desc']}", ['' => 'Selecione...', 0 => 'Desabilitado',
    1 => 'Habilitado'])
    !!}
</div>
@else
<div class="form-group col-md-6">
    {!! Form::text('menu_id', 'Menu')
    ->readonly()
    !!}
</div>
<div class="form-group col-md-6">
    {!! Form::text('name', 'Nome')->required() !!}
</div>
<div class="form-group col-md-6">
    {!! Form::textarea('description', 'Description') !!}
</div>
<div class="form-group col-md-6">
    {!!Form::select('type', "Tipo", [  '' => 'Selecione...',0 => 'Fritura',
    1 => 'Assado',
    2 => 'Cozido',
    3 => 'Grelhado',
    4 => 'Defumado',
    5 => 'Bebida',
    6 => 'Caldo',])
    ->required()
    !!}

</div>
<div class="form-group col-md-6">
    {!!Form::select('category', "Categoria",[  '' => 'Selecione...', 0 => 'Fast Food',
    1 => 'Caseiro',
    2 => 'Executivo',
    3 => 'Grelhado',
    4 => 'Sanduíche',
    5 => 'Sobremesa',
    6 => 'Natural',
    7 => 'Industrializado',])
    ->required()
    !!}
</div>
<div class="form-group col-md-6">
    {!!Form::select('status', "Status", ['' => 'Selecione...', 0 => 'Desabilitado',
    1 => 'Habilitado'])
    !!}
</div>
@endif
