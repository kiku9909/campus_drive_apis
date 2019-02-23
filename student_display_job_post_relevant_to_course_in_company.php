<?php
include("db_connect.php");

$response=array();

if(isset($_REQUEST['job_seeker_id']) && isset($_REQUEST['job_fair_id']) && isset($_REQUEST['company_id']))
{
	$Job_seeker_id=$_REQUEST['job_seeker_id'];
	$job_fair_id=$_REQUEST['job_fair_id'];
	$company_id=$_REQUEST['company_id'];
$query="select cc.Course_id,cjp.Company_job_post_id,cjp.post_name
from job_seeker_tb js,college_course_tb cc,`company_job_post_tb` cjp ,`participated_company_tb` pc,
`company_job_post_allowed_course_tb` cjpa
where 
js.College_course_id=cc.College_course_id and
js.Job_seeker_id=$Job_seeker_id and
pc.job_fair_id=$job_fair_id and
pc.company_id=$company_id and
cjp.participated_company_id = pc.participated_company_id and
cjpa.company_job_post_id=cjp.company_job_post_id and
cjpa.course_id=cc.course_id";

$result=mysqli_query($con,$query);

$response["company_job_post"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$jobpost=array();
			$jobpost["Company_job_post_id"]=$row["Company_job_post_id"];
			$jobpost["post_name"]=$row["post_name"];
			
			array_push($response["company_job_post"],$jobpost);
			
		}
		$response["success"]=1;
		echo json_encode($response);
		
}else {
    // no post found
    $response["success"] = 2;
    $response["message"] = "No Post Found relevant to your course";
 
    // echo no users JSON
    echo json_encode($response);
}
}



?>


