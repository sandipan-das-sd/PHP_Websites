<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link href="calculator.css" rel="stylesheet" type="text/css"\>
    <style>
        *{
    margin:0;
    padding:0;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    box-sizing: border-box;
}


.container{
    width:100%;
    height:100vh;
    background-color: rgb(222, 250, 215);
    display: flex;
    align-items: center;
    justify-content: center;
    
   
}
.calculator{
    background:#3a4452 ;
    padding: 20px;
    border-radius: 20px;
    border: #000;
    
   
}
.calculator form input{
    border: 0;
    outline: 0;
    width: 68px;
    height: 60px;
    border-radius: 20px;
    box-shadow: -8px -8px -15px rgba(255, 255, 255, 0.8), 5px 5px 15px rgba(0, 0, 0, 0.2);
    background: #353a39;
    font-size:25px;
    color:#fff;
    cursor: pointer; 
    margin:7px;
    @media (max-width:379px) {
        width: 100%;
        height: 60%;
        border-radius: 20px;
        font-size:20px;

   }
}
.calculator form input:hover{
    color: #ff1e1e;
    background-color: black;
    transition-delay: 1ms;
}

form .display{
    display: flex;
    justify-content: flex-end;
    margin:20px 0;
    border-radius: 0px;
    box-shadow: #fff;
    @media (max-width:379px) {

}
}
form .display input{
    text-align: right;
    flex: 1;
    font-size: 45px;
    box-shadow: none;
    border-radius: 20px;
    width: 80px;
    height: 80px;

    @media (max-width:379px) {
        font-size: 30px;
        width: 60px;
       height: 70px;

}
}

   

form input.equal{
    width: 145px; 
    background-color: rgb(66, 70, 82);
    @media (max-width:379px) {
        width:60px;
    }
}
form input.operator{
    color: rgba(255, 255, 0, 0.877);
}
    </style>
</head>
<body>
    <div class="container">
        <div class="calculator">
            <form>
                <div class="display">
                   <input type="text" name="display" class="text"> 
                </div>
                <div>
                    <input type="button" value="AC" onclick="display.value =''" class="operator">
                    <input type="button" value="DE" onclick="display.value = display.value.toString().slice(0,-1)" class="operator">  
                    <input type="button" value="." onclick="display.value +='.'" class="operator">  
                    <input type="button" value="/" onclick="display.value +='/'" class="operator">
                </div>
                <div>
                    <input type="button" value="7" onclick="display.value +='7'">
                    <input type="button" value="8" onclick="display.value +='8'">  
                    <input type="button" value="9" onclick="display.value +='9'">  
                    <input type="button" value="*" onclick="display.value +='*'" class="operator">
                </div>
                <div>
                    <input type="button" value="4" onclick="display.value +='4'">
                    <input type="button" value="5" onclick="display.value +='5'">  
                    <input type="button" value="6" onclick="display.value +='6'"> 
                    <input type="button" value="-" onclick="display.value +='-'" class="operator">
                </div>
                <div>
                    <input type="button" value="1" onclick="display.value +='1'">
                    <input type="button" value="2" onclick="display.value +='2'">  
                    <input type="button" value="3" onclick="display.value +='3'">  
                    <input type="button" value="+" onclick="display.value +='+'" class="operator">
                </div>
                <div>
                    <input type="button" value="00" onclick="display.value +='00'">
                    <input type="button" value="0" onclick="display.value +='0'">  
                    <input type="button" value="=" onclick="display.value =eval(display.value)" class="equal operator">  
                </div>

            </form>

        </div>
    </div>
    <script src="calculator.js"></script>
</body>
</html>