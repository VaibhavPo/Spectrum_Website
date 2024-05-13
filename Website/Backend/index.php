<!DOCTYPE html>
<html>
<head>
    <title>Button Links</title>
    <style>
        body {
          font-family: Arial, sans-serif;
          text-align: center;
          margin: 0;
          padding: 0;
        }
        
        .button {
          display: inline-block;
          padding: 10px 20px;
          margin: 10px;
          border: none;
          background-color: #1c6393;
          color: white;
          font-size: 16px;
          cursor: pointer;
          border-radius: 4px;
        }
    
        .button:hover {
          background-color: #2980b9;
        }
      </style>
</head>
<body>

<h1>Choose What To Modify</h1>

<button class="button" onclick="window.location.href = 'SeMoreImg_bck.php';">Image</button>
<button class="button"  onclick="window.location.href = 'Modify quiz.php';">Quiz</button>
<button class="button"  onclick="window.location.href = 'SeMorePdf_bck.php';">PDF</button>

</body>
</html>
