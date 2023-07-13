<?php
require_once '../../connectdb.php';

if (isset($_POST['add_book'])) {
    $isbn = $_POST['isbn'];
    $book_name = $_POST['book_name'];
    $book_author = $_POST['book_author'];
    $book_publish_year = $_POST['book_publish_year'];
    $book_publish_place = $_POST['book_publish_place'];
    $book_category = $_POST['book_category'];
    $book_language = $_POST['book_language'];
    $book_available_quantity = $_POST['book_available_quantity'];

    $sql = "INSERT INTO book_details (ISBN, bookName, bookAuthor, bookPublishYear, bookPublishPlace, bookCatergory, bookLanguage, bookAvailableQuatity, bookViewQuatity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$isbn, $book_name, $book_author, $book_publish_year, $book_publish_place, $book_category, $book_language, $book_available_quantity, 0]);

    header('Location: eLibrary.php');
}

$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; 
$start = ($page - 1) * $limit;
if (isset($_POST['search_book'])) {
    $search_term = $_POST['search_term'];

    $sql = "SELECT * FROM book_details WHERE bookName LIKE ? OR bookAuthor LIKE ? OR ISBN LIKE ? ORDER BY ISBN";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["%$search_term%", "%$search_term%", "%$search_term%"]);
    $books = $stmt->fetchAll();
    $total_books = count($books);
    $sql .= " LIMIT $start, $limit";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["%$search_term%", "%$search_term%", "%$search_term%"]);
    $books = $stmt->fetchAll();
} else {
    $sql = "SELECT * FROM book_details ORDER BY ISBN";
    $stmt = $pdo->query($sql);
    $books = $stmt->fetchAll();
    $total_books = count($books);
    $sql .= " LIMIT $start, $limit";
    $stmt = $pdo->query($sql);
    $books = $stmt->fetchAll();
}

$total_pages = ceil($total_books / $limit);

if (isset($_POST['borrow_book'])) {
    $book_id = $_POST['book_id'];

    $sql = "SELECT bookAvailableQuatity FROM book_details WHERE bookID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$book_id]);
    $row = $stmt->fetch();

    if ($row['bookAvailableQuatity'] > 0) {
        $sql = "UPDATE book_details SET bookAvailableQuatity = bookAvailableQuatity - 1, bookViewQuatity = bookViewQuatity + 1 WHERE bookID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$book_id]);

        $borrower_name = $_POST['borrower_name'];
        $borrower_email = $_POST['borrower_email'];
        $borrow_date = date('Y-m-d');

        $sql = "INSERT INTO bookborrow (bookID, borrowerName, borrowerEmail, borrowDate) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$book_id, $borrower_name, $borrower_email, $borrow_date]);

        header('Location: eLibrary.php');
    } else {
        $error_message = 'This book is not available for borrowing.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>eLibrary</title>
        <link href="../../css/eLibrary.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </head>
    <body>

        <header>
            <h1>eLibrary</h1>
        </header>

        <main>
            <button type="button" class="show-add-book">Add a new book</button>
            <button type="button" class="show-search-book">Search for a book</button>


            <div class="add-book-section">
                <section id="add-book">
                    <h2>Add a new book</h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <label for="isbn">ISBN:</label>
                        <input type="text" name="isbn" required>

                        <label for="book_name">Book name:</label>
                        <input type="text" name="book_name" required>

                        <label for="book_author">Author:</label>
                        <input type="text" name="book_author" required>

                        <label for="book_publish_year">Publish year:</label>
                        <input type="number" name="book_publish_year" required>

                        <label for="book_publish_place">Publish place:</label>
                        <input type="text" name="book_publish_place" required>

                        <label for="book_category">Category:</label>
                        <input type="text" name="book_category" required>

                        <label for="book_language">Language:</label>
                        <input type="text" name="book_language" required>

                        <label for="book_available_quantity">Available quantity:</label>
                        <input type="number" name="book_available_quantity" required>

                        <button type="submit" name="add_book">Add book</button>
                    </form>
                </section>
            </div>

            <div class="search-book-section">
                <section id="search-book">
                    <h2>Search for a Book</h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <label for="search_term">Search Term:</label>
                            <input type="text" class="form-control" id="search_term" name="search_term" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="search_book">Search</button>
                    </form>
                </section>

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Books</h2>
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><a href="#" class="sort-link" data-sort="ISBN">ISBN</a></th>
                                <th><a href="#" class="sort-link" data-sort="bookName">Name</a></th>
                                <th><a href="#" class="sort-link" data-sort="bookAuthor">Author</a></th>
                                <th><a href="#" class="sort-link" data-sort="bookPublishYear">Publish Year</a></th>
                                <th><a href="#" class="sort-link" data-sort="bookPublishPlace">Publish Place</a></th>
                                <th><a href="#" class="sort-link" data-sort="bookCatergory">Category</a></th>
                                <th><a href="#" class="sort-link" data-sort="bookLanguage">Language</a></th>
                                <th><a href="#" class="sort-link" data-sort="bookAvailableQuatity">Available Quantity</a></th>
                                <th><a href="#" class="sort-link" data-sort="bookViewQuatity">View Quantity</a></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $book): ?>
                                <tr>
                                    <td data-column="ISBN"><?php echo $book['ISBN']; ?></td>
                                    <td data-column="bookName"><?php echo $book['bookName']; ?></td>
                                    <td data-column="bookAuthor"><?php echo $book['bookAuthor']; ?></td>
                                    <td data-column="bookPublishYear"><?php echo $book['bookPublishYear']; ?></td>
                                    <td data-column="bookPublishPlace"><?php echo $book['bookPublishPlace']; ?></td>
                                    <td data-column="bookCatergory"><?php echo $book['bookCatergory']; ?></td>
                                    <td data-column="bookLanguage"><?php echo $book['bookLanguage']; ?></td>
                                    <td data-column="bookAvailableQuatity"><?php echo $book['bookAvailableQuatity']; ?></td>
                                    <td data-column="bookViewQuatity"><?php echo $book['bookViewQuatity']; ?></td>
                                    <td>
                                        <?php if ($book['bookAvailableQuatity'] > 0): ?>
                                            <button type="button" class="btn btn-primary btn-sm borrow-book" data-toggle="modal" data-target="#borrowModal" data-book-id="<?php echo $book['bookID']; ?>" data-book-name="<?php echo $book['bookName']; ?>">Borrow</button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Borrow</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="borrowModal" tabindex="-1" role="dialog" aria-labelledby="borrowModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="borrowModalLabel">Borrow Book</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>You are about to borrow <span id="book-name"></span>. Please fill out the following information:</p>
                                <?php if (isset($error_message)): ?>
                                    <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
                                <?php endif; ?>
                                <form action="eLibrary.php" method="POST">
                                    <input type="hidden" id="book_id" name="book_id">
                                    <div class="form-group">
                                        <label for="borrower_name">Your name:</label>
                                        <input type="text" class="form-control" id="borrower_name" name="borrower_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="borrower_email">Your email:</label>
                                        <input type="email" class="form-control" id="borrower_email" name="borrower_email" required>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm borrow-book" data-toggle="modal" data-target="#borrowModal" data-book-id="<?php echo $book['bookID']; ?>" data-book-name="<?php echo $book['bookName']; ?>">Borrow</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  

            </div>

            <script src="../../js/eLibrary.js" type="text/javascript"></script>