
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
      class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white sticky z-10 top-0">
      <nav
        class="flex container mx-auto justify-between items-center px-4 py-6"
      >
        <h1 class="text-1xl md:text-3x1 lg:text-4xl font-bold">
          <a href="./home.html"> Smart Study Planner</a>
        </h1>
        <div class="flex items-center gap-4 text-2xl">
          <span class="hidden sm:block">Welcome,shishir</span>

          <div class="relative group">
            <!-- Button -->
            <button
              class="flex items-center gap-2 px-4 py-2 bg-green-600 rounded-md hover:bg-green-500 transition">
              <i class="ri-user-line"></i>
            </button>

            <!-- Dropdown -->
            <div
              class="absolute right-0 mt-2 w-44 bg-white text-gray-700
                     rounded-md shadow-lg border
                     opacity-0 invisible translate-y-2
                     group-hover:opacity-100 group-hover:visible group-hover:translate-y-0
                     transition-all duration-200 z-50">
              <a href="./home.html" class="block px-4 py-2 hover:bg-gray-100">Home</a>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
              <form action="../backend/logout.php" method="POST" class="">
            <button
              type="submit"
              onclick="return confirm('Are you sure you want to logout?')"
              class="bg-white px-4 py-2 rounded-lg hover:bg-gray-100 flex items-center gap-1">Logout
            </button>
          </form>
            </div>
          </div>
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