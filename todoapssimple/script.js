document.addEventListener("DOMContentLoaded", () => {
  //variabel js
  const taskInput = document.getElementById("taskInput");
  const addTaskButton = document.getElementById("addTaskButton");
  const taskList = document.getElementById("taskList");

  //menambahkan data dengan cara click
  addTaskButton.addEventListener("click", addTask);

  //menambahkan data dengan cara di enter
  taskInput.addEventListener("keypress", function (e) {
    if (e.key === "Enter") return;
  });

  //addTask
  function addTask() {
    //deklarasi variabel
    const taskText = taskInput.value.trim();
    if (taskText === "") return; //skip kosong
    //create new task element
    const taskItem = document.createElement(taskText);
    taskList.appendChild(taskItem);
    //save localstorage
    saveTaskToLocalStorage(taskText);
    //clear inputannya
    taskInput.value = "";
  }

  function saveTaskToLocalStorage(save) {
    //mengambil data dari localstorage
    let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
    tasks.push(save);
    localStorage.setItem("tasks", JSON.stringify(tasks));
  }

  // Load tasks from Local Storage on page load
  loadTasks();
  //fungsi load task
  function loadTasks() {
    //mengambil data dari localstorage
    let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
    tasks.forEach((task) => {
      const taskItem = createTaskElement(task);
      taskList.appendChild(taskItem);
      taskList;
    });
  }

  function createTaskElement(text) {
    const li = document.createElement("li");
    li.textContent = text;

    const deleteButton = document.createElement("button");
    deleteButton.textContent = "Delete";
    deleteButton.addEventListener("click", () => {
      li.remove();
      deleteTaskFromLocalStorage(text);
    });

    li.appendChild(deleteButton);
    return li;
  }

  //delete button
  function deleteTaskFromLocalStorage(task) {
    //delete localstorage
    let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    tasks = tasks.filter((t) => t !== task);
    localStorage.setItem("tasks", JSON.stringify(tasks));
  }
});
