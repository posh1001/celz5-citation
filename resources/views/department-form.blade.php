<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CELZ5 Citation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #4f46e5, #7c3aed, #ec4899);
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        input,
        select,
        textarea {
            background: rgba(255, 255, 255, 0.8);
            color: #111827;
        }

        /* Progress Bar Styles */
        .progress-bar {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 2rem;
        }

        .progress-bar::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 5%;
            width: 90%;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            z-index: 0;
            transform: translateY(-50%);
            border-radius: 2px;
        }

        .progress-step {
            position: relative;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 10;
        }

        .progress-step .icon-wrapper {
            padding: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transition: all 0.3s ease;
        }

        .progress-step.active .icon-wrapper,
        .progress-step.completed .icon-wrapper {
            background-color: #7c3aed;
        }

        .progress-step span {
            margin-top: 6px;
            font-size: 0.8rem;
            color: white;
            text-align: center;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center py-10 px-4">

    <!-- Header -->
    <header class="text-center mb-6">
        <h1 class="text-5xl font-bold text-white drop-shadow-lg">CELZ5 Citation</h1>
        <p class="text-white/80 mt-2 text-lg">Explore our Departments & Groups</p>
    </header>

    <!-- Breadcrumbs -->
    <nav class="text-white text-sm mb-6 w-full max-w-3xl" aria-label="Breadcrumb">
        <ol class="list-reset flex flex-wrap">
            <li>
                <a href="/" class="hover:underline flex items-center space-x-1">
                    <i data-feather="home" class="w-4 h-4"></i>
                    <span>Home</span>
                </a>
            </li>
            <li><span class="mx-2">/</span></li>
            <li>
                <a href="depts" class="hover:underline flex items-center space-x-1">
                    <i data-feather="layers" class="w-4 h-4"></i>
                    <span>Departments</span>
                </a>
            </li>
            <li><span class="mx-2">/</span></li>
            <li>
                <span id="selectedDepartment" class="flex items-center space-x-1">
                    <i data-feather="briefcase" class="w-4 h-4"></i>
                    <span id="selectedDepartmentName">—</span>
                </span>
            </li>
        </ol>
    </nav>

    <!-- Progress Bar -->
    <div class="progress-bar w-full max-w-3xl mb-8">
        <div class="progress-step active" data-step="0">
            <div class="icon-wrapper"><i data-feather="user" class="w-5 h-5"></i></div>
            <span>Personal</span>
        </div>
        <div class="progress-step" data-step="1">
            <div class="icon-wrapper"><i data-feather="layers" class="w-5 h-5"></i></div>
            <span>Department</span>
        </div>
        <div class="progress-step" data-step="2">
            <div class="icon-wrapper"><i data-feather="file-text" class="w-5 h-5"></i></div>
            <span>Citation</span>
        </div>
    </div>

    <!-- Multi-step Form -->
    <div id="multiStepFormWrapper" class="glass p-10 rounded-3xl shadow-2xl w-full max-w-3xl mb-16">
        <!-- Messages -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="multiStepForm" class="space-y-6 text-white" method="POST"
            action="{{ route('department-form.store') }}">

            @csrf
            <!-- Step 1: Personal Info -->
            <div class="form-step space-y-6">
                <h2 class="text-xl font-semibold mb-4 flex items-center space-x-2">
                    <i data-feather="user" class="w-6 h-6 text-white"></i>
                    <span>Step 1: Personal Information</span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                    <div class="flex flex-col">
                        <label class="mb-1">Title</label>
                        <div class="flex items-center space-x-2">
                            <i data-feather="user" class="w-5 h-5 text-gray-700"></i>
                            <input type="text" name="title" class="w-full p-3 rounded-lg text-black"
                                placeholder="Bro, Sis, Pastor..." required>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1">Full Name</label>
                        <div class="flex items-center space-x-2">
                            <i data-feather="edit" class="w-5 h-5 text-gray-700"></i>
                            <input type="text" name="fullname" class="w-full p-3 rounded-lg text-black"
                                placeholder="John Doe" required>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1">Unit</label>
                        <div class="flex items-center space-x-2">
                            <i data-feather="map-pin" class="w-5 h-5 text-gray-700"></i>
                            <input type="text" name="unit" class="w-full p-3 rounded-lg text-black"
                                placeholder="Enter Unit" required>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1">Designation</label>
                        <div class="flex items-center space-x-2">
                            <i data-feather="briefcase" class="w-5 h-5 text-gray-700"></i>
                            <input type="text" name="designation" class="w-full p-3 rounded-lg text-black"
                                placeholder="e.g. Leader" required>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1">Kingschat Handle</label>
                        <div class="flex items-center space-x-2">
                            <i data-feather="message-circle" class="w-5 h-5 text-gray-700"></i>
                            <input type="text" name="kingschat" class="w-full p-3 rounded-lg text-black"
                                placeholder="@handle" required>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-1">Phone Number</label>
                        <div class="flex items-center space-x-2">
                            <i data-feather="phone" class="w-5 h-5 text-gray-700"></i>
                            <input type="tel" name="phone" class="w-full p-3 rounded-lg text-black"
                                placeholder="+234 000 0000" required>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button"
                        class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-semibold hover:bg-indigo-50"
                        onclick="nextStep()">Next</button>
                </div>
            </div>

            <!-- Step 2: Department & Group -->
            <div class="form-step hidden space-y-6">
                <h2 class="text-xl font-semibold mb-4 flex items-center space-x-2">
                    <i data-feather="layers" class="w-6 h-6 text-white"></i>
                    <span>Step 2: Departments</span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label class="mb-1">Department</label>
                        <div class="flex items-center space-x-2">
                            <i data-feather="briefcase" class="w-5 h-5 text-gray-700"></i>
                            <input id="departmentInput" type="text" name="department"
                                class="w-full p-3 rounded-lg text-black" placeholder="Select Department" readonly>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-4">
                    <button type="button"
                        class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-semibold hover:bg-indigo-50"
                        onclick="prevStep()">Previous</button>
                    <button type="button"
                        class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-semibold hover:bg-indigo-50"
                        onclick="nextStep()">Next</button>
                </div>
            </div>

            <!-- Step 3: Citation -->
            <div class="form-step hidden space-y-6">
                <h2 class="text-xl font-semibold mb-4 flex items-center space-x-2">
                    <i data-feather="file-text" class="w-6 h-6 text-white"></i>
                    <span>Step 3: Submit 2025 Citation</span>
                </h2>
                <div class="space-y-4">
                    <div>
                        <label class="mb-1">Period</label>
                        <div class="flex items-center space-x-2">
                            <i data-feather="calendar" class="w-5 h-5 text-gray-700"></i>
                            <input id="periodInput" type="text" name="period"
                                class="w-full p-3 rounded-lg text-black" placeholder="Select period (From – To)"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="mb-1">Citation (max 150 words)</label>
                        <div class="flex items-center space-x-2">
                            <i data-feather="edit-3" class="w-5 h-5 text-gray-700"></i>

                            <div class="w-full">
                                <div class="flex items-start space-x-2 w-full">
                                    <div class="flex-1">
                                        <textarea id="citation" name="citation" rows="6" class="w-full p-3 rounded-lg text-black"
                                            placeholder="Enter your citation (max: 150 words)" required></textarea>

                                        <p id="citationError" class="text-red-600 text-sm mt-1 hidden"></p>
                                        <p id="citationCount" class="text-gray-600 text-sm mt-1">0 / 150 words</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-4">
                    <button type="button"
                        class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-semibold hover:bg-indigo-50"
                        onclick="prevStep()">Previous</button>
                    <button type="submit"
                        class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-semibold hover:bg-indigo-50">Submit</button>
                </div>
            </div>

        </form>
    </div>

    <script>
        feather.replace();

        const steps = document.querySelectorAll('.form-step');
        const progressSteps = document.querySelectorAll('.progress-step');
        let currentStep = 0;

        function updateProgressBar() {
            progressSteps.forEach((step, index) => {
                step.classList.remove('active', 'completed');
                if (index < currentStep) step.classList.add('completed');
                else if (index === currentStep) step.classList.add('active');
            });
        }

        function showStep(index) {
            steps.forEach((step, i) => step.classList.toggle('hidden', i !== index));
            updateProgressBar();
        }

        function nextStep() {
            if (currentStep < steps.length - 1) currentStep++;
            showStep(currentStep);
        }

        function prevStep() {
            if (currentStep > 0) currentStep--;
            showStep(currentStep);
        }

        showStep(currentStep);

        // Prefill form when department or group card is clicked
        function prefillForm(department, group) {
            if (department) {
                document.querySelector('select[name="department"]').value = department;
                document.getElementById('selectedDepartment').querySelector('span').textContent = department;
            }
            if (group) {
                document.querySelector('select[name="group"]').value = group;
            }
            // Scroll to form and show Step 2
            document.getElementById('multiStepForm').scrollIntoView({
                behavior: 'smooth'
            });
            steps.forEach((step, i) => step.classList.toggle('hidden', i !== 1));
            currentStep = 1;
            updateProgressBar();
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Read department from URL ?department=XYZ
            const urlParams = new URLSearchParams(window.location.search);
            const department = urlParams.get("department");

            if (department) {
                document.getElementById("selectedDepartmentName").textContent = department;

                // Also place department in hidden form field (important)
                const deptField = document.getElementById("departmentInput");
                if (deptField) deptField.value = department;
            }

            // Re-initialize icons
            lucide.createIcons();
        });
    </script>

    {{-- DEPARTMENT --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const params = new URLSearchParams(window.location.search);
            const department = params.get("department");

            if (department) {
                document.getElementById("departmentInput").value = department;
            }

            // Re-render icons
            lucide.createIcons();
        });
    </script>

    {{-- CALENDAR --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#periodInput", {
                mode: "range", // enables FROM + TO mode
                dateFormat: "F j, Y", // January 5, 2025
                allowInput: false,
                defaultDate: null,
                altInput: true,
                altFormat: "F j, Y",
                ariaDateFormat: "F j, Y",
            });

            // Re-render icons
            lucide.createIcons();
        });
    </script>

    <script>
        feather.replace();

        document.addEventListener("DOMContentLoaded", function() {
            const savedDept = localStorage.getItem("selectedDepartment");
            if (savedDept) {
                document.getElementById("selectedDepartmentName").textContent = savedDept;
            }
        });
    </script>

    <script>
        feather.replace();

        document.addEventListener("DOMContentLoaded", function() {
            const savedDept = localStorage.getItem("selectedDepartment");
            if (savedDept) {
                // Update the input
                const deptInput = document.getElementById("departmentInput");
                if (deptInput) deptInput.value = savedDept;

                // Optional: Update the breadcrumb span if you have it
                const breadcrumbDept = document.getElementById("selectedDepartmentName");
                if (breadcrumbDept) breadcrumbDept.textContent = savedDept;
            }
        });
    </script>

    {{-- CITATION --}}
    <script>
        document.getElementById("citation").addEventListener("input", function() {
            let text = this.value.trim();

            // Count words
            let words = text.split(/\s+/).filter(word => word.length > 0);
            let wordCount = words.length;

            let errorMsg = document.getElementById("citationError");
            let countDisplay = document.getElementById("citationCount");

            // Update counter
            countDisplay.textContent = wordCount + " / 150 words";

            // Check limit
            if (wordCount > 150) {
                errorMsg.textContent = "You have reached the maximum of 150 words.";
                errorMsg.classList.remove("hidden");

                // Prevent typing more — revert to first 150 words
                this.value = words.slice(0, 150).join(" ");

                // Recalculate after trim
                countDisplay.textContent = "150 / 150 words";
            } else {
                errorMsg.classList.add("hidden");
            }
        });
    </script>

    <script>
        const citationInput = document.getElementById('citation');
        const citationCount = document.getElementById('citationCount');
        const citationError = document.getElementById('citationError');
        const maxWords = 150;

        citationInput.addEventListener('input', () => {
            let text = citationInput.value;
            let words = text.trim().split(/\s+/).filter(word => word.length > 0);
            let wordCount = words.length;

            // Update live word count
            citationCount.textContent = `${wordCount} / ${maxWords} words`;

            if (wordCount > maxWords) {
                citationError.textContent = `You have exceeded the maximum of ${maxWords} words!`;
                citationError.classList.remove('hidden');
            } else {
                citationError.classList.add('hidden');
            }
        });

        // Optional: Prevent form submission if word limit exceeded
        document.querySelector('form').addEventListener('submit', function(e) {
            let text = citationInput.value;
            let words = text.trim().split(/\s+/).filter(word => word.length > 0);
            if (words.length > maxWords) {
                e.preventDefault();
                citationError.textContent = `Cannot submit. Maximum ${maxWords} words allowed.`;
                citationError.classList.remove('hidden');
            }
        });
    </script>

    <!-- Feather icons initialization -->
    <script>
        feather.replace();
    </script>


    <script>
        feather.replace();

        // Get selected department from localStorage
        const selectedDept = localStorage.getItem('selectedDepartment');

        if (selectedDept) {
            // Update breadcrumb
            const breadcrumbDept = document.getElementById('selectedDepartmentName');
            if (breadcrumbDept) {
                breadcrumbDept.textContent = selectedDept;
            }

            // Update input field
            const departmentInput = document.getElementById('departmentInput');
            if (departmentInput) {
                departmentInput.value = selectedDept;
            }

            // Optional: jump to Step 2 if using multi-step form
            if (typeof currentStep !== 'undefined' && typeof showStep === 'function') {
                currentStep = 1; // Step 2 index
                showStep(currentStep);
            }
        }


        const steps = document.querySelectorAll('.form-step');
        let currentStep = 0;

        // Show only the current step
        function showStep(index) {
            steps.forEach((step, i) => step.classList.toggle('hidden', i !== index));
        }
        showStep(currentStep);

        // Next step
        function nextStep() {
            const inputs = steps[currentStep].querySelectorAll('input, textarea, select');
            for (let input of inputs) {
                if (!input.checkValidity()) {
                    input.reportValidity();
                    return; // stop if required input is missing
                }
            }
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        }

        // Previous step
        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        }

        // Prefill department from URL or localStorage
        document.addEventListener("DOMContentLoaded", () => {
            const urlParams = new URLSearchParams(window.location.search);
            const department = urlParams.get("department") || localStorage.getItem("selectedDepartment");
            if (department) {
                const deptInput = document.getElementById("departmentInput");
                const breadcrumbDept = document.getElementById("selectedDepartmentName");
                if (deptInput) deptInput.value = department;
                if (breadcrumbDept) breadcrumbDept.textContent = department;

                // Start on Step 2 if department already selected
                currentStep = 1;
                showStep(currentStep);
            }
        });
    </script>




</body>

</html>
