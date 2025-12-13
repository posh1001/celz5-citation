@extends('layouts.app')

@section('title', $group->name . ' - Citation Form')

@section('content')
   <header x-data="{ open: false }" class="bg-white shadow-md py-4 relative">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-purple-600">CELZ5 Citation</h1>

        <!-- Desktop Nav -->
        <nav class="space-x-4 hidden md:flex">
            <a href="/" class="text-gray-700 hover:text-purple-600 transition">Home</a>
            <a href="/departments" class="text-gray-700 hover:text-purple-600 transition">Departments</a>
            <a href="/groups" class="text-gray-700 hover:text-purple-600 transition">Groups</a>
        </nav>

        <!-- Mobile Menu Button -->
        <button @click="open = !open" class="md:hidden text-gray-700 focus:outline-none">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition
        class="md:hidden bg-white shadow-lg border-t border-gray-200 mt-2">
        <nav class="flex flex-col space-y-2 p-4">
            <a href="/" class="text-gray-700 hover:text-purple-600 transition">Home</a>
            <a href="/departments" class="text-gray-700 hover:text-purple-600 transition">Departments</a>
            <a href="/groups" class="text-gray-700 hover:text-purple-600 transition">Groups</a>
        </nav>
    </div>

    <!-- Progress Bar -->
    <div class="absolute bottom-0 left-0 w-full h-1 bg-gray-200">
        <div id="progress-bar" class="h-1 bg-purple-600 w-0 transition-all duration-500"></div>
    </div>
