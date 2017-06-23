 <?php
include('httpful.phar');
/**/
for($i=0; $i<=1; $i++)

{

   doubleo($i)."<br/>";

}
function doubleo($value)

{

   $url = "http://127.0.0.1/PHPproject/test1.php?function=index&arg=";

   $url.=$value;
//echo $url;
  $responce= \Httpful\Request::get($url)->send();
print_r($responce, false);


   

}  

 