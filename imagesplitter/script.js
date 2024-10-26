document.getElementById('splitButton').addEventListener('click', function() {
    const x = parseInt(document.getElementById('xInput').value);
    const y = parseInt(document.getElementById('yInput').value);
    const image = document.getElementById('sourceImage');
    
    if (isNaN(x) || isNaN(y) || x <= 0 || y <= 0) {
        alert('Please enter valid numbers for X and Y.');
        return;
    }

    // Clear previous grid
    const imageGrid = document.getElementById('imageGrid');
    imageGrid.innerHTML = '';
    
    // Get original image dimensions
    const imgWidth = image.naturalWidth;
    const imgHeight = image.naturalHeight;
    
    // Calculate width and height for each grid item
    const tileWidth = imgWidth / x;
    const tileHeight = imgHeight / y;

    // Set up grid with dynamic rows and columns
    imageGrid.style.gridTemplateColumns = `repeat(${x}, ${tileWidth}px)`;
    imageGrid.style.gridTemplateRows = `repeat(${y}, ${tileHeight}px)`;

    for (let row = 0; row < y; row++) {
        for (let col = 0; col < x; col++) {
            const gridItem = document.createElement('div');
            gridItem.classList.add('grid-item');
            gridItem.style.width = `${tileWidth}px`;
            gridItem.style.height = `${tileHeight}px`;
            
            const tile = document.createElement('img');
            tile.src = image.src;
            tile.style.width = `${imgWidth}px`;
            tile.style.height = `${imgHeight}px`;
            tile.style.objectFit = 'none';
            tile.style.transform = `translate(-${col * tileWidth}px, -${row * tileHeight}px)`;

            gridItem.appendChild(tile);
            imageGrid.appendChild(gridItem);

            // Add click event to remove the tile with animation
            gridItem.addEventListener('click', function() {
                gridItem.classList.add('fade-out');
                setTimeout(() => gridItem.remove(), 500); // Delay for animation
            });
        }
    }
});

// Load the image (make sure it loads before splitting)
window.onload = function() {
    const img = document.getElementById('sourceImage');
    img.onload = function() {
        img.style.display = 'block';
    };
};
