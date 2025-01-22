## **Folder Structure**

```php
project/
├── public/                     # Public directory (entry point for the app)
│   ├── index.php               # Main frontend file
│   └── api/                    # API routes
│       └── index.php           # Entry point for the API
├── app/                        # Backend logic
│   ├── Controllers/            # Controllers
│   │   └── ProductController.php
│   ├── Models/                 # Models
│   │   └── Product.php
│   ├── Core/                   # Core system (e.g., Router, DB)
│   │   ├── Router.php
│   │   ├── Database.php
│   │   └── Response.php
│   └── config/                 # Configuration files
│       └── config.php
├── assets/                     # Frontend assets
│   ├── css/                    # Stylesheets
│   │   └── styles.css
│   ├── js/                     # JavaScript files
│   │   └── app.js
└── vendor/                     # Composer dependencies (optional)

```

---

## **Step-by-Step Implementation**

### **1. Backend API**

### **a. API Entry Point**

`public/api/index.php`

The API routes all requests to the appropriate controller methods.

```php
<?php
// public/api/index.php

require_once '../../app/Core/Router.php';
require_once '../../app/Core/Database.php';

use App\Core\Router;

$router = new Router();

// Define routes
$router->get('/products', 'ProductController@index');
$router->post('/products', 'ProductController@store');
$router->put('/products/{id}', 'ProductController@update');
$router->delete('/products/{id}', 'ProductController@destroy');

// Resolve the route
$router->resolve();

```

---

### **b. Backend Configuration**

`app/config/config.php`

```php
<?php
return [
    'host' => 'localhost',
    'database' => 'fullstack_app',
    'username' => 'root',
    'password' => '',
];

```

---

### **c. Database Connection**

`app/Core/Database.php`

```php
<?php
namespace App\Core;

use PDO;

class Database {
    private static $instance;

    public static function connect() {
        if (!self::$instance) {
            $config = require '../app/config/config.php';
            self::$instance = new PDO(
                "mysql:host={$config['host']};dbname={$config['database']}",
                $config['username'],
                $config['password']
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}

```

---

### **d. Product Model**

`app/Models/Product.php`

```php
<?php
namespace App\Models;

use App\Core\Database;

class Product {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO products (name, price) VALUES (:name, :price)");
        return $stmt->execute([
            'name' => $data['name'],
            'price' => $data['price'],
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE products SET name = :name, price = :price WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'price' => $data['price'],
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}

```

---

### **e. Product Controller**

`app/Controllers/ProductController.php`

```php
php
CopyEdit
<?php
namespace App\Controllers;

use App\Models\Product;

class ProductController {
    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    public function index() {
        echo json_encode($this->product->getAll());
    }

    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->product->create($data);
        echo json_encode(['message' => 'Product created']);
    }

    public function update($params) {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->product->update($params['id'], $data);
        echo json_encode(['message' => 'Product updated']);
    }

    public function destroy($params) {
        $this->product->delete($params['id']);
        echo json_encode(['message' => 'Product deleted']);
    }
}

```

---

### **2. Frontend**

### **a. HTML Page**

`public/index.php`

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fullstack App</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Products</h1>
    <div id="product-list"></div>

    <h2>Add Product</h2>
    <form id="add-product-form">
        <input type="text" id="name" placeholder="Product Name" required>
        <input type="number" id="price" placeholder="Price" required>
        <button type="submit">Add</button>
    </form>

    <script src="../assets/js/app.js"></script>
</body>
</html>

```

---

### **b. JavaScript for Fetching Data**

`assets/js/app.js`

```jsx
const apiBase = 'http://localhost/public/api';

async function fetchProducts() {
    const response = await fetch(`${apiBase}/products`);
    const products = await response.json();
    const productList = document.getElementById('product-list');
    productList.innerHTML = products.map(
        (product) => `<div>${product.name} - $${product.price}</div>`
    ).join('');
}

document.getElementById('add-product-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const price = document.getElementById('price').value;

    await fetch(`${apiBase}/products`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, price }),
    });

    fetchProducts();
});

fetchProducts();

```

---

## **How It Works**

1. **Frontend**: The browser sends requests to the backend API using JavaScript (via `fetch`).
2. **Backend API**:
    - Handles the request via routes defined in the `Router.php`.
    - Delegates to the appropriate controller.
    - Interacts with the database via models.
3. **Database**: Stores and retrieves the data.
4. **Response**: The backend returns JSON, which the frontend parses and displays.

---

## **Features**

- **RESTful API**: All CRUD operations are defined (`GET`, `POST`, `PUT`, `DELETE`).
- **Dynamic Frontend**: Fetch and display data dynamically using JavaScript.
- **Scalable**: Add more features (e.g., authentication, search, etc.) easily.
