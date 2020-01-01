@extends('layouts.app')
@section('content')
<h1>log In</h1>

{{ Form::open(array('url' => 'Contact/submit' , 'method' => 'post')) }}
    <div class="form-group">
        {{Form::label('userName : ', '')}}
        {{Form::Text('userName', '' , ['class' => 'form-control' , 'placeholder'=> 'Enter your userName'])}}
    </div>
    <div class="form-group">
        {{Form::label('password: ', '')}}
        {{Form::Text('password', '',['class' => 'form-control', 'placeholder'=> 'Enter your password'])}}
    </div>
    <div>
         {{Form::submit('Send',['class'=>'btn btn-block btn-primary'])}}
    </div>
{{ Form::close() }}
<div>
   <br/>
</div>
@endsection