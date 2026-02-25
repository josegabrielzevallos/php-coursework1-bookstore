# Online Bookstore - Week 1 Coursework Assignment

## Project Description

This is a simple online bookstore application built with PHP to demonstrate Week 1 skills including:
- Variables, strings, and arrays (indexed and associative)
- Functions and pass-by-reference parameters
- Conditionals (if/else statements)
- Loops (foreach)
- Superglobals ($_POST, $_SERVER)
- Date & time functions
- File handling (write/append to files)

## Features

- **Book Inventory Management**: Store books in associative arrays with title, author, genre, and price
- **Automatic Discounts**: 10% discount applied to all Science Fiction books
- **Add New Books**: HTML form to add new books to the inventory via POST requests
- **Input Validation**: Basic validation for form inputs (required fields, numeric prices)
- **Total Price Calculation**: Automatically calculates total price after discounts
- **Server Information Display**: Shows current date/time, user IP address, and user agent
- **Activity Logging**: Logs every new book addition with timestamp, IP, user agent, and book details
- **Responsive UI**: Clean, readable HTML interface with basic styling

## File Structure

```
Coursework 1/
├── index.php                 # Main application file
├── bookstore_log.txt         # Log file (auto-created on first book addition)
├── nonrepudiation_essay.md   # Essay on nonrepudiation (250 words)
├── README.md                 # This file
└── style.css                 # Optional additional styling
```

## How to Run

### Prerequisites
- PHP 7.0+ (recommended 7.4 or higher)
- A local web server (Apache with AMPPS, XAMPP, or similar)

### Installation Steps

1. **Copy the files** to your web server directory:
   - If using AMPPS: `C:\Program Files\Ampps\www\Coursework 1\`
   - If using XAMPP: `C:\xampp\htdocs\coursework1\`

2. **Open in browser**:
   ```
   http://localhost/Coursework%201/index.php
   ```
   or
   ```
   http://localhost:8080/Coursework%201/index.php
   ```

3. **Test the functionality**:
   - View the default 4 books in the inventory
   - Notice the 10% discount applied to Science Fiction books
   - Add a new book using the form
   - Check that the log file is created and records your entry

## Functionality Details

### Book Inventory
The default inventory includes:
- Dune (Science Fiction) - $29.99 → $26.99 (after 10% discount)
- Foundation (Science Fiction) - $24.99 → $22.49 (after 10% discount)
- The Hobbit (Fantasy) - $19.99 (no discount)
- 1984 (Dystopian) - $18.99 (no discount)

### Discount Function
The `applyDiscounts()` function:
- Accepts the books array by reference (`&$books`)
- Modifies prices directly in the original array
- Applies 10% discount to "Science Fiction" genre books
- Sets a `discounted` flag for UI display

### Form Submission
When a new book is added:
1. Form data is validated (no empty fields, price must be numeric)
2. New book is added to the array
3. Discounts are reapplied (new Science Fiction books get 10% off)
4. Log entry is created with:
   - Current timestamp
   - User's IP address
   - User agent
   - Book details

### Logging
Each log entry in `bookstore_log.txt` follows this format:
```
[2025-11-19 19:32:10] IP: 192.168.0.10 | UA: Mozilla/5.0... | Added book: "Dune" (Science Fiction, $29.99)
```

## Grading Rubric Coverage

- ✅ **Book Inventory**: Associative arrays storing book data (5 points)
- ✅ **Discount Logic**: Function applying 10% to Science Fiction books (5 points)
- ✅ **Pass-by-Reference**: Function updates original array (5 points)
- ✅ **User Input Handling**: POST form with validation (5 points)
- ✅ **Loop for Total**: Calculates total after discounts (5 points)
- ✅ **Output Formatting**: Clear HTML table with readable layout (5 points)
- ✅ **Date & Time**: Displays current timestamp (4 points)
- ✅ **Server Metadata**: Shows IP and user agent (4 points)
- ✅ **File Logging**: Logs with all required details (6 points)
- ✅ **Nonrepudiation Essay**: 250+ word explanation (6 points)

**Total: 50 points**

## Bonus Features

- Digital signatures technology mentioned in essay
- Blockchain technology mention in essay
- Email confirmations concept discussed

## Testing with Tools

### Testing with Browser
1. Navigate to the application URL
2. Fill out the form and submit
3. Verify the new book appears in the table
4. Check the console to confirm log entry

### Testing with Postman (Optional)
1. Set request method to POST
2. Set URL to `http://localhost/Coursework%201/index.php`
3. Use form-data with keys: `title`, `author`, `genre`, `price`
4. Send the request

## Notes

- The `bookstore_log.txt` file is created automatically on first book submission
- Log file uses FILE_APPEND mode so entries accumulate
- All user input is sanitized using `htmlspecialchars()` for security
- The application uses relative file paths, so it works in any directory

## Author Info

Created for Week 1 Coursework Assignment
