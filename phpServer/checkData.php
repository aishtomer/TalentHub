<?php
    require 'conn.php';

    $isLoadMoreSearchData = $_GET['isLoadMoreSearchData'] ?? false;
    $num_rows_loaded = $_GET['num_rows_loaded'] ?? 10;
    $searchData = $_GET['searchData'] ?? '';
    
    if($isLoadMoreSearchData){
        $total_rows = $conn->query("SELECT COUNT(*) FROM userDetails WHERE job_position LIKE '%$searchData%'")->fetch_row()[0];
    }else{
        $total_rows = $conn->query("SELECT COUNT(*) FROM userDetails")->fetch_row()[0];
    }
    
    // Check if there is no more data
    if ($num_rows_loaded >= $total_rows) {
        echo '<div>No More Data!</div>';
    }else if($num_rows_loaded < $total_rows){
        echo '<div class="spinner"></div>';
    }
?>

<style>
    .spinner {
        width: 30px;
        height: 30px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>