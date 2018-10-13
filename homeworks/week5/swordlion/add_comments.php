

<?php
	
	$is_login = false;
	$user_id='';

	if (isset($_COOKIE["member_id"]) && !empty($_COOKIE["member_id"])) {
		$is_login = true;
    	$user_id = $_COOKIE["member_id"];
    } 


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<title>留言板</title>
		<script src="script.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	<script method='jquery'> 
		$(document).ready(function() {
			$(document).on("submit","form",function(e) {
				e.preventDefault();
				const content = $(e.target).find('input[name=content]').val();
				const mainoradd = $(e.target).find('input[name=mainoradd]').val();
				
				$.ajax ({
					type: 'POST',
					url: 'posttocomments.php',
					data: {
						content: content ,
						mainoradd: mainoradd,
					},
					success: function(resp) {
						var res = JSON.parse(resp);
						var id = res.userid;
						if(res.result === 'success') {
							$('.container2').prepend(`
								<div class='contentarea'>
									<div class='nickname'>${res.username}</div>
									<div class='time'>${res.time}</div>
									<hr>
									<div class='content'>${content}</div>
										<div class='littlebox'>
											<div class='openbox'>回應→</div>
											<form action='posttocomments.php' method="POST">
												<input class='content' name='content' type ='text' placeholder="留言內容" /><br>
												<input type='hidden' name="mainoradd" value= ${res.userid}>
												<input class='submit' type ='submit' value='留言'/>
											</form>
										</div>
									</div>
								`)
						}
						if(res.result === 'success2') {
							

							$('.littlebox').find('input[name=mainoradd]').each(function() {
								var input_value=$(this).val();
								if(input_value == mainoradd) {
									if($(this).parent().parent().prev().hasClass('addcomments')) {
										$(this).parent().parent().parent().find('div[class=addcomments]').first().before(`
											<div class='addcomments'>
												<div class='nickname'>${res.username}</div>
												<div class='time'>${res.time}</div>
												<hr>
												<div class='content'>${content}</div>
											</div>
										`);
									} else {
										$(this).parent().parent().before(`
											<div class='addcomments'>
												<div class='nickname'>${res.username}</div>
												<div class='time'>${res.time}</div>
												<hr>
												<div class='content'>${content}</div>
											</div>
										`);
									}
								}
							})
						}
					}
				});
			})
		})
	</script>
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
				  <a class="navbar-brand" href="add_comments.php">留言板</a>
				  <?php 
				    if ($is_login) {
					    require('conn.php');
						$stmt = $conn->prepare("SELECT * from users_certificate WHERE certificate =?");
						$stmt-> bind_param("s", $_COOKIE["member_id"]);
						$stmt->execute();
						$findit = $stmt->get_result();
						$findit2 = $findit->fetch_assoc();
						echo "<div style='color:red;'> Welcome, ".$findit2['username'] ."</div>";	
				?>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				</button>
				    <div class="collapse navbar-collapse" id="navbarNav">
				      <ul class="navbar-nav">
				        <li class="nav-item active">
				          <a class="nav-link" href="logout.php">登出 <span class="sr-only">(current)</span></a>
				        </li>
				<?php 
						} else {
							echo "<div style='color:red;'>Welcome!!</div> ";
				?>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					   <span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav">
					      <li class="nav-item">
					        <a class="nav-link" href="login.php">登入</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="register.php">註冊</a>
					      </li>
				<?php
					}		
				?>
				    	</ul>
					</div>
				</nav>

		<div class ='container'>

			<div class= 'box'>
				<form action='posttocomments.php' method='POST'>
					<input class='content' name='content' type ='text' placeholder="留言內容" /><br>
					<input type='hidden' name="mainoradd" value='0' />
					<?php
						if ($is_login) {
							echo "<input class='submit' type ='submit' value='留言'/>";
						} else {
							echo "<input class='submit' type ='submit' value='請先登入'/>";
						}
					?>
				</form>


			</div>
		</div>

		<div class='container2'>
		<?php

			require('conn.php');

			$stmt2 =$conn->prepare("SELECT * FROM users LEFT JOIN comments ON comments.user_id = users.id WHERE mainoradd = 0 ORDER BY created_at DESC");
			$stmt2->execute();
			$insure = $stmt2->get_result(); 

			if ($insure->num_rows >0) {
				while ( $data = $insure->fetch_assoc()) {
					require('maincomment.php');

					if ($data["user_id"] == $user_id) {
						require('revise.php');		
					}

					$stmt3 = $conn->prepare("SELECT * FROM comments LEFT JOIN users ON comments.user_id = users.id WHERE mainoradd =? ORDER BY created_at DESC");
					$stmt3->bind_param("s" , $data["id"]);
					$stmt3->execute();
					$addfindexe = $stmt3->get_result();

					if ($addfindexe->num_rows >0) {
						while ( $data2 = $addfindexe->fetch_assoc()) {
							require('subcomment.php');
			
							if ($data2["user_id"] == $user_id) {
								require('revise.php');
					}
		?>			
				</div>
		<?php			
					}
				}	
			    require('response.php')
		?>
				</div>
		<?php
				}
			}	
		?>
	</div>
}
</html>

