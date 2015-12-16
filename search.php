<?php

// #####################
// ## PHP-Suche 1.4.4 ##
// #####################

/* *** LIZENZVERTRAG ***

Pflichten und Einschr�nkungen
-----------------------------

Der Copyright-Vermerk und der Link zu "http://www.gaijin.at/" d�rfen nicht
entfernt, ver�ndert oder unkenntlicht gemacht werden und m�ssen gut sichtbar an
unver�nderter Position angezeigt werden.

Der Quellcode des Scripts darf nicht verkauft, oder sonst, kostenlos oder gegen
ein Entgelt weitergegeben, oder in irgendeiner Weise ver�ffentlicht werden.
Dies gilt speziell f�r die Ver�ffentlichung im Internet, auf sog. Heft-CDs oder
anderen Software-Sammlungen.


Benutzungsrechte
----------------

Das Script darf kostenlos f�r private Zwecke genutzt werden. Die Verwendung des
Scripts auf kommerziellen Seiten oder die kommerzielle Verwendung des Scripts
(z.B. durch Webdesigner) ist verboten.

Alle anderen Rechte, einschlie�lich des Ver�ffentlichungsrechts, bleiben beim
Autor.

Es besteht kein Recht auf Support oder sonstige Hilfestellung durch den Autor.

Das Script kann an die pers�nlichen Erfordernisse angepasst werden. Der
Copyright-Vermerk und der Link zu "http://www.gaijin.at/" m�ssen in der unter
"Pflichten und Einschr�nkungen" angegebenen Form erhalten bleiben.

Zuwiderhandlungen gegen Bestimmungen dieses Lizenzvertrages k�nnen
strafrechtlich und zivilrechtlich verfolgt werden.


Haftungsausschluss
------------------

Die Verwendung des Scripts erfolgt auf eigene Verantwortung. Der Autor
�bernimmt keine Haftung f�r die Richtigkeit und Funktionsf�higkeit des Scripts.
Der Autor haftet weder f�r direkte, noch f�r indirekte Sch�den, die durch das
Script entstanden sind. Dies umfasst vor allem, aber nicht ausschlie�lich,
Sch�den an der Hardware, am Betriebssystem oder an anderen Programmen, sowie
die Beeintr�chtigung des Gesch�ftsbetriebes.


Ausnahmen
---------

Die Erteilung einer Ausnahme von den Bestimmungen dieses Lizenzvertrages
erfordert eine ausdr�ckliche Genehmigung des Autors, die ggf. per E-Mail
erteilt wird.

Wenn Sie Fragen zur Lizenz haben, oder eine Ausnahmegenhemigung w�nschen,
senden Sie bitte eine E-Mail an: info@gaijin.at


Professional Version
--------------------

Einige Funktionen dieses Programms stehen nur in der Professional-Version zur
Verf�gung (nur f�r ausgew�hlte �bersetzer und sonstige Personen, die das Script
auf andere Weise unterst�tzt haben). F�r eventuelle Fragen wenden Sie sich
bitte an <webmaster@gaijin.at>.

Features der Professional Version:
  o) Viele zus�tzliche Konfigurationsm�glichkeiten.
  o) Unterverzeichnisse (in beliebiger Tiefe) k�nnen durchsucht werden.
  o) Die Ergebnisse k�nnen seitenweise angezeigt werden, wobei die Treffer pro
     Seite festgelegt werden k�nnen.

*/

define('INTERN_CALL', '1');

// *********************
// *** Einstellungen ***
// *********************

// Sprache / Language
include_once('language/german.php');
//include_once('language/english.php');

// Domain-Name f�r die Anzeige in den Resultaten
// z.B. "http://www.gaijin.at"
$DomainName = 'http://www.dine.bronxx.org';

// Root-Verzeichnis f�r den Zugriff auf die Dateien am Server
// Beispiel: $RootDir=dirname('/htdocs');
$RootDir = dirname('dine.bronxx.org');

// Dateiname f�r die Protokollierung der Suchbegriffe
// (kein Dateiname zum deaktivieren der Protokollierung)
// z.B. "../../files/logs/search_words.log"
$SearchWordLog = '';

// L�nge der Textfragmente um die Fundstellen (in Zeichen)
$Found_Piece_Len = 50;

// Erlaubtes Verzeichnis
// Z.B.: $AllowedDirs = $RootDir.'/content';
$AllowedDir = $RootDir;

