<?php
//var_dump($_POST);
//exit();
//-------------------------------------------------------//
$pl_name = $_POST["pl_name"];
$file_path = $_POST["file_path"];
//スペック
$attack = $_POST["attack"];
$toughness = $_POST["toughness"];
$speed = $_POST["speed"];
$technic = $_POST["technic"];
$imagination = $_POST["imagination"];
$chase = $_POST["chase"];
//-------------------------------------------------------//
//接続率計算
if($attack > 3){
    $attack_count = $attack * 2 - 3;
}else{
    $attack_count = $attack;
}
if($toughness > 3){
    $toughness_count = $toughness * 2 - 3;
}else{
    $toughness_count = $toughness;
}
if($speed > 3){
    $speed_count = $speed * 2 - 3;
}else{
    $speed_count = $speed;
}
if($technic > 3){
    $technic_count = $technic * 2 - 3;
}else{
    $technic_count = $technic;
}
if($imagination > 3){
    $imagination_count = $imagination * 2 - 3;
}else{
    $imagination_count = $imagination;
}
if($chase > 3){
    $chase_count = $chase * 2 - 3;
}else{
    $chase_count = $chase;
}
$Access_count = $attack_count + $toughness_count + $speed_count + $technic_count + $imagination_count + $chase_count;
$Access_power = 100 - $Access_count;
//-------------------------------------------------------//
//ステータス
$pl_critical = $technic * 3 ;
$pl_round = ($speed+$technic) * 5 + $speed;
$pl_battle = ($attack+$toughness+$technic) * 6;
if($Access_power < $pl_battle){$pl_battle = $Access_power;}
$pl_search = ($technic+$imagination+$chase) * 6;
if($Access_power < $pl_search){$pl_search = $Access_power;}
//-------------------------------------------------------//
$msg = ' ';
$msg1 = ' ';
$damage = rand(1,$attack);
//echo 'PL通常攻撃威力は', ' ', $damage, '<br />';
$damage1 = rand(1,$attack) + rand(1,6);
//echo 'PL通常クリティカル攻撃威力は', ' ', $damage1, '<br />';
$damage2 = rand(1,$attack)*2;
//echo 'PLスキル攻撃威力は', ' ', $damage2, '<br />';
$damage3 = rand(1,$attack)*2 + rand(1,6);
//echo 'PLスキルクリティカル攻撃威力は', ' ', $damage3, '<br />';
$enemy_damage = rand(1,3);
//echo '敵ダメージ量は', ' ', $enemy_damage, '<br />';
$dice = rand(1,100);
//echo 'ダイス目は', ' ', $dice, '<br />';
//echo '行動判定は', ' ', $_POST["battle_command"], '<br />';
if($dice <= $pl_critical){
  $attack_result = 2;
  //echo '判定クリティカル成功', '<br />';
}elseif($dice <= $Access_power){
  $attack_result = 1;
  //echo '判定成功', '<br />';
}else{
  $attack_result = 0;
  //echo '判定失敗', '<br />';
}

if($_POST["battle_command"] == 0){
  $enemy_hp = 6;
  $pl_hp = $toughness * 2 + 6 ;
  $msg = '敵が現れた';
  $msg1 = '行動選択して戦おう';
}elseif($_POST["battle_command"] == 1){
  if($attack_result == 1){
    $enemy_hp = $_POST["enemy_hp"] - $damage;
    $msg = "近接攻撃！ $damage のダメージ！";
  }elseif($attack_result == 2){
    $enemy_hp = $_POST["enemy_hp"] - $damage1;
    $msg = "近接クリティカル攻撃！ $damage1 の大ダメージ！";
  }elseif($attack_result == 0){
    $enemy_hp = $_POST["enemy_hp"];
    $msg = "攻撃失敗…";
  }
  $pl_hp = $_POST["pl_hp"] - $enemy_damage;
  $msg1 = "敵からの反撃！ $enemy_damage のダメージ！";
}elseif($_POST["battle_command"] == 2){
  if($attack_result == 1){
    $enemy_hp = $_POST["enemy_hp"] - $damage2;
    $msg = "スキル攻撃！ $damage2 のダメージ！";
  }elseif($attack_result == 2){
    $enemy_hp = $_POST["enemy_hp"] - $damage3;
    $msg = "スキルクリティカル攻撃！ $damage3 の大ダメージ！";
  }elseif($attack_result == 0){
    $enemy_hp = $_POST["enemy_hp"];
    $msg = "攻撃失敗…";
  }
  $pl_hp = $_POST["pl_hp"] - $enemy_damage;
  $msg1 = "敵からの反撃！ $enemy_damage のダメージ！";
}elseif($_POST["battle_command"] == 3){
  $enemy_hp = $_POST["enemy_hp"];
  $pl_hp = $_POST["pl_hp"];
  $msg = "とりあえず様子見だ";
  $msg1 = " ";
}

