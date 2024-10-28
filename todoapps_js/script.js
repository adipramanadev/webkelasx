// Mendapatkan elemen dari DOM
const taskInput = document.getElementById('taskInput');
const addTaskBtn = document.getElementById('addTaskBtn');
const taskList = document.getElementById('taskList');

// Muat tugas dari local storage saat halaman dimuat
document.addEventListener('DOMContentLoaded', loadTasks);

// Event listener untuk tombol tambah tugas
addTaskBtn.addEventListener('click', addTask);

// Fungsi untuk menambahkan tugas
function addTask() {
    const task = taskInput.value.trim();
    if (task) {
        addTaskToDOM(task, false); // false berarti tugas belum selesai
        saveTaskToLocalStorage(task, false);
        taskInput.value = ''; // Kosongkan input setelah tugas ditambahkan
    }
}

// Fungsi untuk menambahkan tugas ke dalam DOM
function addTaskToDOM(task, isCompleted) {
    const li = document.createElement('li');
    li.textContent = task;

    // Jika tugas sudah selesai, tambahkan kelas 'completed'
    if (isCompleted) {
        li.classList.add('completed');
    }
    
    // Tombol Done untuk menandai tugas sebagai selesai
    const doneBtn = document.createElement('button');
    doneBtn.textContent = 'Done';
    doneBtn.classList.add('done-btn');
    doneBtn.addEventListener('click', function () {
        toggleTaskCompletion(li, task);
    });
    li.insertBefore(doneBtn, li.firstChild); // Masukkan tombol Done sebelum teks tugas

    // Tombol hapus untuk setiap tugas
    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Hapus';
    deleteBtn.addEventListener('click', function (e) {
        e.stopPropagation(); // Mencegah event click pada li
        removeTask(li, task);
    });
    li.appendChild(deleteBtn);
    
    taskList.appendChild(li);
}

// Fungsi untuk menyimpan tugas ke local storage
function saveTaskToLocalStorage(task, isCompleted) {
    let tasks = getTasksFromLocalStorage();
    tasks.push({ text: task, completed: isCompleted });
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

// Fungsi untuk mengambil tugas dari local storage
function getTasksFromLocalStorage() {
    return JSON.parse(localStorage.getItem('tasks')) || [];
}

// Fungsi untuk memuat semua tugas dari local storage ke dalam DOM
function loadTasks() {
    const tasks = getTasksFromLocalStorage();
    tasks.forEach(task => addTaskToDOM(task.text, task.completed));
}

// Fungsi untuk menghapus tugas dari DOM dan local storage
function removeTask(taskElement, task) {
    taskElement.remove();
    let tasks = getTasksFromLocalStorage();
    tasks = tasks.filter(t => t.text !== task);
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

// Fungsi untuk menandai tugas sebagai selesai atau belum selesai
function toggleTaskCompletion(taskElement, task) {
    taskElement.classList.toggle('completed');
    let tasks = getTasksFromLocalStorage();
    tasks = tasks.map(t => {
        if (t.text === task) {
            t.completed = !t.completed;
        }
        return t;
    });
    localStorage.setItem('tasks', JSON.stringify(tasks));
}
