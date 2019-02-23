<?php
include("db_connect.php");

$response=array();

if(isset($_REQUEST["company_job_post_id"]))
{
	$company_job_post_id = $_REQUEST["company_job_post_id"];
	
	$query="select c.Company_name,c.Company_address,cjp.Experience_required,cjp.Package_provided,cjp.Post_date,cjp.Post_description,
		cjp.Agreement_details
		from company_job_post_tb cjp,company_tb c,participated_company_tb pc
	    where
		cjp.Participated_company_id=pc.Participated_company_id and 
		pc.Company_id=c.Company_id and
		Company_job_post_id=$company_job_post_id";

	$result=mysqli_query($con,$query);

	$response["companyJobPostDetails"]=array();	

	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_array($result))
		{
			$jobpostdetail=array();
			$jobpostdetail["Company_name"]=$row["Company_name"];
			$jobpostdetail["Company_address"]=$row["Company_address"];
			$jobpostdetail["Experience_required"]=$row["Experience_required"];
			$jobpostdetail["Package_provided"]=$row["Package_provided"];
			$jobpostdetail["Post_date"]=$row["Post_date"];
			$jobpostdetail["Post_description"]=$row["Post_description"];
			$jobpostdetail["Agreement_details"]=$row["Agreement_details"];
			array_push($response["companyJobPostDetails"],$jobpostdetail);
			
		}
		$response["success"]=1;
		
		
}else {
    // no details found
    $response["success"] = 0;
    $response["message"] = "No Students found";
 
    // echo no users JSON
    echo json_encode($response);
	}
}
else{
	$response["success"] = 0;
    $response["message"] = "missing feild required";
}

echo json_encode($response);

?>


