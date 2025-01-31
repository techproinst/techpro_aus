const questions = [
  "Will you describe yourself as someone who likes to solve business-related problems?",
  "Do you enjoy facilitating and ensuring resources are available to get things done?",
  "Do you enjoy facilitating needs and requests between different kinds of people?",
  "Do you like facilitating a meeting to resolve problems among people?",
  "Would you describe yourself as someone that enjoys working with numbers and using experiences and trends to make decisions?",
  "I like identifying and removing impediments.",
  "I am interested in writing and documenting events, processes, and how things should be done.",
  "I am a man-manager who can easily influence people to achieve stated goals with minimal persuasion.",
  "I like to help my team to resolve conflicts?",
  "Do you consider yourself someone who enjoys defining and communicating a clear and compelling vision for new initiatives?"
];

let currentQuestion = -1;
let yesCount = 0;
let noCount = 0;
let neitherCount = 0;

const questionElement = document.getElementById("question");
const optionsElement = document.getElementById("options");
const progressBarInner = document.getElementById("progress-bar-inner");
const progressText = document.getElementById("progress-text");
const preloaderElement = document.getElementById("preloader");
const resultElement = document.getElementById("result");

function loadNextQuestion() {
  currentQuestion++;

  if (currentQuestion < questions.length) {
      questionElement.textContent = (currentQuestion + 1) + ". " + questions[currentQuestion];
      optionsElement.innerHTML = "";

      ["Yes", "No", "Neither"].forEach(option => {
          const button = document.createElement("button");
          button.textContent = option;
          button.onclick = () => handleAnswer(option);
          optionsElement.appendChild(button);
      });

      updateProgress();
  } else {
      showPreloader();
  }
}

function handleAnswer(answer) {
  if (answer === "Yes") yesCount++;
  if (answer === "No") noCount++;
  if (answer === "Neither") neitherCount++;

  loadNextQuestion();
}

function updateProgress() {
  // Calculate progress as 10% per question
  const progress = currentQuestion * 10;
  progressBarInner.style.width = progress + "%";
  progressText.textContent = progress + "% complete";
}

function showPreloader() {
  questionElement.style.display = "none";
  optionsElement.style.display = "none";
  preloaderElement.style.display = "block";
  
  // Set final progress to 100%
  progressBarInner.style.width = "100%";
  progressText.textContent = "100% complete";

  setTimeout(showResult, 2000);
}

function showResult() {
  preloaderElement.style.display = "none";
  resultElement.style.display = "block";

  let resultText = "";
  let resultLink = "";

  if (yesCount > noCount && yesCount > neitherCount) {
      resultText = "Congratulations! <br><br> Based on your responses, it seems that you have a strong affinity for Business Analysis. As a Business Analyst, you'll bridge the gap between business needs and technical solutions.";
      resultLink = "business-analysis";
  } else {
      resultText = "Congratulations!<br><br> Based on your responses, it seems that you have a strong affinity for Scrum Master. As a Scrum Master, you'll facilitate agile practices within teams.";
      resultLink = "scrum-master";
  }

  resultElement.innerHTML = resultText + "<br><br> <a href='" + resultLink + "' class='click-btn'>Click Here</a>";
}

loadNextQuestion();