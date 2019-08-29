<?php
require_once('config.php');
include_once('function.php');


function match_list(){
		global $api_key;
		$api_url  = "http://cricapi.com/api/matches?apikey=".$api_key;
		$result =api_call($api_url);
		return json_decode($result,true);
}


function squad($unique_id){
		global $api_key;
		$api_url  = "https://cricapi.com/api/fantasySquad?apikey=$api_key&unique_id=".$unique_id;
		$result = api_call($api_url);
		return json_decode($result,true);
}

function update_match()
{
$match_list =match_list();
			
			foreach($match_list['matches'] as $match)
			{	
				$team1 =$match['team-1'];
				$team2 =$match['team-2'];
				extract($match);
				echo $sql ="INSERT IGNORE INTO matches(unique_id, date_time, team_1, team_2, match_type, toss_winner_team, winner_team, status) values('$unique_id', '$dateTimeGMT', '$team1', '$team2', '$type', '$toss_winner_team', '$winner_team', '$matchStarted')";
				mysqli_query($con,$sql) or mysqli_error($con);
				
				$sql2 ="update matches set status='$matchStarted' where unique_id ='$unique_id'";
				mysqli_query($con,$sql2) or mysqli_error($con);
				
			}
}

function update_squad($unique_id)
{
	global $con;
	/* Add Match in Squad List */
	$sql1 ="INSERT IGNORE INTO squad(unique_id,status) values('$unique_id', 'ACTIVE')";
	mysqli_query($con,$sql1) or mysqli_error($con);
	$all_data = squad($unique_id);
	$players_list1 = $all_data['squad'][0]['players'];
	$country1 = $all_data['squad'][0]['name'];
	$i=1;
	foreach($players_list1 as $player_name)
	{
			$name = $player_name['name'];
			$pid = $player_name['pid'];
			$sql2 ="INSERT IGNORE INTO players (pid, name, country, status) values( '$pid', '$name','$country1', 'ACTIVE')";
			mysqli_query($con,$sql2) or mysqli_error($con);
			update_player($pid);
			$col_name ='a_'.$i;
			$sql3 ="update squad set $col_name ='$pid' where unique_id ='$unique_id'";
			mysqli_query($con,$sql3) or mysqli_error($con);
		$i++;	
	}
	$j=1;
	$players_list2 = $all_data['squad'][1]['players'];
	$country2 = $all_data['squad'][1]['name'];
	foreach($players_list2 as $player_name)
	{
			$name = $player_name['name'];
			$pid = $player_name['pid'];
			$sql4 ="INSERT IGNORE INTO players(pid, name, country, status) values( '$pid', '$name','$country2', 'ACTIVE')";
			mysqli_query($con,$sql4) or mysqli_error($con);
			update_player($pid);
			$col_name ='b_'.$j;
			$sql5 ="update squad set $col_name ='$pid' where unique_id ='$unique_id'";
			mysqli_query($con,$sql5) or mysqli_error($con);
			$j++;
	}
	
}


function update_player($pid)
{
	global $con;
	global $api_key;
	$api_url  = "https://cricapi.com/api/playerStats?apikey=$api_key&pid=$pid";
	$result = api_call($api_url);
	$all_data = json_decode($result,true);
	echo "<pre>";
	//print_r($all_data);
	$img_url = $all_data['imageURL'];
	$playing_role = $all_data['playingRole'];
	$sql ="update players set playing_role ='$playing_role', image_url ='$img_url' where pid  ='$pid'";
	mysqli_query($con,$sql) or mysqli_error($con);
	
}

update_squad('1034809');
//update_player('253802');
?>
