<template>
  <div class="canvas-container">
    <canvas ref="canvas" :width="canvasWidth" :height="canvasHeight"></canvas>
  </div>
</template>

<script>
export default {
  props: {
    mapSize: {
      type: Number,
      required: true,
    },
    obstacles: {
      type: Array,
      default: () => [],
    },
    roverPosition: {
      type: Object,
      default: () => ({ x: 0, y: 0 }),
    },
    roverDirection: {
      type: String,
      default: 'N',
    },
    width: {
      type: Number,
      default: 800,
    },
    height: {
      type: Number,
      default: 600,
    },
    gridSize: {
      type: Number,
      default: 20,
    },
  },
  data() {
    return {
      canvas: null,
      ctx: null,
    };
  },
  computed: {
    canvasWidth() {
      return this.width;
    },
    canvasHeight() {
      return this.height;
    },
    gridCount() {
      return this.mapSize;
    },
  },
  watch: {
    mapSize: 'drawMap',
    obstacles: 'drawObstacles',
    roverPosition: 'drawRover',
    roverDirection: 'drawRover',
  },
  mounted() {
    this.canvas = this.$refs.canvas;
    this.ctx = this.canvas.getContext('2d');
    this.drawMap();
  },
  methods: {
    drawMap() {
      const { ctx, canvasWidth, canvasHeight, gridSize, gridCount } = this;
      ctx.clearRect(0, 0, canvasWidth, canvasHeight); // Clear the canvas
      ctx.strokeStyle = '#cccccc';
      ctx.lineWidth = 1;
      this.drawObstacles();
      this.drawRover();

      const cellSize = canvasWidth / gridCount;

      for (let x = 0; x <= gridCount; x++) {
        ctx.beginPath();
        ctx.moveTo(x * cellSize, 0);
        ctx.lineTo(x * cellSize, canvasHeight);
        ctx.stroke();
      }

      for (let y = 0; y <= gridCount; y++) {
        ctx.beginPath();
        ctx.moveTo(0, y * cellSize);
        ctx.lineTo(canvasWidth, y * cellSize);
        ctx.stroke();
      }

    },
    drawObstacles() {
      const { ctx, gridSize, obstacles, mapSize } = this;
      ctx.fillStyle = '#ff0000';

      const cellSize = this.canvasWidth / mapSize;

      obstacles.forEach((obstacle) => {
        ctx.fillRect(obstacle[0] * cellSize, obstacle[1] * cellSize, cellSize, cellSize);
      });
    },
    drawRover() {
      const { ctx, gridSize, roverPosition, roverDirection, mapSize } = this;
      // ctx.clearRect(0, 0, this.canvasWidth, this.canvasHeight); // Clear the canvas
      ctx.fillStyle = '#0000ff';

      const cellSize = this.canvasWidth / mapSize;

      ctx.fillRect(roverPosition.x * cellSize, roverPosition.y * cellSize, cellSize, cellSize);

      ctx.fillStyle = '#ffffff';
      ctx.font = '12px Arial';
      ctx.clearText(roverDirection, roverPosition.x * cellSize + 5, roverPosition.y * cellSize + 12);
      ctx.fillText(roverDirection, roverPosition.x * cellSize + 5, roverPosition.y * cellSize + 12);
    },
  },
};
</script>

<style scoped>
.canvas-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; /* Full viewport height */
}

canvas {
  border: 1px solid #000;
}
</style>
