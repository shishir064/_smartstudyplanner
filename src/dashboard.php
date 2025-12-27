<?php
include '../backend/db_connect.php';

$tasks = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");

$totalTasks = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tasks"));
$completedTasks = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tasks WHERE status = 1"));
$pendingTasks = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tasks WHERE status = 0"));
?>

<?php include('open_layout.php') ?>


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
      <h2 class="text-lg font-semibold mb-4">Recent Tasks</h2>

      <div class="space-y-4 min-h-[420px] max-h-[420px] overflow-y-auto pr-2">

        <?php if (mysqli_num_rows($tasks) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($tasks)): ?>
            <?php $completed = $row['status'] == 1; ?>

            <div class="border rounded-lg p-4 flex gap-4 transition
              <?= $completed ? 'bg-gray-100 opacity-70' : 'bg-[#F7FAFF]' ?>">

            
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
