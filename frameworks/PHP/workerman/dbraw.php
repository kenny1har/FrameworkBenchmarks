<?php
function dbraw($pdo) {
  if (isset($_GET['queries'])) {
    $query_count = intval($_GET['queries']);
    if ($query_count < 1) $query_count = 1;
    if ($query_count > 500) $query_count = 500;
  } else {
    $query_count = 1;
  }

  $arr = [];
  $id = mt_rand(1, 10000);
  $statement = $pdo->prepare('SELECT randomNumber FROM World WHERE id = :id');
  $statement->bindParam(':id', $id, PDO::PARAM_INT);

  while ($query_count--) {
    $statement->execute();
    $arr[] = ['id' => $id, 'randomNumber' => $statement->fetchColumn()];
    $id = mt_rand(1, 10000);
  }

  echo json_encode($arr);
}