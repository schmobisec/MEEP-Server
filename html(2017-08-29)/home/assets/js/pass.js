<script type="text/javascript">
 window.onload=function(){
  document.getElementById('my-form').onsubmit=function(){
   var pass=document.getElementById('pass').value;
   var passCheck=document.getElementById('pass-check').value;
   
   if(pass==passCheck){
    alert('성공');
   }else{
    alert('다시입력');
     return false; 
   }
   
  }
 }
</script>