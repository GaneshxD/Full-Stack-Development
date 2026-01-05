<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="min-h-screen bg-slate-50 text-slate-900">
        <div class="max-w-5xl mx-auto px-4 py-10">
            <header class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight">@yield('title')</h1>
                    @hasSection('subtitle')
                        <p class="text-sm text-slate-500">@yield('subtitle')</p>
                    @endif
                </div>
                <div class="flex gap-2">@yield('header-actions')</div>
            </header>

            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
                @yield('content')
            </section>
        </div>
    </main>
</body>
</html>