if($pl_hp > 0){
  $pl_images = $file_path;
}elseif($pl_hp <= 0){
  $msg = 'HPがなくなった。';
  $msg1 = '戦闘終了だ。';
  $pl_images = 'images/loose.png';
}
if($enemy_hp > 0){
  $enemy_images = 'images/obake_a.png';
}elseif($enemy_hp <= 0){
  $msg = '敵を倒した。';
  $msg1 = '戦闘終了だ。';
  $enemy_images = 'images/loose.png';
}

?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>戦闘画面</title>
  <link rel="icon" href="assets/favicon.ico.png">
  <!--CSS-->
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>

<body>
  <div class="window">
    <div class="pl_information">
      <!--ステータス-->
      <h1>PLステータス</h1>
      <div class="status">
        <p>キャラクター名: <?=$pl_name?></p>
        <p>【こうげき】: <?=$attack?></p>
        <p>【たふねす】: <?=$toughness?></p>
        <p>【すばやさ】: <?=$speed?></p>
        <p>【きようさ】: <?=$technic?></p>
        <p>【そうぞう】: <?=$imagination?></p>
        <p>【ついせき】: <?=$chase?></p>
        <p>接続率 : <?=$Access_power?>%</p>
        <p>会心率 : <?=$pl_critical?>%</p>
        <p>速度 : <?=$pl_round?></p>
        <p>通常攻撃成功率 : <?=$pl_battle?>%</p>
        <p>(攻撃力 : 1d<?=$attack?>)</p>
        <p>調査成功率 : <?=$pl_search?>%</p>
      </div>
      <!--コマンド選択バー-->
      <div class="command_choice">
        <form method="POST">
          <fieldset>
            <legend>コマンド入力</legend>
            <div class="side_line">
              <!--隠しデータ-->
              <input type="hidden" name="pl_name" value="<?=$pl_name?>">
              <input type="hidden" name="file_path" value="<?=$file_path?>">
              <input type="hidden" name="attack" value="<?=$attack?>">
              <input type="hidden" name="toughness" value="<?=$toughness?>">
              <input type="hidden" name="speed" value="<?=$speed?>">
              <input type="hidden" name="technic" value="<?=$technic?>">
              <input type="hidden" name="imagination" value="<?=$imagination?>">
              <input type="hidden" name="chase" value="<?=$chase?>">
              <input type="hidden" name="pl_hp" value="<?=$pl_hp?>">
              <input type="hidden" name="enemy_hp" value="<?=$enemy_hp?>">
              <!--選択-->
              <select name="battle_command">
                <option value="1">近接攻撃</option>
                <option value="2">スキルによる攻撃</option>
                <option value="3" selected>待機</option>
              </select>
            </div>
            <div>
              <button>選択</button>
            </div>
          </fieldset>
          <a href="file_read.php">キャラクターリスト</a>
        </form>
      </div>
    </div>
    <div class="gm_information">
      <div class="main_window">
        <div>戦闘画面</div>

        <!--敵画面-->
        <div class="straight_line">
          <div class="battlefield">
            <img src="<?=$enemy_images?>" alt="enemyサンプル" width="100" height="100">
          </div>
          <p>敵のHP : <?=$enemy_hp?></p>
        </div>
        <div>VS</div>
        <!--敵画面-->
        <div class="straight_line">
          <div class="battlefield">
            <img src="<?=$file_path?>" alt="PLサンプル" width="100" height="100">
          </div>
          <p><?=$pl_name?>のHP : <?=$pl_hp?></p>
        </div>
      </div>
      <div class="msg_window">
        <div>メッセージ</div>
        <div><?=$msg?></div>
        <div><?=$msg1?></div>

      </div>    
    </div>
  </div>
</body>

</html>