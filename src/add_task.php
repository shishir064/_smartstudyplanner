<?php
include '../backend/db_connect.php';

$result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Study Planner</title>
    <link rel="stylesheet" href="./output.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css"
      rel="stylesheet"
    />
  </head>

  <body class="bg-[#F7FAFF] text-[#0B132B]">
    <header class="bg-[#3a86ff] text-white sticky z-10 top-0">
      <nav
        class="flex container mx-auto justify-between items-center px-4 py-6"
      >
        <h1 class="text-1xl md:text-3x1 lg:text-4xl font-bold">
          <a href="#home"> Smart Study Planner</a>
        </h1>

        <ul
          class="hidden text-3x1 sm:visible md:visible gap-6 md:text-1xl lg:text-[2rem] lg:gap-9 md:flex"
        >
          <li class="hover:text-[#e3d9d9]"><a href="home.php">Home</a></li>
          <li class="hover:text-[#e3d9d9]"><a href="about_us.php">About</a></li>
          <li class="hover:text-[#e3d9d9]">
            <a href="contact.php">Contact Us</a>
          </li>
          <button>
            <i class="ri-moon-fill"></i>
          </button>
        </ul>
        <button class="md:hidden">manu</button>
      </nav>
    </header>

    <main class="container mx-auto px-4 py-8 h-[calc(100vh-96px)]">
      <!-- grid layout -->
      <div class="grid gird-cols-1 lg:grid-cols-3 gap-6 h-full">
        <!-- left column -->
        <div>
          <form
            action="../backend/tasks.php"
            method="post"
            id="taskForm"
            class="bg-[#FFFFFF] rounded-xl shadow-md p-6 space-y-4">
           
            <div class="space-y-2">
              <label for="taskTitle" class="text-sm font-medium"
                >Task Title *</label
              >
              <input type="text" name="task_title" id="taskTitle" required
                class="w-full px-3 py-2 rounded-lg border border-input bg-[#F7FAFF] focus:outline-none"
                placeholder="Enter task title"
              />
            </div>

            <div class="space-y-2">
              <label for="taskDescription" class="text-sm font-medium"
                >Description</label
              >
              <textarea id="taskDescription" rows="3" name="task_dis"
                class="w-full px-3 py-2 rounded-lg border border-input bg-[#F7FAFF] focus:outline-none"
                placeholder="Add task details..."
              ></textarea>
            </div>

            <div class="space-y-2">
              <label for="taskCategory" class="text-sm font-medium"
                >Category *</label
              >
              <input type="text" id="taskCategory" name="categoty"
                class="w-full px-3 py-2 rounded-lg border bg-[#F7FAFF] focus:outline-none"
                placeholder="e.g., Mathematics, Science"
              />
            </div>

            <div class="space-y-2">
              <label for="taskDueDate" class="text-sm font-medium"
                >Deadline *</label
              >
              <input type="date" id="taskDueDate" name="created_at"
                class="w-full px-3 py-2 rounded-lg border bg-[#F7FAFF] focus:outline-none"
              />
            </div>

            <div class="flex gap-2 pt-2">
              <input type="submit" id="submit_btn" class="flex-1 bg-[#3a86ff] text-white px-4 py-2 rounded-lg hover:bg-[#4380e3] cursor-pointer flex items-center justify-center gap-2"
              value="Submit"
              />
            </div>
          </form>
        </div>

        <!-- Task List (Right Column) -->
        <div class="lg:col-span-2">
          <div id="taskList" class="space-y-4">
            <?php if (mysqli_num_rows($result) >
            0): ?>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="bg-[#F7FAFF] rounded-lg p-4 shadow-sm border">
              <h3 class="text-lg font-semibold">
                <?php echo htmlspecialchars($row['task_title']); ?>
              </h3>

              <p class="text-sm text-gray-600 mt-1">
                <?php echo htmlspecialchars($row['task_description']); ?>
              </p>

              <div class="flex  text-sm text-gray-500 mt-2">
                <p class="px-3 py-1 text-xs font-medium rounded-full border bg-[#F7FAFF] ">
                  <?php echo htmlspecialchars($row['categoty']); ?>
                </p>
              </div>
              <div>
                <p>
                  <?php echo htmlspecialchars($row['created_at']); ?>
                </p>
              </div>

              <form action="../backend/delete_task.php" method="POST">
               <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
               <button type="submit"  onclick="return confirm('Are you sure you want to delete this task?')"
                class="text-red-500 hover:text-red-700 text-sm">
                <i class="ri-delete-bin-6-line"></i>
                Delete
               </button>
             </form>

            </div>

            <?php endwhile; ?>

            <?php else: ?>
            <p class="text-center text-gray-500">
              No tasks yet. Add your first task to get started!
            </p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>