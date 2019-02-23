

<?php

//this API is for fetching  course name which are not in specied college id....so after college login, college can add extra  courses(which are not exist in college yet) through flotingbutton(alert) in college_course_manage activity.
include("db_connect.php");

$response=array();

$College_id = $_REQUEST["College_id"];
	

//all course display
$query="select Course_id,Course_name from course_tb  where Course_id not in(select Course_id from college_course_tb where College_id=$College_id)";

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
    $response["message"] = "No record found";
 
    // echo no users JSON
    echo json_encode($response);
}




?>


