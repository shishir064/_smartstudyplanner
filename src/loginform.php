
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./output.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body class="bg-[#dee0dc] text-[#0B132B]   ">
    <header class="bg-[#3a86ff] text-white ">
        <nav class="flex container mx-auto justify-between items-center px-6 py-4 ">
            <h1 class=" text-1xl md:text-3x1 lg:text-4xl font-bold">
                <a href="./home.html"> Smart Study Planner</a>
            </h1>

           <ul class="hidden text-3x1 sm:visible md:visible gap-6 md:text-1xl lg:text-[2rem] lg:gap-9  md:flex">
        <li class="hover:text-[#e3d9d9]"><a href="home.html">Home</a></li>
        <li class="hover:text-[#e3d9d9]"><a href="about_us.html">About</a></li>
        <li class="hover:text-[#e3d9d9]"><a href="contact.html">Contact Us</a></li>
      </ul>
        </nav>
    </header>

  <section class="flex flex-col justify-center items-center min-h-screen ">
    <div class=" bg-[#ffff] rounded-xl p-4 w-full max-w-sm">
        <form action="../backend/login.php" method="post" class=" flex flex-col gap-4">
          <h1 class="text-center font-medium text-4xl md:text-5xl lg:text-6xl">Log In</h1>
            <div class="flex flex-col ">
                <label for="username">Username</label>
                <input type="text" name="username" class="flex flex-1 border p-2 rounded" placeholder="Username" required>
            </div>
            <div class="flex flex-col ">
                <label for="password">Password</label>
                <input type="password" class="flex flex-1 border p-2 rounded" placeholder="password" required>
            </div>
            <input type="submit" class="bg-blue-600 text-white p-2 rounded" value="Log In">
        </form>
        <div class="text-center mt-4">
            <p>
                Not registered?<span class="text-blue-700 underline"><a href="signup.html">Create an account</a></span>
            </p>
        </div>
    </div>
  </section>

  <footer class="bg-gray-900 text-gray-300 text-center py-6">
      <p>© 2025 Smart Study Planner | All Rights Reserved</p>
  </footer>
  
</body>

</html>

