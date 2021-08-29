<?php
//POST通信できたらpost変数を$messageに代入
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once("../envfile.php");
    //メッセージ転送
    $message = "";
    foreach ($_POST as $key => $value) {
        //keyをわかりやすい日本語に変換
        switch ($key) {
            case "name":
                $key = "生徒の名前";
                break;
            case "coach":
                $key = "担当コーチ";
                break;
            case "subject":
                $key = "教科";
                break;
            case "point":
                $key = "わからないポイント";
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

    //写真転送
    // アップロードされたファイル件を処理
    foreach ($_FILES['fname']['tmp_name'] as $i => $name) {
        // アップロードされたファイルか検査
        if ($name === "") {
            continue;
        } else {
            send_file_to_slack($name);
        }
    }


    echo "フォームの送信が完了しました。24時間以内に対応させていただきます。ありがとうございました。";
}


function send_to_slack($message)
{
    $webhook_url = SEND_TO_SLACK_QUESTION;
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

function send_file_to_slack($filename)
{
    $params = [
    'token' => SEND_FILE_TO_SLACK_QUESTION,
    'channels' => '##06生徒からの質問',
    'file' => new CURLFile($filename),
    'filename' => $filename,
    'initial_comment' => '生徒が添付した写真です。',
];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, 1); // デバッグ出力
    curl_setopt_array($ch, [
    CURLOPT_URL => 'https://slack.com/api/files.upload',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $params,
]);

    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
