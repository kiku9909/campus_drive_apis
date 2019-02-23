<?php
include("db_connect.php");

$response=array();
if(isset($_REQUEST["job_seeker_id"]))
{
 $job_seeker_id = $_REQUEST["job_seeker_id"];
	

//all participated campusdrive 
$query="SELECT j.job_fair_id,j.job_fair_start_date,j.job_fair_end_date,c.college_name FROM `participated_student_tb` ps, `job_fair_tb` j , `job_seeker_tb` js, `college_tb` c WHERE ps.job_seeker_id=js.job_seeker_id 
and ps.job_fair_id=j.job_fair_id 
and j.Host_college_id=c.college_id
and j.job_fair_end_date>sysdate()
and j.IsOnline=1
and ps.job_seeker_id=$job_seeker_id";

$result=mysqli_query($con,$query);

$response["campusDetail"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$campus=array();
			$campus["job_fair_id"]=$row["job_fair_id"];
			$campus["college_name"]=$row["college_name"];
			$campus["job_fair_start_date"]=$row["job_fair_start_date"];
			$campus["job_fair_end_date"]=$row["job_fair_end_date"];
			
			array_push($response["campusDetail"],$campus);
			
		}
		$response["success"]=1;
	
		
}else {
    // no Student found
    $response["success"] = 2;
    $response["message"] = "No Participation";
 
    // echo no users JSON
   
}

}
else
{
$response["success"] = 0;
    $response["message"] = "Required Field missing";
 

}
	echo json_encode($response);
?>


