<link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
<style>
	 h1 {
                  font-family:cursive;
                  color:black;
                  font-size:50px; 
         }
         body {
                  background: #fdf6e3;
         }
         input {
                  font-size:30px;
                  margin-top: 10px;
         }
         form {
                  color:black;
                  margin-top:20px;
                  font-size:20px;
         }
         .container {
                  padding: 5px;
                  background: #fdf6e3;
                  width: 100%;
                  margin:50px auto;
         }

</style>


<div class='container'>

	<h1>會員登入</h1>

	<form action='loginn.php' method='POST'>
		帳號 :<br> <input type='text' name = 'usernames'/><br>
		密碼 :<br> <input type='password' name = 'passwords' /><br>
		<input class='btn btn-light' type='submit' value= '登入' class='login'/>
		<a href="register.php"><input class='btn btn-light' type='button' value= '註冊' / ></a>
	</form>

</div>
