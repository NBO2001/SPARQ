<?php
session_start();
if($_SESSION['msg']== 1 or $_SESSION['msg']== 2 or $_SESSION['msg']== "" ) {
  header("Location:index.php");
}

  unset ($_SESSION['ifon']);

include_once 'ConAL.php';

  $nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
  $ano = filter_input(INPUT_POST,'ano',FILTER_SANITIZE_STRING);
  $tipo_doc =filter_input(INPUT_POST,'assunto',FILTER_SANITIZE_STRING);
  $nome_arq =  $_FILES['pdf']['name'];
  $nome_arq  = explode('.',$nome_arq);
  $tipo_doc = explode (' ',$tipo_doc);
  $tipo_doc = $tipo_doc[0];
  $result_usuario = "SELECT * FROM Ife WHERE cod LIKE '$tipo_doc'";
  $resultado_usuario = mysqli_query($conn, $result_usuario);
  $row_usuario = mysqli_fetch_array($resultado_usuario);

  date_default_timezone_set('America/Sao_Paulo');
  $dataLocal = date('d-m-Y', time());
  $dataL = date('Y-m-d', time());
  $data=date('H:i:s');
  $data=explode(':',$data);
  $horari = $data[0]-1;
  $horari = $horari = $dataLocal." -- ".$horari.":".$data[1].":".$data[2];
  $usuarioname = $_SESSION['usuarioname'];
  $nun = $_SESSION['id'];
if ($nun==""){
 header("Location:Pesquisa.php");
 $_SESSION['ifon']="<script>alert('Campo vazio!!')</script>";

}else if($row_usuario['id'] == ""){
header("Location:Pesquisa.php");
$_SESSION['ifon']="<script>alert('Tipo do documento invalido!!')</script>";
}else if($nome_arq[1] <> "pdf"){
  header("Location:Pesquisa.php");
  $_SESSION['ifon'] = "<script>alert('Arquivo não suportado!!')</script>";
}elseif ($nome =="") {
 header("Location:Pesquisa.php");
 $_SESSION['ifon']="<script>alert('Campo vazio!!')</script>";
}else {
  $tipo_doc = $row_usuario['cod']." -- ".$row_usuario['nome_doc'];
  $fase_con =$row_usuario['fase_con'];
  $fase_con =explode(' ',$fase_con);
  $ano_va = $fase_con[0];
  $fase_in = $row_usuario['fase_in'];
  $fase_in = explode(' ',$fase_in);
  $ano_vb = $fase_in[0];
  if ($ano_va > 0){
    if ($ano_vb>0){
      $ano_ex = $ano_va+$ano_vb;
      $ano_ex = $ano + $ano_ex;
      $fase_con =$row_usuario['fase_con'];
      $fase_in = $row_usuario['fase_in'];
    }else{
      $ano_ex = $ano_va;
      $ano_ex = $ano + $ano_ex;
      $fase_con =$row_usuario['fase_con'];
      $fase_in = $row_usuario['fase_in'];

    }
  }else {
    if ($ano_vb>0){
      $ano_ex = $ano_vb;
      $ano_ex = $ano + $ano_ex;
      $fase_con =$row_usuario['fase_con'];
      $fase_in = $row_usuario['fase_in'];

    }else{
      $ano_ex ="";
      $fase_con =$row_usuario['fase_con'];
      $fase_in = $row_usuario['fase_in'];
    }
  }

  $destin_fin = $row_usuario['destin_fin'];
  $dire = "/home/naatan/Área de Trabalho/In/pdf/".$nun."/";
  mkdir($dire);
  chmod ($dire,0777);
  move_uploaded_file($_FILES['pdf']['tmp_name'],$dire.$tipo_doc." -- ".$horari.".pdf");
$fp = fopen("test.sh","a+");
  $fop = "test.sh";
  chmod ($fop,0777);
$nome_pdf = $tipo_doc." -- ".$horari.".pdf";
$can = "/In/pdf/".$nun."/".$nome_pdf;
$tes = "
  git add pdf/".$nun."/
  git commit -m '".$nome."'";

  fwrite($fp, $tes);
  fclose($fp);

  $sql = "INSERT INTO Ko (nome, imagem,nome_pdf,tipo_doc,ano_doc,data_inserido,can,fase_con,fase_in,destin_fin,ano_ex,usuarioname) VALUES ('$nome', '$nun','$nome_pdf','$tipo_doc','$ano','$dataL','$can','$fase_con','$fase_in','$destin_fin','$ano_ex','$usuarioname')";
  $rs = mysqli_query($conn,$sql);
  //passthru('sh test.sh');
  $nome = utf8_encode ($nome);
  $nome_pdf = utf8_encode ($nome_pdf);

  header("Location:Pesquisa.php");
  unset ($_SESSION['id']);
  $_SESSION['ifon'] = "<p style='color:red;'>Salvo com sucesso!!</p>";
}

?>
