<!doctype html>
<html lang="nl">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>STL-zoeker</title>
 <meta name="description" content="Snelle manier op STL- en OpenScad-bestanden te bekijken.">
 <meta name="author" content="Marcel V">
 <link rel="icon" href="/favicon.ico">
 <link rel="stylesheet" href="client/w3.css">
 <link rel="stylesheet" href="client/materialdesignicons.css">
 <link rel="stylesheet" href="client/stl.css">
 <script src="client/jquery-3.6.0.min.js"></script>
 <script src="client/stl.js"></script>
 <script src="client/clipboard.min.js"></script>
</head>
<body>
 <div class="w3-container m">
  <div class="borb">
   <b>STL-zoeker</b>
  </div>
  <div class="borb padding">
   <div class="w3-row">
    <div class="w3-half">
     <div class="tooltip">
      <input list="hist" type="text" id="pad" name="pad" placeholder="Pad naar folder">
      <span class="tooltiptext">Toets Enter om te bevestigen</span>
     </div><button title="Recurse" id="recurse"><i class="mdi mdi-folder-search-outline"></i></button -->
     <datalist id="hist"></datalist>
    </div>
    <div class="w3-half"><div class="w3-right">
     <input type="radio" name="sort" value="naam"> Naam&nbsp;&nbsp;&nbsp;
     <input type="radio" name="sort" value="grootte"> Grootte&nbsp;&nbsp;&nbsp;
     <input type="radio" name="sort" value="datum" checked> Datum</div>
    </div>
   </div>

  </div>
  <div class="" id="result">
   ...
  </div>

  <div class="borb w3-clear">
   &nbsp;
  </div>
  <div class="w3-clear">
   &nbsp;
  </div>
 </div>

</body>
</html>
