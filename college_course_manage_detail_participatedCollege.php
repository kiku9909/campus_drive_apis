

<?php

//this API is for fetching  participated college detail for specied jobfair id....in college_course_manage_detail_cardview_college.
include("db_connect.php");

$response=array();

$Job_fair_id = $_REQUEST["Job_fair_id"];
	

//all course display
$query="select College_name,College_location,College_webURL from college_tb c,participated_college_tb pc WHERE c.College_id=pc.College_id and Job_fair_id=$Job_fair_id";

$result=mysqli_query($con,$query);

$response["collegedetail"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$college=array();
			$college["College_name"]=$row["College_name"];
			$college["College_location"]=$row["College_location"];
			$college["College_webURL"]=$row["College_webURL"];
			array_push($response["collegedetail"],$college);
			
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


