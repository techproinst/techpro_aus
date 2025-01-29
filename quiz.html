<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personality Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #fff;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .breadcrumb {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .question {
            font-size: 24px;
            font-weight: bold;
            color: #fc3468;
            margin-bottom: 30px;
        }
        .options {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .options button {
            padding: 15px;
            font-size: 16px;
            color: #fc3468;
            background-color: #fff;
            border: 1px solid #fc3468;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
        }
        .options button:hover {
            background-color: #fc3468;
            color: #fff;
        }
        .progress-bar {
            margin-top: 30px;
            height: 10px;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #fc3468;
        }
        .progress-bar-inner {
            height: 100%;
            width: 0%;
            background-color: #fc3468;
            transition: width 0.3s;
        }
        .progress-text {
            margin-top: 10px;
            font-size: 14px;
            color: #888;
        }
        .result {
            font-size: 20px;
            color: #fc3468;
            margin-top: 20px;
            display: none;
        }
        .preloader {
            display: none;
            font-size: 18px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="breadcrumb">Home / Personality Test</div>
        <div class="question" id="question">Loading question...</div>
        <div class="options" id="options"></div>

        <div class="progress-bar">
            <div class="progress-bar-inner" id="progress-bar-inner"></div>
        </div>
        <div class="progress-text" id="progress-text">0% complete</div>
        <div class="preloader" id="preloader">Calculating your result...</div>
        <div class="result" id="result"></div>
    </div>

    <script>
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
                resultLink = "business-analysis.html";
            } else {
                resultText = "Congratulations!<br><br> Based on your responses, it seems that you have a strong affinity for Scrum Master. As a Scrum Master, you'll facilitate agile practices within teams.";
                resultLink = "scrum-analysis.html";
            }

            resultElement.innerHTML = resultText + "<br><br> <a href='" + resultLink + "' class='click'>Click Here</a>";
        }

        loadNextQuestion();
    </script>
</body>
</html>