</header>

    <section class="max-w-5xl mx-auto px-6 py-16">

        {{-- Breadcrumbs --}}
        <nav class="flex items-center text-sm text-gray-500 mb-6 animate-fadeUp">
            <a href="/" class="hover:text-indigo-600 transition">Home</a>
            <span class="mx-2">›</span>
            <a href="/groups" class="hover:text-indigo-600 transition">Groups</a>
            <span class="mx-2">›</span>
            <span class="font-semibold text-gray-800">{{ $group->name }}</span>
        </nav>

        {{-- Step Indicators --}}
        <div class="flex justify-between mb-10">
            <div class="step flex-1 text-center">
                <div
                    class="w-10 h-10 mx-auto rounded-full bg-purple-600 text-white font-bold flex items-center justify-center">
                    1</div>
                <span class="block mt-2 text-sm font-medium text-gray-700">Personal</span>
            </div>
            <div class="step flex-1 text-center">
                <div
                    class="w-10 h-10 mx-auto rounded-full bg-gray-300 text-white font-bold flex items-center justify-center">
                    2</div>
                <span class="block mt-2 text-sm font-medium text-gray-700">Department</span>
            </div>
            <div class="step flex-1 text-center">
                <div
                    class="w-10 h-10 mx-auto rounded-full bg-gray-300 text-white font-bold flex items-center justify-center">
                    3</div>
                <span class="block mt-2 text-sm font-medium text-gray-700">Citation</span>
            </div>
        </div>

        {{-- Multi-Step Form --}}
        <div class="glass-card p-10 rounded-3xl border border-white/20 shadow-2xl backdrop-blur-2xl">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-300 text-green-700 rounded-xl flex items-center gap-3">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form id="multiStepForm" action="{{ route('group-citations.store') }}" method="POST" class="space-y-8">
                @csrf

                {{-- Step 1: Personal Details --}}
                <div class="form-step grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group relative">
                        <i data-lucide="user-round" class="absolute top-3 left-3 w-5 h-5 text-indigo-600"></i>
                        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-xl px-10 py-3 bg-white shadow-sm group-hover:shadow-md transition">
                    </div>

                    <div class="group relative">
                        <i data-lucide="phone" class="absolute top-3 left-3 w-5 h-5 text-indigo-600"></i>
                        <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}"
                            class="w-full border border-gray-300 rounded-xl px-10 py-3 bg-white shadow-sm group-hover:shadow-md transition">
                    </div>

                    <div class="group relative md:col-span-2">
                        <i data-lucide="message-circle" class="absolute top-3 left-3 w-5 h-5 text-indigo-600"></i>
                        <input type="text" name="kingschat" placeholder="KingsChat Handle" value="{{ old('kingschat') }}"
                            class="w-full border border-gray-300 rounded-xl px-10 py-3 bg-white shadow-sm group-hover:shadow-md transition">
                    </div>
                </div>

                {{-- Step 2: Department & Group Details --}}
                <div class="form-step hidden grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group relative">
                        <i data-lucide="layers" class="absolute top-3 left-3 w-5 h-5 text-indigo-600"></i>
                        <input type="text" name="unit" placeholder="Unit" value="{{ old('unit') }}"
                            class="w-full border border-gray-300 rounded-xl px-10 py-3 bg-white shadow-sm group-hover:shadow-md transition">
                    </div>

                    <div class="group relative">
                        <i data-lucide="briefcase" class="absolute top-3 left-3 w-5 h-5 text-indigo-600"></i>
                        <input type="text" name="designation" placeholder="Designation" value="{{ old('designation') }}"
                            class="w-full border border-gray-300 rounded-xl px-10 py-3 bg-white shadow-sm group-hover:shadow-md transition">
                    </div>

                    {{-- Department Selection --}}
                    <div class="group relative">
                        <i data-lucide="building-2" class="absolute top-3 left-3 w-5 h-5 text-indigo-600"></i>
                        <select name="department_id"
                            class="w-full border border-gray-300 rounded-xl px-10 py-3 bg-white text-gray-700 font-medium focus:ring-2 focus:ring-indigo-500 shadow-sm group-hover:shadow-md transition">
                            <option value="" disabled selected>Select Department</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}"
                                    {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="group relative">
                        <i data-lucide="building-2" class="absolute top-3 left-3 w-5 h-5 text-indigo-600"></i>
                        <input type="text" value="{{ $group->name }}" readonly required
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-10 py-3 text-gray-700 font-medium shadow-sm group-hover:shadow-md transition">
                        <input type="hidden" name="department_id" value="{{ $group->id }}" required>
                    </div>
                </div>

                {{-- Step 3: Citation Details --}}
                <div class="form-step hidden grid grid-cols-1 gap-6">
                    <div class="group relative">
                        <i data-lucide="award" class="absolute top-3 left-3 w-5 h-5 text-indigo-600"></i>
                        <input type="text" name="title" placeholder="Title" value="{{ old('title') }}"
                            class="w-full border border-gray-300 rounded-xl px-10 py-3 bg-white shadow-sm group-hover:shadow-md transition">
                    </div>

                    <div class="group relative w-full max-w-md">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <i data-lucide="calendar" class="w-5 h-5 text-indigo-600"></i>
                            Period (From & To)
                        </label>
                        <div
                            class="flex items-center gap-2 border border-gray-300 rounded-xl px-4 py-3 bg-white shadow-sm group-hover:shadow-md transition">
                            <input type="date" name="period_from" value="{{ old('period_from') }}"
                                class="flex-1 border-none px-2 py-1 focus:ring-0 focus:outline-none">
                            <span class="text-gray-400 font-medium">—</span>
                            <input type="date" name="period_to" value="{{ old('period_to') }}"
                                class="flex-1 border-none px-2 py-1 focus:ring-0 focus:outline-none">
                        </div>
                    </div>

                    <div class="group relative">
                        <i data-lucide="align-left" class="absolute top-3 left-3 w-5 h-5 text-indigo-600"></i>
                        <textarea name="description" rows="4" placeholder="Citation (Max 150 words)"
                            class="w-full border border-gray-300 rounded-xl px-10 py-3 bg-white shadow-sm group-hover:shadow-md transition">{{ old('description') }}</textarea>
                    </div>
                </div>

                {{-- Navigation Buttons --}}
                <div class="flex justify-between mt-6">
                    <button type="button" id="prevBtn"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-2 px-6 rounded-xl transition hidden">Previous</button>
                    <button type="button" id="nextBtn"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-xl transition">Next</button>
                    <button type="submit" id="submitBtn"
                        class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-xl transition hidden">Submit</button>
                </div>
            </form>

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="p-4 mt-4 bg-red-100 text-red-700 rounded-xl">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('styles')
    <style>
        #progress-bar {
            width: 0;
            height: 4px;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeUp {
            animation: fadeUp 0.9s ease-out forwards;
        }
    </style>
@endsection

@section('scripts')
    <script>
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', () => {
            const steps = document.querySelectorAll('.form-step');
            const progressBar = document.getElementById('progress-bar');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');
            const stepIndicators = document.querySelectorAll('.step div');
            let currentStep = 0;

            function showStep(index) {
                steps.forEach((step, i) => step.classList.add('hidden'));
                steps[index].classList.remove('hidden');

                prevBtn.style.display = index === 0 ? 'none' : 'inline-block';
                nextBtn.style.display = index === steps.length - 1 ? 'none' : 'inline-block';
                submitBtn.style.display = index === steps.length - 1 ? 'inline-block' : 'none';

                progressBar.style.width = `${((index+1)/steps.length)*100}%`;

                stepIndicators.forEach((el, i) => {
                    el.classList.remove('bg-purple-600', 'text-white');
                    el.classList.add('bg-gray-300', 'text-white');
                    if (i <= index) {
                        el.classList.add('bg-purple-600', 'text-white');
                        el.classList.remove('bg-gray-300');
                    }
                });
            }

            nextBtn.addEventListener('click', () => {
                if (currentStep < steps.length - 1) currentStep++;
                showStep(currentStep);
            });
            prevBtn.addEventListener('click', () => {
                if (currentStep > 0) currentStep--;
                showStep(currentStep);
            });

            showStep(currentStep);
        });
    </script>
@endsection
