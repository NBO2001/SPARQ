<?php
session_start();
if($_SESSION['msg']<>4){
header("Location:index.php");
}
include_once "ConAL.php";
$result_usuario = "SELECT * FROM log";
$resultado_usuario = mysqli_query($conn, $result_usuario);
?>
<!DOCTYPE>
<html lang=pt-br>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css">

<title>Usuarios</title>
<?php
  if(isset($_SESSION['ifon'])){
    echo $_SESSION['ifon'];
    unset ($_SESSION['ifon']);

  }
?>
</head>
<body>
  <div style="width: 1400px;" id = "logo">
  <h1 id="itu" >------  Arquivo acadêmico - PROEG  --------</h1>
  </div>
<div style="overflow: auto;height: 200px;border:solid 1px;position:absolute;width:1115px;left:150px;top:40px;">
<table style="position:absolute;top:0px;" id='minhaTabela'>
   <thead>
        <tr>
             <th>ID</th>
             <th>Usuario</th>
             <th>Senha</th>
             <th>Nivel de acesso</th>
             <th>Setor</th>

        <tr>
   </thead>
   <tbody>
     <?php
     while($row_usuario = mysqli_fetch_array($resultado_usuario)){
     ?>
        <tr>
             <td><?php echo $row_usuario['id'];?></td>
             <td><?php echo $row_usuario['ursu']; ?></td>
             <td><?php echo $row_usuario['senha']; ?></td>
             <td><?php echo $row_usuario['acesso']; ?></td>
             <td><?php echo $row_usuario['setor']; ?></td>

             </tr>
           <?php } ?>

   </tbody>
</table>
</div>
<div>
<form method="POST">
  <input id="bv" type="text" name="nome">
  <input id= "san" style="position:absolute;width:250px;left:680px;top:260px;"name="sand" type="submit" value="Abrir detalhes">
</form>
<form method="POST" action="admini.php">
  <input id="bv" type="text" name="nome">
  <input id= "san" style="position:absolute;width:120px;left:480px;top:260px;" name="sand" type="submit" value="Voltar">
</form>
</div>

<?php $nun = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
if($nun <> ""){
    $vl ="SELECT * FROM log WHERE id LIKE '".$nun."'";
    $rvl = mysqli_query($conn, $vl);
    $linha = mysqli_fetch_assoc($rvl);
    $ida = $linha['id'];
    $usuario = $linha['ursu'];
    $senha = $linha['senha'];
    $acesso = $linha['acesso'];
    $setor = $linha['setor'];
    if ($linha['id']==""){
      echo "<script>alert('Usuario não existe!!')</script>";
    }else{
      echo " <form method='POST' action='up_uso.php'>
      <label class='formataurd' style='left:0px;top:560;font-size:40px;'>Id:</label>
       <input class='formataurd' style='left:410px;top:560;' type='text' name='ida' value='$ida' readonly><br><br>
      <label class='formataurd' style='left:0px;top:320;font-size:40px;'>Nome de usuario:</label>
       <input class='formataurd' style='left:410px;top:320;' type='text' name='usernome' value='$usuario'><br><br>
       <label class='formataurd' style='left:0px;top:380;font-size:40px;'>Setor:</label>
       <input class='formataurd' style='left:410px;top:380;' type='text' name='setor' value='$setor'><br><br>
       <label style='left:0px;top:440;' class='formataurd'>Digite a senha:</label>
       <input class='formataurd' style='left:410px;top:440;' type='text' name='senhauso'value='$senha' required><br><br>
       <label class='formataurd' style='left:0px;top:500;'>Nivel de acesso</label>
       <input class='formataurd' style='left:410px;top:500;' type='number' min='1' max='4' value='$acesso' name='acesso' required><br><br>
      <input class='formataurd' style='left:820px;top:380;' type='submit' value='Atualizar'>
       </form>";
    }
}
?>



<script type="text/javascript">
var tabela = document.getElementById("minhaTabela");
var linhas = tabela.getElementsByTagName("tr");
for(var i = 0; i < linhas.length; i++){
var linha = linhas[i];
linha.addEventListener("click", function(){
selLinha(this, false);
});
}
function selLinha(linha, multiplos){
if(!multiplos){
var linhas = linha.parentElement.getElementsByTagName("tr");
for(var i = 0; i < linhas.length; i++){
  var linha_ = linhas[i];
  linha_.classList.remove("selecionado");
}
}
linha.classList.toggle("selecionado");
}
tabela.addEventListener("click", function(){
var selecionados = tabela.getElementsByClassName("selecionado");
if(selecionados.length < 1){
alert("Selecione pelo menos uma linha");
return false;
}
var dados = "";
for(var i = 0; i < selecionados.length; i++){
var selecionado = selecionados[i];
selecionado = selecionado.getElementsByTagName("td");
dados += "ID: " + selecionado[0].innerHTML + " - Nome: " + selecionado[1].innerHTML + " - Idade: " + selecionado[2].innerHTML + "\n";
var d = selecionado[0].innerHTML;
}
document.getElementById("bv").value = d;
});

</script>
</body>
</html>
