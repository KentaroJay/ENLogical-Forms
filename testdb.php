<?php
$host = "mysql7072.xserver.jp";
            $mysqli = new mysqli($host, "enlogical_team", "enlogical", "enlogical_db");
            if ($mysqli->connect_error) {
                die("MySQL 接続エラー.<br />");
            } else {
                $mysqli->set_charset("utf8"); //utf8 コードの利用にはこれが必要
            }

?>
<?php
$sql = "select * from coach;";
            $res = $mysqli->query($sql); while ($row = $res->fetch_array()) {
                echo $row['name'];
            }
            $res->free();
?>
