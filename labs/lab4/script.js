//=============================
// AI Scientific Calculator
// Part 4.1
//=============================

const display = document.getElementById("display");

const buttons = document.querySelectorAll(".calc-btn");

let expression = "";

let lastAnswer = "";
const historyList=document.getElementById("history-list");

const clearHistoryBtn=document.getElementById("clear-history");
//=============================
// Button Click
//=============================

buttons.forEach(button => {

    button.addEventListener("click", () => {

        const value = button.textContent;

        handleButton(value);

    });

});

//=============================
// Main Handler
//=============================

function handleButton(value){

    switch(value){

        case "AC":

            expression = "";
            break;

        case "⌫":

            expression = expression.slice(0,-1);
            break;

        case "=":

            calculate();
            return;

        case "×":

            expression += "*";
            break;

        case "÷":

            expression += "/";
            break;

        case "π":

            expression += Math.PI;
            break;

        case "e":

            expression += Math.E;
            break;

        case "√":

            expression = Math.sqrt(Number(expression)).toString();
            break;

        case "x²":

            expression = Math.pow(Number(expression),2).toString();
            break;

        case "1/x":

            expression = (1/Number(expression)).toString();
            break;

        case "|x|":

            expression = Math.abs(Number(expression)).toString();
            break;

        case "±":

            expression = (-Number(expression)).toString();
            break;

        case "%":

            expression = (Number(expression)/100).toString();
            break;

        case "Ans":

            expression += lastAnswer;
            break;

        case "sin":

            expression = Math.sin(degreeToRadian(Number(expression))).toString();
            break;

        case "cos":

            expression = Math.cos(degreeToRadian(Number(expression))).toString();
            break;

        case "tan":

            expression = Math.tan(degreeToRadian(Number(expression))).toString();
            break;

        case "log":

            expression = Math.log10(Number(expression)).toString();
            break;

        case "ln":

            expression = Math.log(Number(expression)).toString();
            break;

        case "!":

            expression = factorial(Number(expression)).toString();
            break;

        default:

            expression += value;

    }

    display.value = expression;

}

//=============================
// Calculate
//=============================

function calculate(){

    try{

        let exp=expression;

        exp=exp.replace(/sqrt\(/g,"Math.sqrt(");

        exp=exp.replace(/sin\(/g,"Math.sin(degreeToRadian(");

        exp=exp.replace(/cos\(/g,"Math.cos(degreeToRadian(");

        exp=exp.replace(/tan\(/g,"Math.tan(degreeToRadian(");

        exp=exp.replace(/log\(/g,"Math.log10(");

        exp=exp.replace(/ln\(/g,"Math.log(");

        let open=(exp.match(/\(/g)||[]).length;

        let close=(exp.match(/\)/g)||[]).length;

        while(close<open){

            exp+=")";

            close++;

        }

        const result=eval(exp);

        addHistory(expression,result);

        lastAnswer=result;

        expression=result.toString();

        display.value=expression;

    }

    catch{

        display.value="Invalid Expression";

        expression="";

    }

}

//========================
// Degree → Radian
//========================

function degreeToRadian(angle){

    return angle * Math.PI / 180;

}

//========================
// Factorial
//========================

function factorial(n){

    if(n===0 || n===1){

        return 1;

    }

    let result=1;

    for(let i=2;i<=n;i++){

        result*=i;

    }

    return result;

}

//=========================
// HISTORY
//=========================

function addHistory(exp,result){

    const item=document.createElement("div");

    item.className="history-item";

    item.innerHTML=`

        ${exp} = <strong>${result}</strong>

    `;

    historyList.prepend(item);

    saveHistory();

}

//=========================
// SAVE HISTORY
//=========================

function saveHistory(){

    localStorage.setItem(

        "calcHistory",

        historyList.innerHTML

    );

}

//=========================
// LOAD HISTORY
//=========================

window.onload=()=>{

    const data=localStorage.getItem("calcHistory");

    if(data){

        historyList.innerHTML=data;

    }

};

//=========================
// CLEAR HISTORY
//=========================

clearHistoryBtn.onclick=()=>{

    historyList.innerHTML="No calculations yet.";

    localStorage.removeItem("calcHistory");

};

//=========================================
// AI ASSISTANT
//=========================================

const userInput = document.getElementById("user-input");

const sendBtn = document.getElementById("send-btn");

const chatBox = document.getElementById("chat-box");

sendBtn.addEventListener("click", askAI);

userInput.addEventListener("keypress",function(e){

    if(e.key==="Enter"){

        askAI();

    }

});

function askAI(){

    const question=userInput.value.trim();

    if(question==="") return;

    addUserMessage(question);

    const answer=getAIResponse(question.toLowerCase());

    setTimeout(()=>{

        addBotMessage(answer);

    },500);

    userInput.value="";

}

function addUserMessage(text){

    const div=document.createElement("div");

    div.className="user-message";

    div.innerHTML=text;

    chatBox.appendChild(div);

    chatBox.scrollTop=chatBox.scrollHeight;

}

function addBotMessage(text){

    const div=document.createElement("div");

    div.className="bot-message";

    div.innerHTML=text;

    chatBox.appendChild(div);

    chatBox.scrollTop=chatBox.scrollHeight;

}

function getAIResponse(question){

// Greetings

if(question.includes("hello") || question.includes("hi"))

return "👋 Hello! Ask me any mathematics question.";


// Square Root

if(question.includes("square root"))

return "Square Root Formula:<br><br>√x gives the number whose square equals x.<br><br>Example:<br>√144 = 12";


// Percentage

if(question.includes("percentage"))

return "Percentage Formula:<br><br>(Value ÷ Total) × 100";


// Factorial

if(question.includes("factorial"))

return "Factorial:<br><br>n! = n × (n-1) × ... × 1<br><br>Example:<br>5! = 120";


// Log

if(question.includes("log"))

return "log(x) is logarithm base 10.<br><br>Example:<br>log(100)=2";


// Natural Log

if(question.includes("ln"))

return "ln(x) is logarithm with base e.";


// Sine

if(question.includes("sin"))

return "sin(30°)=0.5<br>sin(90°)=1";


// Cos

if(question.includes("cos"))

return "cos(60°)=0.5<br>cos(0°)=1";


// Tan

if(question.includes("tan"))

return "tan(45°)=1";


// PI

if(question.includes("pi"))

return "π = 3.141592653589793";


// Euler

if(question.includes("euler") || question==="e")

return "Euler Number (e) = 2.718281828";


// Pythagoras

if(question.includes("pythagoras"))

return "Pythagoras Theorem:<br><br>a²+b²=c²";


// Derivative

if(question.includes("derivative"))

return "Example:<br>d(x²)/dx = 2x";


// Integration

if(question.includes("integration"))

return "Example:<br>∫x dx = x²/2 + C";


// Quadratic

if(question.includes("quadratic"))

return "Quadratic Formula:<br><br>x=(-b±√(b²-4ac))/2a";


// AI

if(question.includes("who are you"))

return "I am your Smart Math Assistant integrated into this Scientific Calculator.";

return "Sorry 😔<br>I don't know that yet.<br><br>Try asking about:<br><br>• Factorial<br>• Percentage<br>• Log<br>• sin<br>• cos<br>• tan<br>• π<br>• Quadratic Formula";

}