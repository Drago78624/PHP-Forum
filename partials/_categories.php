<?php 
    $categoryFetchSql = "SELECT * FROM `categories`";
    $categoryFetchResult = mysqli_query($conn, $categoryFetchSql);
    $categories = mysqli_fetch_all($categoryFetchResult, MYSQLI_ASSOC);
?>