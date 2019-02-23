<?php

/*

based on job_seeker_id and job_fair_id you first need to find participated_student_id
then insert in student_priority_tb (participated_student_id,company_id,priority) 
default priority will be 1,2,3 then from next activity it will be updated

Then find student_priority_id and insert Student_priority_id and Company_job_post_id using loop as multiple posts

*/
include("db_connect.php");

	
	if(isset($_REQUEST["job_seeker_id"]) && isset($_REQUEST["job_fair_id"]) && isset($_REQUEST["selctedPostString"]) && isset($_REQUEST["company_id"]))
	{
		$job_seeker_id = $_REQUEST["job_seeker_id"];
		$job_fair_id = $_REQUEST["job_fair_id"];
		$selctedPostString = $_REQUEST["selctedPostString"];
		$company_id=$_REQUEST["company_id"];
		
		//Fetching participated_student_id 	
		
		
		$query="SELECT participated_student_id  FROM `participated_student_tb` WHERE job_seeker_id=$job_seeker_id and job_fair_id=$job_fair_id";
		
		$ParticipatedStudResult = mysqli_query($con,$query);
		if(mysqli_num_rows($ParticipatedStudResult)>0)
		{
			while($row=mysqli_fetch_array($ParticipatedStudResult))
			{
				$participated_student_id=$row["participated_student_id"];
			}
			
				//now insert this in student_priority_tb
		
			$query1="INSERT INTO `student_priority_tb`(`Participated_student_id`, `Company_id`, `Priority`) VALUES ($participated_student_id,$company_id,1)";
			$insertResult=mysqli_query($con,$query1);
				if($insertResult){
				//Get the last inserted id
				$query2="SELECT max(`Student_priority_id`) as  Student_priority_id FROM `student_priority_tb`";
				$lastInsertedIDResult=	mysqli_query($con,$query2);
				if(mysqli_num_rows($lastInsertedIDResult)>0)
				{
						while($row=mysqli_fetch_array($lastInsertedIDResult))
						{
							$student_priority_id=$row["Student_priority_id"];
						}
					//Now insert into student_applied_job_post_tb
					$selctedPostString=rtrim($selctedPostString," ");
					$selctedPostString=explode(" ",$selctedPostString);
										
					foreach($selctedPostString as $item)
					{
					
					  $query="INSERT INTO `student_applied_job_post_tb`(`Student_priority_id`, `Company_job_post_id`) VALUES ($student_priority_id,$item)";
					  $result = mysqli_query($con,$query);
					  if($result)
					  {
						$response["success"]=1;
						$response["message"]="You successfully applied";
					  }
					}
								
				}
				
			}

			
			
		}
	
			
	}	
	else
	{
		$response["success"]=0;
		$response["message"]="Required fields missing";
	}
	echo json_encode($response);

?>