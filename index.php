<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf=8">
<title>Tela inicial</title>
<link rel="stylesheet" type="text/css" href="estilo.css">
<?php
  if(isset($_SESSION['ifon'])){
    echo $_SESSION['ifon'];
    unset ($_SESSION['ifon']);

  }
?>
</head>
<body class="pes_nome_body">
  <div id="login" style="border: 1px solid black;border-radius: 15px;height:50%;">
    <form method="Post" action="logina.php" enctype="multipart/form-data">
      <labe class="logintitulos"  >Login:</label><br>
        <input name="nuso" style="border: 1px solid black;border-radius: 15px;" class="loginfom" type="text" required></input><br>
      <labe class="logintitulos">Senha:</label><br>
        <input class="loginfom" style="border: 1px solid black;border-radius: 15px;" name="senuso" type="password" required></input><br><br>
        <input style="position:absolute;top:180px;left:50px; font-size: 20px;color:white;background-color: black;border: 1px solid black;border-radius: 15px;width:400px;height:10%;" id="btnlogin" name="btnlo" type="submit" value="Entrar"></input>
    </form>
    <label style="position: absolute; top:300px; font-size:15px;">&copy;2019 N.B.O<label>
  </div>
</body>
</html>
