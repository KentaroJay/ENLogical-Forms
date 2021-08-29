<?php
$host = "localhost";
            $mysqli = new mysqli($host, "root", "kentaro0705", "enlogical_db");
            if ($mysqli->connect_error) {
                die("MySQL 接続エラー.<br />");
            } else {
                $mysqli->set_charset("utf8"); //utf8 コードの利用にはこれが必要
            }
?>
<?php
$sql = "select * from coach;";
            $res = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/font.css" />

  <title>質問フォーム</title>
</head>

<body>
  <div class="container py-5">
    <form class="needs-validation" method="POST" action="send/urgent_appointment.php" enctype="multipart/form-data" novalidate>

      <!-- 生徒の名 -->
      <div class="mb-3">
        <label for="name" class="form-label">あなたのお名前</label>
        <input type="text" class="form-control" id="name" name="name" required />
        <div class="invalid-feedback">あなたのお名前を記入してください。</div>
      </div>

      <!-- 担当コーチ -->
      <div class="mb-3">
        <label for="coach" class="form-label">担当コーチ</label>
        <select class="form-select" id="coach" name="coach" required>
          <option value="" disabled selected>コーチを選んでください。</option>
          <?php while ($row = $res->fetch_array()) :?>
          <option
            value="<?php echo $row['name']; ?>">
            <?php echo $row['name']; ?>
          </option>
          <?php endwhile; $res->free(); ?>
        </select>
        <div class="invalid-feedback">
          担当コーチの名前を書いてください.苗字だけでも構いません。
        </div>
      </div>

      <!-- 緊急事項の種類 -->
      <div class="mb-3">
        <label for="case" class="form-label">緊急事項の種類</label>
        <input type="text" class="form-control" id="case" name="case" placeholder="日程変更, 勉強法の質問, etc..." required />
        <div class="invalid-feedback">用件を記入してください。</div>
      </div>

      <!-- ファイル選択 -->
      <div class="input-group mb-3">
        <input type="file" accept="image/*" class="form-control" id="inputGroupFile" name="fname"
          onchange="previewImage(this);" />
        <label class="input-group-text" for="inputGroupFile">もしあれば</label>
        <div class="invalid-feedback">わからない問題の箇所の写真をアップロードしてください。</div>
        <div class="valid-feedback">画像プレビュー</div>
      </div>
      <p>
        <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
          style="max-width: 200px" />
      </p>

      <!-- 緊急事項の内容 -->
      <div class="input-group mb-3">
        <span class="input-group-text">緊急事項の内容</span>
        <textarea class="form-control" aria-label="緊急事項の内容" name="content" required></textarea>
        <div class="invalid-feedback">具体的な要件を記入してください。</div>
      </div>
      <button type="submit" class="btn btn-primary">送信</button>
    </form>
  </div>
  <!-- Bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
  </script>
  <!-- 画像プレビュー -->
  <script async src="js/fileReader.js"></script>
  <script async src="js/validator.js"></script>
</body>

</html>