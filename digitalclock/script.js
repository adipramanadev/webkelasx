let timer;
let centiseconds = 0; // Centiseconds (0.01 seconds)
let isRunning = false;

const timerDisplay = document.getElementById('timerDisplay');
const startButton = document.getElementById('startButton');
const stopButton = document.getElementById('stopButton');
const resetButton = document.getElementById('resetButton');

// Update the timer display
function updateDisplay() {
    const seconds = Math.floor(centiseconds / 100); // Convert centiseconds to full seconds
    const remainingCentiSeconds = centiseconds % 100; // Get the centisecond remainder
    timerDisplay.textContent = `${String(seconds).padStart(3, '0')}:${String(remainingCentiSeconds).padStart(2, '0')}`;
}

// Start timer
startButton.addEventListener('click', function() {
    if (!isRunning) {
        isRunning = true;
        timer = setInterval(() => {
            centiseconds++;
            if (centiseconds >= 99900) { // Max value for 999:99 (99,900 centiseconds)
                clearInterval(timer);
                isRunning = false;
            }
            updateDisplay();
        }, 10);
        startButton.disabled = true;
        stopButton.disabled = false;
        resetButton.disabled = false;
    }
});

// Stop timer
stopButton.addEventListener('click', function() {
    if (isRunning) {
        clearInterval(timer);
        isRunning = false;
        startButton.disabled = false;
        stopButton.disabled = true;
    }
});

// Reset timer
resetButton.addEventListener('click', function() {
    clearInterval(timer);
    isRunning = false;
    centiseconds = 0;
    updateDisplay();
    startButton.disabled = false;
    stopButton.disabled = true;
    resetButton.disabled = true;
});

// Initial display update
updateDisplay();
