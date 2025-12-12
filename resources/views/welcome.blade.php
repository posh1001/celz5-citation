<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CELZ5 Citation</title>
    <!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('images/logo2.png') }}">

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

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex flex-col items-center ">

   <section
    class="relative flex flex-col md:flex-row-reverse w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 overflow-hidden glass py-20 px-6 md:px-12 lg:px-24 items-center justify-center min-h-[60vh] text-white">
         <!-- Right Image Section -->
    <div class="md:w-1/2 flex justify-center items-center relative animate-float">
        <img src="/images/hero.png" alt="hero-img" class="w-80 md:w-96 lg:w-[450px] transform transition-transform duration-700 hover:scale-105">
    </div>


    <!-- Left Text Section -->
    <div class="relative z-10 md:w-1/2 overflow-hidden">
        <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-6 animate-slideInLeft">
            CELZ5 <span class="text-yellow-300">Citation</span>
        </h1>

        <p class="text-xl md:text-2xl mb-4 animate-slideInLeft animation-delay-500">
            CELZ5 Citation is your comprehensive platform for tracking, submitting, and managing departmental and group citations with ease and efficiency.
        </p>
        <p class="text-xl md:text-2xl mb-4 animate-slideInLeft animation-delay-700">
            Seamlessly explore all our departments, groups, and submit your yearly citations in a modern, organized interface.
        </p>
        <p class="text-xl md:text-2xl mb-4 animate-slideInLeft animation-delay-900">
            Built to enhance productivity and foster collaboration, CELZ5 Citation ensures your contributions are recognized and properly documented.
        </p>
    </div>


</section>
    <br>
    <br>
    <br>

    <!-- Departments Section -->
    <x-departments />

    <!-- Groups Section -->
    <x-groups />

    <footer class="mt-16 text-center text-white/70">
        &copy; 2025 CELZ5 Citation. All rights reserved.
    </footer>

    <script>
        feather.replace();

        function goToForm(value, type) {
            // Redirect to form page with query params
            window.location.href = `/form?${type}=${encodeURIComponent(value)}`;
        }

        function goToForm(departmentName) {
            // Encode department name and navigate to form page
            const url = `http://127.0.0.1:8000/dept-form?department=${encodeURIComponent(departmentName)}`;
            window.location.href = url;
        }

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

        document.addEventListener('click', (e) => {
            const target = e.target.closest('a[href^="/group-form"], a[href^="/group-form"]');
            if (!target) return;
            if (target.getAttribute('href').startsWith('/group-form')) {
                e.preventDefault();
                openModal();
            }
        });
    </script>


    {{-- GROUP BREADCRUMB --}}
    <script>
        function goToForm(name, type) {
            localStorage.setItem("selectedDepartment", name);
            localStorage.setItem("selectedType", type);
            window.location.href = "/dept-form";
        }
    </script>


    <style>
/* Slide in animation for text */
@keyframes slideInLeft {
    0% {
        opacity: 0;
        transform: translateX(-50px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-slideInLeft {
    animation: slideInLeft 0.8s ease-out forwards;
}

/* Delay utility classes */
.animation-delay-500 { animation-delay: 0.5s; }
.animation-delay-700 { animation-delay: 0.7s; }
.animation-delay-900 { animation-delay: 0.9s; }

/* Floating animation for the image */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}
</style>

</body>

</html>
