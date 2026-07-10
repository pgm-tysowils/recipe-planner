<x-layouts::app.sidebar :title="$title ?? null">
    <?php
    // Redirect to login if not authenticated
    // if the user isn't an admin, redirect to home
        if (!Auth::check()) {
            header('Location: ' . route('login'));
            exit;
        } elseif (!Auth::user()->is_admin) {
            header('Location: ' . route('home'));
            exit;
        }
    ?>
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts::app.sidebar>
