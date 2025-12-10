<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CELZ5 Citation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 font-['Inter'] min-h-screen p-6">
    <!-- Admin Navbar -->
<nav class="bg-[rgba(255,255,255,0.06)] backdrop-blur-md border-b border-[rgba(255,255,255,0.12)] px-6 py-3 flex items-center justify-between">
    <!-- Left: Logo / Brand -->
  @php
    // Get the logged-in user
    $user = auth()->user();
    // Generate initials from full name
    $initials = collect(explode(' ', $user->name ?? $user->fullname))
        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
        ->take(2) // first 2 letters
        ->implode('');
@endphp

<div class="flex items-center space-x-3">
    <div class="h-8 w-8 rounded-full bg-indigo-400 flex items-center justify-center text-white font-semibold">
        {{ $initials }}
    </div>
    <span class="text-white font-semibold text-lg">{{ $user->name ?? $user->fullname }}</span>
</div>


    <!-- Right: Actions -->
    <div class="flex items-center space-x-4">

        <!-- Logout -->
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-600 to-pink-500 text-white rounded-lg hover:opacity-90 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-8V7a2 2 0 114 0v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</nav>


    <div class="container mx-auto" x-data="citationDashboard()">

        <!-- Header -->
        <header class="mb-8 text-white">
            <h1 class="text-4xl font-bold mb-2 drop-shadow-lg">Citation Submission Dashboard</h1>
            <p class="text-white/80">Manage Departments, Groups & Citations</p>
        </header>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="glass p-6 rounded-xl shadow-lg transform hover:-translate-y-2 transition-all duration-500">
                <div class="flex items-center space-x-4">
                    <i data-feather="layers" class="w-8 h-8 text-indigo-500"></i>
                    <div>
                        <h2 class="text-xl font-semibold">Departments</h2>
                        <p class="text-gray-200 mt-1">Total Department: {{ $departmentsCount }}</p>
                    </div>
                </div>
            </div>

            <div class="glass p-6 rounded-xl shadow-lg transform hover:-translate-y-2 transition-all duration-500">
                <div class="flex items-center space-x-4">
                    <i data-feather="file-text" class="w-8 h-8 text-yellow-500"></i>
                    <div>
                        <h2 class="text-xl font-semibold">Citations</h2>
                        <p class="text-gray-200 mt-1">Total Citation Submitted: {{ $citationsCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Export -->
        <div class="flex flex-col md:flex-row items-center justify-between mb-4 space-y-4 md:space-y-0">
            <!-- Modern Search Bar -->
            <div class="w-full md:w-1/3 mb-6 relative">
                <input type="text" id="searchInput" placeholder="Search by Name, Group, or Department..."
                    class="glass p-3 pl-10 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                <!-- Search icon -->
                <svg class="w-5 h-5 absolute left-3 top-3 text-gray-400 pointer-events-none" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            {{-- EXPORT DATA --}}

            <div class="flex space-x-3">
                <a href="{{ route('citations.exportExcel') }}"
                    class="glass px-4 py-2 rounded-lg hover:bg-indigo-600 transition-all">
                    Export Excel
                </a>

                <a href="{{ route('citations.exportCSV') }}"
                    class="glass px-4 py-2 rounded-lg hover:bg-pink-600 transition-all">
                    Export CSV
                </a>

                <a href="{{ route('citations.exportWord') }}"
                    class="glass px-4 py-2 rounded-lg hover:bg-yellow-600 transition-all">
                    Export Word
                </a>
            </div>


        </div>

        <!-- Table -->
        <div class="overflow-x-auto glass rounded-xl shadow-lg">
            <table class="min-w-full text-left border-collapse shadow-lg rounded-lg overflow-hidden">
                <thead
                    class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white text-sm tracking-wide">
                    <tr>
                        <th class="p-3 align-top">
                            <div class="flex flex-col items-start space-y-1">
                                <i class="ph ph-clipboard text-white text-lg"></i>
                                <span>Title.</span>
                            </div>
                        </th>
                        <th class="p-3 align-top">
                            <div class="flex flex-col items-start space-y-1">
                                <i class="ph ph-user text-white text-lg"></i>
                                <span>Full Name.</span>
                            </div>
                        </th>
                        <th class="p-3 align-top">
                            <div class="flex flex-col items-start space-y-1">
                                <i class="ph ph-building text-white text-lg"></i>
                                <span>Unit.</span>
                            </div>
                        </th>
                        <th class="p-3 align-top">
                            <div class="flex flex-col items-start space-y-1">
                                <i class="ph ph-briefcase text-white text-lg"></i>
                                <span>Designation.</span>
                            </div>
                        </th>
                        <th class="p-3 align-top">
                            <div class="flex flex-col items-start space-y-1">
                                <i class="ph ph-chat-text text-white text-lg"></i>
                                <span>Kingschat Handle.</span>
                            </div>
                        </th>
                        <th class="p-3 align-top">
                            <div class="flex flex-col items-start space-y-1">
                                <i class="ph ph-phone text-white text-lg"></i>
                                <span>Phone.</span>
                            </div>
                        </th>
                        <th class="p-3 align-top">
                            <div class="flex flex-col items-start space-y-1">
                                <i class="ph ph-office-building text-white text-lg"></i>
                                <span>Department.</span>
                            </div>
                        </th>
                        <th class="p-3 align-top">
                            <div class="flex flex-col items-start space-y-1">
                                <i class="ph ph-calendar text-white text-lg"></i>
                                <span>Period.</span>
                            </div>
                        </th>
                        <th class="p-3 align-top">
                            <div class="flex flex-col items-start space-y-1">
                                <i class="ph ph-file-text text-white text-lg"></i>
                                <span>Citation.</span>
                            </div>
                        </th>
                        <th class="p-3 align-top">
                            <div class="flex flex-col items-start space-y-1">
                                <i class="ph ph-clock text-white text-lg"></i>
                                <span>Created At.</span>
                            </div>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white/5 text-white/90 divide-y divide-white/20">
                    @forelse ($citations as $citation)
                        <tr class="hover:bg-white/10 transition-all">
                            <td class="p-3">{{ $citation->title ?? 'N/A' }}</td>
                            <td class="p-3">{{ $citation->fullname ?? 'N/A' }}</td>
                            <td class="p-3">{{ $citation->unit ?? 'N/A' }}</td>
                            <td class="p-3">{{ $citation->designation ?? 'N/A' }}</td>
                            <td class="p-3">{{ $citation->kingschat ?? 'N/A' }}</td>
                            <td class="p-3">{{ $citation->phone ?? 'N/A' }}</td>
                            <td class="p-3">{{ $citation->department ?? 'N/A' }}</td>
                            <td class="p-3">{{ $citation->period ?? 'N/A' }}</td>
                            <td class="p-3 flex items-center space-x-2">
                                <span>{{ Str::limit($citation->citation ?? 'N/A', 30, '...') }}</span>
                                <button
                                    @click="openModal('{{ addslashes($citation->fullname ?? '') }}', '{{ addslashes($citation->citation ?? '') }}')"
                                    class="text-indigo-400 underline ml-2 hover:text-indigo-200 transition-all">
                                    View More
                                </button>
                            </td>
                            <td class="p-3">
                                {{ $citation->created_at ? $citation->created_at->format('d-m-Y H:i') : 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="p-4 text-center text-white/80">No citations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="mt-4">
            {{ $citations->withQueryString()->links('pagination::tailwind') }}
        </div>


        <!-- Modal -->
        <div x-show="open" x-cloak
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 transition-opacity duration-300">
            <div
                class="bg-white/10 backdrop-blur-lg border border-white/20 p-6 rounded-2xl w-full max-w-lg max-h-[80vh] overflow-y-auto relative shadow-xl">
                <!-- Close Button -->
                <button @click="close()"
                    class="absolute top-4 right-4 text-white/80 hover:text-white text-2xl transition-colors">&times;</button>

                <!-- Sender -->
                <h2 class="text-2xl font-semibold mb-4 text-white/90">Sender: <span x-text="fullname"></span></h2>

                <!-- Message -->
                <p class="text-white/80 whitespace-pre-wrap break-words text-lg leading-relaxed" x-text="citation">
                </p>
            </div>
        </div>

    </div>

    <script>
        feather.replace();

        function citationDashboard() {
            return {
                open: false,
                fullname: '',
                citation: '',
                openModal(name, citationText) {
                    this.fullname = name;
                    this.citation = citationText;
                    this.open = true;
                },
                close() {
                    this.open = false;
                }
            }
        }
    </script>

    <style>
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
        }

        button,
        a {
            transition: all 0.3s ease;
        }
    </style>


    {{-- SEARCHBAR --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const table = document.querySelector('table tbody');

            searchInput.addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = table.querySelectorAll('tr');

                rows.forEach(row => {
                    const fullname = row.cells[1].textContent.toLowerCase();
                    const group = row.cells[7].textContent.toLowerCase();
                    const department = row.cells[6].textContent.toLowerCase();

                    if (fullname.includes(filter) || group.includes(filter) || department.includes(
                            filter)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

    {{-- EXPORT DATA --}}

    <script>
        function exportData(format) {
            const filteredData = [];

            document.querySelectorAll('tbody tr').forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells.length) {
                    filteredData.push({
                        title: cells[0].innerText,
                        fullname: cells[1].innerText,
                        unit: cells[2].innerText,
                        designation: cells[4].innerText,
                        kingschat: cells[5].innerText,
                        phone: cells[6].innerText,
                        citation: cells[7].innerText,
                        created_at: cells[8].innerText
                    });
                }
            });

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/citations/export/${format}`;
            form.style.display = 'none';

            const token = document.createElement('input');
            token.name = '_token';
            token.value = '{{ csrf_token() }}';
            form.appendChild(token);

            const input = document.createElement('input');
            input.name = 'filteredData';
            input.value = JSON.stringify(filteredData);
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        }
    </script>

    <script>
        document.querySelectorAll('button[data-type]').forEach(button => {
            button.addEventListener('click', () => {
                const type = button.getAttribute('data-type');
                // Redirect to export route with type and all=1 to export all data
                window.location.href = `/citations/export?type=${type}&all=1`;
            });
        });
    </script>

</body>

</html>
