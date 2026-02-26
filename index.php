<?php


// 1. BOOK INVENTORY (Arrays)
$books = [
    [
        'title' => 'Dune',
        'author' => 'Frank Herbert',
        'genre' => 'Science Fiction',
        'price' => 29.99
    ],
    [
        'title' => 'Dorian Gray',
        'author' => 'Oscar Wilde',
        'genre' => 'Drama',
        'price' => 24.99
    ],
    [
        'title' => 'Little Prince',
        'author' => 'Antoine de Saint-Exupéry',
        'genre' => 'Fantasy',
        'price' => 19.99
    ],
    [
        'title' => 'Origin',
        'author' => 'Dan Brown',
        'genre' => 'Thriller',
        'price' => 18.99
    ]
];

// 2. DISCOUNT LOGIC FUNCTION (Pass-by-Reference)
function applyDiscounts(array &$books) {
    foreach ($books as &$book) {
        if ($book['genre'] === 'Science Fiction') {
            $book['original_price'] = $book['price'];
            $book['price'] = $book['price'] * 0.9; // 10% discount
            $book['discounted'] = true;
        } else {
            $book['original_price'] = $book['price'];
            $book['discounted'] = false;
        }
    }
}

// 3. USER INPUT HANDLING (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic validation
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $author = isset($_POST['author']) ? trim($_POST['author']) : '';
    $genre = isset($_POST['genre']) ? trim($_POST['genre']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    
    $errors = [];
    
    if (empty($title)) {
        $errors[] = "Title is required.";
    }
    if (empty($author)) {
        $errors[] = "Author is required.";
    }
    if (empty($genre)) {
        $errors[] = "Genre is required.";
    }
    if (empty($price) || !is_numeric($price) || (float)$price <= 0) {
        $errors[] = "Price must be a positive number.";
    }
    
    if (empty($errors)) {
        // Add new book to array
        $newBook = [
            'title' => $title,
            'author' => $author,
            'genre' => $genre,
            'price' => (float)$price
        ];
        $books[] = $newBook;
        
        // Log the new book addition
        $timestamp = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $logLine = "[{$timestamp}] IP: {$ip} | UA: {$userAgent} | Added book: \"{$title}\" ({$genre}, $" . number_format((float)$price, 2) . ")\n";
        
        file_put_contents('bookstore_log.txt', $logLine, FILE_APPEND);
        
        $success_message = "Book '{$title}' added successfully!";
    }
}

// Apply discounts to all books
applyDiscounts($books);

// 4. TOTAL PRICE CALCULATION (Loop)
$totalPrice = 0;
foreach ($books as $book) {
    $totalPrice += $book['price'];
}

// 6. SERVER INFO & TIMESTAMP
$currentTime = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>📚 Online Bookstore</h1>
        
        <!-- 6. SERVER INFO & TIMESTAMP -->
        <div class="server-info">
            <p><strong>Request time:</strong> <?php echo $currentTime; ?></p>
            <p><strong>IP Address:</strong> <?php echo htmlspecialchars($ip); ?></p>
            <p><strong>User Agent:</strong> <?php echo htmlspecialchars($userAgent); ?></p>
        </div>
        
        <!-- Success/Error Messages -->
        <?php if (isset($success_message)): ?>
            <div class="success">✓ <?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="error">
                ✗ Please fix the following errors:
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <!-- 5. OUTPUT FORMATTING - BOOK LIST (HTML) -->
        <h2>Our Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Original Price</th>
                    <th>Final Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['genre']); ?></td>
                        <td>$<?php echo number_format($book['original_price'], 2); ?></td>
                        <td>
                            $<?php echo number_format($book['price'], 2); ?>
                            <?php if ($book['discounted']): ?>
                                <span class="discount-badge">-10%</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- 4. TOTAL PRICE CALCULATION -->
        <div class="total-section">
            Total Price After Discounts: <span style="color: #2e7d32;">$<?php echo number_format($totalPrice, 2); ?></span>
        </div>
        
        <!-- 3. USER INPUT HANDLING - ADD NEW BOOK FORM -->
        <div class="form-section">
            <h2>Add a New Book</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="title">Book Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" required>
                </div>
                
                <div class="form-group">
                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="genre" required>
                </div>
                
                <div class="form-group">
                    <label for="price">Price ($):</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required>
                </div>
                
                <button type="submit">Add Book</button>
            </form>
        </div>
    </div>
</body>
</html>
