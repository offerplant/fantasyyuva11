<?php
require_once('config.php');
$con = mysqli_connect($host_name, $db_user,$db_password,$db_name) or mysqli_error($con);
/*---------OfferPlant Master Functions-------------*/

function insert_data( $table_name, $ArrayData, $rvalue =true)
	{
		global $con;
		global $user_id;
		$result =null;
		//echo"<pre>";
		//print_r($ArrayData);
		$ArrayData['created_by'] =$user_id;
		$columns = implode(", ",array_keys($ArrayData));
		$escaped_values =array_values($ArrayData);
		foreach ($escaped_values as $newvalue)
		{
			$newvalues[] = "'". preg_replace('/[^A-Za-z.@,+:0-9\-]/', ' ', $newvalue)."'";
			
		}
		//$data = mysqli_escape_string ($escaped_values);
		$values  = implode(", ", $newvalues);

		$sql = "INSERT IGNORE INTO $table_name ($columns) VALUES ($values)";
		
		$res =mysqli_query($con,$sql) or die("Error in Inserting Data". mysqli_error($con));
		$id = mysqli_insert_id($con);
		if(mysqli_affected_rows($con)>0)
		{
			$result['id'] =$id;	
			$result['status'] ='success';	
			$result['msg'] =" Data Inserted Successfully";
		}
		if($rvalue ==true)
		{
		return $result;	
		}
	}
	
function update_data( $table_name, $ArrayData, $id, $field_name='id', $rvalue =true )
	{
		global $con;
		$result =null;
		$cols = array();
 		foreach($ArrayData as $key=>$value) 
			{
				$newvalue = preg_replace('/[^A-Za-z.@,:+0-9\-]/', ' ', $value);
				$cols[] = "$key = '$newvalue'";
			}
		echo $sql = "UPDATE $table_name SET " . implode(', ', $cols) . " WHERE $field_name  ='".$id ."'";
		$res=mysqli_query($con,$sql) or mysqli_error($con);
		$num = mysqli_affected_rows($con);
		if($num>0)
		{
			$result['status'] ='success';	
			$result['msg'] = $num." Record Updated Successfully";
		}
		if($rvalue ==true)
		{
		return $result;	
		}
	}
	
	
function delete_data( $table_name, $id )
	{
		global $con;
		$sql = "delete from $table_name WHERE id  ='".$id ."'";
			$res =mysqli_query($con,$sql) or die("Error in Getting Data". mysqli_error($con));
		$num = mysqli_affected_rows($con);
		if($num >=1)
		{
		 $result['status']='success';
		 $result['msg'] =$num. " Record deleted successfully";
		}else{
			$result['status']='failure';
			$result['msg'] = "Soory ! No Record found to delete";
		}
		return $result;
	}
		
function get_all( $table_name, $column_list ='*', $status = null )
	{
		global $con;
		//$column_list['id'] ='id';
		//$column_list['status'] ='status';
		if($column_list <>'*'){
			$column_list =implode(',',$column_list);
		}
		
			if($status)
			{
			$sql = "SELECT $column_list FROM $table_name where status ='$status'";
			}
			else{
				$sql = "SELECT $column_list FROM $table_name";
			}
		$res = mysqli_query($con,$sql) or die("Error In Loding Data : ".mysqli_error($con));
		if (mysqli_num_rows($res) >=1)
		{
			while($row =mysqli_fetch_assoc($res))
			{
				$data[] = $row;
			}
		return json_encode($data);
		}	
		else{
			return "No Record Found";
		}
		
	}
	
function direct_sql($sql, $rtype ='json' )
	{
		global $con;
		$res = mysqli_query($con,$sql) or die("Error In Loding Data : ".mysqli_error($con));
		//$data['count'] =mysqli_num_rows($res);
		if (mysqli_num_rows($res) >=1)
		{
			while($row =mysqli_fetch_assoc($res))
			{
				$data[] = $row;
			}
			if($rtype=='arr')
			{
			return $data;
			}else{
			return json_encode($data);
			}
		}	
		else{
			return "No Record Found";
		}
		
	}
function get_data($table_name, $id, $field_name =null, $p_key ='id')
	{
		global $con;
		$sql = "SELECT * FROM $table_name where $p_key ='$id' ";
		$res = mysqli_query($con,$sql) or die(" Student Information Error : ".mysqli_error($con));
		if (mysqli_num_rows($res) >=1)
		{
		$row =mysqli_fetch_assoc($res);
		extract($row);
			if($field_name)
			{
			return $row[$field_name];
			}
			else{
				return json_encode($row);
			}
		}else{
			return " No Record Found";
		}
	}
	
function removespace($str)
		{
		$str =trim($str);
		return strtolower(preg_replace("/[^a-zA-Z0-9]+/", "_", $str));
		}
		

