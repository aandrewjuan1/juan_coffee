<?php
require_once base_path('app/Models/Product.php');

class ProductController {

    public function index() {
        $productModel = new Product();
        try {
            $products = $productModel->index();
        } catch (Exception $e) {
            Session::flash('error', 'Failed to retrieve products.');
            redirect('/error');
        }
        return view('products/index.view.php', ['products' => $products]);
    }

    public function create() {
        $productModel = new Product();
        try {
            $categories = $productModel->getCategories();
        } catch (Exception $e) {
            Session::flash('error', 'Failed to retrieve categories.');
            redirect('/error');
        }
        return view('products/create.view.php', ['categories' => $categories]);
    }

    public function store() {
        $formData = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'category_id' => $_POST['category_id'],
            'user_id' => $_SESSION['user_id'],  // Assuming the logged-in user's ID is in the session
        ];

        // ... existing validation and error handling

        $productModel = new Product();
        try {
            $productModel->add($formData);
            Session::flash('success', 'Product created successfully.');
        } catch (Exception $e) {
            Session::flash('error', 'Failed to create product.');
        }
        redirect('/juan_coffee/products');
    }

    public function update() {
        $id = $_POST['id'];
        $formData = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'category_id' => $_POST['category_id'],
            'user_id' => $_SESSION['user_id'],  // Assuming the logged-in user's ID is in the session
        ];

        $errors = $this->validate($formData);
        if (!empty($errors)) {
            Session::flash('errors', $errors);
            redirect("/juan_coffee/products/edit?id=$id");
        }

        $productModel = new Product();
        try {
            $productModel->update($id, $formData);
            Session::flash('success', 'Product updated successfully.');
        } catch (Exception $e) {
            Session::flash('error', 'Failed to update product.');
        }
        redirect('/juan_coffee/products');
    }
    
    public function edit() {
        $id = $_GET['id'];
        $productModel = new Product();
        try {
            $product = $productModel->find($id);
            $categories = $productModel->getCategories();
        } catch (Exception $e) {
            Session::flash('error', 'Failed to retrieve product or categories.');
            redirect('/error');
        }
        return view('products/edit.view.php', ['product' => $product, 'categories' => $categories]);
    }


    public function delete() {
        $id = $_POST['id'];
        $productModel = new Product();
        try {
            $productModel->delete($id);
            Session::flash('success', 'Product deleted successfully.');
        } catch (Exception $e) {
            Session::flash('error', 'Failed to delete product.');
        }
        redirect('/juan_coffee/products');
    }

    private function validate($data) {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Name is required.';
        }

        if (empty($data['description'])) {
            $errors['description'] = 'Description is required.';
        }

        if (empty($data['price']) || !is_numeric($data['price'])) {
            $errors['price'] = 'Price is required and must be a number.';
        }

        if (empty($data['category_id'])) {
            $errors['category_id'] = 'Category is required.';
        }

        return $errors;
    }
}
?>
