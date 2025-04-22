# Rover Web Application
As defined in the given PDF

## How it works
The backend (in PHP) generates a mission (`MissionControl` class) and sends it back to the frontend.

The rest of the missionis handled client-side.

## Original design
Domain on the backend as currently is.

Then have an in-memory repository for the missions so we can have a restful API for the client to interact:
  - `POST /api/mission-control` -> creates a new mission
  - `GET /api/mission-control/:id` -> returns the data of said mission
  - `POST /api/mission-control/:id/commands` -> runs the commands and retunr the updated mission status

This was my desired configuration, but I had problems setting up the in-memory repository and I had to change for the final "client-side runs things".

## Running it
Installing npm deps:
```
  pnpm install
```

Run the migrations
```
  php artisan migrate
```

Running the Laravel app
```
  composer run dev
```