function dropdown($array_list, $selected =null)
		{
			foreach($array_list as $list)
			{
				?>
				<option value='<?php echo $list; ?>' <?php if($list =$selected) echo "selected"; ?>><?php echo $list; ?></option>
				<?php
			}
		}
function countr($table)
		{
		global $con;
		
		$query ="select * from $table";
		
		$res = mysqli_query($con,$query) or die(" User Information Error : ".mysqli_error($con));
		$row =mysqli_fetch_assoc($res);
		return mysqli_num_rows($res);
		}
function bulksms($no,$msg,$count)
		{
		global $con;
		global $sender_id;
		global $auth_key;
		$no =urlencode($no);
		$msg = substr(urlencode($msg),0,158);
			
		/*--------------------SEND SMS ---------------------*/
				
						
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, "http://sms.morg.in/api/sendhttp.php?authkey=$auth_key&mobiles=$no&message=$msg&sender=$sender_id&route=4&country=0&unicode=1");
		//$res= curl_exec($ch);
						
		echo("<div class='alert alert-success alert-dismissable'>
			 <button type='button' class='close' data-dismiss='aler' aria-hidden='true'>&times;</button>
			 <i class='fa fa-warning fa-2x'></i>&nbsp;&nbsp; Thanks ! $count SMS send Sucessfully. </div>");
				
		}
function sendsms($number,$sms)
		{
		if(preg_match('/^[6-9]{1}[0-9]{9}+$/', $number) ==1)
			{
			$no ='91'.urlencode($number);
			$msg = substr(urlencode($sms),0,340);
			global $sender_id;
			global $auth_key;
			$ch = curl_init();
		

			curl_setopt($ch,CURLOPT_URL, "http://sms.morg.in/api/sendhttp.php?authkey=$auth_key&mobiles=$no&message=$msg&sender=$sender_id&route=4&country=0");
			//$res= curl_exec($ch);
			curl_close($ch);
			}
		
		}	
		
function uploadimg ($file_name , $imgkey = 'rand')
    {
        if ($imgkey =='rand') { $imgkey = rand(10000,99999); }
        $target_dir = "upload/";
        $target_file = $imgkey."_". basename($_FILES[$file_name]["name"]);
		$target_file = strtolower(preg_replace("/[^a-zA-Z0-9.]+/", "", $target_file));
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        
            $check = getimagesize($_FILES[$file_name]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            unlink($target_file);
            //echo "Sorry, file already exists.";
            $uploadOk = 1;
        }
        // Check file size
        if ($_FILES[$file_name]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$file_name]["tmp_name"],$target_dir.$target_file)) {
                echo "The file ". basename( $_FILES[$file_name]["name"]). " has been uploaded.";
                return $target_file;
            } else {
                echo "<script> alert('Sorry, there was an error uploading your file.'')</script>";
            }
        }
    }


function rowcount($table, $field_name='id')
{
	global $con;
	$query ="SELECT distinct($field_name) from $table";
	$res = mysqli_query($con,$query) or die(" Count Error : ".mysqli_error($con));
	$count  = mysqli_num_rows($res);
	return $count;
}	



function mymail( $to, $subject, $msg )
{
		global $noreply_email;
		global $inst_name;
		$from = $noreply_email;
		 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
		 
		// Compose a simple HTML email message
		$message = '<html><body>';
		$message .= '<table width="600px" border="1" Cellpadding="0" cellspacing="0" align="center" height="400" bgcolor="azure">';
		$message .= '<tr height="25px" bgcolor="orange"><td align="center"><h2>'.$subject .'</h2></td></tr>' ;
		$message .= '<tr><td><div style="color:dodgerblue;font-size:16px;font-family:arial;text-align:center;">'.$msg .'</div></td></tr>';
		$message .= '<tr><td><div style="color:dodgerblue;font-size:16px;font-family:arial;text-align:center;">'.$inst_name.'</div></td></tr>';
		$message .= '</table></body></html>';
		 
		// Sending email
		if(mail($to, $subject, $message, $headers)){
			return 'success';
		} else{
			return 'Failed';
		}
}	

function dropdownlist($tablename,$value,$list,$selected =null)
		{
		global $con;
		$i =0;
		$query ="select distinct $list, $value from $tablename";
		$res = mysqli_query( $con,$query) or die(" Creating Drop down Error : ".mysqli_error($con));
		while($row =mysqli_fetch_array($res))
		{
			$key =$row[$value];
			$show =$row[$list];
			//echo $selected;
		?>
		
			<option value='<?php echo $key; ?>'<?php if($key ==$selected) echo "selected";?> ><?php echo $show; ?></option>
		<?php
		}		
		}

function api_call ($api_url)
		{
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$api_url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		return $result;
		}
/*-------------END of OfferPlant Master Function ------------*/

function team_logo($name)
{
	$flag ='flag/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-",$name)).'.png';
	if(file_exists($flag))
	{
	 $logo = $flag;
	}
	else{
		$logo = 'flag/default.png';
	}
	return $logo;
}

?>

