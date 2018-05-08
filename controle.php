<html>
<head>
    <meta charset="utf-8">
    <title>Inlogscherm</title>
</head>
<body>

<form action="controle.php" method="POST">
    <?php
    session_start();
    $_SESSION['email']=$_POST['email'];
    $_SESSION['wachtwoord']=$_POST['wachtwoord'];
    $_SESSION['rol']=$_POST['rol'];


    // controleren inlognaam/wachtwoord in database

    include('include/db.php');
    $conn=fnConndb();
    $query="
            SELECT emailadres, wachtwoord  
            FROM " .$_SESSION['rol']. " 
            WHERE emailadres='" .$_SESSION['email']. "' and wachtwoord='" .$_SESSION['wachtwoord']. "' ";

    $result=mysqli_query($conn, $query);




    // controle aantal records

    $aantal=mysqli_num_rows($result);
    if ($aantal==1)
    {
        header('refresh:0; url=dashboard.php');
    }
    else
    {
        header('refresh:0; url=startscherm.php');
    }
    ?>

</form>

</body>
</html>