<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type='text/css'>

    <title>Fantasy Yuva 11</title>
  </head>
  <body >
	
	  <div class="col-md-4 offset-md-4">
		<nav class="navbar navbar-dark bg-dark">
		  <span class="navbar-brand mb-0 h1">FantasyYuva11</span>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
			<!--<ul class="navbar-nav">
			  <li class="nav-item active">
				<a class="nav-link" href="#">Profile</span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">Chnage Password</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">Wallet</a>
			  </li>
			  
			</ul>-->
		  </div>
		</nav>
		<div class='container' >
			<?php 
			include_once('function.php');
			$res =direct_sql("select * from matches where match_type='ODI' or match_type='T20I'"); 
			$match_list =json_decode($res,true);
			
			foreach($match_list as $match)
			{
				//print_r($match);
			?>
			
			<div class="card"  >
			  <div class="card-body">
				<div class='row text-center'>
					<input type='text' class='form-control' >
				</div>
			  </div>
			</div>
			<?php
			}?>
			
			 
	  </div>
			<button class='btn btn-block btn-success'> Create Your Team </button>		
	  <div class="col-xs-12 footer text-center" style="">
		&copy 2019 FantasyYuva11 
	  </div>
	</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

