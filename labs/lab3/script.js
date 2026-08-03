// ==============================
// QUIZ APP
// ==============================

// Select 20 random questions (or fewer if question bank is smaller)
let questions = [...questionBank]
    .sort(() => Math.random() - 0.5)
    .slice(0, Math.min(20, questionBank.length));

let currentQuestion = 0;
let score = 0;
let answers = new Array(questions.length).fill(null);

const startScreen = document.getElementById("start-screen");
const quizBox = document.getElementById("quiz-box");
const resultBox = document.getElementById("result-box");

const startBtn = document.getElementById("start-btn");
const nextBtn = document.getElementById("next-btn");
const prevBtn = document.getElementById("prev-btn");
const restartBtn = document.getElementById("restart-btn");

const questionElement = document.getElementById("question");
const optionsElement = document.getElementById("options");

const progressBar = document.getElementById("progress-bar");
const questionNumber = document.getElementById("question-number");
const scoreElement = document.getElementById("score");

const timerElement = document.getElementById("timer");

let timeLeft = 20 * 60;
let timer;

// ==============================
// START QUIZ
// ==============================

startBtn.addEventListener("click", () => {

    startScreen.classList.add("hide");

    quizBox.classList.remove("hide");

    startTimer();

    loadQuestion();

});

// ==============================
// LOAD QUESTION
// ==============================

function loadQuestion() {

    const q = questions[currentQuestion];

    questionNumber.textContent = currentQuestion + 1;

    questionElement.textContent = q.question;

    progressBar.style.width =
        ((currentQuestion + 1) / questions.length) * 100 + "%";

    optionsElement.innerHTML = "";

    q.options.forEach((option, index) => {

        const div = document.createElement("div");

        div.className = "option";

        div.textContent = option;

        if (answers[currentQuestion] === index) {

            div.classList.add("selected");

        }

        div.onclick = () => selectOption(index);

        optionsElement.appendChild(div);

    });

}

// ==============================
// SELECT OPTION
// ==============================

function selectOption(index) {

    answers[currentQuestion] = index;

    loadQuestion();

}

// ==============================
// NEXT
// ==============================

nextBtn.addEventListener("click", () => {

    if (currentQuestion < questions.length - 1) {

        currentQuestion++;

        loadQuestion();

    }

    else {

        finishQuiz();

    }

});

// ==============================
// PREVIOUS
// ==============================

prevBtn.addEventListener("click", () => {

    if (currentQuestion > 0) {

        currentQuestion--;

        loadQuestion();

    }

});

// ==============================
// TIMER
// ==============================

function startTimer() {

    timer = setInterval(() => {

        timeLeft--;

        let minutes = Math.floor(timeLeft / 60);

        let seconds = timeLeft % 60;

        timerElement.textContent =

            `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;

        if (timeLeft <= 0) {

            clearInterval(timer);

            finishQuiz();

        }

    }, 1000);

}

// ==============================
// RESULT
// ==============================

function finishQuiz() {

    clearInterval(timer);

    score = 0;

    questions.forEach((q, index) => {

        if (answers[index] === q.answer) {

            score++;

        }

    });

    quizBox.classList.add("hide");

    resultBox.classList.remove("hide");

    scoreElement.textContent =

        `${score} / ${questions.length}`;

}

// ==============================
// RESTART
// ==============================

restartBtn.addEventListener("click", () => {

    location.reload();

});