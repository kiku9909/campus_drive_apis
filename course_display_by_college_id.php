<?php
include("db_connect.php");

$response=array();

if(isset($_POST['college_id']))
{
	$id=$_POST['college_id'];
$query="SELECT cou.course_id,cou.course_name FROM `college_course_tb` cc,course_tb cou,college_tb coll WHERE cc.college_id=coll.college_id and cou.course_id=cc.course_id and cc.college_id=$id";

$result=mysqli_query($con,$query);

$response["courses"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$course=array();
			$course["Course_id"]=$row["course_id"];
			$course["Course_name"]=$row["course_name"];
			
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
}



?>


