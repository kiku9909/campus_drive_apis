<?php
include("db_connect.php");

$response=array();


$query="SELECT * FROM `course_tb`";

$result=mysqli_query($con,$query);

$response["courses"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$course=array();
			$course["Course_id"]=$row["Course_id"];
			$course["Course_name"]=$row["Course_name"];
			
			array_push($response["courses"],$course);
			
		}
		$response["success"]=1;
		echo json_encode($response);
		
}else {
    // no Student found
    $response["success"] = 0;
    $response["message"] = "No Courses found";
 
    // echo no users JSON
    echo json_encode($response);
}




?>


