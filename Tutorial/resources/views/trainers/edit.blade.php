@extends('layouts.app')

@section('title','Trainer Edit')

@section('content')

	@include('common.errors')
	<img style="height: 200px; width: 200px; background-color: #EFEFEF; margin: 20px;" class="card-img-top rounded-circle mx-auto d-block" src="/images/{{$trainer->avatar}}" alt="">

	{!! Form::model($trainer,['route'=>['trainers.update',$trainer],'method'=>'PUT','files'=>true])!!}
		
		@include('trainers.form')

		{!! Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	{!! Form::close()!!}
	
@endsection

