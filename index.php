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

                $_SESSION['ID'] = $usuario['ID'];
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
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>