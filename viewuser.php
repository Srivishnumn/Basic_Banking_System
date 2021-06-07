<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
    <link rel="stylesheet" href="css/viewuser.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">
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
    include 'connect.php';
    $sql = "SELECT * FROM `users`";
    $result = mysqli_query($con, $sql);
    ?>
    <br>
    <div id="cust">
        <p>Customers</p>
    </div>
    <br><br>
    <div>
        <table id="mytable">
            <tr>
                <th>Customer-ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
                <th>Transfer</th>
            </tr>
            <?php
                while ($rows = mysqli_fetch_assoc($result)) {
            ?>
                <tr style="color : black;">
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                    <td><a href="transfer.php?id= <?php echo $rows['id']; ?>"> <button type="button" class="btn" style="background-color : #A569BD;">Transfer</button></a></td>
                </tr>
            <?php
                }
            ?>
        </table>
    </div>
    
    <footer id="adduser">
        <p>&copy 2021. Made by <b>SriVishnu M N</b><br>THE SPARKS FOUNDATION</p>
    </footer>
</body>
</html>