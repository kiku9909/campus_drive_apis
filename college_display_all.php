<?php
include("db_connect.php");

$response=array();


$query="SELECT * FROM `college_tb`";

$result=mysqli_query($con,$query);

$response["colleges"]=array();

if(mysqli_num_rows($result)>0)
{
		while($row=mysqli_fetch_array($result))
		{
			
			$stud=array();
			$stud["College_id"]=$row["College_id"];
			$stud["College_name"]=$row["College_name"];
			$stud["College_location"]=$row["College_location"];
			$stud["College_email"]=$row["College_email"];
			$stud["College_webURL"]=$row["College_webURL"];
			$stud["College_password"]=$row["College_password"];
			$stud["College_contact"]=$row["College_contact"];
			
			array_push($response["colleges"],$stud);
			
		}
		$response["success"]=1;
		echo json_encode($response);
		
}else {
    // no Student found
    $response["success"] = 0;
    $response["message"] = "No Students found";
 
    // echo no users JSON
    echo json_encode($response);
}




?>


