<!DOCTYPE HTML>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Scio Test 1</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" type="text/css" media="all" href="assets/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Oswald:300,400|Open+Sans:400,400italic,600,600italic" />
<link rel="stylesheet" type="text/css" media="all" href="assets/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<!--[if lt IE 9]>
<script src="https://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
</head>
<body>

<div class="loading">
	<div class="loading-dialog">
		<p>Cargando...</p>
	</div>
</div><!-- .loading -->
<div class="wrapper">
	<header id="header">
		<nav class="options">
			<ul class="row">
				<li class="col"><a href="#window-home">Portada</a></li>
				<li class="col"><a href="#window-users">Usuarios</a></li>
				<li class="col"><a href="#window-comments">Comentarios</a></li>
			</ul>
		</nav><!-- .options -->
	</header><!-- #header -->

	<section id="content">
		<div class="window" id="window-home">
			<h2>Estadísticas</h2>
			<ul>
				<li class="users">
					<span class="label">Usuarios</span> <span class="value"></span>
				</li>
				<li class="comments">
					<span class="label">Comentarios</span> <span class="value"></span>
				</li>
			</ul>
		</div><!-- #window-home -->

		<div class="window" id="window-users">
			<h2>Usuarios</h2>
			<form action="/api/users/add" class="add" enctype="multipart/form-data" method="post">
				<h6>Crear usuario</h6>
				<div class="response"></div>
				<label class="row">
					<span class="col col-span-3">UserName</span>
					<input class="col col-span-9" name="user_name" placeholder="Introduce el nombre de usuario" type="text" />
				</label>
				<input name="add" type="button" value="Crear" />
				<input name="reset" type="reset" value="Limpiar" />
			</form><!-- .add -->
			<form action="/api/users" class="view" enctype="multipart/form-data" method="get">
				<h6>Filtrar usuarios</h6>
				<p class="row">
					<input class="col" name="per_page" placeholder="Resultados por página (0 para todos)" type="text" />
					<input class="col" name="page" placeholder="Número de página" type="text" />
					<select class="col" name="filter">
						<option value="UserId" selected="selected">Ordenar por ID</option>
						<option value="UserName">Nombre de usuario</option>
						<option value="CreatedDate">Fecha de registro</option>
					</select>
					<select class="col" name="order">
						<option value="desc" selected="selected">Orden Descendente</option>
						<option value="asc">Orden Ascendente</option>
					</select>
				</p>
				<input name="view" type="button" value="Filtrar" />
				<input name="reset" type="reset" value="Limpiar" />
			</form><!-- .view -->
			<ul class="list"></ul>
			<form action="/api/users/edit/" class="edit" enctype="multipart/form-data" method="post">
				<h6>Editar usuario</h6>
				<div class="response"></div>
				<label class="row">
					<span class="col col-span-3">UserName</span>
					<input class="col col-span-9" name="user_name" placeholder="Introduce el nombre de usuario" type="text" />
				</label>
				<input name="user_id" type="hidden" />
				<input name="edit" type="button" value="Actualizar" />
				<input name="reset" type="reset" value="Cancelar" />
				<a href="/api/users/delete/">Borrar</a>
			</form><!-- .edit -->
		</div><!-- #window-users -->

		<div class="window" id="window-comments">
			<h2>Comentarios</h2>
			<ul>
				<li class="users">
					<span class="label">Usuarios</span> <span class="value"></span>
				</li>
				<li class="comments">
					<span class="label">Comentarios</span> <span class="value"></span>
				</li>
			</ul>
		</div><!-- #window-comments -->
	</section><!-- #content -->

	<footer id="footer">
		Derechos Reservados &copy; 2014, Tonny.org
	</footer><!-- #footer -->
</div><!-- .wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="assets/scripts/functions.js"></script>
<script src="assets/scripts/main.js"></script>
<script src="assets/scripts/users.js"></script>
<script src="assets/scripts/comments.js"></script>
</body>
</html>