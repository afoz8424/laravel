<div class="form-group">
	{!! Form::label('name','Nombre')!!}
	{!! Form::text('name',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
	{!! Form::label('descripcion','Descripcion')!!}
	{!! Form::textarea('descripcion',null,['class'=>'form-control','rows' => 2, 'cols' => 40])!!}
</div>
<div class="form-group">
	{!! Form::label('avatar','Avatar')!!}
	{!! Form::file('avatar')!!}
</div>