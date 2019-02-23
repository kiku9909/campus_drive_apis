<?php
include("db_connect.php");

if(isset($_POST["College_course_id"]) && isset($_POST["Student_name"]) && isset($_POST["Student_contact"]) && isset($_POST["Student_email"]) && isset($_POST["Student_gender"]) && isset($_FILES["Student_profile"]["name"]) && isset($_FILES["Student_resume"]["name"]) && isset($_POST["Student_password"]) && isset($_POST["Student_cgpa"])&&isset($_POST['isOther']))
{
	$collegecourseid = $_POST["College_course_id"];
	$name = $_POST["Student_name"];
	$contact = $_POST["Student_contact"];
	$email = $_POST["Student_email"];
	$gender = $_POST["Student_gender"];
	$profile=time().$_FILES['Student_profile']['name'];
	$resume = time().$_FILES["Student_resume"]["name"];
	$password = $_POST["Student_password"];
	$cgpa = $_POST["Student_cgpa"];
	$isother=$_POST["isOther"];
	
	$emChk = mysqli_query($con,"SELECT `Student_email` FROM `job_seeker_tb` WHERE `Student_email` = '".$email."'");

	if ($emChk->num_rows > 0) {
		$response["success"] = 3;
		$response["message"] = "Oops! Email is already taken.";
		$response["result"]="none";
		$response["query"]="query";
			// echoing JSON response
		echo json_encode($response);
	}
	else{

		$query="INSERT INTO `job_seeker_tb`(`College_course_id`, `Student_name`, `Student_contact`, `Student_email`, `Student_gender`, `Student_profile`, `Student_resume`, `Student_password`, `Student_cgpa`,`IsOther`,`Registered_date`) VALUES ($collegecourseid,'$name','$contact','$email','$gender','$profile','$resume','$password',$cgpa,$isother,".date('Y-m-d').")";

		$result = mysqli_query($con,$query);

		if($result){
			//sucessfully inserted
			//Upload Image on server Folder

			move_uploaded_file($_FILES['Student_profile']['tmp_name'],"./Uploaded_document/Picture/$profile");

			move_uploaded_file($_FILES['Student_resume']['tmp_name'],"./Uploaded_document/Resume/$resume");


			$response["success"] = 1;
			$response["message"] = "Student Record successfully created.";
			echo json_encode($response);
		}else{
			 // failed to insert row
			$response["success"] = 0;
			$response["message"] = "Oops! An error occurred.";
			$response["result"]=$result;
			$response["query"]=$query;
			// echoing JSON response
			echo json_encode($response);
		}
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