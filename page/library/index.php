<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLibrary Service</title>
    <link rel="stylesheet" href="eLibrary.css">
</head>
<body>
    <header>
        <h1>eLibrary Service</h1>
    </header>
    <main>
        <form id="search-form">
            <label for="search">Search a book by title:</label>
            <input type="text" id="search" name="search">
            <button type="submit">Search</button>
        </form>
        <div id="result-container">
            <!-- Results will be displayed here -->
        </div>
    </main>
    <script src="eLibrary.js"></script>
</body>
</html>
