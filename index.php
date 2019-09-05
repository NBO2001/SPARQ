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
<style>
#btnlogin{
  position:absolute;
  top:180px;
  left:50px;
  width:400px;
  height:10%;
  font-size: 20px;
  color:white;
  background-color: black;
  border: 1px solid black;
  border-radius: 15px;

}
#login{
  border: 1px solid black;
  border-radius: 15px;
  height:50%;
}
.loginfom{
  border-radius: 15px;
  border: 1px solid black;

}
@media (max-width: 1000px) {
#login{
  position: absolute;
  top:5%;
  left:0;
  height:90%;
  width:100%;
}
.logintitulos{
  font-size: 90px;
}
.loginfom{
  font-size: 90px;
  border: 1px solid black;
  border-radius: 15px;
}
#btnlogin{
  position: absolute;
  top:70%;
  left:25%;
  width:50%;
  height:20%;
  font-size: 50px;

}
#copra{
  position: absolute;
   top:90%;
  font-size:10%;
}
}
#copra{
  position: absolute;
   top:90%;
  font-size:80%;
}

</style>
</head>
<body class="pes_nome_body">
  <div id="login" style="">
    <form method="Post" action="logina.php" enctype="multipart/form-data">
      <labe class="logintitulos"  >Login:</label><br>
        <input id="logion1"  name="nuso" style="" class="loginfom" type="text" required></input><br>
      <labe class="logintitulos">Senha:</label><br>
        <input class="loginfom" style="" name="senuso" type="password" required></input><br><br>
        <input style="" id="btnlogin" name="btnlo" type="submit" value="Entrar"></input>
        <label id="copra" style="">&copy;2019 N.B.O<label>
    </form>

  </div>
</body>
</html>
