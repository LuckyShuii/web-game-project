# Web Game Dev

Side project focused on experimenting with web game development. The V1 implements a turn-based PVE combat system, with full server-side logic and a simple frontend interface. Future iterations will introduce a 2D grid map, player movement, and interactions that trigger combat

# Github Workflow

Main: Current version in production
Preprod: Should be the main version and used before pushing a release in production (hotfix for example)
V-Version.Number: Fully working version of the game
Staging: Current/Next version being worked on

New ticket for WIP version :

1. Create a new branch from staging with trigram-ticketnumber-description, ex: "LBT-14-combat-logs"
2. Merge this new branch once the work is done into staging
3. Once the staging branch is fully working for the current WIP version, merge it to the version branch, ex: staging > V-1.0

For a hotfix in production version:

1. Create a branch using the naming rule, from main
2. Merge this branch in preprod
3. If tests are okay, merge into main and deploy
