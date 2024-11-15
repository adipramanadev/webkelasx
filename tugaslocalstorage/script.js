// Fungsi untuk menyimpan nama ke localStorage
function saveName() {
    const nameInput = document.getElementById('nameInput');
    const name = nameInput.value.trim();
    if (name) {
        localStorage.setItem('userName', name);
        displayGreeting();
        nameInput.value = '';
    }
}

// Fungsi untuk menampilkan pesan sapaan jika nama tersedia di localStorage
function displayGreeting() {
    const greeting = document.getElementById('greeting');
    const name = localStorage.getItem('userName');
    if (name) {
        greeting.innerHTML = `Halo, ${name}! Selamat datang kembali.`;
    } else {
        greeting.innerHTML = 'Masukkan nama Anda untuk menyimpan ke localStorage.';
    }
}

// Fungsi untuk menghapus nama dari localStorage
function clearName() {
    localStorage.removeItem('userName');
    displayGreeting();
}

// Event listener untuk form submit
document.getElementById('userForm').addEventListener('submit', (event) => {
    event.preventDefault();
    saveName();
});

// Event listener untuk tombol hapus
document.getElementById('clearButton').addEventListener('click', clearName);

// Menampilkan sapaan pada saat halaman pertama kali dimuat
displayGreeting();
