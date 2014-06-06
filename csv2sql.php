
<html>
<head>
<title> csv2 sql</title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>
<br>
<br>
<h1> CSV to Mysql </h1>
<p> This Php Script Will Import very large CSV files to MYSQL database in a minute</p>
<p> Instructions :
1. Enter all the required fields 
2. enter the file name with extension
3. clock on upload button 
</br>
</br>
</br>
<form class="form-horizontal"action="index.php" method="post">
    <div class="form-group">
        <label for="mysql" class="control-label col-xs-2">Mysql addrress</label>
		<div class="col-xs-3">
        <input type="text" class="form-control" name="mysql" id="mysql" placeholder="">
		</div>
    </div>
	<div class="form-group">
        <label for="username" class="control-label col-xs-2">Username</label>
		<div class="col-xs-3">
        <input type="text" class="form-control" name="username" id="username" placeholder="">
		</div>
    </div>
	<div class="form-group">
        <label for="password" class="control-label col-xs-2">Password</label>
		<div class="col-xs-3">
        <input type="text" class="form-control" name="password" id="password" placeholder="">
		</div>
    </div>
	<div class="form-group">
        <label for="db" class="control-label col-xs-2">Database name</label>
		<div class="col-xs-3">
        <input type="text" class="form-control" name="db" id="db" placeholder="">
		</div>
    </div>
	
	<div class="form-group">
        <label for="table" class="control-label col-xs-2">table name</label>
		<div class="col-xs-3">
        <input type="name" class="form-control" name="table" id="table">
		</div>
    </div>
	<div class="form-group">
        <label for="csvfile" class="control-label col-xs-2">Name of the file</label>
		<div class="col-xs-3">
        <input type="name" class="form-control" name="csv" id="csv">
		</div>
		eg. MYDATA.csv
    </div>
	<div class="form-group">
	<label for="login" class="control-label col-xs-2">Database name</label>
    <div class="col-xs-3">
    <button type="submit" class="btn btn-primary">Login</button>
	</div>
	</div>
</form>
</div>

</body>

<?php 

if(isset($_POST['username'])&&isset($_POST['mysql'])&&isset($_POST['db'])&&isset($_POST['username']))
{
$sqlname=$_POST['mysql'];
$username=$_POST['username'];
$table=$_POST['table'];
if(isset($_POST['password']))
{
$password=$_POST['password'];
}
else
{
$password= '';
}
$db=$_POST['db'];
$file=$_POST['csv'];

echo $sqlname;
echo '<br>';
echo $username;

echo '<br>';
echo $password;
echo '<br>';
echo $db;
echo '<br>';
echo $table;
echo '<br>';
echo $file;
echo '<br>';
$cons= mysqli_connect("$sqlname", "$username","$password","$db") or die(mysql_error());

$result=mysqli_connect($cons,'select count(*) count from'.$table.'');
 $result->count();

//If the fields in CSV are not seperated by comma(,)  replace comma(,) in the below query with that  delimiting character 
//If each tuple in CSV are not seperated by new line.  replace \n in the below query  the delimiting character which seperates two tuples in csv
// for more information about the query http://dev.mysql.com/doc/refman/5.1/en/load-data.html
mysqli_query($cons, '
    LOAD DATA LOCAL INFILE "'.$file.'"
        INTO TABLE '.$table.'
        FIELDS TERMINATED by \',\'
        LINES TERMINATED BY \'\n\'
');


}





?>
</html>
