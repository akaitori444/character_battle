<?php


?>
<!-- ①フォームの説明 -->

<!-- ②$_FILEの確認 -->

<!-- ③バリデーション -->



<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>キャラクター入力画面</title>
    <link rel="icon" href="assets/favicon.ico.png">
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
  </head>
  <body>
    <div>
      <div class="top">
        <div class="title">バトルコロシアム</div>
      </div>
    </div>
    <a href="character_list.php">キャラクターリスト</a>
    <dvi>
      <form enctype="multipart/form-data" action="./file_upload.php" method="POST">
          <h1>キャラクター入力</h1>
          <p>あなたのキャラクターデータを入力してください</p>
          <div>
            名前: <input type="text" name="name">
          </div>
          <h1>イメージ</h1>
          <p>キャラクターの画像を入力してください</p>
          <div class="file-up">
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
            <input name="img" type="file" accept="image/*" />
          </div>
          <div>
            <textarea
              name="caption"
              placeholder="キャプション(140文字以下)"
              id="caption"
            ></textarea>
          </div>
          <input type="hidden" name="battle_command" value="0">
          <h1>スペック</h1>
          <p>キャラクターのスペックを決めてください(能力が高いほど行動の成功率が下がります)</p>
          <div class="side_line">
            <div>こうげき:</div>
            <select name="attack">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3" selected>3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <div class="side_line">
            <div>たふねす:</div>
            <select name="toughness">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3" selected>3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <div class="side_line">
            <div>すばやさ:</div>
            <select name="speed">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3" selected>3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <div class="side_line">
            <div>きようさ:</div>
            <select name="technic">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3" selected>3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <div class="side_line">
            <div>そうぞう:</div>
            <select name="imagination">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3" selected>3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <div class="side_line">
            <div>ついせき:</div>
            <select name="chase">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3" selected>3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <div>
            <button>作成</button>
          </div>
      </form>
    </dvi>
  </body>
</html>
