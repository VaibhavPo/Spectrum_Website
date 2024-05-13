<div style="display:none">
    <?php
    // Include your database connection file
    include('Backend/Database_Quiz.php'); ?>
</div>
<?php


// Fetch quiz questions and options from the database
$quiz_table_name = $_GET['name']; // Replace with your table name
$query = "SELECT * FROM `$quiz_table_name`";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Quiz</title>
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
    <style>
        .questions {
            width: 100%;

            /* border: 2px solid red; */

        }

        .slider-box {
            position: relative;
            width: 80vw;
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
          
        }

        .slider-box li {
            list-style: none;
            display: flex;
            /* border: 2px solid red; */
        }

        ul {
            font-size: 20px;
            font-weight: 300;
        }

        .options {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* Adjust column width as needed */
            gap: 10px;
            /* Add some gap between grid items */
            justify-content: center;
            /* Center items horizontally */
            align-items: center;
            /* Center items vertically */
            /* border: 2px solid red; */
        }

        /* Hide the default radio button */
        input[type="radio"] {
            display: none;

        }

        /* Style the custom radio button */
        input[type="radio"]+label {
            position: relative;
            padding: 5px;
            margin-top: 5px;
            padding-left: 30px;
            /* Adjust the padding as needed to control the size */
            cursor: pointer;
        }

        /* Style the radio button indicator */
        input[type="radio"]+label::before {

            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 20px;
            /* Adjust the size of the indicator */
            height: 20px;
            /* Adjust the size of the indicator */

            /* Define a gradient border image */

            border-width: 2px;
            border-style: solid;
            border-image: linear-gradient(45deg, rgb(50, 200, 150), rgb(100, 200, 255));

            /* Replace #ff0000 and #00ff00 with your desired gradient colors */
            border-image-slice: 1;


            /* Border color */

            /* Make it a circle */
            background-color: white;
            /* Background color */
        }

        /* Style the radio button indicator when selected */
        input[type="radio"]:checked+label::before {
            background: linear-gradient(45deg, rgb(40, 180, 140), rgb(90, 180, 230));
            border: 2px solid white;
            /* Change background color when selected */
        }


        img {
            max-height: 200px;
            /* Set the maximum height for images */
            width: auto;
            /* Maintain the aspect ratio while resizing */
            display: block;
            /* Remove any extra spacing around the image */
            margin: 0 auto;
            /* Center the image horizontally */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            /* Add a subtle shadow */
            border: 1px solid #ccc;
            /* Add a border */
            border-radius: 5px;
            /* Add rounded corners */
            margin-bottom: 10px;
        }

        @media screen and (max-width: 800px) {
            .slider-box li {
                height: 30px;

                
            }

            .options {
                grid-template-columns: repeat(1, 1fr);
                gap: 2px;
            }

            /* Hide the default radio button */
            input[type="radio"] {
                display: block;

            }

            /* Style the custom radio button */
            input[type="radio"]+label {
                position: relative;
                padding: 2px;
                margin-top: 0px;
                padding-left: 10px;
                /* Adjust the padding as needed to control the size */
                cursor: pointer;
            }

            /* Style the radio button indicator */
            input[type="radio"]+label::before {
                display: none;
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                width: 20px;
                /* Adjust the size of the indicator */
                height: 20px;
                /* Adjust the size of the indicator */

                /* Define a gradient border image */

                border-width: 2px;
                border-style: solid;
                border-image: linear-gradient(45deg, rgb(50, 200, 150), rgb(100, 200, 255));

                /* Replace #ff0000 and #00ff00 with your desired gradient colors */
                border-image-slice: 1;


                /* Border color */

                /* Make it a circle */
                background-color: white;
                /* Background color */
            }

            /* Style the radio button indicator when selected */
            input[type="radio"]:checked+label::before {

                /* Change background color when selected */
            }
            ul {
            font-size: 14px;
            font-weight: 300;
        }
        }


    
    </style>
</head>

<body style="min-height: 100vh;">
    <div class="nav-secondary">
        <a href="home.html" class="logo">
            <img src="Assets/icon.png" alt="Logo" width="30" height="30" id="logo-secondary">
        </a>
        <h2>
            <?php echo $quiz_table_name; ?>
        </h2>
    </div>
    
        <form action="Calculate_score.php" method="post">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="slider-box">
                    <h5 style="text-align:left; padding:10px 10px 10px 10px;">
                        <?php echo $row['question_text']; ?>
                    </h5>
                    <?php if (!empty($row['question_image'])): ?>
                        <img src="<?php echo $row['question_image']; ?>" alt="">
                    <?php endif; ?>
                    <div>
                        <ul class="options">
                            <li>
                                <input type="radio" id="option1_<?php echo $row['id']; ?>"
                                    name="answer[<?php echo $row['id']; ?>]" value="1">
                                <label for="option1_<?php echo $row['id']; ?>"><?php echo $row['option1']; ?></label>
                            </li>
                            <li>
                                <input type="radio" id="option2_<?php echo $row['id']; ?>"
                                    name="answer[<?php echo $row['id']; ?>]" value="2">
                                <label for="option2_<?php echo $row['id']; ?>"><?php echo $row['option2']; ?></label>
                            </li>
                            <li>
                                <input type="radio" id="option3_<?php echo $row['id']; ?>"
                                    name="answer[<?php echo $row['id']; ?>]" value="3">
                                <label for="option3_<?php echo $row['id']; ?>"><?php echo $row['option3']; ?></label>
                            </li>
                            <li>
                                <input type="radio" id="option4_<?php echo $row['id']; ?>"
                                    name="answer[<?php echo $row['id']; ?>]" value="4">
                                <label for="option4_<?php echo $row['id']; ?>"><?php echo $row['option4']; ?></label>
                            </li>
                        </ul>
                        
                    </div>
                </div>

                </div>
            <?php endwhile; ?>
            <input type="hidden" name="database" value="<?php echo $quiz_table_name; ?>">
            <button class="primary ">&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp; <input type="hidden"
                    name="submit" value="Submit"></button>
        </form>
   
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
$mysqli->close();
?>