<?php
include('config.inc.php');
session_start();
if($_GET['check'] == 'login'){
    $acc_email = $_POST['auth-email'];
    $acc_pass  = $_POST['auth-pass'];
    
    $sql="SELECT * FROM account Where acc_email='".$acc_email."' and acc_password='".$acc_pass."' ";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_array($result);
        $_SESSION['auth-id'] = $row['acc_id'];
        $_SESSION['auth-name'] = $row['acc_name'];
        $_SESSION['auth-email'] = $row['acc_email'];
        $_SESSION['auth-address'] = $row['acc_address'];
        $_SESSION['auth-phone'] = $row['acc_phone'];
        $_SESSION['auth-status'] = $row['acc_status'];
        
        header('Location: ?page=home');
    }else{
        echo "<script>";
        echo "alert(\" Incorrect information \");"; 
        echo "window.history.back()";
        echo "</script>";
    }
}elseif($_GET['check'] == 'register'){
    $acc_name = $_POST['auth-name'];
    $acc_email = $_POST['auth-email'];
    $acc_pass  = $_POST['auth-pass'];

    $sql="SELECT * FROM account Where acc_email='".$acc_email."' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    if(!$row){
        $query = "INSERT INTO account (acc_name,acc_email,acc_password,acc_address,acc_phone,acc_status) 
        VALUES ('$acc_name','$acc_email','$acc_pass','no detail','no detail','member')";
        mysqli_query($conn, $query);
        echo "<script>location.href='?page=home'</script>";
    }else{
    ?>
        <script>
        
        </script>
    <?php
    }
}
?>