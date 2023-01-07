<?php

require_once "./dbc.php";
/*
//データ確認用
echo('<pre>');
var_dump($_POST);
echo('</pre>');
echo('<pre>');
var_dump($result);
echo('</pre>');
exit();
*/
//-------------------------------------------------------//
//character_list引継ぎ
$pl_name_input = $_POST["pl_name_input"];
$file_path_input = $_POST["file_path_input"];
//スペック
$attack_input = $_POST["attack_input"];
$toughness_input = $_POST["toughness_input"];
$speed_input = $_POST["speed_input"];
$technic_input = $_POST["technic_input"];
$imagination_input = $_POST["imagination_input"];
$chase_input = $_POST["chase_input"];
$Access_power_input = $_POST["Access_power_input"];
//-------------------------------------------------------//
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>キャラクターリスト</title>
  <link rel="icon" href="assets/favicon.ico.png">
  <!--jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!--CSS-->
  <!--リセットCSS-->
  <link rel="canonical" href="#">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link rel="stylesheet" type="text/css" href="css/reset.css"/>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>

<body>
  <a href="upload_form.php">入力画面</a>
  <h1>PLの選んだキャラクターは<?php echo $pl_name_input ?></h1>
  <img src="<?php echo $file_path_input ?>" alt="PL1" width="100" height="100">
  <fieldset  class="straight_line">
    <legend>戦うキャラクターを選ぶ</legend>
    <table>
      <thead>
        <tr>
          <th>見た目</th>
          <th>キャラクター名</th>
          <th>【接続率】</th>
          <th>【こうげき】</th>
          <th>【たふねす】</th>
          <th>【すばやさ】</th>
          <th>【きようさ】</th>
          <th>【そうぞう】</th>
          <th>【ついせき】</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $record): ?>
          <?php
          //-------------------------------------------------------//
          //接続率計算
          if($record["attack"] > 3){
            $attack_count = $record["attack"] * 2 - 3;
          }else{
            $attack_count = $record["attack"];
          }
          if($record["toughness"] > 3){
            $toughness_count = $record["toughness"] * 2 - 3;
          }else{
            $toughness_count = $record["toughness"];
          }
          if($record["speed"] > 3){
            $speed_count = $record["speed"] * 2 - 3;
          }else{
            $speed_count = $record["speed"];
          }
          if($record["technic"] > 3){
            $technic_count = $record["technic"] * 2 - 3;
          }else{
            $technic_count = $record["technic"];
          }
          if($record["imagination"] > 3){
            $imagination_count = $record["imagination"] * 2 - 3;
          }else{
            $imagination_count = $record["imagination"];
          }
          if($record["chase"] > 3){
            $chase_count = $record["chase"] * 2 - 3;
          }else{
            $chase_count = $record["chase"];
          }
          $Access_count = $attack_count + $toughness_count + $speed_count + $technic_count + $imagination_count + $chase_count;
          $Access_power = 100 - $Access_count;
          //-------------------------------------------------------//
          ?>
          <tr>
          <form enctype="multipart/form-data" action="./vt_battle.php" method="POST">
          <td><img src="<?php echo $record["file_path"] ?>" alt="PL" width="100" height="100"></td>
          <td><?php echo $record["pl_name"] ?></td>
          <td> <?php echo $Access_power ?>% </td>
          <td><?php echo $record["attack"] ?></td>
          <td><?php echo $record["toughness"] ?></td>
          <td><?php echo $record["speed"] ?></td>
          <td><?php echo $record["technic"] ?></td>
          <td><?php echo $record["imagination"] ?></td>
          <td><?php echo $record["chase"] ?></td>
          <td><div><button>バトルを行う</button></div></td>
          <td><?php $pl_name = $record["pl_name"];
          $file_path = $record["file_path"];
          //スペック
          $attack = $record["attack"];
          $toughness = $record["toughness"];
          $speed = $record["speed"];
          $technic = $record["technic"];
          $imagination = $record["imagination"];
          $chase = $record["chase"]; 
          $pl_hp_set = $toughness * 2 + 6 ;?>
          <input type="hidden" name="file_path2" value="<?=$file_path?>">
          <input type="hidden" name="enemy_name" value="<?=$pl_name?>">
          <input type="hidden" name="enemy_hp" value="<?=$pl_hp_set?>">
          <input type="hidden" name="attack2" value="<?=$attack?>">
          <input type="hidden" name="toughness2" value="<?=$toughness?>">
          <input type="hidden" name="speed2" value="<?=$speed?>">
          <input type="hidden" name="technic2" value="<?=$technic?>">
          <input type="hidden" name="imagination2" value="<?=$imagination?>">
          <input type="hidden" name="chase2" value="<?=$chase?>">
          <input type="hidden" name="Access_power2" value="<?=$Access_power?>">
          <!--PLステータス-->
          <input type="hidden" name="battle_command" value="0">
          <input type="hidden" name="file_path" value="<?=$file_path_input?>">
          <input type="hidden" name="pl_name" value="<?=$pl_name_input?>">
          <input type="hidden" name="attack" value="<?=$attack_input?>">
          <input type="hidden" name="toughness" value="<?=$toughness_input?>">
          <input type="hidden" name="speed" value="<?=$speed_input?>">
          <input type="hidden" name="technic" value="<?=$technic_input?>">
          <input type="hidden" name="imagination" value="<?=$imagination_input?>">
          <input type="hidden" name="chase" value="<?=$chase_input?>">
          <input type="hidden" name="Access_power" value="<?=$Access_power_input?>">
        
          </td>
          </form>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>