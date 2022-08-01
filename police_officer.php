<?php
include("admin_header.php");

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
	header('location:admin_login.php');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Police Officers</title>
	<!-- custom css file link  -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/admin_style.css">
	<link rel="stylesheet" href="css/admin.css">
</head>

<body>

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Police Officers</h1>

				</div>







				<div class="table-data">
					<div class="order">

						<div class="head">
							<h3>All police officers</h3>

						</div>

						<table>
							<thead>
								<tr>
									<th></th>
									<th>Full name</th>
									<th>Email</th>
									<th>Phone Number</th>
									<th>Work Id</th>
									<th>Police Station</th>
									<th>Postal Address</th>

								</tr>

							</thead>

							<tbody>
								<?php
								$police_query = mysqli_query($conn, "SELECT * FROM police") or die('query failed');
								if (mysqli_num_rows($police_query) > 0) {
									while ($fetch_police = mysqli_fetch_assoc($police_query)) {
								?>
										<tr>
											<td></td>
											<td>
												<p><?php echo $fetch_police['fullname']; ?></p>
											</td>
											<td><?php echo $fetch_police['email']; ?></td>
											<td>
												<p><?php echo $fetch_police['phone']; ?></p>
											</td>
											<td><?php echo $fetch_police['workid']; ?></span></td>
											<td><?php echo $fetch_police['station']; ?></td>
											<td><?php echo $fetch_police['postaladdress']; ?></td>


										</tr>







					</div>
			<?php }
								}
			?>


			</tbody>
			</table>
				</div>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->



</body>

</html>