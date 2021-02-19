<?php
  function getBlockCount(){
    global $snatcoin;
    return $snatcoin->getblockcount(); 
  }
  function getBlockHash($block){
    global $snatcoin;
    return $snatcoin->getblockhash($block); 
  }
  function getBlock($block){
    global $snatcoin;
    return var_dump($getblock=$snatcoin->getblock($snatcoin->getblockhash($block)));
  }
  function getBlockSize($block){
    global $snatcoin;
    return $getblock=$snatcoin->getblock($snatcoin->getblockhash($block))["size"];
  }
  function getConfirmations($block){
    global $snatcoin;
    return $getblock=$snatcoin->getblock($snatcoin->getblockhash($block))["confirmations"];
  }
  function getSender($trans, $block){
    global $snatcoin;
    $getblock=$snatcoin->getblock($snatcoin->getblockhash($block));
    return $snatcoin->getrawtransaction($snatcoin->getrawtransaction($getblock["tx"][$trans], 1)["vin"][0]["txid"], 1)["vout"][$snatcoin->getrawtransaction($getblock["tx"][$trans], 1)["vin"][0]["vout"]]["scriptPubKey"]["addresses"][0];
  }
  function getReceiver($trans, $block){
    global $snatcoin;
    $getblock=$snatcoin->getblock($snatcoin->getblockhash($block));
    return $snatcoin->gettransaction($getblock["tx"][$trans])["details"][0]["address"]; 
  }
  function getAmount($trans, $block){
    global $snatcoin;
    $getblock=$snatcoin->getblock($snatcoin->getblockhash($block));
    return $snatcoin->gettransaction($getblock["tx"][$trans])["amount"]; 
  }
  function getTransID($trans, $block){
    global $snatcoin;
    $getblock=$snatcoin->getblock($snatcoin->getblockhash($block));
    return $getblock["tx"][$trans]; 
  }
  function totalTrans($block){
    global $snatcoin;
    $getblock=$snatcoin->getblock($snatcoin->getblockhash($block));
    return count($getblock["tx"]);
  }
  function getTimeReceived($trans, $block){
    global $snatcoin;
    $getblock=$snatcoin->getblock($snatcoin->getblockhash($block));
    return $snatcoin->gettransaction($getblock["tx"][$trans])["timereceived"]; 
  }
  function tx($block){
    global $snatcoin;
    $getblock=$snatcoin->getblock($snatcoin->getblockhash($block));
    return $getblock["tx"]; 
  }
  function walletBalance($block){
    global $snatcoin;
    $sitebalance=$snatcoin->getbalance();
    return $sitebalance=number_format($sitebalance, 8);
  }

?>