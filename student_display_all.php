<?php
include("db_connect.php");

$response=array();


$query="SELECT * FROM `job_seeker_tb`";

$result=mysqli_query($con,$query);

$response["students"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$stud=array();
			$stud["Student_id"]=$row["Job_seeker_id"];
			$stud["College_course_id"]=$row["College_course_id"];
			$stud["Student_name"]=$row["Student_name"];
			$stud["Student_contact"]=$row["Student_contact"];
			$stud["Student_email"]=$row["Student_email"];
			$stud["Student_gender"]=$row["Student_gender"];
			$stud["Student_profile"]=$row["Student_profile"];
			$stud["Student_resume"]=$row["Student_resume"];
			$stud["Student_password"]=$row["Student_password"];
			$stud["Student_cgpa"]=$row["Student_cgpa"];
			
			array_push($response["students"],$stud);
			
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


