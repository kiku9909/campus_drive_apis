<?php
	include("db_connect.php");
	$response = array();
	$query = "select Job_fair_id,College_name,Job_fair_start_date,Job_fair_end_date from job_fair_tb ,college_tb where Host_college_id=College_id";
	$result = mysqli_query($con,$query);
	$response["jobfairs"] = array();
	
	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_array($result))
		{
			$jobfair = array();
			$jobfair["Job_fair_id"] = $row["Job_fair_id"];
			$jobfair["College_name"] = $row["College_name"];
			$jobfair["Job_fair_start_date"] = $row["Job_fair_start_date"];
			$jobfair["Job_fair_end_date"] = $row["Job_fair_end_date"];
						
			array_push($response["jobfairs"],$jobfair);
		}
		$response["success"]=1;
		echo json_encode($response);
	}
	else
	{
		// no Student foundCompany_password
		$response["success"] = 0;
		$response["message"] = "No Students found";
 
		// echo no users JSON
		echo json_encode($response);
	}
	
?>