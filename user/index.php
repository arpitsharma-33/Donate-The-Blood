
<?php 

include 'include/header.php';
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){

if(isset($_POST['date'])){

$showForm = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Are you sure , you want a save the life. If you press yes, then you will not be able to donate before 3 months.</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
<form target="" method="post">
<br>
<input type="hidden" name="userID" value="'.$_SESSION['user_id'].'">
<button type="submit" name="updateSave" class="btn btn-danger">Yes</button>

<button type="button" class="btn btn-info" data-dismiss="alert">
<span aria-hidden="true">Oops! No </span>
</button>      
</form>
</div>
';
}

              if(isset($_POST['userID'])){

				$userID = $_POST['userID'];

				$crntDate = date_create();
				$crntDate = date_format($crntDate, 'Y-m-d');

                $sql = "UPDATE donor SET save_life_date = '$crntDate' WHERE id='$userID'";

				if(mysqli_query($connection,$sql)){

$_SESSION['save_life_date'] = $crntDate;
					header("Location: ../index.php");
				}else{

					$submitError = ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>OOPS.. SOMETHING WENT WRONG . DATA NOT INSERTED. TRY AGAIN #</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>';
				}
			  }
	
?>


<style>
	h1,h3{
		display: inline-block;
		padding: 10px;
	}

	.name{
		color: orange;
		/* background-color:rgb(87, 159, 223); */
		font-size: 17px;
		font-weight: 700;
	}
	.donors_data{
		
		background-color:whitesmoke;
		border-radius: 10px;
		margin:20px 5px 0px 5px;
		-webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		-moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		padding: 30px;
	}
</style>

			<div class="container" style="padding: 60px 0;">
			<div class="row">
				<div class="col-md-12 col-md-push-1">
					<div class="panel panel-default" style="padding: 20px;">
						<div class="panel-body">

						<?php if(isset($submitError)) echo $submitError; ?>
							
								<div class="alert alert-danger alert-dismissable" style="font-size: 18px; display: none;">
    						
    								<strong>Warning!</strong> Are you sure,you want a save the life. If you press yes, then you will not be able to donate before 3 months.
    							
    							<div class="buttons" style="padding: 20px 10px;">
    								<input type="text" value="" hidden="true" name="today">
    								<button class="btn btn-primary" id="yes" name="yes" type="submit">Yes</button>
    								<button class="btn btn-info" id="no" name="no">No</button>
    							</div>
  							</div>
							<div class="heading text-center">
								<h3>Welcome </h3> <h1> <?php   if(isset(	$_SESSION['name']))  echo 	$_SESSION['name'];   ?></h1>
							</div>
							<p class="text-center">Here you can manage your account & update your profile</p>

					<div class="test-success text-center" id="data" style="margin-top: 20px;">
						<?php if(isset($showForm)) echo $showForm;    ?></div>

			<?php

                             $safeDate = $_SESSION['save_life_date'];

							 if($safeDate == '0'){
								echo '<form target="" method="post" action="">
								<button style="margin-top: 40px;" type="submit" name="date" id="save_the_life" class="btn btn-lg btn-danger center-aligned ">Save The Life</button>
								</form>';
	                            
							 }else{
                                     
								$start = date_create("$safeDate");
								$end   = date_create();
								$diff  = date_diff( $start , $end );

								//$diffYear = $diff->y;
								$diffMonth = $diff->m;
								//$diffDays = $diff->d;

								// echo $diffYear."   ";
								if ($diffMonth >=3){
									echo '<form target="" method="post" action="">
								<button style="margin-top: 40px;" type="submit" name="date" id="save_the_life" class="btn btn-lg btn-danger center-aligned ">Save The Life</button>
								</form>';
	                            

								}else{

								// echo $diffDays."   ";


                                echo '<div class="donors_data">
								<span class="name">Congratulations!       .</span>
								<span>You have saved a life. You can donate now after three months. We are very thankful to you.</span>
								</div>';
							 }
							}


                            ?>
							

							<!-- Display Message here-->
							

						
						
						  
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
<?php
}else{
	header("Location: ../index.php");
}


include 'include/footer.php'; 
?>