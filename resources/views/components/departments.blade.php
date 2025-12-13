<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CELZ5 Citation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex flex-col items-center py-12">

    <!-- Departments Section -->
    <section class="w-full max-w-7xl px-4 mb-16">
        <h2 class="text-3xl text-white font-semibold mb-8 text-center flex items-center justify-center space-x-2">
            <i data-feather="layers" class="w-6 h-6 text-white"></i>
            <span>Departments</span>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <!-- Departments -->
            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Cell Ministry','department')">
                <i data-feather="users" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Cell Ministry</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Zonal Operations','department')">
                <i data-feather="settings" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Zonal Operations</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Church Admin / Pioneering & Visitation','department')">
                <i data-feather="clipboard" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Church Admin / Pioneering & Visitation</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Rhapsody of Realities','department')">
                <i data-feather="book-open" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Rhapsody of Realities</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Healing School','department')">
                <i data-feather="heart" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Healing School</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Finance','department')">
                <i data-feather="credit-card" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Finance</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('TV Production','department')">
                <i data-feather="video" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">TV Production</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Ministry Material','department')">
                <i data-feather="file-text" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Ministry Material</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Foundation School & First Timer Ministries','department')">
                <i data-feather="user-plus" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Foundation School & First Timers Ministry</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Love World Music Department','department')">
                <i data-feather="music" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Love World Music Department</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Global Mission / HR / Admin','department')">
                <i data-feather="globe" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Global Mission / HR / Admin</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Children & Women Ministries','department')">
                <i data-feather="users" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Children & Women Ministries</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('LMMS, LXP, Ministry Programs, Bibles Partnership','department')">
                <i data-feather="book" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">LMMS, LXP, Ministry Programs, Bibles Partnership</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('LW USA, LTM / Radio Brands, Inner City Missions','department')">
                <i data-feather="flag" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">LW USA, LTM / Radio Brands, Inner City Missions</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Follow Up Department','department')">
                <i data-feather="refresh-cw" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Follow Up Department</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Prayer','department')">
                <i data-feather="heart" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Prayer</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Evangelism','department')">
                <i data-feather="send" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Evangelism</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

            <div class="glass p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:scale-105 transition-transform"
                onclick="goToForm('Sceptre','department')">
                <i data-feather="star" class="w-12 h-12 text-white mb-2"></i>
                <h3 class="text-white font-semibold">Sceptre</h3>
                <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
            </div>

        </div>
    </section>



    <script>
        feather.replace();

        function goToForm(departmentName) {
            // Store the selected department in localStorage
            localStorage.setItem("selectedDepartment", departmentName);

            // Redirect to the form page
            window.location.href = "citations.christembassylz5.org/dept-form"; // Change this to your actual form route
        }
    </script>

    <script>
        // Get department from URL
        const params = new URLSearchParams(window.location.search);
        const departmentFromURL = params.get('department');

        if (departmentFromURL) {
            // Prefill department select
            const departmentSelect = document.querySelector('select[name="department"]');
            if (departmentSelect) {
                departmentSelect.value = departmentFromURL;
            }

            // Update breadcrumb
            const breadcrumbDept = document.getElementById('selectedDepartment').querySelector('span');
            if (breadcrumbDept) {
                breadcrumbDept.textContent = departmentFromURL;
            }

            // Optionally, jump to Step 2
            currentStep = 1;
            showStep(currentStep);
        }
    </script>

</body>

</html>
