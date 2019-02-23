<?php
	include("db_connect.php");
	$response = array();
	
	$College_id = $_REQUEST["College_id"];

	//college_static _block
	$query="SELECT  `College_name`, `College_location`, `College_email`,`College_contact` FROM `college_tb` WHERE College_id=$College_id";
	$result=mysqli_query($con,$query);

	
	//jobfair details
	$query1 = "select Host_college_id,job_fair_id,Job_fair_start_date,c.College_name from job_fair_tb j,college_tb c where j.Host_college_id=c.College_id";	
	$result1 = mysqli_query($con,$query1);
	
	//total students in job fair
	$query2 = "SELECT  COUNT(p.job_seeker_id) as Student_count
				FROM job_fair_tb j
				LEFT JOIN participated_student_tb p
				ON j.job_fair_id = p.job_fair_id
				GROUP BY j.job_fair_id";
	$result2 = mysqli_query($con,$query2);
	
	
	//total companies in job fair
	$query3 = "SELECT  COUNT(pc.Company_id) as Company_count
				FROM job_fair_tb j
				LEFT JOIN participated_company_tb pc
				ON j.job_fair_id=pc.job_fair_id
				GROUP BY j.Job_fair_id";
	$result3 = mysqli_query($con,$query3);
	
	
	//total college in job fair
	$query4 = "SELECT  COUNT(pc.College_id) as College_count
				FROM job_fair_tb j
				LEFT JOIN participated_college_tb pc
				ON j.job_fair_id=pc.job_fair_id
				GROUP BY j.Job_fair_id";
	$result4 = mysqli_query($con,$query4);
	
	
	$response["collegedetail"]=array();
	$response["jobfairdetails"] = array();
	$response["jobfairdetails1"] = array();
	$response["jobfairdetails2"] = array();
	$response["jobfairdetails3"] = array();
	

	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_array($result))
		{
			
			$college=array();
			$college["College_name"]=$row["College_name"];
			$college["College_location"]=$row["College_location"];
			$college["College_email"]=$row["College_email"];
			$college["College_contact"]=$row["College_contact"];
			array_push($response["collegedetail"],$college);
			
		}
		$response["success"]=1;
		
		
	}
		else {
			// no Student found
			$response["success"] = 0;
			$response["message"] = "may be some error exsist";
		 
		   
		}
	
	if(mysqli_num_rows($result1)>0)
	{
		$jobfairdetail = array();
		while($row1=mysqli_fetch_array($result1))
		{
			
			$jobfairdetail["Job_fair_start_date"] = $row1["Job_fair_start_date"];
			$jobfairdetail["College_name"] = $row1["College_name"];
			$jobfairdetail["job_fair_id"] = $row1["job_fair_id"];
			array_push($response["jobfairdetails"],$jobfairdetail);
		}
		$response["success"]=1;
	
	}
	else
	{
		// no job fair details
		$response["success"] = 0;
		$response["message"] = "No job fair details found";
 
		
	}
	if(mysqli_num_rows($result2)>0)
	{
		$jobfairdetail1 = array();
		while($row2=mysqli_fetch_array($result2))
		{
			$jobfairdetail1["Total_student"] = $row2["Student_count"];			
				array_push($response["jobfairdetails1"],$jobfairdetail1);
		}
		$response["success"]=1;
		
	}
	else
	{
		// no student
		$response["success"] = 0;
		$response["message"] = "No student found";
 
	
	}
	if(mysqli_num_rows($result3)>0)
	{
		$jobfairdetail2 = array();
		
		while($row3=mysqli_fetch_array($result3))
		{
			$jobfairdetail2["Total_company"] = $row3["Company_count"];			
			array_push($response["jobfairdetails2"],$jobfairdetail2);
			
		}
		$response["success"]=1;
		
	}
	else
	{
		// no company
		$response["success"] = 0;
		$response["message"] = "No Company found";
 
		
		
	}
	if(mysqli_num_rows($result4)>0)
	{
		$jobfairdetail3=array();
		while($row4=mysqli_fetch_array($result4))
		{
			$jobfairdetail3["Total_college"] = $row4["College_count"];			
			array_push($response["jobfairdetails3"],$jobfairdetail3);
		}
		$response["success"]=1;
		
	}
	else
	{
		// no college
		$response["success"] = 0;
		$response["message"] = "No College found";
 
		
		echo json_encode($response);
	}
	echo json_encode($response);
?>