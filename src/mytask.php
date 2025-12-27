<?php include '../backend/db_connect.php';
$result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");?>
<?php include('open_layout.php') ?>

            
          <div class="flex justify-between">
              <h1 class="text-black text-4xl font-semibold  px-3 py-4 rounded-lg ">Task List</h1>
              <button
                onclick="openModal()"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
                <i class="ri-add-line"></i> Add Task
              </button>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
              <div class="bg-white rounded-xl shadow overflow-hidden">
             <div class="relative overflow-x-auto min-h-[420px] max-h-[420px] -mx-4 sm:mx-0">
    <table class="min-w-[900px] w-full text-sm text-left text-gray-700">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="table-checkbox" type="checkbox" value="" class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                        <label for="table-checkbox" class="sr-only">Table checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    S.N
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Topic
                </th>
                <th scope="col" class="px-6  py-3 font-medium">
                    Description
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Subject
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Time
                </th>
                <th scope="col" class="px-6 py-3  font-medium">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
<?php if (mysqli_num_rows($result) > 0): ?>
<?php $sn = 1; ?>
<?php while ($row = mysqli_fetch_assoc($result)): ?>
<?php $completed = $row['status'] == 1; ?>

<tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">

  
  <td class="w-4 p-4 text-center">
    <form action="../backend/update_status.php" method="POST">
      <input type="hidden" name="task_id" value="<?= $row['id']; ?>">
      <input type="hidden" name="status" value="<?= $completed ? 0 : 1; ?>">

      <input
        type="checkbox"
        onchange="this.form.submit()"
        <?= $completed ? 'checked' : ''; ?>
        class="w-4 h-4 accent-blue-600 cursor-pointer"
      >
    </form>
  </td>

  
  <td class="px-6 py-4 font-medium">
    <?= $sn++; ?>
  </td>

  
  <th class="px-6 py-4 font-semibold text-heading whitespace-nowrap">
    <?= htmlspecialchars($row['task_title']); ?>
  </th>

  
  <td class="px-6 py-4 text-gray-600">
    <?= htmlspecialchars($row['task_description']); ?>
  </td>

  
  <td class="px-6 py-4">
    <span class="px-3 py-1 text-xs">
      <?= htmlspecialchars($row['categoty']); ?>
    </span>

  </td>

  <td class="px-6 py-4">
    <span class="px-3 py-1 text-xs rounded-full
      <?= $completed
        ? 'bg-green-100 text-green-700'
        : 'bg-yellow-100 text-yellow-700'; ?>">
      <?= $completed ? 'Completed' : 'Pending'; ?>
    </span>
  </td>

 
  <td class="px-6 py-4 text-gray-500">
    <?= htmlspecialchars($row['created_at']); ?>
  </td>

  
  <td class="px-6 py-4 flex gap-4">

    
    <button
      onclick="openEditModal(
        <?= $row['id']; ?>,
        '<?= htmlspecialchars($row['task_title'], ENT_QUOTES); ?>',
        '<?= htmlspecialchars($row['task_description'], ENT_QUOTES); ?>',
        '<?= htmlspecialchars($row['categoty'], ENT_QUOTES); ?>'
      )"
      class="text-blue-500 hover:text-blue-600 hover:underline font-medium">
      Edit
    </button>

    
    <form action="../backend/delete_task.php" method="POST">
      <input type="hidden" name="task_id" value="<?= $row['id']; ?>">
      <button
        onclick="return confirm('Delete this task?')"
        class="text-red-500 hover:text-red-600 hover:underline font-medium">
        Remove
      </button>
    </form>

  </td>
</tr>

<?php endwhile; ?>
<?php else: ?>
<tr>
  <td colspan="7" class="text-center py-10 text-gray-500">
    No tasks found. Add your first task.
  </td>
</tr>
<?php endif; ?>
</tbody>

    </table>
  </div>
</div>


     <?php include('close_layout.php') ?>

    <div
      id="taskModal"
      class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50"
    >
      <div class="bg-white rounded-xl w-full max-w-md p-6">
        <h2 class="text-xl font-semibold mb-4">Add New Task</h2>

        <form action="../backend/tasks.php" method="POST">
          <div class="space-y-2">
              <label for="taskTitle" class="text-sm font-medium"
                >Topic *</label
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

    <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-xl w-full max-w-md p-6">
    <h2 class="text-xl font-semibold mb-4">Edit Task</h2>

    <form action="../backend/update_task.php" method="POST">
      <input type="hidden" name="task_id" id="edit_id">

      Topic *<input id="edit_title" name="task_title" placeholder="Edit your topic" 
        class="w-full mb-3 px-3 py-2 border rounded-lg bg-[#F7FAFF]" required>

      Description *<textarea id="edit_description" name="task_dis" placeholder="Edit your details"
        class="w-full mb-3 px-3 py-2 border rounded-lg bg-[#F7FAFF]"></textarea>

      Subject *<input id="edit_category" name="categoty" placeholder="Edit your subject"
        class="w-full mb-4 px-3 py-2 border rounded-lg bg-[#F7FAFF]">

      <div class="flex justify-end gap-3">
        <button type="button" onclick="closeEditModal()"
          class="px-4 py-2 border rounded-lg">Cancel</button>

        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
          Save
        </button>
      </div>
    </form>
  </div>
</div>

  <script src="script.js"></script>

  </body>
</html>
