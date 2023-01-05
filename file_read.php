<?php
require_once "./dbc.php";
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>キャラクターリスト</title>
  <link rel="icon" href="assets/favicon.ico.png">
  <!--CSS-->
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>

<body>
  <a href="upload_form.php">入力画面</a>
  <fieldset>
    <legend>キャラクターリスト</legend>
    <table>
      <thead>
        <tr>
          <th>見た目</th>
          <th>キャラクター名</th>
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
          <tr>
          <form enctype="multipart/form-data" action="./vt_battle.php" method="POST">
          <td><img src="<?php echo $record["file_path"] ?>" alt="PL" width="100" height="100"></td>
          <td><?php echo $record["pl_name"] ?></td>
          <td><?php echo $record["attack"] ?></td>
          <td><?php echo $record["toughness"] ?></td>
          <td><?php echo $record["speed"] ?></td>
          <td><?php echo $record["technic"] ?></td>
          <td><?php echo $record["imagination"] ?></td>
          <td><?php echo $record["chase"] ?></td>
          <td><button>バトルを行う</button></td>
          <td><?php $pl_name = $record["pl_name"];
          $file_path = $record["file_path"];
          //スペック
          $attack = $record["attack"];
          $toughness = $record["toughness"];
          $speed = $record["speed"];
          $technic = $record["technic"];
          $imagination = $record["imagination"];
          $chase = $record["chase"]; ?>
          <input type="hidden" name="battle_command" value="0">
          <input type="hidden" name="file_path" value="<?=$file_path?>">
          <input type="hidden" name="pl_name" value="<?=$pl_name?>">
          <input type="hidden" name="attack" value="<?=$attack?>">
          <input type="hidden" name="toughness" value="<?=$toughness?>">
          <input type="hidden" name="speed" value="<?=$speed?>">
          <input type="hidden" name="technic" value="<?=$technic?>">
          <input type="hidden" name="imagination" value="<?=$imagination?>">
          <input type="hidden" name="chase" value="<?=$chase?>"></td>
          </form>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>