<?php
/*
//受信確認用
echo('<pre>');
var_dump($_POST);
echo('</pre>');
exit();
*/
//-------------------------------------------------------//
//PL
$pl_name = $_POST["pl_name"];
$file_path = $_POST["file_path"];
//スペック
$attack = $_POST["attack"];
$toughness = $_POST["toughness"];
$speed = $_POST["speed"];
$technic = $_POST["technic"];
$imagination = $_POST["imagination"];
$chase = $_POST["chase"];
$Access_power = $_POST["Access_power"];
//ステータス
$pl_hp_set = $toughness * 2 + 6 ;
$pl_critical = $technic * 3 ;
$pl_round = ($speed+$technic) * 5 + $speed;
$pl_battle = ($attack+$toughness+$technic) * 6;
if($Access_power < $pl_battle){$pl_battle = $Access_power;}
$pl_search = ($technic+$imagination+$chase) * 6;
if($Access_power < $pl_search){$pl_search = $Access_power;}
//-------------------------------------------------------//
//NPC
$enemy_name = $_POST["enemy_name"];
$file_path2 = $_POST["file_path2"];
//スペック
$attack2 = $_POST["attack2"];
$toughness2 = $_POST["toughness2"];
$speed2 = $_POST["speed2"];
$technic2 = $_POST["technic2"];
$imagination2 = $_POST["imagination2"];
$chase2 = $_POST["chase2"];
$Access_power2 = $_POST["Access_power2"];
//-------------------------------------------------------//
//ステータス
$enemy_hp_set = $toughness2 * 2 + 6 ;
$pl_critical2 = $technic2 * 3 ;
$pl_round2 = ($speed2+$technic2) * 5 + $speed2;
$pl_battle2 = ($attack2+$toughness2+$technic2) * 6;
if($Access_power2 < $pl_battle2){$pl_battle2 = $Access_power2;}
$pl_search2 = ($technic2 + $imagination2 + $chase2) * 6;
if($Access_power2 < $pl_search2){$pl_search2 = $Access_power2;}
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
$enemy_damage = rand(1,$attack2);
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
  $enemy_hp = $enemy_hp_set;
  $pl_hp = $pl_hp_set;
  $msg = 'バトル開始だ！';
  $msg1 = '行動選択して戦おう';
}elseif($_POST["battle_command"] == 1){ //近接攻撃
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

}elseif($_POST["battle_command"] == 2){ //スキルによる攻撃
  if($attack_result == 1){
    $enemy_hp = $_POST["enemy_hp"] - $damage2;
    $Access_power = $_POST["Access_power"] - 10;
    $msg = "スキル攻撃！ $damage2 のダメージ！";
  }elseif($attack_result == 2){
    $enemy_hp = $_POST["enemy_hp"] - $damage3;
    $Access_power = $_POST["Access_power"] - 10;
    $msg = "スキルクリティカル攻撃！ $damage3 の大ダメージ！";
  }elseif($attack_result == 0){
    $enemy_hp = $_POST["enemy_hp"];
    $msg = "攻撃失敗…";
  }
  $pl_hp = $_POST["pl_hp"] - $enemy_damage;
  $msg1 = "敵からの反撃！ $enemy_damage のダメージ！";

}elseif($_POST["battle_command"] == 3){ //調査
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
}elseif($_POST["battle_command"] == 4){ //スキルによる攻撃
  $enemy_hp = $_POST["enemy_hp"];
  $msg = "なにもしない";
  $pl_hp = $_POST["pl_hp"] - $enemy_damage;
  $msg1 = "敵からの反撃！ $enemy_damage のダメージ！";}

if($pl_hp > 0){
  $pl_images = $file_path;
}elseif($pl_hp <= 0){
  $msg = 'HPがなくなった。';
  $msg1 = '戦闘終了だ。';
  $pl_images = 'images/loose.png';
}
if($enemy_hp > 0){
  $enemy_images = $file_path2;
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
              <!--PL隠しデータ-->
              <input type="hidden" name="pl_name" value="<?=$pl_name?>">
              <input type="hidden" name="file_path" value="<?=$file_path?>">
              <input type="hidden" name="pl_hp" value="<?=$pl_hp?>">
              <input type="hidden" name="Access_power" value="<?=$Access_power?>">
              <input type="hidden" name="attack" value="<?=$attack?>">
              <input type="hidden" name="toughness" value="<?=$toughness?>">
              <input type="hidden" name="speed" value="<?=$speed?>">
              <input type="hidden" name="technic" value="<?=$technic?>">
              <input type="hidden" name="imagination" value="<?=$imagination?>">
              <input type="hidden" name="chase" value="<?=$chase?>">
              <!--NPC隠しデータ-->
              <input type="hidden" name="enemy_name" value="<?=$enemy_name?>">
              <input type="hidden" name="enemy_hp" value="<?=$enemy_hp?>">
              <input type="hidden" name="file_path2" value="<?=$file_path2?>">
              <input type="hidden" name="Access_power2" value="<?=$Access_power2?>">
              <input type="hidden" name="attack2" value="<?=$attack2?>">
              <input type="hidden" name="toughness2" value="<?=$toughness2?>">
              <input type="hidden" name="speed2" value="<?=$speed2?>">
              <input type="hidden" name="technic2" value="<?=$technic2?>">
              <input type="hidden" name="imagination2" value="<?=$imagination2?>">
              <input type="hidden" name="chase2" value="<?=$chase2?>">
              <!--選択-->
              <select name="battle_command">
                <option value="1">近接攻撃</option>
                <option value="2">スキルによる攻撃</option>
                <option value="3">調査する</option>
                <option value="4" selected>待機</option>
              </select>
            </div>
            <div>
              <button>選択</button>
            </div>
          </fieldset>
          <a href="character_list.php">キャラクターリスト</a>
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
          <p><?=$enemy_name?>のHP : <?=$enemy_hp?></p>
          <meter id="fuel"
                  min="0" max="<?=$enemy_hp_set?>"
                  value="<?=$enemy_hp?>">
                at <?=$enemy_hp?>/<?=$enemy_hp_set?>
          </meter>
        </div>
        <div class="vs">VS</div>
        <!--敵画面-->
        <div class="straight_line">
          <div class="battlefield">
            <img src="<?=$file_path?>" alt="PLサンプル" width="100" height="100">
          </div>
          <p><?=$pl_name?>のHP : <?=$pl_hp?></p>
          <meter id="fuel"
                min="0" max="<?=$pl_hp_set?>"
                value="<?=$pl_hp?>">
              at <?=$pl_hp?>/<?=$pl_hp_set?>
          </meter>
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