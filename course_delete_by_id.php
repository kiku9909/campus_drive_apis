<?php
include("db_connect.php");
$response=array();

if(isset($_REQUEST['id']))
{
	
	$id=$_REQUEST['id'];
	$query="DELETE FROM `course_tb` WHERE  Course_id=$id";
	$result=mysqli_query($con,$query);
	if($result>0)
	{
	$response["success"]=1;
	echo json_encode($response);
	}
	else
	{
		$response["success"]=0;
		$response["message"]="An error occured";
	echo json_encode($response);
	}
	
}
else
{
	$response["success"]=0;
	$response["message"]="Required field(s) missing";
	echo json_encode($response);
}

?>