// Erlaubte Erweiterungen als Array, getrennt mit einem Beistrich
// Z.B.: $AllowedExts=array('.php','.php3','.php4','.htm','.html','.ihtml','.shtm','.shtml','.txt');
$AllowedExts = array('.php','.html','.shtml');

// Deutsche Umlaute dekodieren ("&auml;" wird zu "ä")
$ActivateUmlaut = true;

// Dekodiert HTML-Entities (dadurch wird beispielsweise "&auml;" zu "�")
$EntityDecode = true;

// Links zu den gefundenen Seiten in einem neuen Tab/Fenster �ffnen
$LinkTargetBlank = true;

// Zeichensatz f�r das Suchscript
//$Charset = 'utf-8';
$Charset = 'iso-8859-1';

// Unterst�tzung f�r diverse Schreibweisen von deutschen Sonderzeichen (z.B. "ue", "sz" oder "u" statt "�").
$GermanUml = true;

// *****************************************************************************

// DIE FOLGENDEN EINSTELLUNGEN SOLLTEN NICHT VER�NDERT WERDEN!
// DO NOT CHANGE ANY OF THE FOLLOWING SETTINGS!

$SearchIsUTF8 = (strtolower($Charset) == 'utf-8');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?php echo GetLngStr('PageTitle'); ?></title>

<meta name="title" content="<?php echo GetLngStr('PageTitle'); ?>">
<meta name="author" content="Werner Rumpeltesz">
<meta name="robots" content="noindex,nofollow">
<meta http-equiv="content-type" content="text/html; charset='<?php echo $Charset; ?>">
<link rel=stylesheet type="text/css" href="search.css">

</head>
<body>



<h4><?php echo GetLngStr('PageTitle'); ?></h4>

<?php
  $SearchTerm = FormatSearchString(stripslashes(GetParam("q", "P")));
  if (!$SearchTerm) $SearchTerm = FormatSearchString(stripslashes(GetParam("q", "G")));
?>

<table border=0 cellspacing=0 cellpadding=0><tr><td>
<form class=formbox action="<?php echo GetParam('PHP_SELF', 'S'); ?>" method="post">
<table border=0 cellspacing=0 cellpadding=1>
<tr><td class=formfield nowrap><?php echo GetLngStr('FormSearchTerm'); ?>&nbsp;</td><td><input type="text" name="q" size=40 maxlength=250 value="<?php echo $SearchTerm; ?>"></td></tr>
<tr><td></td><td class=formfield><input type="submit" value="<?php echo GetLngStr('FormSubmitButton'); ?>" name="submit">&nbsp;&nbsp;&nbsp;<?php echo GetLngStr('FormAndOperator'); ?></td></tr>
</table>
</form>
</td></tr></table>

<p><small><b>PHP-Suche</b> powered by <a href="http://www.gaijin.at/" target="_blank">www.gaijin.at</a></small></p>

<br>

<?php

if($SearchTerm){
  // Protokollierung der Suchbegriffe
  if(file_exists($SearchWordLog)) {
    $fp=@fopen($SearchWordLog, 'a');
    if($fp) {
      flock($fp,2);
      fputs($fp,$SearchTerm."\r\n",256);
      flock($fp,3);
      fclose($fp);
    }
  }

  echo '<h4>'.GetLngStr('Result').'</h4>'."\n";

  $files=ReadDirs($AllowedDir, $AllowedExts);

  $ResultCount=0;
  if($files && $SearchTerm){
    foreach($files as $f){
      if(SearchFile($f,$SearchTerm)){
        $fn=$f;
        if(substr($f,0,strlen($RootDir))==$RootDir) $fn=$DomainName.substr($f,strlen($RootDir));
        $ResultCount++;
        echo $ResultCount.'. ';
        echo '<a href="'.$fn.'"';
        if ($LinkTargetBlank) echo ' target="_blank"';
        echo '><b>'.$Site_Title.'</b></a><br>';
        echo '<span class=small><span class=grey>'.$Site_Content.'</span></span><br>';
        echo '<span class=grey>'.GetLngStr('ResultItemFile').'</span> <span class=green>'.$fn.'</span>';
        echo ' - ';
        echo '<span class=grey>'.GetLngStr('ResultItemSize').'</span> <span class=green>'.round(filesize($f)/1024,2).' '.GetLngStr('ResultItemSizeKB').'</span>';
        echo '<br>';
        echo "<br>\n";
      }
    }
    clearstatcache();
  }
  echo '<p>'.GetLngStr('ResultPagesFound', $ResultCount).'</p>'."\n";
  echo '<p><small><b>PHP Search</b> powered by <a href="http://www.gaijin.at/" target="_blank">www.gaijin.at</a></small></p>'."\n";
}

