<html>

<?php

include 'config.php';
$username = "$webuser";
$password = "$webpass";
$nonsense = "$webhash";

if (isset($_COOKIE['PrivatePageLogin'])) {
   if ($_COOKIE['PrivatePageLogin'] == md5($password.$nonsense)) {
?>

<html>
<body>
<center>
<form action="insert.php" method="post">
Date: <input type="date" name="date1" required>
Description: <input type="text" name="description" required>
Deposit: (+) <input type="number" name="deposit" step="any" >
Payment: (-)<input type="number" name="payment" step="any" >
<input type="submit">
</form>

</body>
</html>

<?php
include 'config.php';
$con=mysqli_connect("$dbhost","$dbuser","$dbpassword","$dbname");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL. Make sure to edit the config.php file: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM $tablename");



echo "<table border='1'>
<tr>
<th>ID</th>
<th>Date</th>
<th>Description</th>
<th>Deposit (+)</th>
<th>Payment (-)</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {

  echo "<tr>";
  echo "<td>" . $row['ID'] . "</td>";
  echo "<td>" . $row['date1'] . "</td>";
  echo "<td>" . $row['description'] . "</td>";
  echo "<td>$" . $row['Deposit'] . "</td>";
  echo "<td>$" . $row['Payment'] . "</td>";
 
  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);
?>

Your Current balance is: $
<?php
include 'config.php';
$con = mysqli_connect("$dbhost", "$dbuser", "$dbpassword","$dbname");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }


$sql = "SELECT SUM(Deposit) FROM $tablename";
$sql2 = "SELECT SUM(Payment) FROM $tablename";
$result = mysqli_query($con,$sql);
$result2 = mysqli_query($con,$sql2);
while ($row = mysqli_fetch_array($result)) 
while ($row2 = mysqli_fetch_array($result2)) {
	printf ($row[0] - $row2[0]);
}
mysqli_close($con);
?>

	
<center>

<?php
      exit;
   } else {
      echo "Bad Cookie. Remove Cookies and try again";
      exit;
   }
}

if (isset($_GET['p']) && $_GET['p'] == "login") {
   if ($_POST['user'] != $username) {
      echo "Sorry, that username does not match.";
      exit;
   } else if ($_POST['keypass'] != $password) {
      echo "Sorry, that password does not match.";
      exit;
   } else if ($_POST['user'] == $username && $_POST['keypass'] == $password) {
      setcookie('PrivatePageLogin', md5($_POST['keypass'].$nonsense), time()+60);
      header("Location: $_SERVER[PHP_SELF]");
   } else {
      echo "Sorry, you could not be logged in at this time.";
   }
}
?>

<center>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>?p=login" method="post">
<label>Username: <input type="text" name="user" id="user" /></label><br />
<label>Password: <input type="password" name="keypass" id="keypass" /></label><br />
<input type="submit" id="submit" value="Login" />
</form>

</center>


