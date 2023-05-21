<?php
session_start();
if (!isset($_SESSION['userlogin'])) {
    header("Location: main.php");
}
$type = isset($_GET['type']) ? $_GET['type'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>e-BYRYS-KKDS</title>


    <link rel="icon" href="img/core-img/favicon.ico">


    <link rel="stylesheet" href="style.css">
    <link href='https://css.gg/arrow-left-o.css' rel='stylesheet'>


</head>

<body>

    <div>
        <form action="" method="post">
            <div class="login-box login-login">
                <h1 class="header">e-BYRYS-KKDS</h1>
                <p class="labels">Permanently delete account? </p>
                <input type="submit" name="submit" id="delete" value="delete">
                <a href="main.php" class="lower-buttons"><i class="gg-arrow-left-o"
                style="margin: 0; margin-right: 20px;"></i>Ana Sayfaya Dön</a></div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>,
    <script>

        


    $(function() {
        $('#delete').click(function(e) {
            
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'process-delete.php',
                data: {
                    id: "<?php echo $_SESSION["userlogin"]["id"]?>",
                    email: "<?php echo $_SESSION["userlogin"]["email"]?>", 
                    type: "<?php echo $type?>", 
                },
                success: function(data) {
                    alert(data)
                    if ($.trim(data) === "Başarılı") {
                        setTimeout('window.location.href = "main.php"', 600);
                    }
                },
                error: function(data) {
                    alert('Hata');
                }
            })

        })
    })
    </script>

</body>

</html>