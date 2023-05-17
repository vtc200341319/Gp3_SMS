<?php
$query = $_GET['query'];

function searchFiles($dir, $query) {
  $results = [];
  $files = scandir($dir);

  foreach ($files as $file) {
    if ($file === '.' || $file === '..') {
      continue;
    }

    $path = $dir . '/' . $file;

    if (is_dir($path)) {
      $results = array_merge($results, searchFiles($path, $query));
    } else {
      if (strpos(strtolower($file), strtolower($query)) !== false) {
        $results[] = $path;
      }
    }
  }

  return $results;
}

$baseDir = __DIR__;

$searchResults = searchFiles($baseDir, $query);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Search Results</title>
</head>
<body>
  <h1>Search Results</h1>

  <?php if (!empty($searchResults)): ?>
    <ul>
      <?php foreach ($searchResults as $result): ?>
        <li><a href="<?php echo $result; ?>"><?php echo $result; ?></a></li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>No results found.</p>
  <?php endif; ?>
</body>
<script src="search.js"></script>

</html>
