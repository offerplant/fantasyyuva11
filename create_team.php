<?php 
	require_once('header.php');  
	$unique_id = $_GET['unique_id'];
?> 
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
			<div class='row'>
					<div class='col'> 
						<div class="card">
							<div class="card-body" id='btcount' style='background:lightgreen'>BAT <span class='badge badge-success text-right'></span> </div>
						</div>
					</div>
					<div class='col'> 
						<div class="card">
							<div class="card-body" id='bwcount' style='background:lightpink'>BOWL <span class='badge badge-success'></span></div>
						</div>
					</div>
					<div class='col'> 
						<div class="card">
							<div class="card-body" id='wkcount' style='background:lightyellow'>WK <span class='badge badge-success'></span></div>
						</div>
					</div>
					<div class='col'> 
						<div class="card">
							<div class="card-body" id='arcount' style='background:lightblue'>AR <span class='badge badge-success'></span></div>
						</div>
					</div>
					
			</div>
			<div class='plist' >
				<div class='teamA'>
			<?php 
			$res =direct_sql("select * from squad where unique_id ='$unique_id' "); 
			$squad =json_decode($res,true);
			//print_r($squad);
			for($i=1; $i<=16; $i++)
			{
				$p_id = $squad[0]['a_'.$i];
			
			?>
			<div class="card <?php echo removespace(get_data('players',$p_id, 'playing_role', 'pid')); ?>" id="<?php echo $p_id;?>">
			  <div class="card-body">
				<div class="media">
				  <img class="align-self-center mr-3" src="<?php echo get_data('players',$p_id, 'image_url', 'pid'); ?>" alt="<?php echo get_data('players',$p_id, 'name', 'pid'); ?>" width='40px' width='40px' style='border-radius:4px;'>
				  <div class="media-body">
					
					<p align='left' style='display:inline;'>
						<b><?php echo get_data('players',$p_id, 'name', 'pid'); ?></b><br>
						<span class='prole badge badge-primary'><?php echo get_data('players',$p_id, 'playing_role', 'pid'); ?> </span> <br>
						<span class='badge badge-danger'> From <?php echo get_data('players',$p_id, 'country', 'pid'); ?> </span>
						
					</p>
					
					
				  </div>
				<p style='padding-top:10px;color:#c2c2c2;'>
					<i class='pselect fa fa-check-circle fa-3x text-default' ></i>
				</p>
				</div>
				
			  </div>
			</div>
			
			<?php
			}
			
		echo "</div>";
		echo "<div class='teamB'>";
			
			for($i=1; $i<=16; $i++)
			{
				$p_id = $squad[0]['b_'.$i];
			
			?>
			<div class="card <?php echo removespace(get_data('players',$p_id, 'playing_role', 'pid')); ?>" id="<?php echo $p_id;?>">
			  <div class="card-body">
				<div class="media">
				  <img class="align-self-center mr-3" src="<?php echo get_data('players',$p_id, 'image_url', 'pid'); ?>" alt="<?php echo get_data('players',$p_id, 'name', 'pid'); ?>" width='40px' width='40px' style='border-radius:4px;'>
				  <div class="media-body">
					
					<p align='left' style='display:inline;'>
						<b><?php echo get_data('players',$p_id, 'name', 'pid'); ?></b><br>
						<span class='badge badge-primary'><?php echo get_data('players',$p_id, 'playing_role', 'pid'); ?> </span> <br>
						<span class='badge badge-danger'> From <?php echo get_data('players',$p_id, 'country', 'pid'); ?> </span>
						
					</p>
					
					
				  </div>
				<p style='padding-top:10px;color:#d2d2d2;'>
					<i class='pselect fa fa-check-circle fa-3x text-default' ></i>
				</p>
				</div>
				
			  </div>
			</div>
			<?php
			}?>
		</div>
		</div>
			
	</div>
	</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	
	<script>
		$(document).ready(function(){
			var playerlist=[];
			
			
		  $(".pselect").click(function(){
			$(this).toggleClass("fa fa-check fa text-success");
			var playerType=$(this).closest(".card")[0].classList[1];
			var batsman = $(".text-success").closest($("[class*=batsman]")).css("background","lightgreen").length;
			var bowler = $(".text-success").closest($("[class*=bowler]")).css("background","lightpink").length;
			var allrounder = $(".text-success").closest($("[class*=allrounder]")).css("background","lightblue").length;
			var wicketkeeper = $(".text-success").closest($("[class*=wicketkeeper]")).css("background","lightyellow").length;
			var playerlist=$(this).closest(".card").attr('id');
			if(batsman<3)
			{
			$("#btcount span").html(batsman);
			}
			$("#bwcount span").html(bowler);
			$("#arcount span").html(allrounder);
			$("#wkcount span").html(wicketkeeper);
		  });
		  
		$("#btcount").click(function(){
		  $(".plist .card").css("display","block");
		  $(".plist .card").filter(':not("[class*=batsman]")').css("display","none");
		});
		$("#bwcount").click(function(){
		   $(".plist .card").css("display","block");
		  $(".plist .card").filter(':not("[class*=bowler]")').css("display","none");
		});
		$("#arcount").click(function(){
		  $(".plist .card").css("display","block");
		  $(".plist .card").filter(':not("[class*=allrounder]")').css("display","none");
		});
		$("#wkcount").click(function(){
		   $(".plist .card").css("display","block");
		  $(".plist .card").filter(':not("[class*=wicketkeeper]")').css("display","none");
		});
		});
	</script>
  </body>
</html>

