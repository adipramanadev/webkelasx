const canvas = document.getElementById('animationCanvas');
const ctx = canvas.getContext('2d');

const circle = {
    x: 0, // Starting X position
    y: canvas.height / 2, // Centered vertically
    radius: 10,
    speed: 2 // Speed of the circle
};

// Function to draw the circle
function drawCircle() {
    ctx.beginPath();
    ctx.arc(circle.x, circle.y, circle.radius, 0, Math.PI * 2);
    ctx.fillStyle = 'white';
    ctx.fill();
    ctx.closePath();
}

// Function to update the circle's position
function update() {
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
    drawCircle();

    // Move the circle horizontally
    circle.x += circle.speed;

    // Reset position to the left when it reaches the right edge
    if (circle.x - circle.radius > canvas.width) {
        circle.x = -circle.radius;
    }

    requestAnimationFrame(update); // Continue the animation
}

// Start the animation
update();
