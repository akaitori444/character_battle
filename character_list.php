<?php
require_once "./dbc.php";
//var_dump($result);
//exit();
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
  <fieldset  class="straight_line">
    <legend>キャラクターリスト</legend>
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
          <form enctype="multipart/form-data" action="./enemy_list.php" method="POST">
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
          <td><?php 
          $pl_name = $record["pl_name"];
          $file_path = $record["file_path"];
          //スペック
          $attack = $record["attack"];
          $toughness = $record["toughness"];
          $speed = $record["speed"];
          $technic = $record["technic"];
          $imagination = $record["imagination"];
          $chase = $record["chase"]; ?>
          <input type="hidden" name="file_path_input" value="<?=$file_path?>">
          <input type="hidden" name="pl_name_input" value="<?=$pl_name?>">
          <input type="hidden" name="attack_input" value="<?=$attack?>">
          <input type="hidden" name="toughness_input" value="<?=$toughness?>">
          <input type="hidden" name="speed_input" value="<?=$speed?>">
          <input type="hidden" name="technic_input" value="<?=$technic?>">
          <input type="hidden" name="imagination_input" value="<?=$imagination?>">
          <input type="hidden" name="chase_input" value="<?=$chase?>">
          <input type="hidden" name="Access_power_input" value="<?=$Access_power?>"></td>
          </form>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>