// ############################################################################

function SearchFile($localfile, $search){
  global $Found_Piece_Len;
  global $EntityDecode;
  global $RootDir;
  global $DomainName;
	global $Charset, $SearchIsUTF8, $GermanUml;
	
  global $Site_Title;
  global $Meta_Title;
  global $Site_Content;
  global $Meta_Description;
  global $Meta_Robots;

  $Site_Title='';
  $Meta_Title='';
  $Meta_Keywords='';
  $Site_Content='';
  $Meta_Description='';
  $Meta_Robots='';
  
  $url = $localfile;
  if (substr($localfile, 0, strlen($RootDir)) == $RootDir) $url = $DomainName.substr($localfile, strlen($RootDir));

  // *** Meta-Angaben ermitteln ***
  $gmtarray=@get_meta_tags($url);
  if ($gmtarray !== false) {
    while(list($key,$val)=each($gmtarray)){
      switch(strtolower($key)){
        case 'title': $Meta_Title=$val; break;
        case 'keywords': $Meta_Keywords=$val; break;
        case 'description': $Meta_Description=$val; break;
        case 'robots': $Meta_Robots=strtolower($val); break;
        case 'revisit': $Meta_Revisit=strtolower($val); break;
        case 'revisit-after': $Meta_RevisitAfter=strtolower($val); break;
      }
    }
  }

  // *** Dateiinhalt einlesen (bzw. Ausgabe bei PHP) ***
  $fp=@fopen($url,'r');
  if(!$fp) return false;
  $content='';
  while(!feof($fp)){
    $content.=fgets($fp,10240);
  }
  fclose($fp);

  // UTF-8 BOM entfernen und Kodierung erkennen
  $isutf8 = false;
  if (substr($content, 0, 3) == "\xEF\xBB\xBF") {
		// UTF-8 BOM entfernen
		$content = substr($content, 3);
		$isutf8 = true;
  } else {
		if (preg_match('/<head.*?>.*?<meta [^>]*content[^>]*=[^>]*charset[^>]*=([a-z_\-\d]+)[^a-z_\-\d]*>.*?<\/head>/si', $content, $matches) == 1) {
			if (count($matches) == 2) {
				$pagecharset = strtolower(trim($matches[1]));
				if ($pagecharset == 'utf-8') {
					$isutf8 = true;
				}
			}
		}
  }

  // Zu durchsuchende Dateien kodieren oder dekodieren
  if ($SearchIsUTF8 && !$isutf8) {
		$content = utf8_encode($content);
	} else if (!$SearchIsUTF8 && $isutf8) {
		$content = utf8_decode($content);
	}

  // HTML-Entities konvertieren
  if ($EntityDecode) {
    $content = html_entity_decode($content, ENT_COMPAT, $Charset);
  } else {
		$content = str_replace('&nbsp;', ' ', $content);
	}
	
	// PHP-Scripts entfernen
  $content = preg_replace('/<\?.*?\?>/s', '', $content);
	
  // *** Seitentitel ermitteln ***
  $Site_Title = GetSiteTitle($content);
  if(!$Site_Title) $Site_Title = $Meta_Title;
  if(!$Site_Title) $Site_Title = basename($url);

	// Kopfzeilen entfernen
	$content = preg_replace('/<head.*?>.*?<\/head>/si', '', $content);
	
	// Zu durchsuchende Daten zusammenstellen
	$searchtitle = $Site_Title;
	if ($searchtitle != $Meta_Title) $searchtitle .= ' '.$Meta_Title;
	$content = $searchtitle.' '.$Meta_Keywords.' '.$Meta_Description.' '.trim($content);

  $content = strip_tags($content);
  $content = str_replace("\n", ' ', $content);
  $content = str_replace("\r", '', $content);
  $sc = ' '.trim($content);

  while(strpos($sc,'  ')){
    $sc=str_replace('  ',' ',$sc);
  }
  $content=$sc;

  // *** Suchen ***
  $found = false;
  if ($SearchIsUTF8) {
		$a = explode(' ', mb_convert_case($search, MB_CASE_LOWER, $Charset));
		$lowcontent = mb_convert_case($content, MB_CASE_LOWER, $Charset);
  } else {
		$a = explode(' ', strtolower($search));
		$lowcontent = strtolower($content);
  }
  
  $result_text = '';
  foreach ($a as $arg) {
    $p0len = 0;
    $p0 = false;
    
    // Suche mit deutschen Sonderzeichen in diversen Schreibweisen.
    if ($GermanUml) {
      $regarg = $arg;
      $regarg = preg_replace('/(�|ae|a)/i', '(�|ae|a)', $regarg);
      $regarg = preg_replace('/(�|oe|o)/i', '(�|oe|o)', $regarg);
      $regarg = preg_replace('/(�|ue|u)/i', '(�|ue|u)', $regarg);
      $regarg = preg_replace('/(�|sz|ss)/i', '(�|sz|ss)', $regarg);
      
      if ($regarg != $arg) {
        if (preg_match('/'.$regarg.'/i', $lowcontent, $matches, PREG_OFFSET_CAPTURE)) {
          $p0 = $matches[0][1];
          $p0len = strlen($matches[0][0]);
        }
      }
    }
    
    // Normale Suchen ohne Ersetzungen (zeichengleich)
    if ($p0 === false) {
      $p0 = strpos($lowcontent, $arg);
      $p0len = strlen($arg);
    }
    
    if ($p0 !== false) {
      $p1 = $Found_Piece_Len;
      $p2 = $Found_Piece_Len;
      if (($p0 - $p1) < 0) $p1 = $p0;
      $result_text .= '...' . htmlspecialchars(substr($content, $p0 - $p1, $p1));
      $result_text .= '<span class=hit>'. htmlspecialchars(substr($content, $p0, $p0len)) . '</span>';
      $result_text .= htmlspecialchars(substr($content, $p0 + $p0len, $p2)) . '...';
      $found = true;
    } else {
      $found = false;
      break;
    }
  }

  if (!$found) return false;

  $Site_Content = $result_text;

  return true;
}

