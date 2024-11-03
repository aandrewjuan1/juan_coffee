<?php require base_path('app/views/head.php') ?>

<div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Product</h2>
    
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

    <form action="/juan_coffee/products/update" method="POST">
        <!-- Simulate the PUT method -->
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Product Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
            <textarea id="description" name="description" rows="5" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-bold mb-2">Price:</label>
            <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-bold mb-2">Category:</label>
            <select id="category" name="category_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= htmlspecialchars($category['id']) ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="flex justify-center space-x-4 mt-6">
            <div class="mb-4">
                <a href="/juan_coffee/products">
                    <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full transition-all duration-300">
                        Cancel
                    </button>
                </a>
            </div>
            <div class="text-center">
                <input type="submit" name="updateProduct" value="Update Product" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition-all duration-300">
            </div>
        </div>
    </form>
</div>

<?php require base_path('app/views/footer.php') ?>
