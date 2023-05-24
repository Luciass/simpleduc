const form = document.getElementById("task-form");
const progressBar = document.querySelector(".progress");

form.addEventListener("input", function(event) {
  const completedTasks = getCompletedTasks();
  updateProgressBar(completedTasks);
});

function getCompletedTasks() {
  let completedTasks = 0;
  const taskInputs = document.querySelectorAll("input[type='date'], input[type='text'], textarea");
  
  taskInputs.forEach(function(taskInput) {
    if (taskInput.value.trim() !== "") {
      completedTasks++;
    }
  });
  
  return completedTasks;
}

function updateProgressBar(completedTasks) {
  const totalTasks = 5; // Total des champs à remplir (y compris le bouton submit)
  const progress = (completedTasks / totalTasks) * 100;
  
  progressBar.style.width = progress + "%";
}
