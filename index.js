function greet(Name){
    alert("hello"+" "+Name);
}

 var time1 = setTimeout(greet,2000,'Rushil');

 function clearGreet(){
    clearTimeout(time1,5000);
 }

 clearGreet();
 