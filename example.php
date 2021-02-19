<?php
  require_once 'jsonRPCClient.php';
  require_once 'snatRPC.php';
  $snatcoin = new jsonRPCClient('http://snatuser:snatpass@127.0.0.1:2332/');

  $currentBlock = getBlockCount();

  echo "Amount of transactions on current block [";
  echo $currentBlock; 
  echo "]: ";
  echo totalTrans($currentBlock);
  echo "<br><br>";


?>

