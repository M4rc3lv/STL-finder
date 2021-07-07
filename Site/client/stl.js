$(function(){

 $("#result").on("click","button",function(){
  var audio = new Audio('client/hit.ogg');
  audio.volume = 0.04;
  audio.play();
  flash($(this).parent().parent());
 });

 var LastPad = localStorage.getItem('LastPad') ? localStorage.getItem('LastPad') : "";
 $("#pad").val(LastPad);
 localStorage.setItem('LastPad', LastPad);

 var Hist=localStorage.getItem('items') ? JSON.parse(localStorage.getItem('items')) : [];
 localStorage.setItem('items', JSON.stringify(Hist));
 Load();

 if(Params()["pad"]) {
  $("#pad").val(Params()["pad"]);
  Load();
 }

 Hist.forEach(function(I){
  $("#hist").append("<option value='"+I+"'>"+I+"</option>");
 });

 $("#hist").change(function(){
  let S = $("#hist").val();
  $("#pad").val(S);
  Load();
 });

 $("#pad").on('keyup', function (e) {
  if (e.key === 'Enter' || e.keyCode === 13) Load();
 });

 $("#recurse").click(function(){
  Load(true);
 });

 function Load(Recurse=false) {
  if(!$("#pad").val() || $("#pad").val()==="") return;

  let Found=false;
  Hist.forEach(function(I){
   if(I===$("#pad").val()) Found=true;
  });
  if(!Found) Hist.unshift($("#pad").val());
  if(Hist.length>8) Hist.length=8;
  $("#result").load("load.php?recurse="+(Recurse?1:0)+"&pad="+encodeURI($("#pad").val()+"&sort="+$('input:radio[name=sort]:checked').val()),function(){
   $("div[data-done='0']").each(function(){
    $(this).load("load.php?stlfile="+encodeURIComponent($(this).attr("data-name")),function(){
     $(this).attr("data-done","1");//.append(OSTOOLS);
     //var f=$(this).attr("data-name");
     //f = f.substring(f.lastIndexOf('/')+1);
     //f = f.substring(0,f.lastIndexOf('.'));
    });
   });
  });


  localStorage.setItem('LastPad', $("#pad").val());
  localStorage.setItem('items', JSON.stringify(Hist));
 }

 $("#pad").focus(function(){
  $(".tooltiptext").css("visibility","visible");
  setTimeout(function(){$(".tooltiptext").css("visibility","hidden");},3000);
 }).focusout(function(){
  $(".tooltiptext").css("visibility","hidden");
 }).keydown(function(e){
  if (e.key === "Enter") {console.log(13);
   $(".tooltiptext").css("visibility","hidden");
  }
 });

 $("#folderup").click(function(){

 });

 $("input:radio[name=sort]").on("change",function(){
  Load();
 });

 new ClipboardJS('button');

 function flash(x) {
  $(x).fadeOut(111).fadeIn(111).fadeOut(111).fadeIn(111);
 }


});



function Params() {
 var vars = {};
 var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
  vars[key] = value;
 });
return vars;
}
