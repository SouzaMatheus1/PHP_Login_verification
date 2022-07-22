<?php
    include('conexao.php');

    if(isset($_POST['email']) || isset($_POST['senha'])){
        if(strlen($_POST['email']) == 0){
            echo"Fill in the email field";
        }else if(strlen($_POST['senha']) == 0){
            echo"Fill in the password field";
        }else{
            $email = $conn->real_escape_string($_POST['email']);
            $senha = $conn->real_escape_string($_POST['senha']);

            $sql_code = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
            $sql_query = $conn->query($sql_code) or die("Query failed".$conn->error);

            $quantidade = $sql_query->num_rows;

            if($quantidade == 1){
                $usuario = $sql_query->fetch_assoc();

                if(!isset($_SESSION)){
                    session_start();
                }

                $_SESSION['ID'] % usuario['ID'];
                $_SESSION['nome'] = $usuario['nome'];

                header("Location: painel.php");
            }else{
                echo"Login unsuccessful! Check your e-mail or password.";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f81bc8ebbf.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='style.css'>
    
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Auto-login</h1>
    </header>
    
    <main >
        <form action="painel.php" method='POST'>
        <div class='inputs'>  
            <section>
                <input type='email' name='email' placeholder="email@email.com"
                style='
                background: none;
                border-top: none;
                border-left: none;
                border-right: none;'>
            </section>

            <section>
                <input type='password' name='password' placeholder="****************">
            </section>

            <section>
                <a href="#"><button type="sumbit">Login</button>
                    </a>
            </section>
            <hr>
                Perdeu a senha?
                <a id='inputs-forgot' href="#">Recuperar senha.</a>
                <br>
                Entre também com:
            <section id='inputs-links'>
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                <a href="#"><i class="fa-brands fa-google-plus-square"></i>
            </section></a>
            
        </div>
        </form>
        
    </main>
    
    <footer>
        <p>Todos os direitos reservados&reg;</p>
    </footer>
</body>
</html>