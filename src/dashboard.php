<?php
include '../backend/db_connect.php';

$result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>dashboard</title>
  <link rel="stylesheet" href="./output.css" />
   <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css"
  rel="stylesheet"/>
</head>
<body>
  <header class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white sticky z-10       top-0">
      <nav class="flex container mx-auto justify-between items-center px-4 py-6">
        <h1 class="text-1xl md:text-3x1 lg:text-4xl font-bold">
          <a href="#home"> Smart Study Planner</a>
        </h1>

        <div class="flex items-center gap-4 text-2xl">
         <span class="hidden sm:block">Welcome, Student</span>
         <a href="logout.php" class="bg-white text-blue-600 px-4 py-2 rounded-lg    hover:bg-gray-200">
          Logout
         </a>
       </div>
      </nav>
  </header>

  <main class="max-w-8xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-4 gap-8 h-full">
    <aside class="bg-white rounded-xl shadow p-6 ">
      <ul class="space-y-4 font-medium">
        <li class="text-blue-600 flex items-center gap-2">
          <i class="ri-dashboard-line"></i> Dashboard
        </li>
        <li class="flex items-center gap-2 hover:text-blue-600 cursor-pointer">
          <i class="ri-task-line"></i> My Tasks
        </li>
        <li class="flex items-center gap-2 hover:text-blue-600 cursor-pointer">
          <i class="ri-calendar-line"></i> Planner
        </li>
        <li class="flex items-center gap-2 hover:text-blue-600 cursor-pointer">
          <i class="ri-calendar-line"></i> <a href="add_task.php">planner</a>
        </li>
        <li class="flex items-center gap-2 hover:text-blue-600 cursor-pointer">
          <i class="ri-user-line"></i> Profile
        </li>
      </ul>
    </aside>

    <section class="lg:col-span-3 space-y-6">

  <!-- STATS CARDS -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-xl shadow text-center">
      <h3 class="text-gray-500">Total Tasks</h3>
      <p class="text-3xl font-bold text-blue-600 mt-2">12</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow text-center">
      <h3 class="text-gray-500">Completed</h3>
      <p class="text-3xl font-bold text-green-600 mt-2">7</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow text-center">
      <h3 class="text-gray-500">Pending</h3>
      <p class="text-3xl font-bold text-red-500 mt-2">5</p>
    </div>
  </div>

  <!-- TASK LIST (SCROLLABLE) -->
  <div class="bg-white rounded-xl shadow p-4">

    <h2 class="text-xl font-semibold mb-4">Your Tasks</h2>

    <div
      id="taskList"
      class="space-y-4 max-h-[420px] overflow-y-auto pr-2"
    >
      <?php if (mysqli_num_rows($result) > 0): ?>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <div class="bg-[#F7FAFF] rounded-lg p-4 shadow-sm border">
            <h3 class="text-lg font-semibold">
              <?php echo htmlspecialchars($row['task_title']); ?>
            </h3>

            <p class="text-sm text-gray-600 mt-1">
              <?php echo htmlspecialchars($row['task_description']); ?>
            </p>

            <div class="flex gap-2 mt-2">
              <span class="px-3 py-1 text-xs rounded-full border bg-white">
                <?php echo htmlspecialchars($row['categoty']); ?>
              </span>
              <span class="text-xs text-gray-400">
                <?php echo htmlspecialchars($row['created_at']); ?>
              </span>
            </div>

            <form action="../backend/delete_task.php" method="POST" class="mt-3">
              <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
              <button
                type="submit"
                onclick="return confirm('Are you sure you want to delete this task?')"
                class="text-red-500 hover:text-red-700 text-sm flex items-center gap-1"
              >
                <i class="ri-delete-bin-6-line"></i> Delete
              </button>
            </form>
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

  </main>

  <footer class="bg-gray-900 text-gray-300 text-center py-6">
    <p>© 2025 Smart Study Planner | All Rights Reserved</p>
  </footer>
    
</body>
</html>