// ############################################################################

function FormatSearchString($search){
  while (strpos($search, '  ')) {
    $search = str_replace('  ', ' ', $search);
  }
  return trim($search);
}

// ############################################################################

function ReadDirs($d,$ExtArray){
  $fileArray=array();
  if($hDir = opendir($d)){
    while($file=readdir($hDir)){
			if ( ($file == '.') || ($file == '..') ) continue;
      if(!is_dir($d.'/'.$file)){
        // *** .*-Dateien (zB .htaccess) ignorieren ***
        if(substr($file,0,1)!='.'){
  		    foreach($ExtArray as $ext){
		        if(substr(strtolower($file),strlen($file)-strlen($ext),strlen($ext))==strtolower($ext)){
    			    array_push($fileArray,$d.'/'.$file);
		        	continue;
		        }
		      }
	      }
      }
    }
    closedir($hDir);
  }
  return $fileArray;
}

// ############################################################################

function GetSiteTitle($content)
{
  $p1=strpos(strtolower($content),'<title>');
  if(!$p1) return false;
  $p2=strpos(strtolower($content),'</title>',$p1);
  if(!$p2) return false;
  return trim(substr($content,$p1+7,$p2-$p1-7));
}

// ############################################################################

function GetParam($ParamName, $Method = 'P', $DefaultValue = '') {
  if ($Method == 'P') {
    if (isset($_POST[$ParamName])) return $_POST[$ParamName]; else return $DefaultValue;
  } else if ($Method == 'G') {
    if (isset($_GET[$ParamName])) return $_GET[$ParamName]; else return $DefaultValue;
  } else if ($Method == 'S') {
    if (isset($_SERVER[$ParamName])) return $_SERVER[$ParamName]; else return $DefaultValue;
  }
}

// ############################################################################

function GetLngStr($sId, $sParams = '') {
	global $Lang;
  global $SearchIsUTF8;
  
	if (isset($Lang[$sId]))
		$sResult = $Lang[$sId];
	else
		$sResult = '{Missing string "'.$sId.'"}';

  $aParams = explode("\t", $sParams);
  for ($i = 0; $i < count($aParams); $i++) {
    $sResult = str_replace('%s'.($i + 1).'%', $aParams[$i], $sResult);
  }
  
  if (!$SearchIsUTF8) $sResult = utf8_decode($sResult);
  
  return $sResult;
}

// ############################################################################

?>



</body>
</html>
