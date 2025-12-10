<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin Login — Dashboard</title>

  <!-- Tailwind Play CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root{
      --glass-bg: rgba(255,255,255,0.06);
      --glass-border: rgba(255,255,255,0.12);
      --accent: rgba(99,102,241,0.95);
      --accent-2: rgba(236,72,153,0.95);
      --glass-blur: 10px;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: linear-gradient(90deg, var(--accent), var(--accent-2));
      min-height: 100vh;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .glass {
      background: linear-gradient(180deg, rgba(255,255,255,0.05), rgba(255,255,255,0.03));
      border: 1px solid var(--glass-border);
      backdrop-filter: blur(var(--glass-blur));
      -webkit-backdrop-filter: blur(var(--glass-blur));
      box-shadow: 0 6px 30px rgba(2,6,23,0.4), inset 0 1px 0 rgba(255,255,255,0.05);
      border-radius: 14px;
    }

    .bubble {
      position: absolute;
      border-radius: 50%;
      filter: blur(50px);
      opacity: 0.12;
      animation: floatBubbles 15s ease-in-out infinite alternate;
      transform: translateZ(0);
    }

    @keyframes floatBubbles {
      0% { transform: translateY(0) translateX(0); }
      50% { transform: translateY(-30px) translateX(20px); }
      100% { transform: translateY(0) translateX(0); }
    }

    .input-focus:focus {
      outline: none;
      box-shadow: 0 0 0 4px rgba(99,102,241,0.12);
      border-color: rgba(99,102,241,0.9);
    }
  </style>
</head>
<body>
  <!-- Floating bubbles -->
  <div class="bubble w-72 h-72 bg-[radial-gradient(circle,_#634bf3,_#ec4899)] -top-8 -left-16"></div>
  <div class="bubble w-56 h-56 bg-[radial-gradient(circle,_#06b6d4,_#7c3aed)] right-8 bottom-24"></div>

  <div class="min-h-screen flex items-center justify-center px-6 py-12">
    <main class="relative z-10 w-full max-w-4xl glass p-1">
      <div class="grid grid-cols-1 md:grid-cols-2">
        <!-- Left: Info Panel -->
        <section class="p-10 md:p-12 hidden md:flex flex-col justify-between bg-[rgba(255,255,255,0.02)] rounded-l-lg">
          <div>
            <h3 class="text-2xl font-semibold text-white bg-gradient-to-r from-indigo-500 to-pink-500">Admin Citation Dashboard</h3>
            <p class="mt-4 text-white/70">Secure, elegant, and simple citation admin login panel. Access users, content, and settings safely.</p>
          </div>
          <footer class="text-xs text-white/50 mt-6">© {{ now()->year }} CELZ5 Citation</footer>
        </section>

        <!-- Right: Login Form -->
        <section class="p-8 md:p-12 glass rounded-r-lg">
          <div class="max-w-md mx-auto">
            <h2 class="text-lg font-semibold mb-6">Admin Sign In</h2>

            <!-- Display Laravel validation errors -->
            @if ($errors->any())
              <div class="mb-4 p-3 bg-red-600/30 text-red-100 rounded">
                <ul class="list-disc list-inside text-sm">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
              @csrf

              <div>
                <label for="email" class="text-sm font-medium text-white/80 block mb-2">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                  class="w-full p-3 rounded-lg bg-[rgba(255,255,255,0.02)] border border-[rgba(255,255,255,0.03)] text-white placeholder-white/40 input-focus"
                  placeholder="admin@company.com">
              </div>

              <div>
                <label for="password" class="text-sm font-medium text-white/80 block mb-2">Password</label>
                <input id="password" name="password" type="password" required minlength="8"
                  class="w-full p-3 rounded-lg bg-[rgba(255,255,255,0.02)] border border-[rgba(255,255,255,0.03)] text-white placeholder-white/40 input-focus"
                  placeholder="Enter password">
              </div>

              <div class="flex items-center justify-between text-white/70 text-sm">
                <label class="inline-flex items-center gap-2">
                  <input type="checkbox" name="remember" class="rounded border-white/10 text-indigo-400">
                  Remember me
                </label>
              </div>

              <button type="submit"
                class="w-full py-3 rounded-lg font-semibold text-white"
                style="background: linear-gradient(90deg,var(--accent),var(--accent-2)); box-shadow: 0 8px 30px rgba(99,102,241,0.12);">
                Sign in
              </button>
            </form>
          </div>
        </section>
      </div>
    </main>
  </div>
</body>
</html>
