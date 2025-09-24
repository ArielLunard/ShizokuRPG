<?php
include('config.php');

function  classe($conn){
    $result = $conn->query("SELECT * FROM `tb_classe`");
    while ($row = $result->fetch_assoc()) {
        echo '<option value="'.$row['tb_classe_id'].'">'.$row['classe'].'</option>';
    }
}

function  sub_classe($conn,$classe){
    if (!is_null($classe)) {
        $tb_classe_id = $classe;
    }else{
        $tb_classe_id = 'null';
    }
    $result = $conn->query("SELECT tb_sub_classe_id, sub_classe FROM `tb_sub_classe` WHERE `tb_classe_id` = nvl($tb_classe_id,`tb_classe_id`);");
    while ($row = $result->fetch_assoc()) {
        echo '<option value="'.$row['tb_sub_classe_id'].'">'.$row['sub_classe'].'</option>';
    }
}

if (isset($_POST['tb_classe_id'])) {
    sub_classe($conn, $_POST['tb_classe_id']);
}
?>