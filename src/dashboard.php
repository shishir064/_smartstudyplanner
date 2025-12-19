<?php
include '../backend/db_connect.php';

$tasks = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");

$totalTasks = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tasks"));
$completedTasks = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tasks WHERE status = 1"));
$pendingTasks = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tasks WHERE status = 0"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">

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


<main class="flex-1 max-w-8xl mx-auto w-full px-4 py-6 grid grid-cols-1 lg:grid-cols-4 gap-6">


  <aside class="bg-white rounded-xl shadow p-5">
    <ul class="space-y-4 font-medium">
      <li class="text-blue-600 flex items-center gap-2">
        <i class="ri-dashboard-line"></i> Dashboard
      </li>
      <li class="flex items-center gap-2 hover:text-blue-600">
        <i class="ri-task-line"></i>
        <a href="mytask.php">My Tasks</a>
      </li>
      <li class="flex items-center gap-2 hover:text-blue-600">
        <i class="ri-calendar-line"></i>
        <a href="status.php">Status</a>
      </li>
      <li class="flex items-center gap-2 hover:text-blue-600">
        <i class="ri-user-line"></i>
        <a href="profile.php">Profile</a>
      </li>
    </ul>
  </aside>


  <section class="lg:col-span-3 space-y-6">


    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
      <div class="bg-white rounded-xl shadow p-6 text-center">
        <p class="text-gray-500">Total Tasks</p>
        <p class="text-3xl font-bold text-blue-600"><?= $totalTasks ?></p>
      </div>

      <div class="bg-white rounded-xl shadow p-6 text-center">
        <p class="text-gray-500">Completed</p>
        <p class="text-3xl font-bold text-green-600"><?= $completedTasks ?></p>
      </div>

      <div class="bg-white rounded-xl shadow p-6 text-center">
        <p class="text-gray-500">Pending</p>
        <p class="text-3xl font-bold text-red-600"><?= $pendingTasks ?></p>
      </div>
    </div>


    <div class="bg-white rounded-xl shadow p-5">
      <h2 class="text-lg font-semibold mb-4">Your Tasks</h2>

      <div class="space-y-4 min-h-[420px] max-h-[420px] overflow-y-auto pr-2">

        <?php if (mysqli_num_rows($tasks) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($tasks)): ?>
            <?php $completed = $row['status'] == 1; ?>

            <div class="border rounded-lg p-4 flex gap-4 transition
              <?= $completed ? 'bg-gray-100 opacity-70' : 'bg-[#F7FAFF]' ?>">

            
              <form action="../backend/update_status.php" method="POST">
                <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
                <input type="hidden" name="status" value="<?= $completed ? 0 : 1 ?>">
                <input type="checkbox"
                  onchange="this.form.submit()"
                  <?= $completed ? 'checked' : '' ?>
                  class="w-5 h-5 mt-1 accent-blue-600">
              </form>

              
              <div class="flex-1">
                <h3 class="font-semibold <?= $completed ? 'line-through text-gray-400' : '' ?>">
                  <?= htmlspecialchars($row['task_title']) ?>
                </h3>

                <p class="text-sm mt-1 <?= $completed ? 'line-through text-gray-400' : 'text-gray-600' ?>">
                  <?= htmlspecialchars($row['task_description']) ?>
                </p>

                <div class="flex gap-2 mt-2 text-xs text-gray-400">
                  <span><?= htmlspecialchars($row['categoty']) ?></span>
                  <span><?= htmlspecialchars($row['created_at']) ?></span>
                </div>

                <form action="../backend/delete_task.php" method="POST" class="mt-3">
                  <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
                  <button onclick="return confirm('Delete task?')" class="text-red-500 text-sm">
                    Delete
                  </button>
                </form>
              </div>
            </div>

          <?php endwhile; ?>
        <?php else: ?>
          <p class="text-center text-gray-500 py-20">No tasks yet</p>
        <?php endif; ?>

      </div>
    </div>

  </section>
</main>

<footer class="bg-gray-900 text-gray-300 text-center py-4">
  © 2025 Smart Study Planner
</footer>

</body>
</html>
