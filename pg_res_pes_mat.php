<?php
session_start();
if($_SESSION['msg']==""){
 header("Location:index.php");
}
include_once "ConAL.php";
$nun = filter_input(INPUT_POST,'nume',FILTER_SANITIZE_STRING);
$nun = preg_replace("/\s+/","",$nun);
if($nun==""){
  header("Location:pg_ini1.php");
  $_SESSION['ifon'] = "<script>alert('Ocorreu um erro')</script>";
}else{
      $result_usuario = "SELECT * FROM Alunos WHERE Num_mat LIKE '$nun'";
      $resultado_usuario = mysqli_query($conn, $result_usuario);
      $row_usuario = mysqli_fetch_array($resultado_usuario);
      if($row_usuario['id'] == ""){
        header("Location:pg_ini1.php");
        $_SESSION['ifon'] = "<script>alert('Nenhum registro encontrado')</script>";
      }else{
      $_SESSION['id'] = $row_usuario['id'];
      $result_usuarioa = "SELECT * FROM Ko WHERE imagem LIKE '".$_SESSION['id']."'";
      $resultado_usuarioa = mysqli_query($conn, $result_usuarioa);

      }
}
?>
<!DOCTYPE html>
<html lang=pt-br>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="estilo.css">

<title>Inserir</title>
</head>
<body>
  <div style="width: 1400px;" id = "logo">
  <h1 id="itu" >------  Arquivo acadêmico - PROEG  --------</h1>
  </div>
  <body>
    <nav>
    		<ul>
          <li><a href="pg_ini1.php">Inicio</a></li>
    		<li><a href="pg_pesquisa.php">Pesquisa por matrícula</a></li>
        <li><a href="pg_pesquisa_nome.php">Pesquisa por nome</a></li>


    		<?php
        if($_SESSION['msg']==1){
         echo "<li><a href='sair.php'>Sair</a></li>";
       }else if($_SESSION['msg']==2){
         if($row_usuario['STS'] == 1){
           echo "<li><a href='devolucao.php'>Emprestimo/Devolução</a></li>";
           echo "<li><a href='#'>Histórico de emprestimos</a></li>";
           echo "<li><a href='sair.php'>Sair</a></li>";
         }else{
         echo "<li><a href='empr.php'>Emprestimo/Devolução</a></li>";
         echo "<li><a href='#'>Histórico de emprestimos</a></li>";
         echo "<li><a href='sair.php'>Sair</a></li>";
       }}else if($_SESSION['msg']== 3 or 4){
         if($row_usuario['STS'] == 1){
           echo "<li><a href='devolucao.php'>Emprestimo/Devolução</a></li>";
           echo "<li><a href='#'>Histórico de emprestimos</a></li>";
           echo "<li><a href='#'>Altera registro</a></li>";
           echo "<li><a href='sair.php'>Sair</a></li>";
         }else{
         echo "<li><a href='empr.php'>Emprestimo/Devolução</a></li>";
         echo "<li><a href='#'>Histórico de emprestimos</a></li>";
         echo "<li><a href='#'>Altera registro</a></li>";
         echo "<li><a href='sair.php'>Sair</a></li>";}
       }
       ?>

    		</ul>
    </nav>
<!-- Responsavel pela pesquisa-->
<div id="hu" >
<h1 id="tituhu">Informações do aluno:</h1>
<label class="infaluno">Nome: &nbsp</label>
<label class="infaluno"><?php echo $row_usuario['Nome_civil']; ?></label><br>
<label class="infaluno">Matrícula: &nbsp</label>
<label class="infaluno"><?php echo $row_usuario['Num_mat']; ?>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
<label class="infaluno">Curso: &nbsp</label>
<label class="infaluno"><?php echo $row_usuario['Cod_cur']; ?> -- &nbsp </label>
<label class="infaluno"><?php echo $row_usuario['Nome_cur']; ?></label><br>
<label class="infaluno">Forma de ingresso: &nbsp</label>
<label class="infaluno"><?php echo $row_usuario['Fin']; ?></label><br>
<label class="infaluno">Forma de evasão: &nbsp</label>
<label class="infaluno"><?php echo $row_usuario['Fev']; ?></label><br>
<label class="infaluno">Ano de ingresso: &nbsp</label>
<label class="infaluno"><?php echo $row_usuario['Ain']; ?></label><br>
<label class="infaluno">Ano de evsão: &nbsp</label>
<label class="infaluno"><?php echo $row_usuario['Aev']; ?></label>
<label class="infaluno"><?php
if($row_usuario['STS'] == 1){
  echo "<span style='color:red;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AVISO:A pasta não está no arquivo</span>";
}else{
echo ""; }?></label>
<?php
$cod = $row_usuario['Cod_cur']." - ".$row_usuario['Num_mat'];
$_SESSION['lesa'] = $cod;
if($_SESSION['msg']==1){
  $cod = $row_usuario['Cod_cur']." - ".$row_usuario['Num_mat'];
echo "<form method='POST' action='soli_pas.php'>
<input type='text' style='display:none;' name='Num_mat' value='$cod' readonly>
<input  name='sand' style='position:absolute;left:700px;top:20px;' type='submit' value='Solicitar pasta'>
</form>";
}
?>




<form method="POST" action="pdf_visu.php" target="_blank">
  <input id="bv" type="text" name="nome">
  <input id= "san" name="sand" type="submit" value="Visualizar">
</form>

</div>
<div id="tab">
<h1 id="tituhu" >Conteúdo da pasta:<h1>
<table id='minhaTabela'>
   <thead>
        <tr>
             <th>ID</th>
             <th>Tipo do <br> documento</th>
             <th>Descrição</th>
             <th>Ano do documento</th>
             <th>Inserido em:</th>

        <tr>
   </thead>
   <tbody>
     <?php
     while($row_usuarioa = mysqli_fetch_array($resultado_usuarioa)){
     ?>
        <tr>
              <?php
              $resudata = $row_usuarioa['data_inserido'];
              $resudata = explode('-',$resudata);
              $resudata = $resudata[2]."-".$resudata[1]."-".$resudata[0];
              ?>
             <td><?php echo $row_usuarioa['id'];?></td>
             <td><?php echo $row_usuarioa['tipo_doc']; ?></td>
             <td><?php echo $row_usuarioa['nome']; ?></td>
             <td><?php echo $row_usuarioa['ano_doc']; ?></td>
             <td><?php echo $resudata; ?></td>

             </tr>
           <?php } ?>

   </tbody>
</table>

</div>


<script type="text/javascript">
  var tabela = document.getElementById("minhaTabela");
var linhas = tabela.getElementsByTagName("tr");

for(var i = 0; i < linhas.length; i++){
var linha = linhas[i];
linha.addEventListener("click", function(){
//Adicionar ao atual
selLinha(this, false);


//Selecione apenas um
//selLinha(this, true); //Selecione quantos quiser

});
}



/**
Caso passe true, você pode selecionar multiplas linhas.
Caso passe false, você só pode selecionar uma linha por vez.
**/
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

/**
Exemplo de como capturar os dados
**/
//var btnVisualizar = document.getElementById("visualizarDados");

tabela.addEventListener("click", function(){
var selecionados = tabela.getElementsByClassName("selecionado");
//Verificar se eestá selecionado
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

//alert(dados);
document.getElementById("bv").value = d;
//document.getElementById("confirmacao").innerHTML ="Deseja visualizar o arquivo de id:" + d +"?";

});

</script>
</body>
</html>
