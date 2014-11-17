<!DOCTYPE html>
<html>
<head>
	<title>Proyecto laravel | Digitalocean</title>
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  {{ HTML::style('css/estilos.css', array('media' => 'screen'))}}
</head>
<body>
			<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <b class="caret"></b></a>
          <ul class="dropdown-menu">
            @foreach($catnav as $cat)
              <li>{{ HTML::link('/store/category/'.$cat->id, $cat->name) }}</li>
            @endforeach
          </ul>
        </li>
      </ul>
     <!-- <form class="navbar-form navbar-left" role="search" action="store/search" method="get">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="keyword">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        {{ Form::token()}}
      </form>-->
      {{ Form::open(array('url'=>'store/search', 'method'=>'get'))}}
      {{ Form::text('keyword', null, array('placeholder'=>'Search by keyword')) }}
      {{ Form::submit('search')}}
      {{ Form::close()}}
      <ul class="nav navbar-nav navbar-right">
        @if(Session::has('cart.item'))
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">ITEMS <b class="caret"></b></a>
              <ul class="dropdown-menu">
                @foreach(Session::all() as $item)
                  <li>Item</li>

                @endforeach
              </ul>
          </li>

        @else
          <li>Carro basio</li>

        @endif
        @if(Auth::check())

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->firstname }} <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
              @if(Auth::user()->admin == 1)
                <li> {{ HTML::link('admin/categories', 'Manage Categories')}} </li>
                <li> {{ HTML::link('admin/products', 'Manage Products')}} </li>
              @endif
            <li> {{HTML::link('users/signout', 'Sign Out')}} </li>

            
         
          </ul>
        </li>

        @else
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign IN <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li> {{HTML::link('users/signin', 'Sign In')}} </li>
            <li> {{HTML::link('users/newaccount', 'Sign Up')}} </li>

            
         
          </ul>
        </li>


        @endif
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
@if(Session::has('message'))
	<p class="alert alert-danger"> {{Session::get('message')}}</p>
@endif	

  @yield('search-keywords')

	@yield('content')


  @yield('pagination')
	
</div>


</body>
</html>