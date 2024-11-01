<?php require base_path('app/views/head.php') ?>

<main>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Register</h2>
            </div>

            <form class="mt-8 space-y-6" action="/juan_coffee/register" method="POST">
                <div class="-space-y-px rounded-md shadow-sm">
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email"
                               name="email"
                               type="email"
                               autocomplete="email"
                               required
                               class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Email address">
                        <?php if (Session::has('errors') && isset(Session::get('errors')['email'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= Session::get('errors')['email'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password"
                               name="password"
                               type="password"
                               autocomplete="current-password"
                               required
                               class="relative block w-full appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Password">
                        <?php if (Session::has('errors') && isset(Session::get('errors')['password'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= Session::get('errors')['password'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Repeat Password Field -->
                    <div>
                        <label for="password_confirmation" class="sr-only">Repeat Password</label>
                        <input id="password_confirmation"
                               name="password_confirmation"
                               type="password"
                               autocomplete="current-password"
                               required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Repeat Password">
                        <?php if (Session::has('errors') && isset(Session::get('errors')['password_confirmation'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= Session::get('errors')['password_confirmation'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Register
                    </button>
                    <a href="/juan_coffee/login" class="text-blue flex justify-center underline mt-4">
                        Log In
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require base_path('app/views/footer.php') ?>
