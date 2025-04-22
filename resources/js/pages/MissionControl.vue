<template>
  <div class="container">
    <h1>Welcome to the Mars Rover Mission!</h1>
    <p>{{ message }}</p>
    <ButtonLink @click="connectToMissionControl">Connect to Mission Control</ButtonLink>
    <div v-if="connected" class="center">
      <h2>Connected to Mission Control</h2>
      <p>You are now connected to the mission control system.</p>
      <MapGrid
        :mapSize="mapSize"
        :obstacles="obstacles"
        :roverPosition="roverPosition"
        :roverDirection="roverDirection"
        :cellSize="gridSize"
      />
      <div>
        <input v-model="commands" placeholder="Enter commands (e.g., FFLRR)" />
        <button @click="sendCommands">Send Commands</button>
      </div>
    </div>
  </div>
</template>

<script>
import ButtonLink from '../components/ButtonLink.vue';
import MapGrid from '../components/MapGrid.vue';

export default {
  components: {
    ButtonLink,
    MapGrid,
  },
  props: {
    message: String,
  },
  data() {
    return {
      connected: false,
      mapSize: 200,
      gridSize: 20,
      missionControlId: null,
      obstacles: [],
      roverPosition: { x: 0, y: 0 },
      roverDirection: 'N',
      commands: '',
    };
  },
  methods: {
    async connectToMissionControl() {
      try {
        const response = await fetch('/api/mission-control', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            map_size: this.mapSize,
          }),
        });

        if (response.ok) {
          const data = await response.json();
          this.connected = true;
          this.missionControlId = data.id;
          this.mapSize = data.map.size;
          this.obstacles = data.map.obstacles;
          this.roverPosition = data.rover.position;
          this.roverDirection = data.rover.direction;
          console.log('Mission Control Connected:', data);
        } else {
          console.error('Failed to connect to Mission Control:', await response.json());
        }
      } catch (error) {
        console.error('Error connecting to Mission Control:', error);
      }
    },
    sendCommands() {
      this.commands.split('').forEach((command) => {
        this.processCommand(command);
      });
    },
    processCommand(command) {
      switch (command) {
        case 'F':
          this.moveForward();
          break;
        case 'B':
          this.moveBackward();
          break;
        case 'L':
          this.turnLeft();
          break;
        case 'R':
          this.turnRight();
          break;
        default:
          console.error('Invalid command:', command);
      }
    },
    moveForward() {
      switch (this.roverDirection) {
        case 'N':
          this.roverPosition.y -= 1;
          break;
        case 'E':
          this.roverPosition.x += 1;
          break;
        case 'S':
          this.roverPosition.y += 1;
          break;
        case 'W':
          this.roverPosition.x -= 1;
          break;
      }
      if (this.isOutLimits()) {
        this.moveBackward;
      }
    },
    moveBackward() {
      switch (this.roverDirection) {
        case 'N':
          this.roverPosition.y += 1;
          break;
        case 'E':
          this.roverPosition.x -= 1;
          break;
        case 'S':
          this.roverPosition.y -= 1;
          break;
        case 'W':
          this.roverPosition.x += 1;
          break;
      }
      if (this.isOutLimits()) {
        this.moveForward();
      }
    },
    turnLeft() {
      const directions = ['N', 'W', 'S', 'E'];
      const currentIndex = directions.indexOf(this.roverDirection);
      this.roverDirection = directions[(currentIndex + 1) % directions.length];
    },
    turnRight() {
      const directions = ['N', 'E', 'S', 'W'];
      const currentIndex = directions.indexOf(this.roverDirection);
      this.roverDirection = directions[(currentIndex + 1) % directions.length];
    },
    isOutLimits() {
      if (
        this.roverPosition.x < 0 ||
        this.roverPosition.x >= this.mapSize ||
        this.roverPosition.y < 0 ||
        this.roverPosition.y >= this.mapSize
      ) {
        console.error('Rover out of bounds:', this.roverPosition);
        return true;
      }
      return false;
    },
  },
};
</script>

<style scoped>
.container {
  text-align: center;
  margin-top: 50px;
}

.center {
  margin: auto;
}
</style>
