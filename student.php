<?php
	session_start();
	$_SESSION['currentPage'] = "student";
?>
<!DOCTYPE html>
<html>
	<?php include "includes/head.php"; ?>
	<body>
		<?php include "includes/header.php";?>

		<!--Main layout-->
		<main style="margin-top: 65px;">
            <?php
                include "functions.php";
                $test;
                if(isset($_GET['empID'])){
                    $empID = htmlspecialchars($_GET['empID']);
                    $test=empReadDetails($empID);
                }
                else{
                    echo "Redirect to Home";
                }
                
            ?>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card mx-5 px-0"> 
                        <div class="container mx-0 px-0 ">
                            <h4 class="w-100 text-light bg-info p-3"><b>KBTC</b></h4> 
                            <div class="container p-5">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>ID: <?php echo $test->row0->studID; ?></p>
                                        <p>Name: <?php echo $test->row0->studName; ?></p>
                                        <p>Batch: <?php echo $test->row0->studBatch; ?></p>
                                        <p>Class: <?php echo $test->row0->studClass; ?></p>
                                        <p>Guardian Name: <?php echo $test->row0->studguardianName; ?></p>
                                        <p>Date of Birth: <?php echo $test->row0->studdateofBirth; ?></p>
                                        <p>Emergency Call 1: <?php echo $test->row0->studemergencyPhone1; ?></p>
                                        <p>Emergency Call 2: <?php echo $test->row0->studemergencyPhone2; ?></p>
                                        <p>School Emergency Call: <?php echo $test->row0->studschoolEmergency; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="border border-info p-2">
                                            <img src="assets/qrcodes/employee/<?php echo $empID; ?>.png" class="w-100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
		</main>
		<!--Main layout-->
		<?php
			include 'includes/footer.php';
		?>
	</body>
</html>
