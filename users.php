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
	<title>Users</title>
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
					<h1>Public Users</h1>

				</div>







				<div class="table-data">
					<div class="order">

						<div class="head">
							<h3>All users</h3>

						</div>

						<table>
							<thead>
								<tr>
									<th></th>
									<th>firstname</th>
									<th>lastname</th>
									<th>Email</th>
									<th>Phone Number</th>
									<th>Town</th>
									<th>ID number</th>

								</tr>

							</thead>

							<tbody>
								<?php
								$users_query = mysqli_query($conn, "SELECT * FROM public") or die('query failed');
								if (mysqli_num_rows($users_query) > 0) {
									while ($fetch_users = mysqli_fetch_assoc($users_query)) {
								?>
										<tr>
											<td></td>
											<td>
												<p><?php echo $fetch_users['firstname']; ?></p>
											</td>
											<td><?php echo $fetch_users['lastname']; ?></td>
											<td>
												<p><?php echo $fetch_users['email']; ?></p>
											</td>
											<td><?php echo $fetch_users['phone']; ?></span></td>
											<td><?php echo $fetch_users['town']; ?></td>
											<td><?php echo $fetch_users['idnumber']; ?></td>


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