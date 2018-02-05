# Toggl CLI

A Command line interface tool for [Toggle.com](https://toggl.com) written using Laravel Zero. This tool uses Toggl API v8.

### Installation instructions

Using the tool is pretty simple, as long as you have PHP >= 7.1 installed and composer ready to install the dependencies.

- 1 - Clone the repository
- 2 - Run `composer install`
- 3 - Copy the .env.example file `cp .env.example .env`

### How to use

After following the installation instructions using the CLI tool is pretty straight forward. We start off by setting the API key:

`php toggl set:token your_toggle_API_token`

You may test this token by requesting information about yourself:

`php toggl about:me`

We assume you've already created or have access to at least one Workspace in your account. By running the follow command the CLI tool lists your Workspaces and asks you to choose which to activate:

`php toggl workspace:list`

From this point on you'll be able to do the most basic things from your command line interface. For example, let's add a new Project.

`php toggl project:create "My First Project"`

You might notice this project gets actived right away, which means the tasks and timers you'll start after this step are linked to this Project. Of course, similar to selecting a Workspace, you can also select an existing Project. Once again, you'll be asked to select a Project:

`php toggl project:list`

Adding tasks, which is in paid plans only by the way, isn't magic anymore either. Tasks are linked to the activated Project so make sure you're in the right one while executing the following command:

`php toggl task:create "My First Task"`

To list existing tasks and select one to work with, use:

`php toggl task:list`

Running timers is just as easy, there are 3 commands waiting to be used! The first one creates a new TimeEntry, if a Task is activated the timer gets linked to the task, otherwise it's connected to the active project and only holds a description:

`php toggl timer:start "My First Timer Description"`

You can check the running timer from within the CLI as well. If the timer has stopped since starting (f.e. from within the Toggl web interface or application) the CLI tool will automatically deactive your active timer.

`php toggl timer:status`

To stop the active timer simply run:

`php toggl timer:stop`

There are 3 hidden commands which you most likely won't use yet. These commands are called from within the `:list` commands. I'm planning on creating shortcuts to workspaces/projects/tasks so you can set them using identifiers you can remember (f.e. `php toggl workspace:set Pendo` where `Pendo` is a shorthand to the workspace ID).

- `php toggl workspace:set workspace_id`
- `php toggl project:set project_id`
- `php toggl task:set task_id`

### Aliases

.. soon there'll be a short description on how to create aliases in your bash profile to make commands easier to remember and shorter to type. Of course it's all down to personal preference, but we'll get you started anyway ..

### To-do

Below you can find my current plans for the tool. Feel free to make suggestions using the Issues list or by forking and creating a PR. Right now it's mainly written to fit my needs.

**Configuration Commands**

- [X] Set API token
- [X] Set active Workspace
- [X] Set active Project
- [X] Set active Task

**List data Commands**

- [X] Get info on current user
- [X] Get Workspaces list
- [X] Get Projects list (within active Workspace)
- [X] Get Tasks list (within active Project) 

**Timer Commands**

- [X] Create a Task
- [X] Start a timer for active Task or create a TimeEntry with a description
- [X] Stop the active Timer
- [X] Get info on running Timer

**Extra functionality**

- [ ] Save Project IDs to custom name for quick access in commands
- [ ] Save Workspace IDs to custom name for quick access in commands
- [ ] Have the timer commands calculate seconds back to HH:mm:ss format