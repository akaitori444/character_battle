<?php
//⓵ファイルの保存 
//⓶DB接続
//⓷DBへの保存
require_once "./dbc.php";

/*---------------------------------------------------------------------------*/
//ファイル関連の取得
$file = $_FILES['img'];
//var_dump($file);
//var_dump($_POST);
//exit();

$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'images\ ';
$save_filename = date('YmdHis') . $filename;
$err_msgs = array();
$save_path = $upload_dir . $save_filename;

//キャラクター名
$pl_name = $_POST["name"];
//スペック
$attack = $_POST["attack"];
$toughness = $_POST["toughness"];
$speed = $_POST["speed"];
$technic = $_POST["technic"];
$imagination = $_POST["imagination"];
$chase = $_POST["chase"];

//キャプションを取得
$caption = filter_input(INPUT_POST,'caption',
FILTER_SANITIZE_SPECIAL_CHARS);

/*---------------------------------------------------------------------------*/
// キャプションのバリデーション
//未入力
if(empty($caption)){
    array_push($err_msgs,  'キャプションを入力してください。');
    echo '<br>';
}
//140文字か？
if(strlen($caption) > 140){
    array_push($err_msgs,  'キャプションは140文字以内で入力してください。');
    echo '<br>';
}

/*---------------------------------------------------------------------------*/
//ファイルのバリデーション
    //ファイルサイズが1MB未満か
    if($filesize > 1048576 || $file_err == 2){
        array_push($err_msgs,  'ファイルサイズは1MB未満にしてください。');
        echo '<br>';
    }

    //拡張は画像形式か
    $allow_ext = array('jpg', 'jpeg', 'png');
    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array(strtolower($file_ext), $allow_ext)){
        array_push($err_msgs,  '画像ファイルを添付してください。');
        echo '<br>';
    }

    if(count($err_msgs) === 0){
        //ファイルはあるかどうか？
        if(is_uploaded_file($tmp_path)){
            if(move_uploaded_file($tmp_path, $save_path)){
                echo $filename . 'を'. $upload_dir.'にアップしました。';
            }else{
                array_push($err_msgs,  'ファイルが保存できませんでした。');
            }
            //配列にするのもあり
            //$fileDate = array($filename, $save_path, $caption);
            // DBに保存(ファイル名、ファイルパス、キャプション)
            $result = fileSave($filename, $save_path, $caption, $pl_name, $attack, $toughness, $speed, $technic, $imagination, $chase);
        }else{
            array_push($err_msgs,  'ファイルが選択されていません。');
            echo '<br>';
    }} else {
        foreach($err_msgs as $masg){
            echo $masg;
            echo '<br>';
        }
    }
/*---------------------------------------------------------------------------*/


?>

<a href="./upload_form.php">戻る</a>
