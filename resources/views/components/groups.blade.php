<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Groups</title>
<script src="https://cdn.tailwindcss.com"></script>
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

<section class="w-full max-w-7xl px-4 mb-16">
    <h2 class="text-3xl text-white font-semibold mb-8 text-center flex items-center justify-center space-x-2">
        <i data-feather="users" class="w-6 h-6 text-white"></i>
        <span>Groups</span>
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="groupContainer">
        <!-- Group cards inserted via JS -->
    </div>
</section>

<script>
feather.replace();

// List of groups
const groups = [
    'Lekki', 'Victoria Island', 'Alasia', 'Ikoyi Group 1', 'Ikoyi Group 2', 'Ajiwe', 'Obalende', 'Mobil',
    'Chevron', 'Onishon', 'Ajah', 'Kajola', 'Lekki Phase 1', 'Epe', 'Lagos Island', 'Youth Group',
    'Owode Badore', 'Free Trade Zone', 'Eputu', 'Ogombo', 'Abijo', 'Tedo'
];

const container = document.getElementById('groupContainer');

groups.forEach(group => {
    const card = document.createElement('div');
    card.className = "glass p-4 rounded-xl shadow-md flex flex-col items-center text-center hover:scale-105 transition-transform";
    card.innerHTML = `
        <i data-feather="map-pin" class="w-8 h-8 text-white mb-2"></i>
        <p class="text-white font-semibold">${group}</p>
        <p class="text-white/60 text-sm mt-1">Click to submit your citation</p>
    `;

    // Click handler: store group and redirect
    card.addEventListener('click', () => {
        localStorage.setItem("selectedGroup", group);
        window.location.href = "http://127.0.0.1:8000/group-form";
    });

    container.appendChild(card);
});

// Re-render icons
feather.replace();
</script>

</body>
</html>
