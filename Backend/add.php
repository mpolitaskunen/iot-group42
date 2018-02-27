<!doctype html>
<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="$1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Weather data</title>

    <?php
    include_once 'connect.php';
    ?>

</head>
<body>
     <?php
	$temp1 = $_GET["temp1"];
	$hum1 = $_GET["hum1"];

    //if(isset($_POST['temp1'])){
    //    $sql = "INSERT INTO weather (temp1, hum1) VALUES ('".$temp1."','".$hum1."')";
    //}
	printf("%s", mysqli_connect_error());
	$stmt = mysqli_prepare($link, "INSERT INTO weather (temp1,hum1) VALUES (?,?)");
	mysqli_stmt_bind_param($stmt, 'ss', $temp1, $hum1);

        //$temp1 = $_POST['temp1'];
        //$hum1 = $_POST['hum1'];

	mysqli_stmt_execute($stmt);

	printf("%d Row inserted.\n", mysqli_stmt_affected_rows($stmt));

	mysqli_stmt_close($link);
    ?>

    <form method="post"> 
    <label id="first"> First name:</label><br/>
    <input type="text" name="username"><br/>

    <label id="first">Password</label><br/>
    <input type="password" name="password"><br/>

    <label id="first">Email</label><br/>
    <input type="text" name="email"><br/>

    <button type="submit" name="save">save</button>
    <button type="submit" name="get">get</button>
    </form>

</body>
</html>
