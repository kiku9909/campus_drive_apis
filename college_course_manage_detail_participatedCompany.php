

<?php

//this API is for fetching  participated company detail for specied jobfair id....in college_course_manage_detail_cardview_company.
include("db_connect.php");

$response=array();

$Job_fair_id = $_REQUEST["Job_fair_id"];
	

//all course display
$query="select Company_name,Company_address,Company_webURL from company_tb c,participated_company_tb pc WHERE c.Company_id=pc.Company_id and Job_fair_id=$Job_fair_id";

$result=mysqli_query($con,$query);

$response["companydetail"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$company=array();
			$company["Company_name"]=$row["Company_name"];
			$company["Company_address"]=$row["Company_address"];
			$company["Company_webURL"]=$row["Company_webURL"];
			array_push($response["companydetail"],$company);
			
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


