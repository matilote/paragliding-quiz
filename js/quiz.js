const question = document.getElementById("question");
const choices = Array.from(document.getElementsByClassName("question-text"));
const questionCounterText = document.getElementById("progress-bar");
const choiceContainer = document.getElementsByClassName("choice-container")

let currentQuestion = {};
let acceptingAnswers = false;
let score = 0;
let questionCounter = 0;
let availableQuesions = [];

let questions = [];

fetch("./data/questions.json")
  .then(res => {
    return res.json();
  })
  .then(loadedQuestions => {
    console.log(loadedQuestions)
    questions = loadedQuestions
    startGame();
  })
  .catch( err => {
    console.errror(err)
  })

//CONSTANTS
const CORRECT_BONUS = 1;
const MAX_QUESTIONS = 3;

startGame = () => {
  questionCounter = 0;
  score = 0;
  availableQuesions = [...questions];
  getNewQuestion();
};

getNewQuestion = () => {
  if (availableQuesions.length === 0 || questionCounter >= MAX_QUESTIONS) {
    //go to the end page
    localStorage.setItem('mostRecentScore', `${score}/${MAX_QUESTIONS}`);
    return window.location.assign("result.html");
  }
  questionCounter++;
  questionCounterText.innerText = `${questionCounter}/${MAX_QUESTIONS}`;
  questionCounterText.style.width = `${(questionCounter/MAX_QUESTIONS) * 100}%`
  const questionIndex = Math.floor(Math.random() * availableQuesions.length);
  currentQuestion = availableQuesions[questionIndex];
  question.innerText = currentQuestion.question;

  choices.forEach(choice => {
    const number = choice.dataset["number"];
    choice.innerText = currentQuestion["choice" + number];
  });

  availableQuesions.splice(questionIndex, 1);
  acceptingAnswers = true;
};

choices.forEach(choice => {
  choice.addEventListener("click", e => {
    if (!acceptingAnswers) return;

    acceptingAnswers = false;
    const selectedChoice = e.target;
    const selectedAnswer = selectedChoice.dataset["number"];

    const classToApply = selectedAnswer == currentQuestion.answer ? 'correct' : 'incorrect'

    if (classToApply === "correct") {
      incrementScore(CORRECT_BONUS);
      selectedChoice.innerHTML += `<i class="fas fa-check fa-lg" style="color: green;"></i>`;
    } else {
      selectedChoice.innerHTML += `<i class="fas fa-times fa-lg" style="color: red;"></i>`;
    }

    selectedChoice.parentElement.classList.add(classToApply)
    setTimeout(() => {
      selectedChoice.parentElement.classList.remove(classToApply)
      getNewQuestion();
    }, 1000)
    
  });
});

incrementScore = num => {
  score += num;
};

