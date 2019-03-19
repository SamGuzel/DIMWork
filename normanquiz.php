<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>WarHistory.Uk</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/quiz.css" rel="stylesheet">
</head>
<body>
    <!-- This is the php to include the nav bar -->
    <?php include('includes/nav.php') ?>

    <header>
        <!-- Full Page Intro -->
        <div id="intro-section" class="view">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-gradient d-flex justify-content-center align-items-center">

                <!-- Content -->
                <div class="container px-md-3 px-sm-0">

                    <!--Grid row-->
                    <div class="row wow fadeIn container">

                        <!--Grid column-->
                        <div id="quiz"></div>
                        <div class="quiz-container center">
                        <button id="previous">Previous Question</button>
                        <button id="next">Next Question</button>
                        <button id="submit">Submit Quiz</button>
                        <div id="results"></div>
                        </div>



                        </div>
                        <!--Grid column-->

                    </div>
                    <!--Grid row-->

                </div>
                <!-- Content -->
</div>

        <!-- Full Page Intro -->

<script>
    (function () {
        const myQuestions = [{
                question: "When did the norman conquest start?",
                answers: {
                    a: "1096",
                    b: "2006",
                    c: "1066"
                },
                correctAnswer: "c"
            },
            {
                question: "Which king did not have a claim to the thrown?",
                answers: {
                    a: "King Harald Hardrada",
                    b: "Earl Harold Godwinson",
                    c: "Duke William of Normandy",
                    d: "King Henry the 8th"
                },
                correctAnswer: "d"
            },
            {
                question: "Which King won the crown?",
                answers: {
                    a: "King Harald Hardrada",
                    b: "Earl Harold Godwinson",
                    c: "Duke William of Normandy",
                    d: "King Henry the 8th"
                },
                correctAnswer: "c"
            },
            {
                question: "The Battle of Stamford Bridge was known as what?",
                answers: {
                    a: "The end of the viking age",
                    b: "A football derby game",
                    c: "The bloodies battle in history",
                    d: "A lie made up by the english"
                },
                correctAnswer: "a"
            }

        ];

        function buildQuiz() {
            // we'll need a place to store the HTML output
            const output = [];

            // for each question...
            myQuestions.forEach((currentQuestion, questionNumber) => {
                // we'll want to store the list of answer choices
                const answers = [];

                // and for each available answer...
                for (letter in currentQuestion.answers) {
                    // ...add an HTML radio button
                    answers.push(
                        `<label>
             <input type="radio" name="question${questionNumber}" value="${letter}">
              ${letter} :
              ${currentQuestion.answers[letter]}
           </label>`
                    );
                }

                // add this question and its answers to the output
                output.push(
                    `<div class="slide">
           <div class="question"> ${currentQuestion.question} </div>
           <div class="answers"> ${answers.join("")} </div>
         </div>`
                );
            });

            // finally combine our output list into one string of HTML and put it on the page
            quizContainer.innerHTML = output.join("");
        }

        function showResults() {
            // gather answer containers from our quiz
            const answerContainers = quizContainer.querySelectorAll(".answers");

            // keep track of user's answers
            let numCorrect = 0;

            // for each question...
            myQuestions.forEach((currentQuestion, questionNumber) => {
                // find selected answer
                const answerContainer = answerContainers[questionNumber];
                const selector = `input[name=question${questionNumber}]:checked`;
                const userAnswer = (answerContainer.querySelector(selector) || {}).value;

                // if answer is correct
                if (userAnswer === currentQuestion.correctAnswer) {
                    // add to the number of correct answers
                    numCorrect++;

                    // color the answers green
                    answerContainers[questionNumber].style.color = "lightgreen";
                } else {
                    // if answer is wrong or blank
                    // color the answers red
                    answerContainers[questionNumber].style.color = "red";
                }
            });

            // show number of correct answers out of total
            resultsContainer.innerHTML = `${numCorrect} out of ${myQuestions.length}`;
        }

        function showSlide(n) {
            slides[currentSlide].classList.remove("active-slide");
            slides[n].classList.add("active-slide");
            currentSlide = n;

            if (currentSlide === 0) {
                previousButton.style.display = "none";
            } else {
                previousButton.style.display = "inline-block";
            }

            if (currentSlide === slides.length - 1) {
                nextButton.style.display = "none";
                submitButton.style.display = "inline-block";
            } else {
                nextButton.style.display = "inline-block";
                submitButton.style.display = "none";
            }
        }

        function showNextSlide() {
            showSlide(currentSlide + 1);
        }

        function showPreviousSlide() {
            showSlide(currentSlide - 1);
        }

        const quizContainer = document.getElementById("quiz");
        const resultsContainer = document.getElementById("results");
        const submitButton = document.getElementById("submit");

        // display quiz right away
        buildQuiz();

        const previousButton = document.getElementById("previous");
        const nextButton = document.getElementById("next");
        const slides = document.querySelectorAll(".slide");
        let currentSlide = 0;

        showSlide(0);

        // on submit, show results
        submitButton.addEventListener("click", showResults);
        previousButton.addEventListener("click", showPreviousSlide);
        nextButton.addEventListener("click", showNextSlide);
    })();
</script>
