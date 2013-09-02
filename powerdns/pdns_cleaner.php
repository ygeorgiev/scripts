<?php
/* config *********************************************************************************/
$my_dns = array("ns1.gribo.net.","ns2.gribo.net.","ns3.gribo.net.","ns4.gribo.net.","ns0.hahpss.com.","ns1.hahpss.com.","ns1.bashost.org.","ns2.bashost.org.");
error_reporting(E_ALL & ~E_DEPRECATED);
$conf = parse_ini_file('/etc/powerdns/pdns.conf');
/* end config ****************************************************************************/

/* connet tothe database*/
$link = mysql_connect($conf['gmysql-host'], $conf['gmysql-user'], $conf['gmysql-password']);
mysql_select_db($conf['gmysql-dbname']);

/* get all domains */
$query = "select name from domains where name NOT LIKE '%arpa'";
$result = mysql_query($query);


while ($row = mysql_fetch_assoc($result))
{
  /* check DNS server for domain */
  if (dns_match($my_dns,$row["name"]) === TRUE)
  {
    echo $row["name"]." use my dns\n";
  }
  else
  {
    echo $row["name"]." don't use my dns\n";
  }
}


function dns_match($my_dns,$domain)
{
  /* get DNS servers */
  $command = 'dig +short -tns '.$domain;
  exec($command,$dig);

  /* match? */
  $dig_uper = array_change_key_case($dig);
  $all_dns = array_unique(array_merge($my_dns,$dig_uper));
  $c1 = count($my_dns) + count($dig_uper);
  $c2 = count($all_dns);
  if ($c1 == $c2)
  {
    return FALSE;
  }
  else
  {
    return TRUE;
  }
}
?>

