# Online Bookstore - PHP Coursework 1

## Project Description

A simple online bookstore application built with PHP demonstrating fundamental web development concepts:
- Arrays and associative arrays for data management
- Functions with pass-by-reference parameters
- Conditionals and loops for logic control
- Form handling with POST requests
- Input validation and error handling
- Server information and logging
- Date/time functions
- File I/O operations

## Features

- **Book Inventory**: Books stored in associative arrays with title, author, genre, and price
- **Automatic Discounts**: 10% discount for Science Fiction books
- **Add New Books**: Form to add books to the inventory
- **Input Validation**: Validates required fields and numeric prices
- **Total Price**: Calculates total after applying discounts
- **Server Info**: Displays request time, IP address, and user agent
- **Activity Logging**: Records all new book additions to a log file
- **Simple UI**: Clean, minimal HTML table with basic styling

## File Structure

```
php-coursework1-bookstore/
├── index.php                 # Main application
├── style.css                 # Basic styling
├── bookstore_log.txt         # Activity log (auto-created)
├── nonrepudiation_essay.md   # Nonrepudiation essay
└── README.md                 # This file
```

## How to Run

### Prerequisites
- PHP 7.0+ installed
- Local web server (Apache, AMPPS, XAMPP, or similar)

### Setup

1. Place files in web server directory:
   - AMPPS: `C:\Program Files\Ampps\www\php-coursework1-bookstore\`
   - XAMPP: `C:\xampp\htdocs\php-coursework1-bookstore\`

2. Open in browser:
   ```
   http://localhost/php-coursework1-bookstore/index.php
   ```

3. **Test the application**:
   - View default books in inventory
   - Science Fiction books show -10% discount
   - Add new books using the form
   - Log file records all additions

## Inventory

Default books:
- **Dune** by Frank Herbert (Science Fiction) - $29.99 → $26.99
- **Dorian Gray** by Oscar Wilde (Drama) - $24.99
- **Little Prince** by Antoine de Saint-Exupéry (Fantasy) - $19.99
- **Origin** by Dan Brown (Thriller) - $18.99

## How It Works

### Discount Function
The `applyDiscounts()` function uses pass-by-reference to modify the original array:
- Iterates through all books
- Applies 10% discount to Science Fiction titles
- Flags discounted items in the UI

### Form Submission & Validation
When adding a new book:
1. Validate form inputs (no empty fields, valid price)
2. Add book to array
3. Reapply discounts
4. Log the addition to `bookstore_log.txt`

### Log Format
```
[2026-02-25 14:30:45] IP: 127.0.0.1 | UA: Mozilla/5.0... | Added book: "New Title" (Genre, $19.99)
```
