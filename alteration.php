<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">	
	<title>BikeLabs</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
	<header>
		<div class="head-container">
			<h1 class="unselectable">BikeLabs</h1>
		</div>
		
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      	<li class="nav-item active header-padding">
		        	<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
		      	</li>
		      	<li class="nav-item header-padding">
			        <a class="nav-link" href="spparts.php">Spare Parts</a>
		      	</li>
		      	<li class="nav-item dropdown header-padding">
		        	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Modify </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="modification.php">Body Modification</a>
			          <a class="dropdown-item" href="alteration.php">Engine Alteration</a>
			        </div>
		      	</li>
		      	<li class="nav-item header-padding">
		        	<a class="nav-link" href="#">New Bikes</a>
	      		</li>
		      	<li class="nav-item header-padding">
		        	<a class="nav-link" href="#">View Prices</a>
      			</li>
		      	
		    </ul>

		    <form class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
		      <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
		    </form>
		  </div>	
		</nav>
	</header>


	<!-- Alteration section -->

<section id="modify" class="section">
	<div class="container">
		<h2 class="section-head">
			<i class="fas fa-cogs"></i> <h1 class="unselectable">Engine Alteration</h1>
		</h2>
		<p class="lead">Modify your motorbike according to your specific preferences.</br> Add or remove parts from and to your motorbike, change the chassis, or alter the engine.</p>
		<a href="alteration.php" class="btn btn-outline-danger mb mt">Start Alteraion Now</a>
		<div class='slider border-new border border-dark rounded'>
		  <div class='slide1'></div>
		  <div class='slide2'></div>
		  <div class='slide3'></div>
		</div>
	</div>
</section>
<hr>

	<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="index.php"> BikeLabs.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
<script src="script/main.js"></script>
</body>
</html>