<?php
include("db_connect.php");

$response=array();

$job_seeker_id = $_REQUEST["job_seeker_id"];

$query="select Job_seeker_id,Student_name,Student_email,Student_profile from job_seeker_tb where Job_seeker_id=$job_seeker_id";

$result=mysqli_query($con,$query);
$response["studentdetail"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			$student=array();
			$student["Job_seeker_id"]=$row["Job_seeker_id"];
			$student["Student_name"]=$row["Student_name"];
			$student["Student_email"]=$row["Student_email"];
			$student["Student_profile"]=$row["Student_profile"];
			array_push($response["studentdetail"],$student);
		}
		$response["success"]=1;
		echo json_encode($response);
		
}else {
    // no Student foundCompany_password
    $response["success"] = 0;
    $response["message"] = "No Students found";
 
    // echo no users JSON
    echo json_encode($response);
}




?>


