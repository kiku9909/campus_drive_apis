<?php
	include("db_connect.php");
	$response = array();
	
	$job_fair_id = $_REQUEST["job_fair_id"];
	
	
	$response["jobfairdetails"] = array();
	//jobfair details
	$query1 = "select Job_fair_start_date,Job_fair_end_date,Student_registration_start_date,Student_registration_end_date from job_fair_tb where Job_fair_id=$job_fair_id";	
	$result1 = mysqli_query($con,$query1);
	if(mysqli_num_rows($result1)>0)
	{
		while($row1=mysqli_fetch_array($result1))
		{
			$jobfairdetail = array();
			$jobfairdetail["Job_fair_end_date"] = $row1["Job_fair_end_date"];
			$jobfairdetail["Student_registration_start_date"] = $row1["Student_registration_start_date"];
			$jobfairdetail["Student_registration_end_date"] = $row1["Student_registration_end_date"];			
		}
		$response["success"]=1;

	}
	else
	{
		// no job fair details
		$response["success"] = 0;
		$response["message"] = "No job fair details found";
 
		
	}
	//total students in registration
	$query2 = "select count(js.Job_seeker_id) as Student_count
	from job_seeker_tb js,participated_student_tb pc,job_fair_tb jf
	where 
	js.Job_seeker_id=pc.Job_seeker_id and
	pc.Job_fair_id=jf.Job_fair_id and
	jf.Job_fair_id=$job_fair_id";
	$result2 = mysqli_query($con,$query2);
	if(mysqli_num_rows($result2)>0)
	{
		while($row2=mysqli_fetch_array($result2))
		{
			$jobfairdetail["Total_student"] = $row2["Student_count"];			
			array_push($response["jobfairdetails"],$jobfairdetail);
			if($row2["Student_count"]==0)
			{
				$response["success"]=0;
			}
			else
			{
				$response["success"]=1;
			}
		}
	
		
	
	}
	else
	{
		// no student
		$response["success"] = 0;
		$response["message"] = "No student found";
 
		// echo no users JSON
		echo json_encode($response);
	}
	
	//job post details for company
	$response["jobpostdetails"] = array();
	$query3 = "select cjp.Company_job_post_id,cjp.Post_name,c.Company_name,c.Company_webURL,c.Company_address,cjp.Post_description,cjp.Experience_required
			   from Company_job_post_tb cjp,student_priority_tb sp,Company_tb c,Participated_company_tb pc,job_seeker_tb js,
			   participated_student_tb ps,job_fair_tb j,student_applied_job_post_tb sjp
			   where
			   ps.job_seeker_id=js.job_seeker_id and
			   cjp.Participated_company_id=pc.Participated_company_id and
			   c.Company_id=pc.Company_id and
			   pc.Job_fair_id=j.Job_fair_id and
			   j.Job_fair_id=$job_fair_id
			   group by cjp.Post_name";
	$result3 = mysqli_query($con,$query3);
	
	if(mysqli_num_rows($result3)>0)
	{
		while($row3=mysqli_fetch_array($result3))
		{
			$jobid=$row3["Company_job_post_id"];
			$query6 = "select * from Company_job_post_tb cjp,student_applied_job_post_tb sajp where sajp.Company_job_post_id=cjp.Company_job_post_id and sajp.Company_job_post_id=$jobid";
			$result6 = mysqli_query($con,$query6);
			$count6=mysqli_num_rows($result6);
			
			$jobpostdetail = array();
			$jobpostdetail["Company_job_post_id"] = $row3["Company_job_post_id"];
			$jobpostdetail["Company_name"] = $row3["Company_name"];
			$jobpostdetail["Company_name"] = $row3["Company_name"];
			$jobpostdetail["Company_webURL"] = $row3["Company_webURL"];
			$jobpostdetail["Company_address"] = $row3["Company_address"];
			$jobpostdetail["Post_name"] = $row3["Post_name"];
			$jobpostdetail["Post_description"] = $row3["Post_description"];
			$jobpostdetail["Experience_required"] = $row3["Experience_required"];
			$jobpostdetail["Total_people"]=$count6;
			array_push($response["jobpostdetails"],$jobpostdetail);
		}
		$response["success"]=1;
		
	}
	else
	{
		// no job post details
		$response["success"] = 0;
		$response["message"] = "No job post details found";
 
		
	}
	//course names for job fairs
	$response["coursesname"] = array();
	$query4 = "select cc.Course_name
			   from  job_fair_tb j,college_tb c,job_fair_course_tb jfc,course_tb cc
			   where
			   j.Host_college_id=c.College_id and
			   j.Job_fair_id=jfc.Job_fair_id and
			   jfc.Course_id=cc.Course_id and
			   j.Job_fair_id=$job_fair_id";
	$result4 = mysqli_query($con,$query4);
	if(mysqli_num_rows($result4)>0)
	{
		while($row4=mysqli_fetch_array($result4))
		{
			$coursename = array();
			$coursename["Course_name"] = $row4["Course_name"];
			array_push($response["coursesname"],$coursename);
		}
		$response["success"]=1;
	}
	else
	{
		// no job post details
		$response["success"] = 0;
		$response["message"] = "No job post details found";
 
	}
	echo json_encode($response);
	
?>