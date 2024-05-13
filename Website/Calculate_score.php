<div style="display:none">
    <?php
    // Include your database connection file
    include('Backend/Database_Quiz.php'); ?>
</div>
<?php

$quiz_table_name=$_POST['database'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Replace with your table name

    // Fetch correct answers from the database
    $query = "SELECT id, correct_answer,marks FROM `$quiz_table_name`";
    $result = $mysqli->query($query) or die($mysqli->error()); // Add error handling here

    $total_score = 0;
    $user_answers = array(); // Array to store user's answers
    $correct_answers = array(); // Array to store correct answers
    $correct_answers_copy = array();

    while ($row = $result->fetch_assoc()) {
        $question_id = $row['id'];
        $correct_answer = $row['correct_answer'];
        $mark = $row['marks'];
       


        // Check if the user's answer matches the correct answer
        if (isset($_POST['answer'][$question_id])) {
            $user_answer = $_POST['answer'][$question_id];
           
            $user_answers[$question_id] = $user_answer;
            // $correct_answers[$question_id] = $correct_answer;

            if ($user_answer == $correct_answer) {
                $total_score=$total_score+$mark;
            }
        }
        $correct_answers[$question_id] = $correct_answer;
        
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ,shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="Assets/Favicons">
    <link rel="icon" type="image/png" sizes="32x32" href="Assets/Favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Assets/Favicons/favicon-16x16.png">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="button.css">
    <link rel="stylesheet" href="See more css.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,700,600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>        .slider-box {
            position: relative;
            width: 80%;
            height: auto;

            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            background-color: white;
            box-shadow: 2px 2px rgb(73, 160, 120);
            margin: 5px;
            margin-top: 5px;
            margin-bottom: 10px;
            margin-left: 0%;
        }
        li{list-style:  none;}
        ul {
            font-size: 18px;
            font-weight: 300;
        }
        .status{
            color: rgb(120, 160, 120);
        }
        .Hstatus{
            font-weight: 300;
            color: black;
        }
        @media screen and (max-width: 800px){
            ul {
            font-size: 14px;
            font-weight: 300;
        }
        p{
            margin-top:2px ;
            margin-bottom: 2px;
        }
        }
        
        </style>
        
</head>
<body>

<body style="min-height: 100vh;">
    <div class="nav-secondary">
        <a href="home.html" class="logo">
            <img src="Assets/icon.png" alt="Logo" width="30" height="30" id="logo-secondary">
        </a>
        <h2>
            <?php echo $quiz_table_name; ?>
        </h2>
    </div>
    <h3>Total Score: <?php echo $total_score; ?></h3>
    <h3>Questions and Answers:</h3>

    <?php
    // Fetch quiz questions and options from the database
    
    $query = "SELECT * FROM `$quiz_table_name`";
    $result = $mysqli->query($query);

    // Iterate through the questions and display them with answers and status
    while ($row = $result->fetch_assoc()) {
        $question_id = $row['id'];
        $correct_answer = array_key_exists($question_id, $correct_answers) ? $correct_answers[$question_id] : 'hi';
        $user_answer = array_key_exists($question_id, $user_answers) ? $user_answers[$question_id] : '';
    
        echo "<div class='slider-box'>";
        echo "<h5>{$row['question_text']}</h5>";
    
        if (!empty($row['question_image'])) {
            echo "<img src='{$row['question_image']}' alt='' width='200'>";
        }
    
        echo "<ul >";
        echo "<li style='text-justify:left'>a) {$row['option1']}</li>";
        echo "<li style='text-justify:left'>b) {$row['option2']}</li>";
        echo "<li style='text-justify:left'>c) {$row['option3']}</li>";
        echo "<li style='text-justify:left'>d) {$row['option4']}</li>";
        echo "</ul>";
    
        if (empty($user_answer)) {
            echo "<p class='status'><span class='Hstatus'>Status: </span> Not Attempted";
            echo " (Correct Answer: $correct_answer)</p>";
        } else {
            echo "<p>Your Answer: $user_answer</p>";
    
            if ($user_answer == $correct_answer) {
                echo "<p><span class='Hstatus'>Status: </span> <span style='color:green'>Correct</span></p>";
            } else {
                echo "<p class='status'> <span class='Hstatus'>Status: </span><span style='color:red'>Wrong </span>(Correct Answer: $correct_answer)</p>";
            }
        }
    
        echo "</div>";
    }
    
    ?>
    <button class="secondary" onclick="window.location.href='quiz.php?name=<?php echo $quiz_table_name; ?>'">Once more</button>
    <footer class="footer" style="margin-top:auto">
    <div class="social-icons">
      <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
      <!-- Add more social media icons as needed -->
    </div>
    <div class="footerText">
      Thank You For visiting us.

    </div>
    <div class="footerText">
      <a href="mailto:bc@gmail.com" class="mail">For support</a>
    </div>
  </footer>
</body>
</html>

<?php
}

$mysqli->close();
?>
