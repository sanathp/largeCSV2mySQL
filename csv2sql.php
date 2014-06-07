
<html>
<head>
<title> csv2 sql</title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>
<br>
<h1> CSV to Mysql </h1>
<p> This Php Script Will Import very large CSV files to MYSQL database in a minute</p>

</br>
<form class="form-horizontal"action="csv2sql.php" method="post">
    <div class="form-group">
        <label for="mysql" class="control-label col-xs-2">Mysql Server address (or)<br>Host name</label>
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
	<label for="login" class="control-label col-xs-2"></label>
    <div class="col-xs-3">
    <button type="submit" class="btn btn-primary">Upload</button>
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
$cons= mysqli_connect("$sqlname", "$username","$password","$db") or die(mysql_error());

$result1=mysqli_query($cons,"select count(*) count from $table");
$r1=mysqli_fetch_array($result1);
$count1=(int)$r1['count'];
//If the fields in CSV are not seperated by comma(,)  replace comma(,) in the below query with that  delimiting character 
//If each tuple in CSV are not seperated by new line.  replace \n in the below query  the delimiting character which seperates two tuples in csv
// for more information about the query http://dev.mysql.com/doc/refman/5.1/en/load-data.html
mysqli_query($cons, '
    LOAD DATA LOCAL INFILE "'.$file.'"
        INTO TABLE '.$table.'
        FIELDS TERMINATED by \',\'
        LINES TERMINATED BY \'\n\'
')or die(mysql_error());

$result2=mysqli_query($cons,"select count(*) count from $table");
$r2=mysqli_fetch_array($result2);
$count2=(int)$r2['count'];

$count=$count2-$count1;
if($count>0)
echo "Success";
echo "<b> total $count records have been added to the table $table </b> ";


}
else{
echo "Mysql Server address/Host name ,Username , Database name ,Table name , File name are the Mandatory Fields";
}

?>
<h3> Instructions </h3>
1.  Keep this php file and Your csv file in one folder <br>
2.  Create a table in your mysql database to which you want to import <br>
3.  Open the php file from your localhost server <br>
4.  Enter all the fields  <br>
5.  click on upload button  </p>

<h3> Facing Problems ? Some of the reasons can be the ones shown below </h3>
1) Check if the table to which you want to import is created and the datatype of each column matches with the data in csv<br>
2) If fields in your csv are not separated by commas go to Line 117 of php file and change the query<br>
3) If each tuple in your csv are not one below other(i.e not seperated by a new line) got line 117 of php file and change the query<br>

</html>
