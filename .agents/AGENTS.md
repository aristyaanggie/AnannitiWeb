# Agent Guidelines for AnannitiWeb Project

## Session Initialization & Context Continuity
1. **Always Read `DEVELOPMENT_STATE.md`**: At the very beginning of any new session or task, you MUST read the `DEVELOPMENT_STATE.md` file located at the root of the workspace. This file contains the most recent updates, the current state of the project, established conventions, and pending tasks.
2. **Update `DEVELOPMENT_STATE.md`**: Before ending your work or concluding a major feature, you MUST update `DEVELOPMENT_STATE.md` to reflect what you just did. Summarize your changes, document any new conventions (e.g., specific gradient logic, layout limits), and adjust the To-Do list so the next agent will know exactly where to pick up.

## Project Specific Rules
- **Aesthetics First**: This is a premium tattoo studio website. Design must be top-tier, featuring smooth gradients, modern typography, and a cohesive dark-mode aesthetic. 
- **Transitions**: Do not rely solely on Tailwind default gradients if they produce banding. Use custom inline `linear-gradient` with multi-stop cubic easing curves where necessary to ensure flawless blends between sections.
- **Images**: Always use `onerror="this.style.display='none'"` on dynamically loaded grid images to prevent broken placeholder boxes.
