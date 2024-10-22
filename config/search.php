<?php
// Check if the search query exists
if (isset($_GET['query'])) {
    $search_query = $_GET['query'];

    // Secure the query to prevent SQL injection
    $search_query = mysqli_real_escape_string($conn, $search_query);

    // Query the database to search for products that match the search term
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_query%' OR description LIKE '%$search_query%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Search Results for '$search_query':</h2>";
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . $row['product_name'] . " - " . $row['description'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No products found for '$search_query'.";
    }
} else {
    //echo "Please enter a search term.";
}