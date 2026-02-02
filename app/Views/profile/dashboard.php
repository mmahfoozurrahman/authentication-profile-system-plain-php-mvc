<?php view('layouts/profile/header.php', ['title' => $title]); ?>

<!-- Dashboard Container -->
<div class="flex flex-col lg:flex-row min-h-screen">

    <?php view('layouts/profile/sidebar.php', ['title' => $title]); ?>

    <!-- Main Content -->
    <main class="flex-1 p-6 lg:p-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">My Dashboard</h2>
                <p class="text-gray-600">Welcome back,
                    <?php echo $_SESSION['user']['name']; ?>!
                </p>
            </div>
            <div class="flex items-center space-x-4 mt-4 md:mt-0">
                <button onclick="window.location.href='/logout.php'"
                    class="flex items-center space-x-2 px-4 py-2 bg-white border border-gray-200 rounded-lg text-gray-600 hover:text-indigo-600 hover:border-indigo-600 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    <a href="/logout.php">Logout</a>
                </button>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="max-w-4xl">
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-24 h-24 rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 flex items-center justify-center text-3xl font-bold text-indigo-600">
                                <?php
                                $words = explode(' ', $_SESSION['user']['name']);
                                foreach ($words as $word) {
                                    echo strtoupper(substr($word, 0, 1));
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0 md:ml-6 flex-1">
                            <h3 class="text-xl font-bold text-gray-800">
                                <?php echo $_SESSION['user']['name']; ?>
                            </h3>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="p-4 border rounded-lg">
                            <p class="text-gray-500 text-sm">Email</p>
                            <p class="font-medium">
                                <?php echo $_SESSION['user']['email']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php view('layouts/profile/footer.php', ['title' => $title]); ?>