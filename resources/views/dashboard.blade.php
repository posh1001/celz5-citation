<!-- resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        .glass {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.10);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .modal-glass {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.12);
            border-radius: 1.2rem;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .hover-zoom:hover {
            transform: scale(1.05);
            transition: all 0.3s ease-in-out;
        }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-bg {
            background: rgba(0, 0, 0, 0.55);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-900 to-indigo-700 min-h-screen text-white">

    <!-- NAVBAR -->
    <nav class="flex items-center justify-between p-4 glass mb-6">
        <div class="flex items-center gap-4">
            @php
                $user = auth()->user();
                $initials = $user
                    ? strtoupper(substr($user->name, 0, 1) . substr(strrchr($user->name, ' '), 1, 1))
                    : 'AD';
            @endphp

            <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                {{ $initials }}
            </div>

            <span class="text-lg font-semibold">Admin Dashboard</span>
        </div>

        <form method="POST" action="">
            @csrf
            <button type="submit" class="glass px-4 py-2 rounded-lg hover:bg-red-600 transition">
                Logout
            </button>
        </form>
    </nav>
    <br>
    <br>

    <div class="container mx-auto p-6 fade-in">

        <!-- CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <!-- Departments -->
            <div class="glass p-6 shadow-lg hover-zoom fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm opacity-80">Departments</h2>
                        <p class="text-2xl font-semibold mt-2">{{ $departmentsCount }}</p>
                    </div>
                    <i class="fas fa-building fa-2x opacity-50"></i>
                </div>
            </div>

            <!-- Groups -->
            <div class="glass p-6 shadow-lg hover-zoom fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm opacity-80">Groups</h2>
                        <p class="text-2xl font-semibold mt-2">{{ $groupsCount }}</p>
                    </div>
                    <i class="fas fa-users fa-2x opacity-50"></i>
                </div>
            </div>

            <!-- Citations -->
            <div class="glass p-6 shadow-lg hover-zoom fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm opacity-80">Citations</h2>
                        <p class="text-2xl font-semibold mt-2">{{ $citationsCount }}</p>
                    </div>
                    <i class="fas fa-quote-right fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <br>
        <br>

        <!-- SEARCH + EXPORT -->
        <div class="flex flex-col md:flex-row items-center justify-between mb-6 gap-4">

            <!-- SEARCH -->
            <input id="searchInput" type="text" placeholder="Search..."
                class="glass p-2 rounded-lg w-full md:w-1/3 text-black focus:outline-none">

            <!-- EXPORT (center) -->
            <div class="flex gap-2 justify-center w-full md:w-auto">
                <a href="{{ route('admin.dashboard.export.csv') }}"
                    class="glass p-2 rounded-lg hover:bg-indigo-500 transition">
                    <i class="fas fa-file-csv mr-2"></i>CSV
                </a>

                <a href="{{ route('admin.dashboard.export.excel') }}"
                    class="glass p-2 rounded-lg hover:bg-indigo-500 transition">
                    <i class="fas fa-file-excel mr-2"></i>Excel
                </a>

                <a href="{{ route('admin.dashboard.export.pdf') }}"
                    class="glass p-2 rounded-lg hover:bg-indigo-500 transition">
                    <i class="fas fa-file-pdf mr-2"></i>PDF
                </a>
            </div>

        </div>


        <!-- TABLE -->
        <div class="overflow-x-auto fade-in">
            <table class="glass w-full text-left border-collapse shadow-lg">
                <thead>
                    <tr class="border-b border-white/20 text-sm font-semibold">
                        <th class="p-3">Title</th>
                        <th class="p-3">Full Name</th>
                        <th class="p-3">Unit</th>
                        <th class="p-3">Group</th>
                        <th class="p-3">Designation</th>
                        <th class="p-3">Kingschat Handle</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Citation</th>
                        <th class="p-3">Timestamp</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($citations as $citation)
                        <tr class="border-b border-white/10 text-sm">
                            <td class="p-3">{{ $citation->title }}</td>
                            <td class="p-3">{{ $citation->name }}</td>
                            <td class="p-3">{{ $citation->unit }}</td>
                            <td class="p-3">{{ $citation->groups }}</td>
                            <td class="p-3">{{ $citation->designation }}</td>
                            <td class="p-3">{{ $citation->handle }}</td>
                            <td class="p-3">{{ $citation->phone }}</td>
                            <td class="p-3">{{ \Illuminate\Support\Str::limit($citation->citation, 50) }}</td>
                            <td class="p-3">{{ $citation->created_at->format('Y-m-d') }}</td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('admin.citation.show', $citation->id) }}"
                                    class="glass px-3 py-1 rounded hover:bg-indigo-500 transition">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.citation.destroy', $citation->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="glass px-3 py-1 rounded bg-red-500/40 hover:bg-red-500/60 transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="p-3 text-center text-gray-300">No citations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4 flex justify-center">
            {{ $citations->links() }}
        </div>

    </div>

    <!-- MODAL -->
    <div id="modal" class="hidden fixed inset-0 modal-bg flex items-center justify-center p-4 z-50">
        <div class="modal-glass p-6 w-full max-w-lg relative">

            <button id="closeModal" class="absolute top-3 right-3 text-white hover:text-red-300">
                <i class="fas fa-times fa-lg"></i>
            </button>

            <h2 class="text-xl font-semibold mb-4">Full Citation</h2>

            <p id="modalText" class="leading-relaxed text-gray-200 text-base"></p>
            <p id="modalSender" class="mt-6 text-sm text-gray-300 italic text-right"></p>
        </div>
    </div>


    <script>
        /*** SAMPLE DATA ***/
        const data = [{
                title: 'Mr.',
                name: 'John Doe',
                unit: 'Unit 1',
                groups: 'Group A',
                designation: 'Leader',
                handle: '@johndoe',
                phone: '+2341234567',
                citation: 'John’s full citation text goes here. Lorem ipsum dolor sit amet...',
                timestamp: '2025-01-10'
            },

            {
                title: 'Mrs.',
                name: 'Jane Smith',
                unit: 'Unit 2',
                groups: 'Group B',
                designation: 'Member',
                handle: '@janesmith',
                phone: '+2349876543',
                citation: 'Jane has contributed greatly. Vivamus magna justo, lacinia eget...',
                timestamp: '2025-02-15'
            },

            {
                title: 'Mr.',
                name: 'Bob Johnson',
                unit: 'Unit 1',
                groups: 'Group C',
                designation: 'Member',
                handle: '@bobj',
                phone: '+2344567890',
                citation: 'Bob’s citation: Praesent sapien massa, convallis a pellentesque...',
                timestamp: '2025-03-20'
            },
        ];

        let currentPage = 1;
        let rowsPerPage = 10; // UPDATED (10 rows per page)
        let filteredData = data;

        /*** ELEMENTS ***/
        const tableBody = document.getElementById('tableBody');
        const pagination = document.getElementById('pagination');
        const searchInput = document.getElementById('searchInput');


        /*** RENDER TABLE ***/
        function renderTable() {
            tableBody.innerHTML = '';

            const start = (currentPage - 1) * rowsPerPage;
            const pageData = filteredData.slice(start, start + rowsPerPage);

            pageData.forEach((row) => {
                const shortCitation =
                    row.citation.length > 50 ?
                    row.citation.substring(0, 50) + "..." :
                    row.citation;

                tableBody.innerHTML += `
            <tr class="border-b border-white/10 text-sm">
                <td class="p-3">${row.title}</td>
                <td class="p-3">${row.name}</td>
                <td class="p-3">${row.unit}</td>
                <td class="p-3">${row.groups}</td>
                <td class="p-3">${row.designation}</td>
                <td class="p-3">${row.handle}</td>
                <td class="p-3">${row.phone}</td>

                <td class="p-3">
                    ${shortCitation}
                    <button class="text-indigo-300 underline ml-2"
                        onclick="showCitation('${row.citation.replace(/'/g, "\\'")}', '${row.name}')">
                        Read more
                    </button>
                </td>

                <td class="p-3">${row.timestamp}</td>

                <td class="p-3 flex gap-2">
                    <button class="glass px-3 py-1 rounded hover:bg-indigo-500 transition">
                        <i class="fas fa-eye"></i>
                    </button>

                    <button class="glass px-3 py-1 rounded bg-red-500/40 hover:bg-red-500/60 transition">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
            });

            renderPagination();
        }

        function goToPage(page) {
            currentPage = page;
            renderTable();
        }



        /*** MODAL ***/
        function showCitation(text, sender) {
            document.getElementById('modalText').textContent = text;
            document.getElementById('modalSender').textContent = `— ${sender}`;
            document.getElementById('modal').classList.remove('hidden');
        }

        document.getElementById('closeModal').addEventListener('click', () =>
            document.getElementById('modal').classList.add('hidden')
        );


        /*** INITIAL LOAD ***/
        renderTable();
    </script>

</body>

</html>
