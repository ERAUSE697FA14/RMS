<?php 
require_once 'connectvars.php';
@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);

@header("Pragma: no-cache");
header("Content-Type: application/json; charset=utf-8");

$dbhost      = DB_HOST;
$dbuser      = DB_USER;
$dbpass     = DB_PASSWORD;
$dbname    = DB_NAME;

$filename=date("Y-m-d_H-i-s")."-".$dbname.".sql";

$tmpFile = str_replace('\\','/',(dirname(__FILE__)))."/backupdb/".$filename;

$cmd="./mysqldump -h$dbhost -uroot -pziyirashminathan  $dbname ¦ gzip -9 > ".$tmpFile;

exec("cd /usr/bin/");
exec($cmd); 
 
echo "<tr><td colspan='2' style='font-size:15px;text-align:center;' nowrap>DB Backup Info</td></tr>";
echo "<tr><td nowrap>File Name: </td><td>".$filename."</td></tr>";
echo "<tr><td nowrap>File Directory: </td><td>".str_replace('\\','/',$tmpFile)."</td></tr>";
echo "<tr><td nowrap>CMD: </td><td style='color:green;'>".$cmd."</td></tr>";

if (filesize($tmpFile)>0){
echo "<tr><td colspan='2' style='font-size:15px;color:#006600' nowrap>Successful!</td></tr>";
}
else{
echo "<tr><td colspan='2' style='font-size:15px;color:red' nowrap>Failed!</td></tr>";
echo "<tr><td nowrap>CMD: </td><td style='color:red;'>".$cmd."</td></tr>";
}
exit;
?>
