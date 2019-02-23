<?php
include("db_connect.php");

/*
This is for letting student to see the companies in particular drive 
*/

$response=array();
if(isset($_REQUEST["job_fair_id"]))
{
 $job_fair_id = $_REQUEST["job_fair_id"];
	

//all participated campusdrive 
$query="
SELECT pc.company_id,c.company_name,c.company_address FROM `participated_company_tb` pc, company_tb c WHERE
pc.company_id=c.company_id
and pc.job_fair_id=$job_fair_id";

$result=mysqli_query($con,$query);

$response["companyDetail"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$campusCompany=array();
			$campusCompany["company_id"]=$row["company_id"];
			$campusCompany["company_name"]=$row["company_name"];
			$campusCompany["company_address"]=$row["company_address"];
	
			array_push($response["companyDetail"],$campusCompany);
			
		}
		$response["success"]=1;
	
		
}else {
    // no Student found
    $response["success"] = 2;
    $response["message"] = "No Participation of company";
 
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


