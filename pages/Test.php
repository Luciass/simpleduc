<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.progress-bar {
  width: 100%;
  height: 20px;
  background-color: #f2f2f2;
  border-radius: 10px;
  margin-top: 20px;
}

.progress {
  height: 100%;
  background-color: #4CAF50;
  border-radius: 10px;
  width: 0%;
  transition: width 0.3s ease-in-out;
}


    </style>
</head>
<body>
<form id="task-form">
  <label for="task1-input">Tâche 1 :</label>
  <input type="text" id="" />
  <label for="task2-input">Tâche 2 :</label>
  <input type="text" id="task2-input" />
  <label for="task3-input">Tâche 3 :</label>
  <input type="text" id="task3-input" />
  <label for="task4-input">Tâche 4 :</label>
  <input type="text" id="task4-input" />
  <label for="task5-input">Tâche 5 :</label>
  <input type="text" id="task5-input" />
  <button type="submit">Ajouter</button>
</form>

<div class="progress-bar">
  <div class="progress"></div>
</div>

</body>
<script src="./main.js"></script>
</html>
