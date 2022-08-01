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
	<title>Police stations</title>
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
					<h1>Police Stations</h1>

				</div>







				<div class="table-data">
					<div class="order">

						<div class="head">
							<h3>All police stations</h3>

						</div>

						<table>
							<thead>
								<tr>
									<th></th>
									<th>Name</th>
									<th>Code</th>
									<th>County</th>
									<th>Location</th>
									<th>Phone Number</th>

								</tr>

							</thead>

							<tbody>
								<?php
								$stations_query = mysqli_query($conn, "SELECT * FROM police_station") or die('query failed');
								if (mysqli_num_rows($stations_query) > 0) {
									while ($fetch_stations = mysqli_fetch_assoc($stations_query)) {
								?>
										<tr>
											<td></td>
											<td>
												<p><?php echo $fetch_stations['name']; ?></p>
											</td>
											<td><?php echo $fetch_stations['code']; ?></td>
											<td><?php echo $fetch_stations['county']; ?></td>
											<td><?php echo $fetch_stations['location']; ?></span></td>
											<td><?php echo $fetch_stations['phone']; ?></td>


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