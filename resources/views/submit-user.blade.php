@extends('layouts.app')

@section('title', 'Submit Your Details')

@section('content')
<!-- Page Progress Bar -->
<div class="fixed top-0 left-0 w-full bg-gray-200 h-3 z-50">
    <div class="relative h-full">
        <!-- Filled part -->
        <div id="pageProgress" class="absolute top-0 left-0 h-full bg-purple-600 w-1/3 transition-all"></div>

        <!-- Step numbers -->
        <div class="absolute top-1/2 left-0 w-full flex justify-between -translate-y-1/2 px-4">
            <span class="w-8 h-8 bg-purple-600 text-white font-bold rounded-full flex items-center justify-center">1</span>
            <span class="w-8 h-8 bg-gray-400 text-white font-bold rounded-full flex items-center justify-center">2</span>
            <span class="w-8 h-8 bg-gray-400 text-white font-bold rounded-full flex items-center justify-center">3</span>
        </div>
    </div>
</div>

<section class="min-h-screen flex items-center justify-center py-12 px-4 bg-gradient-to-br from-purple-50 to-indigo-50 mt-6">
    <div class="max-w-3xl w-full glass-card rounded-3xl p-12 shadow-2xl border border-white/20">
        <h2 class="text-3xl font-bold text-gray-900 mb-10 flex items-center gap-3">
            <i data-lucide="user-plus" class="w-10 h-10 text-purple-600"></i>
            Submit Your Details - Step <span id="currentStep">1</span>
        </h2>

        <form id="userForm" class="space-y-6">
            @php
                $fields = [
                    ['label' => 'Title', 'id' => 'title', 'icon' => 'award', 'color' => 'from-purple-400 to-purple-500'],
                    ['label' => 'Full Name', 'id' => 'full_name', 'icon' => 'user', 'color' => 'from-purple-400 to-purple-500'],
                    ['label' => 'Unit', 'id' => 'unit', 'icon' => 'layers', 'color' => 'from-purple-400 to-purple-500'],
                    ['label' => 'Designation', 'id' => 'designation', 'icon' => 'briefcase', 'color' => 'from-purple-400 to-purple-500'],
                    ['label' => 'Kingschat Handle', 'id' => 'kingschat_handle', 'icon' => 'message-circle', 'color' => 'from-purple-400 to-purple-500'],
                    ['label' => 'Phone Number', 'id' => 'phone_number', 'icon' => 'phone', 'color' => 'from-purple-400 to-purple-500'],
                ];
            @endphp

            @foreach ($fields as $field)
            <div class="relative">
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 w-9 h-9 rounded-full bg-gradient-to-br {{ $field['color'] }} flex items-center justify-center shadow-md">
                    <i data-lucide="{{ $field['icon'] }}" class="w-5 h-5 text-white"></i>
                </div>
                <input type="text" id="{{ $field['id'] }}" placeholder=" "
                    class="peer w-full pl-14 pr-4 py-3 bg-white/30 text-gray-900 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 focus:outline-none transition">
                <label for="{{ $field['id'] }}"
                    class="absolute left-14 top-1/2 transform -translate-y-1/2 text-gray-700/70 pointer-events-none transition-all duration-200
                           peer-placeholder-shown:translate-y-0 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base
                           peer-focus:-translate-y-5 peer-focus:text-purple-600 peer-focus:text-sm">
                    {{ $field['label'] }}
                </label>
            </div>
            @endforeach

            <div class="flex justify-between mt-6">
                <button type="button" id="prevStep" class="px-6 py-3 bg-gray-300 rounded-xl hover:bg-gray-400 transition">Previous</button>
                <button type="button" id="nextStep" class="px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition">Next</button>
            </div>
        </form>
    </div>
</section>
@endsection

@section('scripts')
<script>
    lucide.createIcons();

    let currentStep = 1;
    const totalSteps = 3;

    const pageProgress = document.getElementById('pageProgress');
    const currentStepSpan = document.getElementById('currentStep');
    const prevBtn = document.getElementById('prevStep');
    const nextBtn = document.getElementById('nextStep');
    const stepNumbers = document.querySelectorAll('.absolute.flex > span');

    function updateProgress() {
        const percent = (currentStep / totalSteps) * 100;
        pageProgress.style.width = percent + '%';

        currentStepSpan.textContent = currentStep;

        // Update step number colors
        stepNumbers.forEach((num, index) => {
            if(index + 1 === currentStep) {
                num.classList.remove('bg-gray-400');
                num.classList.add('bg-purple-600');
            } else {
                num.classList.remove('bg-purple-600');
                num.classList.add('bg-gray-400');
            }
        });

        // Disable buttons at edges
        prevBtn.disabled = currentStep === 1;
        nextBtn.disabled = currentStep === totalSteps;
        prevBtn.classList.toggle('opacity-50 cursor-not-allowed', prevBtn.disabled);
        nextBtn.classList.toggle('opacity-50 cursor-not-allowed', nextBtn.disabled);
    }

    prevBtn.addEventListener('click', () => {
        if(currentStep > 1) currentStep--;
        updateProgress();
    });

    nextBtn.addEventListener('click', () => {
        if(currentStep < totalSteps) currentStep++;
        updateProgress();
    });

    updateProgress();
</script>
@endsection
