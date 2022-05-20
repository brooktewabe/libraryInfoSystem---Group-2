



<?php 
    require_once('./config/dbconfig.php'); 
   

$host="localhost";
$user="root";
$password="";
$database="library";
$ISBN="";
$title="";
$author="";
$edition="";
$price="";
$NoOfCopy="";
$ID="";
$FirstName="";
$LastName="";
$NoOfCheckedOut="";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try{
$connect=mysqli_connect($host, $user,$password,$database);
if($connect)
echo"connected succesfully";
}
catch(mysqli_sql_exception $ex)
{
echo'error';
}
function getPosts()
{
$posts=array();
$posts[0]=$_POST['ISBN'];
$posts[1]=$_POST['title'];
$posts[2]=$_POST['author'];
$posts[3]=$_POST['edition'];

$posts[5]=$_POST['NoOfCopy'];
$posts[6]=$_POST['ID'];
$posts[7]=$_POST['FirstName'];
$posts[8]=$_POST['LastName'];
$posts[9]=$_POST['NoOfCheckedOut'];
return $posts;
}
//search
if(isset($_POST['search']))
{
$data=getPosts();
$search_Query="SELECT * FROM books WHERE ISBN=$data[0]";
$search_Result=mysqli_query($connect,$search_Query);
if($search_Result)
{
	if(mysqli_num_rows($search_Result))
		{
			while($row=mysqli_fetch_array($search_Result))
			{
			$ISBN=$row['ISBN'];
			$title=$row['title'];
			$author=$row['author'];
			$edition=$row['edition'];
			$price=$row['price'];
			$NoOfCopy=$row['NoOfCopy'];
			}
		}
	else
	{
	echo 'no data for this ISBN';
}
}
else
{
echo'result error';
}
}
//search customer
if(isset($_POST['search1']))
{
$data=getPosts();
$search_Query1="SELECT * FROM customers WHERE ID=$data[6]";
$search_Result1=mysqli_query($connect,$search_Query1);
if($search_Result1)
{
	if(mysqli_num_rows($search_Result1))
		{
			while($row=mysqli_fetch_array($search_Result1))
			{
			$ID=$row['ID'];
			$FirstName=$row['FirstName'];
			$LastName=$row['LastName'];
			
			}
		}
	else
	{
	echo 'no data for this ID';
}
}
else
{
echo'result error';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Check out</title>
</head>
<body class="bg-dark">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2> Checkout book </h2>
                    </div>
                        <div class="card-body">
                            <form method="POST" action="checkOut.php">
				<div class="card-footer">
				<h4>Customer Information</h4>
                                ID:<input type="number" name="ID" placeholder=" ID" class="form-control mb-2"    value="<?php echo $ID;?>">
                                <input type="submit" name="search1" value ="Search" >
				</div>
				First Name: <input type="text" name="FirstName" placeholder="First Name " class="form-control mb-2" readonly   value="<?php echo $FirstName; ?>">
                                Last Name: <input type="text" name="LastName" placeholder=" Last Name" class="form-control mb-2" readonly   value="<?php echo $LastName; ?>">
                                No of checked out: <input type="number" name="NoOfCheckedOut" placeholder="No. Of Checked Out" class="form-control mb-2"  value="<?php echo $NoOfCheckedOut; ?>">
                               
                        <hr></div>
                        
                        <div class="card-body">
                            <form method="POST" action="checkOut.php">
				<div class="card-footer">
				<h4>Book Information</h4>
                                ISBN:<input type="number" name="ISBN" placeholder=" ISBN" class="form-control mb-2"    value="<?php echo $ISBN;?>">
                                <input type="submit" name="search" value ="Search">
				</div>
                                Title: <input type="text" name="title" placeholder=" Title" class="form-control mb-2" readonly   value="<?php echo $title; ?>">
                                Author: <input type="text" name="author" placeholder=" Author" class="form-control mb-2"  readonly  value="<?php echo $author; ?>">
                                Edition: <input type="number" name="edition" placeholder=" Edition" class="form-control mb-2"  readonly  value="<?php echo $edition; ?>">
				Customer ID: <input type="number" name="I" placeholder="ID" class="form-control mb-2"  value="<; ?>">	
				Available no. of copy:<br>(Make sure to count 1 down while checking out) <input type="number" name="NoOfCopy" placeholder="No. of copy" class="form-control mb-2" value="<?php echo $NoOfCopy; ?>">
				Borrow Date: <input type="date" name="borrowDate" placeholder="Borrow Date" class="form-control mb-2"  value="<; ?>">
				Due Date: <input type="date" name="deuDate" placeholder="Due date" class="form-control mb-2"  value="<; ?>">
                        </div>
                    <div class="card-footer">
                            <input type="submit" name="check_out" class="btn btn-success" value="Check Out">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>