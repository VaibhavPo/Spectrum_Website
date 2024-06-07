<!DOCTYPE html>
<html>
<head>
<style>
  body {
    margin: 0;
    padding: 0;
    transition: background-color 0.5s;
  }
</style>
</head>
<body>

<button id="whiteButton">Turn White</button>

<script>
document.getElementById("whiteButton").addEventListener("click", function() {
  document.body.style.backgroundColor = "white";
});
</script>

</body>
</html>
