<?php
	include("db_connect.php");

	$response=array();
	$response["companyDetailByPriority"]=array();
	if(isset($_REQUEST["job_seeker_id"]) && isset($_REQUEST["job_fair_id"]))
	{
		$job_seeker_id = $_REQUEST["job_seeker_id"];
		$job_fair_id = $_REQUEST["job_fair_id"];

		//all participated company details as per the priority 
		$query="select sp.Student_priority_id,c.Company_name,c.Company_address,sp.Priority
		from student_priority_tb sp,participated_student_tb ps,job_fair_tb j,Company_tb c
		where
		sp.Participated_Student_id=ps.Participated_Student_id and
		c.Company_id=sp.Company_id and
		ps.Job_fair_id=j.Job_fair_id and
		sp.Participated_Student_id=$job_seeker_id and
		j.Job_fair_id=$job_fair_id
		order by sp.Priority";
		
		$result=mysqli_query($con,$query);

		if(mysqli_num_rows($result)>0)
		{
				while($row=mysqli_fetch_array($result))
				{
					$company = array();
					$company["Student_priority_id"] = $row["Student_priority_id"];
					$company["Company_name"] = $row["Company_name"];
					$company["Company_address"] = $row["Company_address"];
					$company["Priority"] = $row["Priority"];
					array_push($response["companyDetailByPriority"],$company);
				}
				$response["success"]=1;
		}		
		else {
				// no compnay details found as per the priority
				$response["success"] = 2;
				$response["message"] = "No company";
			 
				// echo no users JSON
			   echo json_encode($response);
			}
	}
		else
		{
			$response["success"] = 0;
			$response["message"] = "Required Field missing";
			echo json_encode($response);
		}
echo json_encode($response);

?>