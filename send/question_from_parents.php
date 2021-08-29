<?php
//POST通信できたらpost変数を$messageに代入
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../envfile.php");
    //メッセージ転送
    $message = "";
    foreach ($_POST as $key => $value) {
        //keyをわかりやすい日本語に変換
        switch ($key) {
            case "name-parent":
                $key = "保護者様の名前";
                break;
            case "name-student":
                $key = "生徒の名前";
                break;
            case "content":
                $key = "お問い合わせの内容";
                break;
            default:
                $key = "不正なキーが検出されました";
                break;
        }
        //メッセージを作成
        $message .= $key."\n    ".$value."\n";
    }
    $message = array(
        'text'=>$message,
    );
    send_to_slack($message);

    echo "フォームの送信が完了しました。24時間以内に対応させていただきます。ありがとうございました。";
}


function send_to_slack($message)
{
    $webhook_url = SEND_TO_SLACK_QUESTION_FROM_PARENTS;
    $options = array(
    'http' => array(
      'method' => 'POST',
      'header' => 'Content-Type: application/json',
      'content' => json_encode($message),
    )
  );
    $response = file_get_contents($webhook_url, false, stream_context_create($options));
    return $response === 'ok';
}
