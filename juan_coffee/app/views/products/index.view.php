<?php require base_path('app/views/head.php') ?>

<main class="pb-5">
    <div class="flex justify-between items-center p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Product List</h1>

        <?php if (Session::has('user')) : ?>
            <div class="flex items-center space-x-4">
                <span class="text-gray-800 font-semibold"><?= htmlspecialchars(Session::get('user')) ?></span>
                
                <!-- Logout form -->
                <form action="/juan_coffee/logout" method="POST" class="inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-4 py-2 transition-colors duration-300">
                        Logout
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="flex space-x-2">
                <a href="/juan_coffee/login" class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-4 py-2 transition-colors duration-300">
                    Login
                </a>
                <a href="/juan_coffee/register" class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-4 py-2 transition-colors duration-300">
                    Register
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="container mx-auto mt-10">
        <!-- Display success/error messages -->
        <?php if (Session::has('success')): ?>
            <div class="mb-4 text-green-600 bg-green-100 border border-green-400 rounded-lg p-3">
                <?= htmlspecialchars(Session::get('success')) ?>
            </div>
        <?php endif; ?>
        <?php if (Session::has('errors')): ?>
            <div class="mb-4 bg-red-100 border border-red-400 text-red-600 rounded-lg p-3">
                <ul>
                    <?php foreach (Session::get('errors') as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($products)) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($products as $product) : ?>
                    <div class="bg-white rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105">
                        <div class="mb-4">
                            <p class="text-lg font-semibold text-gray-800">Name: <span class="text-gray-600"><?= htmlspecialchars($product['name']) ?></span></p>
                            <p class="text-gray-700">Description: <span class="text-gray-600"><?= htmlspecialchars($product['description']) ?></span></p>
                            <p class="text-gray-700">Price: <span class="text-gray-600">$<?= number_format($product['price'], 2) ?></span></p>
                            <p class="text-gray-700">Category: <span class="text-gray-600"><?= htmlspecialchars($product['category_name']) ?></span></p>
                            <p class="text-gray-700">Created By: <span class="text-gray-600"><?= htmlspecialchars($product['creator_email']) ?></span></p>
                            <p class="text-gray-700">Updated By: <span class="text-gray-600"><?= htmlspecialchars($product['updater_email']) ?></span></p>
                            <p class="text-gray-700">Last Updated: <span class="text-gray-600"><?= htmlspecialchars($product['updated_at']) ?></span></p>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <a href="/juan_coffee/products/edit?id=<?= $product['id'] ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-4 rounded transition-all duration-300">
                                Edit
                            </a>
                            <form action="/juan_coffee/products/delete" method="POST" class="inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-4 rounded transition-all duration-300">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-500 text-center mt-6">No products found.</p>
        <?php endif; ?>

        <!-- Button to create a new product -->
        <div class="mt-8 text-center">
            <a href="/juan_coffee/products/create">
                <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition-all duration-300">
                    Create a Product
                </button>
            </a>
        </div>
    </div>
</main>

<?php require base_path('app/views/footer.php') ?>
