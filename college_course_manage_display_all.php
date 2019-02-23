<?php
//this API is for displaying course name for specied college id
include("db_connect.php");

$response=array();

$College_id = $_REQUEST["College_id"];
	

//all course display
$query="SELECT c.Course_name,c.Course_id FROM course_tb c,college_course_tb cc WHERE c.Course_id=cc.Course_id and  cc.College_id=$College_id";

$result=mysqli_query($con,$query);

$response["coursedetail"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$course=array();
			$course["Course_id"]=$row["Course_id"];
			$course["Course_name"]=$row["Course_name"];
			
			array_push($response["coursedetail"],$course);
			
		}
		$response["success"]=1;
		echo json_encode($response);
		
}else {
    // no Student found
    $response["success"] = 0;
    $response["message"] = "No Students found";
 
    // echo no users JSON
    echo json_encode($response);
}




?>


