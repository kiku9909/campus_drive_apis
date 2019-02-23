<?php
	include("db_connect.php");
	
	if(isset($_POST["Company_name"]) && isset($_POST["Company_address"]) && isset($_POST["Company_email"]) && isset($_POST["Company_contact_person"]) && isset($_POST["Company_contact"]) && isset($_POST["Company_webURL"]) && isset($_POST["Company_establishedOn"]) && isset($_POST["Company_password"]) && isset($_FILES["Company_logo"]["name"]))
	{
		$name = $_POST["Company_name"];
		$address = $_POST["Company_address"];
		$email = $_POST["Company_email"];
		$personName=$_POST["Company_contact_person"];
		$contact = $_POST["Company_contact"];
		$url = $_POST["Company_webURL"];
		$establishedOn = $_POST["Company_establishedOn"];
		$profile=time().$_FILES['Company_logo']['name'];
		$password=$_POST["Company_password"];
	    
		
		
		
		$query="INSERT INTO `company_tb`(`Company_name`, `Company_address`, `Company_email`,`Company_contact_person`, `Company_contact`, `Company_webURL`, `Company_establishedOn`, `Company_password`,`Registered_date`,`Company_logo`) VALUES ('$name','$address','$email','$personName','$contact','$url','$establishedOn','$password','".date('Y/m/d')."','$profile')";

		
		$result = mysqli_query($con,$query);
		
		if($result){
			move_uploaded_file($_FILES['Company_logo']['tmp_name'],"./Uploaded_document/CompanyLogo/$profile");
			//sucessfully inserted
			$response["success"] = 1;
			$response["message"] = "Company Record successfully created.";
			echo json_encode($response);
		}else{
			 // failed to insert row
			$response["success"] = 0;
			$response["message"] = "Oops! An error occurred.";
 
			// echoing JSON response
			echo json_encode($response);
	}
}
	else{
		 // required field is missing
		$response["success"] = 0;
		$response["message"] = "Required field(s) is missing";
 
		// echoing JSON response
		echo json_encode($response);
	}

?>