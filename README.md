# L3

Assginment 3 for 1dv610

## Assigment Test Cases


#### Use cases are a continuation of Daniel Tolls use cases.

# UC5. Check Users Todo List

### Preconditions
A user is authenticated. Ex. UC1

### Main Scenario

1. Starts when a user wants to check his/hers todo list.
2. System presents one todo-list with remaining todos and one list with completed todos, that belongs to the user.

# UC6. Add item to todo-list.

### Preconditions
A user is authenticated. Ex. UC1

### Main Scenario

1. Starts when a user wants to check his/hers todo list.
2. System presents the a textarea to enter the new todo-item.
3. User provides a new item.
4. System now adds new item to the ordered list of remaining todos for 
that user.

# UC7. Completes item in todo-list.

### Preconditions
A user is authenticated and has added incomplete todos. See UC1 and UC6.

### Main Scenario

1. Starts when a user wants to complete a todo.
2. System presents a button for completing a todo item in the list with remaining todos.
3. Users presses the button for completing that todo.
4. System moves the todo from the remaining todo list to the list for completed todos.

# UC8. Completes item in todo-list.

### Preconditions
A user is authenticated and has todos saved in the remaining or completed list. See UC1 and UC6.

### Main Scenario

1. Starts when a user wants to delete a todo-item.
2. System presents a delete button for every todo.
3. User presses a delete button.
4. System now removes the item from the list.