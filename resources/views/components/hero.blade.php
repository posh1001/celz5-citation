<section
    class="hero relative bg-gradient-to-br from-indigo-700 via-purple-700 to-fuchsia-700 text-white overflow-hidden">
    <!-- subtle grain -->
    <div class="absolute inset-0 pointer-events-none opacity-25"
        style="background-image:url('https://grainy-gradients.vercel.app/noise.svg'); background-size:cover;"></div>

    <div class="max-w-7xl mx-auto px-6 relative flex flex-col md:flex-row items-center md:items-start gap-8">
        <!-- LEFT: TEXT -->
        <div class="w-full md:w-1/2 flex flex-col gap-6 items-center md:items-start text-center md:text-left">
            <h1 class="text-4xl md:text-6xl font-extrabold opacity-0 animate-slide-stagger" style="--delay:0s;">
                CELZ5 Citation Portal
            </h1>

            <p class="lead text-lg md:text-xl text-white/90 opacity-0 animate-slide-stagger" style="--delay:0.35s;">
                Organize, track, and manage departmental citations with elegant design and precise workflows.
            </p>

            <div class="flex flex-col md:flex-row gap-3 items-center md:items-start mt-4">
                <a href="/departments"
                    class="inline-block bg-gradient-to-r from-purple-500 to-indigo-500 text-white font-semibold px-6 py-3 rounded-2xl shadow-lg
                    transform transition-all duration-700 opacity-0 translate-y-6 hover:scale-105"
                    id="exploreDepartmentsBtn">
                    Explore Departments
                </a>

                <a href="/groups"
                    class="inline-block px-4 py-2 rounded-full border border-white/10 text-white/95 opacity-0 animate-slide-stagger"
                    style="--delay:0.95s;">
                    Browse Groups
                </a>
            </div>

            <!-- small hint row -->
            <div class="mt-4 flex gap-4 flex-wrap justify-center md:justify-start text-sm text-white/80">
                <span class="inline-flex items-center gap-2 py-1 px-2 bg-white/6 rounded-full glass-card">
                    <i data-lucide="check" class="w-4 h-4"></i>Departments
                </span>
                <span class="inline-flex items-center gap-2 py-1 px-2 bg-white/6 rounded-full glass-card">
                    <i data-lucide="zap" class="w-4 h-4"></i> Groups
                </span>
            </div>
        </div>

        <!-- RIGHT: HERO CARDS (hidden on mobile) -->
        <div class="md:w-1/2 hidden md:block relative">
            @php
                $positions = [
                    ['top' => -40, 'right' => 0, 'rotation' => '-6deg', 'delay' => 0],
                    ['top' => 100, 'right' => -120, 'rotation' => '4deg', 'delay' => 0.35],
                    ['top' => 100, 'right' => 180, 'rotation' => '8deg', 'delay' => 0.7],
                ];
            @endphp

            @foreach ($positions as $i => $p)
                <div
                    class="floating glass-card rounded-3xl overflow-hidden relative transform transition-all duration-700 ease-out glow-ring floating-item
                        w-80 h-80 md:absolute"
                    style="
                        --rotation: {{ $p['rotation'] }};
                        top: {{ $p['top'] }}px;
                        right: {{ $p['right'] }}px;
                        animation-delay: {{ $p['delay'] }}s;
                    "
                    role="img" aria-label="Decorative image {{ $i + 1 }}">
                    <!-- decorative gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-300/20 to-purple-300/30 mix-blend-overlay pointer-events-none"></div>

                    <!-- image placeholder -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div
                            class="w-40 h-40 rounded-2xl bg-[linear-gradient(135deg,#7c3aed33,#4f46e533)] flex items-center justify-center text-white/90 text-sm font-medium">
                            <span>CELZ5 Citation</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('exploreDepartmentsBtn');

            // Animate in
            setTimeout(() => {
                btn.classList.remove('opacity-0', 'translate-y-6');
                btn.classList.add('opacity-100', 'translate-y-0');
            }, 700);
        });
    </script>
</section>
