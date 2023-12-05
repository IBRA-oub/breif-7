<?php
if (isset($_POST['valid'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Connect to your database (replace with your actual database connection code)
        $conn = new mysqli("localhost", "root", "", "cihdb");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute a query to get user information based on username and password
        $query = "SELECT id, role_id FROM user WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user with the provided username and password exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId, $roleId);
            $stmt->fetch();

            // Check the user's role
            if ($roleId == 1) {
                // Admin role, redirect to admin dashboard
                header("Location: admindashboardusers.php");
                exit();
            } else {
                // Client role, redirect to client page
                header("Location: clientdashboardaccounts.php");
                exit();
            }
        } else {
            echo "Verify information";
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Veuillez compléter tous les champs...";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>CIHBANK</title>
    <link rel="shortcut icon" type="image/icon" href="CIHL.png"/>
</head>

<body>
<section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
         CIH<img class="w-12 h-12" src="CIHL.png" alt="logo">BANK        
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Sign in to your account
              </h1>
              <form class="space-y-4 md:space-y-6" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                  <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
                      <input id="username" type="username" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input id="password" type="password" name="password" id="password" placeholder="•••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>  
                  <button name="valid" type="submit" class="w-full text-white bg-orange-600 hover:bg-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">log in</button>
              </form>
          </div>
      </div>
  </div>
</section>
</body>
</html>