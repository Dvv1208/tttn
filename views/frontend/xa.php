<?php
$maqh = 0;
if (isset($_GET['maqh'])) $maqh = $_GET['maqh'];
settype($maqh, "string");
$conn = new PDO("mysql:host=localhost;dbname=tttn;charset=utf8", "root", "");
$stmt = $conn->prepare("SELECT xaid, name, maqh  FROM tttn_devvn_xaphuongthitran WHERE maqh=?");
$stmt->execute([$maqh]);
$data  = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
