<?php
session_start();
include 'menu.php';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حسابفا - برنامه حسابداری</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php echo getMenu(); ?>

        <!-- Main Content -->
        <div class="flex-1 p-4">
            <?php
                if (isset($_GET['message'])) {
                    echo '<div class="bg-green-200 text-green-800 p-3 rounded mb-4">' . htmlspecialchars($_GET['message']) . '</div>';
                }
            ?>
            <h2 class="text-2xl font-bold mb-4">داشبورد</h2>
            <p>به برنامه حسابداری خود خوش آمدید!</p>
        </div>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const menuItems = document.querySelectorAll('#sidebar li');

            menuItems.forEach(item => {
                if (item.querySelector('.submenu')) {
                    item.addEventListener('click', function(e) {
                        e.stopPropagation();
                        this.classList.toggle('active');
                        this.querySelector('.submenu').style.display = this.classList.contains('active') ? 'block' : 'none';
                    });
                }
            });

            var currentPage = window.location.pathname;
            var menuLinks = document.querySelectorAll("#sidebar a");

            for (var i = 0; i < menuLinks.length; i++) {
                var link = menuLinks[i];
                var linkPath = link.getAttribute('href');

                if (linkPath === currentPage) {
                    link.classList.add("active-menu");
                }
            }
        });
    </script>
</body>
</html>