<?php require base_path('app/views/head.php') ?>

<div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Add a Product</h2>

    <!-- Display any session messages -->
    <?php if (Session::has('errors')): ?>
        <div class="mb-4">
            <ul class="text-red-600">
                <?php foreach (Session::get('errors') as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if (Session::has('success')): ?>
        <div class="mb-4 text-green-600">
            <?= htmlspecialchars(Session::get('success')) ?>
        </div>
    <?php endif; ?>

    <form action="/juan_coffee/products/store" method="POST" class="space-y-4">
        <!-- Product Name Field -->
        <div>
            <label for="name" class="block text-lg font-medium text-gray-700">Product Name:</label>
            <input type="text" id="name" name="name" required
                   class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Description Field -->
        <div>
            <label for="description" class="block text-lg font-medium text-gray-700">Description:</label>
            <textarea id="description" name="description" rows="5" required
                      class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <!-- Price Field -->
        <div>
            <label for="price" class="block text-lg font-medium text-gray-700">Price:</label>
            <input type="number" id="price" name="price" required
                   class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Category Dropdown -->
        <div>
            <label for="category" class="block text-lg font-medium text-gray-700">Category:</label>
            <select id="category" name="category_id" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Select a Category --</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= htmlspecialchars($category['id']) ?>">
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Back and Submit Buttons -->
        <div class="flex justify-center space-x-4 mt-6">
            <div class="text-center">
                <a href="/juan_coffee/products">
                    <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full transition-all duration-300">
                        Back to Products
                    </button>
                </a>
            </div>
            <div class="text-center">
                <input type="submit" name="addProduct" value="Submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition-all duration-300">
            </div>
        </div>
    </form>
</div>

<?php require base_path('app/views/footer.php') ?>
