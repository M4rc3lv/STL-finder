<?php

function scanAllDir($dir) {
 $result = [];
 foreach(scandir($dir) as $filename) {
  if ($filename[0] === '.') continue;
   $filePath = $dir . '/' . $filename;
   if (is_dir($filePath)) {
    foreach (scanAllDir($filePath) as $childFilename) {
    $result[] = $filename . '/' . $childFilename;
   }
  }
  else
   $result[] = $filename;
 }
 return $result;
}

function scan_dir($dir) {
 $ignored = array('.', '..');
 $files = array();
 $list = array();
 if($_GET["recurse"])
  $list=scanAllDir($dir);
 else
  foreach (scandir($dir) as $file) {
   array_push($list,$file);
  }
 foreach ($list as $file) {
  if (in_array($file, $ignored) ||
   pathinfo($file, PATHINFO_EXTENSION)!=="stl")
    continue;
  if(isset($_GET["sort"]) && $_GET["sort"]==="naam") {
   $files[$file] = $file;
   asort($files, SORT_FLAG_CASE| SORT_STRING);
  }
  else if(isset($_GET["sort"]) && $_GET["sort"]==="grootte") {
   $files[$file] = filesize($dir . '/' . $file);
   arsort($files);
  }
  else {
   $files[$file] = filemtime($dir . '/' . $file);
   arsort($files);
  }
 }
 $files = array_keys($files);
 return ($files) ? $files : false;
}

if(isset($_GET["stlfile"])) {
 $F=$_GET["stlfile"];
 $Plaatje=str_replace("/","_",$F).".png";
 $Out=__DIR__."/cache/$Plaatje";

 // Indien plaatje ouder is dan STL-bestand dan opnieuw genereen
 if(!file_exists($Out) || (file_exists($Out) && filemtime($Out)< filemtime($F))) {
  $TempScadFile = __DIR__."/cache/$Plaatje.scad";
  $TempScad = fopen($TempScadFile, "w") or die("Unable to open file!");
  fwrite($TempScad, "import(\"$F\");");
  fclose($TempScad);
  exec(__DIR__."/OpenSCAD-2021.01-x86_64.AppImage --colorscheme Tomorrow  -o '$Out' '$TempScadFile'");
 }
 echo "<div class='w3-display-container'>
   <img src='cache/$Plaatje' class='w3-image' />
   <div class='w3-display-topleft FName'>".basename($F)."</div>
   <div class='w3-display-bottomleft P1'>
    <button class='w3-button Copy' data-clipboard-text='$F'>
     <i class='mdi mdi-content-copy' title='Kopiëren'></i>
    </button>
   </div>
  </div>";
}

if(isset($_GET["pad"])) {
 $files = scan_dir($_GET["pad"]);
 $i=0;
 foreach($files as $F) {
  if($F!==".." && $F!==".") {
   $C=$i==4? "NORIGHT":"";
   if($i==4) $i=0;
   else $i++;
   echo "<div class='stl $C' data-done='0' data-name='".$_GET["pad"]."/".$F."'></div>";
  }
 }
}
