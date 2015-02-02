<?php
try
{
require_once 'BullhornAPI.php';
$BhObj=new BullhornAPI();
//$result=$BhObj->getAccessCode();
$url="https://auth.bullhornstaffing.com/oauth/authorize?client_id=a52a23d3-24a5-42c9-8ff6-1b0b9ad2bff7&scope=&state=107008&response_type=code";

echo '<PRE>';
//$result = json_decode($result,true); 
print file_get_contents($url);
echo '</PRE>';
curl_close($ch);

} catch (Exception $e) {
    echo sprintf("ERROR: %s", $e->getMessage());
}
?>