<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
    <link rel="stylesheet" href="css/viewuser.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/history.css">
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
    <?php
    include 'connect.php'
    ?>
    <br>
    <div class="th1">
        <p>Transaction History</p>
    </div>
    <br><br>
    <div>
        <table id="mytable">
            <tr>
                <th>Transaction-ID</th>
                <th>Payer</th>
                <th>Payee</th>
                <th>Amount</th>
            </tr>
            <?php
        $sql = "SELECT * FROM `transfers` ORDER BY transfer_id DESC LIMIT 10";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<form method ='post' action = 'acustomer.php'>";
            echo "<td>". $row['transfer_id'] . "</td>
            <td>". $row['payer'] . "</td>
            <td>". $row['payee'] . "</td>
            <td>". $row['amount'] . "</td>";
            echo "</form>";
           echo  "</tr>";
        }
        ?>
        </table>
    </div>

    <br><br>
    <footer id="hist">
        <p>&copy 2021. Made by <b>SriVishnu M N</b><br>THE SPARKS FOUNDATION</p>
    </footer>
</body>
</html>