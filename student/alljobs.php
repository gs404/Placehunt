<?php 

require_once('sidenav.php');
require_once('../includes/studentfunctions.php');

session_start();
if(!isset($_SESSION['name'])){
	header('location: ../index.php');
}	

function eligible($expected){
	global $connection;
	$name=$_SESSION['name'];
	$query = "SELECT grad_cgpa FROM education WHERE education_id = (SELECT proid FROM student_profile WHERE proid=(SELECT SID FROM STUDENT WHERE NAME= '$name'))";
	if(mysqli_query($connection, $query)) {
        $cgpa = mysqli_fetch_all(mysqli_query($connection, $query), MYSQLI_ASSOC)[0]['grad_cgpa'];
    }

    if($cgpa>=$expected){
    	return "";
    }
    else {
    	return "disabled";
    }
}

function apply(){
	global $connection;
	$name=$_SESSION['name'];
	echo $name;
}

function getalljobshtml($jobs){
    $jobshtml = "";
    foreach($jobs as $job){

        $jobshtml = $jobshtml."<tr>";
        $jobshtml = $jobshtml."<td>".$job['jid']."</td>";
		$jobshtml = $jobshtml."<td>".$job['title']."</td>";
		$jobshtml = $jobshtml."<td>".$job['skills']."</td>";
		$jobshtml = $jobshtml."<td>".$job['description']."</td>";
		$jobshtml = $jobshtml."<td>".$job['salary']."</td>";
		$jobshtml = $jobshtml."<td>".$job['CGPA']."</td>";
		$jobshtml = $jobshtml."<td> <input type='button' id='".$job['jid']."' onclick='apply(".$job['jid'].")' value='apply'".eligible($job['CGPA'])."></td>";
		$jobshtml = $jobshtml."</tr>";


    }

    return $jobshtml;
}

$alljobs = getalljobs();
$alljobshtml = getalljobshtml($alljobs);

?>

		<style>

		.widget {
			flex-basis: 350px;
			flex-grow: 10;
			height: 550px;
			margin: 5%;
			border-radius: 2px;
			border: none;
			background-color: #ffffff;
			position: relative;
			box-shadow: 0px 0px 25px black;
			transition: all 0.81s ease;
		}
		table {
		    border-collapse: collapse;
		    width: 100%;
		}
		th {
			background: blue;
		}
		th, td {
		    padding: 8px;
		    text-align: left;
		    border-bottom: 2px solid #ddd;
		}
		tr:hover {background-color:#f5f5f5;}
		</style>


		<div class="main-content">
			<div class="title">
				<?php echo $_SESSION['name']."'s" ?> Applied jobs
			</div>
			<div class="main">
				<div class="widget">
					<div class="title">Jobs</div>
					<table>
					  <tr>
					    <th>Id</th>
					    <th>Title</th>
					    <th>Skills</th>
						<th>Description</th>
						<th>Salary</th>
						<th>CGPA</th>
						<th>Apply</th>
					  </tr>
					  <?php 
                        echo $alljobshtml;
                      ?>
					</table>
					<!--div class="overlay-wid">
					    <div class="text">Here You can view your applied jobs</div>
					</div-->
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			function apply(jid) {
				<?php
					echo 1+2;
				?>
			}
		</script>

	</body>
</html>