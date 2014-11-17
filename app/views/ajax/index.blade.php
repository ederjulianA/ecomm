<!DOCTYPE html>
<html>
<head>
	<title>ajax</title>

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	{{ HTML::script('js/admin.js')}}
    {{ HTML::style('css/estilos.css', array('media' => 'screen'))}}
</head>
<body>

{{ Form::open( array(
    'route' => 'ajax-lista',
    'method' => 'post',
    'id' => 'form-add-setting'
) ) }}
 
{{ Form::label( 'categoria', 'Setting Name:' ) }}
{{ Form::text( 'categoria', '', array(
    'id' => 'categoria',
    'placeholder' => 'Enter Setting Name',
    'maxlength' => 20,
    'required' => true,
) ) }}

 
{{ Form::submit( 'Add Setting', array(
    'id' => 'btn-add-setting',
) ) }}
 
{{ Form::close() }}

<a href="#" id="btn-load" class="btn btn-info">Load Productos</a>
<div class="con-pro">
    
</div>

<div class="feed">
    <h2>Novedades</h2>
    
</div>


</body>
</html>