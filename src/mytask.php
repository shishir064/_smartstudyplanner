<?php include '../backend/db_connect.php';
$result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="./output.css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css"
      rel="stylesheet"
    />
  </head>

  <body class="min-h-screen flex flex-col bg-[#F7FAFF]">
    <header
      class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white sticky z-10 top-0"
    >
      <nav
        class="flex container mx-auto justify-between items-center px-4 py-6"
      >
        <h1 class="text-1xl md:text-3x1 lg:text-4xl font-bold">
          <a href="#home"> Smart Study Planner</a>
        </h1>
        <div class="flex items-center gap-4 text-2xl">
          <span class="hidden sm:block">Welcome, Student</span>

          <form action="../backend/logout.php" method="POST" class="mt-3">
            <button
              type="submit"
              onclick="return confirm('Are you sure you want to logout?')"
              class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-200 flex items-center gap-1"
            >
              <i class="ri-delete-bin-6-line"></i> Logout
            </button>
          </form>
        </div>
      </nav>
    </header>

    <main class="flex-1 w-full">
      <div class="max-w-8xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
          <aside class="bg-white rounded-xl shadow p-6 h-full">
            <ul class="space-y-4 font-medium">
              <li
                class="text-blue-600 hover:text-blue-500 flex items-center gap-2"
              >
                <i class="ri-dashboard-line"></i>
                <a href="dashboard.php">Dashboard</a>
              </li>
              <li
                class="text-blue-600 hover:text-blue-500 flex items-center gap-2"
              >
                <i class="ri-dashboard-line"></i>
                <a href="mytask.php">My tasks</a>
              </li>
              <li
                class="flex items-center gap-2 text-blue-600 hover:text-blue-500 cursor-pointer"
              >
                <i class="ri-calendar-line"></i>
                <a href="status.php">Status</a>
              </li>
              <li
                class="text-blue-600 hover:text-blue-500 flex items-center gap-2"
              >
                <i class="ri-dashboard-line"></i>
                <a href="profile.php">Profile</a>
              </li>
            </ul>
          </aside>

          <section class="lg:col-span-3 space-y-6">
            <div class="flex justify-end">
              <button
                onclick="openModal()"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
                <i class="ri-add-line"></i> Add Task
              </button>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
              <div
                id="taskList"
                class="space-y-4 min-h-[420px] max-h-[420px] overflow-y-auto pr-2">
                <?php if (mysqli_num_rows($result) >
                0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php $completed = $row['status'] == 1; ?>

               <div class="rounded-lg p-4 shadow-sm border transition 
                <?= $completed ? 'opacity-50 bg-gray-100' : 'bg-[#F7FAFF]' ?>">
  
               <div class="flex items-start gap-3">
    
    
    <form action="../backend/update_status.php" method="POST">
      <input type="hidden" name="task_id" value="<?= $row['id']; ?>">
      <input type="hidden" name="status" value="<?= $completed ? 0 : 1; ?>">
      
      <input 
        type="checkbox" 
        onchange="this.form.submit()"
        <?= $completed ? 'checked' : ''; ?>
        class="mt-1 w-5 h-5 accent-blue-600 cursor-pointer"
      >
    </form>

    <div class="flex-1">
      <h3 class="text-lg font-semibold 
        <?= $completed ? 'line-through text-gray-400' : ''; ?>">
        <?= htmlspecialchars($row['task_title']); ?>
      </h3>

      <p class="text-sm mt-1 
        <?= $completed ? 'line-through text-gray-400' : 'text-gray-600'; ?>">
        <?= htmlspecialchars($row['task_description']); ?>
      </p>

      <div class="flex gap-2 mt-2">
        <span class="px-3 py-1 text-xs rounded-full border bg-white">
          <?= htmlspecialchars($row['categoty']); ?>
        </span>
        <span class="text-xs text-gray-400">
          <?= htmlspecialchars($row['created_at']); ?>
        </span>
      </div>
  
      
      <form action="../backend/delete_task.php" method="POST" class="mt-3 flex gap-3">
        <input type="hidden" name="task_id" value="<?= $row['id']; ?>">

        <button
          <?= $completed ? 'disabled' : ''; ?>
          class="text-blue-600 text-sm flex items-center gap-1 px-6 py-2 rounded-2xl 
          hover:bg-blue-100 disabled:opacity-40 disabled:cursor-not-allowed">
          <i class="ri-edit-box-line"></i> Edit
        </button>

        <button
          onclick="return confirm('Delete this task?')"
          class="text-red-500 text-sm flex items-center gap-1 px-6 py-2 rounded-2xl hover:bg-red-100">
          <i class="ri-delete-bin-6-line"></i> Delete
        </button>
      </form>
           </div>
            </div>
              </div>

                <?php endwhile; ?>

                <?php else: ?>
                <p class="text-center text-gray-500 py-10">
                  No tasks yet. Add your first task to get started!
                </p>
                <?php endif; ?>
              </div>
            </div>
          </section>
        </div>
      </div>
    </main>

    <footer class="bg-gray-900 text-gray-300 text-center py-6">
      <p>© 2025 Smart Study Planner | All Rights Reserved</p>
    </footer>
    <div
      id="taskModal"
      class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50"
    >
      <div class="bg-white rounded-xl w-full max-w-md p-6">
        <h2 class="text-xl font-semibold mb-4">Add New Task</h2>

        <form action="../backend/tasks.php" method="POST">
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

          <div class="flex justify-end gap-3 mt-6">
            <button
              type="button"
              onclick="closeModal()"
              class="px-4 py-2 border rounded-lg"
            >
              Cancel
            </button>
            <button
              class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
              Add Task
            </button>
          </div>
        </form>
      </div>
    </div>
    <script>
  function openModal() {
    taskModal.classList.remove('hidden');
    taskModal.classList.add('flex');
  }
  function closeModal() {
    taskModal.classList.add('hidden');
    taskModal.classList.remove('flex');
  }
</script>
  </body>
</html>
