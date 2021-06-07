<?php
include 'connect.php';
if (isset($_POST['submit'])) {
    $from = $_GET['id']; 
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * FROM users WHERE id=$from";
    $query = mysqli_query($con, $sql);
    $sql1 = mysqli_fetch_array($query);
    
    $sql = "SELECT * FROM users WHERE id='$to'";
    $query = mysqli_query($con,$sql);
    $sql2 = mysqli_fetch_array($query);

    if(($amount) < 0){
        echo '<script type="text/javascript">';
        echo ' alert("Negative values cannot be transferred")';
        echo '</script>';
    }

    elseif ($amount > $sql1['balance']) {
        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance")';
        echo '</script>';
    }

    elseif ($amount == 0){
        echo '<script type="text/javascript">';
        echo 'alert("Oops! Zero value cannot be transfered">';
        echo '</script>';
    }
    else{
        $newbalance = $sql1['balance']-$amount;
        $sql = "UPDATE users SET balance=$newbalance where id=$from";
        mysqli_query($con,$sql);

        $newbalance = $sql2['balance']+$amount;
        $sql = "UPDATE users SET balance=$newbalance where id=$to";
        mysqli_query($con,$sql);

        $payer = $sql1['name'];
        $payee = $sql2['name'];
        $sql = "INSERT INTO transfers(`payer`, `payee`, `amount`) VALUES ('$payer', '$payee', '$amount')";
        $query = mysqli_query($con,$sql);

        if($query){
            echo "<script> alert('Transaction Successful'); 
            window.location='history.php';
            </script>";
        }

        $newbalance = 0;
        //$newbalance2 = 0;
        $amount = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
    <link rel="stylesheet" href="css/viewuser.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/transfer.css">
</head>
<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">Sparks Foundation Bank</label>
        <ul>
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="viewuser.php">View Customers</a></li>
            <li><a href="history.php">Transfer History</a></li>
        </ul>
    </nav>
    <br><br>
    <?php
    include 'connect.php';
    $sid = $_GET['id'];
    ?>
    <ul class="heading">
    <li>Payer Details&nbsp&nbsp:</li><li>Payee Details&nbsp&nbsp:</li>
    </ul>
    <br><br>
    <div>
        <div class="leftdiv">
        <?php
            //if (isset($_SESSION['user']))
            //{
            //$user=$_SESSION['user'];
            $result=mysqli_query($con,"SELECT * FROM users WHERE id='$sid'");
            while($row=mysqli_fetch_array($result))
            {
                echo "<p><b class='font-weight-bold'>Customer ID</b> &nbsp;: ".$row['id']."</p><br>";
                echo "<p name='sender'><b class='font-weight-bold'>Name&nbsp;&nbsp;</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$row['name']."</p><br>";
                echo "<p><b class='font-weight-bold'>Email ID</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$row['email']."</p><br>";
                echo "<p><b class='font-weight-bold'>Balance</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;<b>&#8377;</b> ".$row['balance']."</p>";
            }         
            //}
        ?>
        </div>
        <div class="rightdiv">
            <form name="transaction" method="post">
            <div style="padding-top:2%;display:inline;">
            </div>
            <p style="margin-left:45px;"><b style="font-size:28px;">Payer ID&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;<?php echo "$sid" ?>
            <br><br><br>
            <b style="font-size:28px;">Enter Reciever ID&nbsp;&nbsp;&nbsp;:</b>
            <input name="to" type="number" style="width: 200px; height: 30px" required>
            <br><br><br>
            <b style="font-size:28px;">Amount to be transferred &#8377;:</b>
            <input name="amount" type="number" style="width: 200px; height: 30px" min="100" required>
            <br><br><br>
            <button class="transferbut" type="submit" name="submit"><b>Transfer</b></button>
            </form>
        </div>
    </div>
    <footer id="transfoot">
        <p>&nbsp;&copy 2021. Made by <b>SriVishnu M N</b><br>THE SPARKS FOUNDATION</p></p>
    </footer>
</body>
</html>