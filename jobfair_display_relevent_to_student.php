<?php
	include("db_connect.php");
	$response = array();
	if(isset($_REQUEST["job_seeker_id"]))
	{
	$job_seeker_id = $_REQUEST["job_seeker_id"];
	
	$query = "select c.College_name as Job_fair_name,j.Job_fair_id,j.Job_fair_start_date,j.Job_fair_end_date,j.Student_registration_start_date,j.Student_registration_end_date
			  from job_seeker_tb js,college_tb c,college_course_tb cc,participated_college_tb pc,job_fair_course_tb jc,job_fair_tb j
			  where
			  j.Host_college_id=c.College_id and 
			  js.College_course_id=cc.College_course_id and
			  pc.College_id=cc.College_id and
		      cc.course_id=jc.course_id and
			  pc.Job_fair_id=j.Job_fair_id and
			  jc.Job_fair_id=j.Job_fair_id and
			  pc.IsApproved=1 and
			  pc.IsParticipated=1 and
			  js.Job_seeker_id=$job_seeker_id";
	
	$result = mysqli_query($con,$query);
	$response["jobfairs"] = array();
	
	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_array($result))
		{
			$jobfair = array();
			$jobfair["Job_fair_id"] = $row["Job_fair_id"];
			$jobfair["Job_fair_name"] = $row["Job_fair_name"];
			$jobfair["Job_fair_start_date"] = $row["Job_fair_start_date"];
			$jobfair["Job_fair_end_date"] = $row["Job_fair_end_date"];
			$jobfair["Student_registration_start_date"] = $row["Student_registration_start_date"];
			$jobfair["Student_registration_end_date"] = $row["Student_registration_end_date"];
			array_push($response["jobfairs"],$jobfair);
		}
		$response["success"]=1;
		
	}
	else
	{
		// no jobfair as per Student criteria
		$response["success"] = 2;
		$response["message"] = "No jobfair found as per the Student criteria";
 
		// echo no users JSON
		echo json_encode($response);
	}
}
else
{
	//require field is missing
	$response["success"] = 0;
    $response["message"] = "Required Field missing";
}	
echo json_encode($response);
?>