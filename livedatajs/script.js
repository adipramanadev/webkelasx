const canvas = document.getElementById('liveChart');
const ctx = canvas.getContext('2d');
const label = document.getElementById('live-data-label');

let data = Array(20).fill(0);

function updateData() {
  const newDataPoint = Math.floor(Math.random() * 100);
  data.push(newDataPoint);
  data.shift();
  label.textContent = `Live Data: ${newDataPoint}%`;
}

function drawChart() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  ctx.beginPath();
  ctx.moveTo(0, canvas.height - (data[0] * canvas.height) / 100);

  for (let i = 1; i < data.length; i++) {
    const x = (canvas.width / (data.length - 1)) * i;
    const y = canvas.height - (data[i] * canvas.height) / 100;
    ctx.lineTo(x, y);
  }

  ctx.lineTo(canvas.width, canvas.height);
  ctx.lineTo(0, canvas.height);
  ctx.closePath();
  ctx.fillStyle = 'rgba(0, 255, 0, 0.2)';
  ctx.fill();
}

function updateChart() {
  updateData();
  drawChart();
}

setInterval(updateChart, 1000);
