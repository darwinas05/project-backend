<?php
require_once __DIR__ . "/../popos/users.php";

if (session_status() === PHP_SESSION_NONE)
  session_start();

$loggedUser = null;
if (isset($_SESSION["logged_user"]))
  $loggedUser = unserialize($_SESSION["logged_user"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./../../public/css/output.css">
  <script></script>
</head>

<body>
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex flex-shrink-0 items-center">
            <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4">
              <a href="index.php" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">Home</a>
              <a href="product.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Products</a>
            </div>
          </div>
        </div>

        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          <button id="cesta" type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
            <span class="absolute -inset-1.5"></span>
            <!--cesta de la compra-->
            <span class="sr-only">View shopping basket</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13l-1.5 5.5m11-5.5L16.5 18.5M7 18a1.5 1.5 0 1 0 3 0a1.5 1.5 0 0 0-3 0m10 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 0 0-3 0" />
            </svg>
          </button>

          <!-- Menú para usuarios autenticados o no autenticados -->
          <?php
          if ($loggedUser != null) {
          ?>

            <div class="relative ml-3">
              <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="text-white">
                  <!--para mostrar le nombre de la cuenta registrada-->
                  <?php echo htmlspecialchars($loggedUser->getUsername()); ?>
                </span>
              </button>
              <!--Menú desplegable del usuario-->
              <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700">Profile</a>
                <a href="settings.php" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                <form action="server/controllers/controller.php" method="POST" class="block w-full text-left">
                  <input type="hidden" name="action" value="logout">
                  <button type="submit" class="w-full px-4 py-2 text-sm text-left text-gray-700">Logout</button>
                </form>
              </div>
            </div>
          <?php
          } else {
          ?>

            <a href="login.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Log in</a>
            <a href="registro.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Sign in</a>
          <?php
          }
          ?>

        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2">
        <a href="index.php" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Home</a>
        <?php if ($loggedUser != null) { ?>
          <a href="profile.php" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Profile</a>
          <a href="settings.php" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Settings</a>
          <form action="server/controllers/controller.php" method="POST" class="block">
            <input type="hidden" name="action" value="logout">
            <button type="submit" class="w-full px-3 py-2 text-base font-medium text-left text-gray-300 hover:bg-gray-700 hover:text-white">Logout</button>
          </form>
        <?php } else { ?>
          <a href="login.php" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Log in</a>
          <a href="registro.php" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Sign in</a>
        <?php } ?>
      </div>
    </div>
  </nav>
</body>

</html>