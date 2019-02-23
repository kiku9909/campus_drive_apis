<?php
include("db_connect.php");

$response=array();

if(isset($_REQUEST['college_id']) && isset($_REQUEST['course_id']))
{
	$college_id=$_REQUEST['college_id'];
	$course_id=$_REQUEST['course_id'];
$query="SELECT * FROM `college_course_tb` WHERE college_id=$college_id and course_id=$course_id";

$result=mysqli_query($con,$query);

$response["college_course"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$course=array();
			$course["college_course_id"]=$row["College_course_id"];
			
			array_push($response["college_course"],$course);
			
		}
		$response["success"]=1;
		echo json_encode($response);
		
}else {
    // no Student found
    $response["success"] = 0;
    $response["message"] = "Not found";
 
    // echo no users JSON
    echo json_encode($response);
}
}



?>


