<?php require_once('header.php'); ?>
  <body >
	
	  <div class="col-md-4 offset-md-4">
		<nav class="navbar navbar-dark bg-dark">
		  <span class="navbar-brand mb-0 h1">FantasyYuva11</span>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<i class='fa fa-plus'></i> Create Team
		  </button>
		  
		</nav>
		<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner">
			<div class="carousel-item active">
				<img src="slide1.jpg" class="d-block w-100" alt="...">
			</div>
			<div class="carousel-item">
			  <img src="slide2.jpg" class="d-block w-100" alt="...">
			</div>
			<div class="carousel-item">
			  <img src="slide3.jpg" class="d-block w-100" alt="...">
			</div>
		  </div>
		</div>
		<div class='container' >
			<?php 
			include_once('function.php');
			$res =direct_sql("select * from matches where match_type='ODI' or match_type='T20I' order by unique_id "); 
			$match_list =json_decode($res,true);
			
			foreach($match_list as $match)
			{
				//print_r($match);
			?>
			
			<div class="card"  >
			  <div class="card-body">
				<div class='row text-center'>
					<div class='col-3'>
					<img src="<?php echo team_logo($match['team_1']); ?>" class="img-thumbnail" alt="<?php echo team_logo($match['team_2']); ?>" >
						
					</div>
					<div class='col-6 text-center'>
						<?php echo $match['team_1']; ?> vs <?php echo $match['team_2']; ?>
						<?php echo $match['match_type']; ?>
						<span class='badge badge-primary'><?php echo date('d-m-Y H:i A',strtotime($match['date_time'])); ?> </span>
					</div>
					<div class='col-3'>
					<img src="<?php echo team_logo($match['team_2']); ?>" class="img-thumbnail" alt="<?php echo team_logo($match['team_2']); ?>">
						
					</div>
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

