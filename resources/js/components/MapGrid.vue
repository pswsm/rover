<template>
  <div class="map-container" :style="mapStyle">
    <div
      v-for="(row, y) in mapSize"
      :key="'row-' + y"
      class="map-row"
      :style="rowStyle"
    >
      <div
        v-for="(col, x) in mapSize"
        :key="'col-' + x"
        class="map-cell"
        :class="{ obstacle: isObstacle(x, y), rover: isRover(x, y) }"
        :style="cellStyle"
      >
        <span v-if="isRover(x, y)" class="rover-direction">{{ roverDirection }}</span>
      </div>
    </div>
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
    cellSize: {
      type: Number,
      default: 20,
    },
  },
  computed: {
    mapStyle() {
      return {
        width: this.mapSize * this.cellSize + 'px',
        height: this.mapSize * this.cellSize + 'px',
      };
    },
    rowStyle() {
      return {
        display: 'grid',
        gridTemplateColumns: `repeat(${this.mapSize}, ${this.cellSize}px)`,
      };
    },
    cellStyle() {
      return {
        width: this.cellSize + 'px',
        height: this.cellSize + 'px',
      };
    },
  },
  methods: {
    isObstacle(x, y) {
      return this.obstacles.some((obstacle) => obstacle[0] === x && obstacle[1] === y);
    },
    isRover(x, y) {
      return this.roverPosition.x === x && this.roverPosition.y === y;
    },
  },
};
</script>

<style scoped>
.map-container {
  display: grid;
  grid-template-rows: repeat(v-bind(mapSize), v-bind(cellSize)px);
  border: 1px solid #000;
  margin: auto;
}

.map-row {
  display: grid;
}

.map-cell {
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #cccccc;
}

.obstacle {
  background-color: red;
}

.rover {
  background-color: blue;
  color: white;
  font-weight: bold;
}

.rover-direction {
  font-size: 12px;
}
</style>
