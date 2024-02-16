<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="author" content="Eliezer Rubio"/>
	    <meta name="description" content="Prueba TUXPAN"/>
		<title>@yield('title', 'Bienvenido') | TUXPAN</title>
		<link rel="stylesheet" href="{{ mix('css/styles.css') }}">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Tuxpan</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="#">Tareas</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Estados de tareas</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Usuarios</a>
						</li>
					</ul>
					<button class="btn btn-primary">Iniciar sesión</button>
				</div>
			</div>
		</nav>

		@yield('content')

        <div class="modal fade" id="defaultModal" tabindex="-1" aria-labelledby="defaultModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="{{ mix('js/scripts.js') }}" defer></script>
	</body>
</html>