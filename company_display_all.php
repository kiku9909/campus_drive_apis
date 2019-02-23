<?php
include("db_connect.php");

$response=array();


$query="SELECT * FROM `company_tb`";

$result=mysqli_query($con,$query);

$response["companies"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$stud=array();
			$stud["Company_id"]=$row["Company_id"];
			$stud["Company_name"]=$row["Company_name"];
			$stud["Company_address"]=$row["Company_address"];
			$stud["Company_email"]=$row["Company_email"];
			$stud["Company_contact"]=$row["Company_contact"];
			$stud["Company_webURL"]=$row["Company_webURL"];
			$stud["Company_establishedOn"]=$row["Company_establishedOn"];
			$stud["Company_password"]=$row["Company_password"];
			
			array_push($response["companies"],$stud);
			
		}
		$response["success"]=1;
		echo json_encode($response);
		
}else {
    // no Student foundCompany_password
    $response["success"] = 0;
    $response["message"] = "No Company found";
 
    // echo no users JSON
    echo json_encode($response);
}




?>


