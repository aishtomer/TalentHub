<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <script src="https://kit.fontawesome.com/06f85f1f52.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Lexend+Deca:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/phpServer/public/styles/Home-page.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <?php 
    require 'header.php';
  ?>
  <body>
    <div class="container">
      <div class="row">
        <div class="search-lists">
          <h2>Newly Added</h2>
          <form action="" method="post">
            <input type="text" class="form-control" id="search-input" placeholder="&#xf002 Search">
          </form>
        </div>
        <div id="card-container"><?php require 'get-more-data.php';?><!--data will display here--></div>
        <div class="loading"><?php require 'checkData.php';?></div>
      </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </div>

  </body>   
</html>

<style>
    .loading {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 100%;
    }
</style>

<script>
    let page = 2;
    let loading = false;
    var num_rows_loaded;
    let isSearchData = false;
    var query;
    
    function loadMoreData(isRefreeshDataFromSearch = false, isLoadMoreSearchData = false, searchData = '') {
      if (loading) {
        return;
      }
      loading = true;
      
      $.ajax({
        url: 'get-more-data.php',
        type: 'GET',
        data: {page: page, isLoadMoreSearchData:isLoadMoreSearchData, searchData:searchData, num_rows_loaded:num_rows_loaded},
        success: function(response) {
            if(isRefreeshDataFromSearch){
               $('#card-container').empty().append(response);
            }else{
                $('#card-container').append(response);
            }
          page++;
          loading = false;
        },
        error: function(xhr, status, error) {
          console.error(error);
          loading = false;
        }
      }); 
      loader(isLoadMoreSearchData, searchData);
        
    }
    
    
    function loader(isLoadMoreSearchData, searchData){
      $.ajax({
        url: 'checkData.php',
        type: 'GET',
        data: {num_rows_loaded: num_rows_loaded, isLoadMoreSearchData:isLoadMoreSearchData, searchData:searchData},
        success: function(response) {
          $('.loading').empty().append(response);
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });          
    }
  
  
    
    $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
          if(isSearchData){
            loadMoreData(undefined, true, query);
          }else{
            loadMoreData();
          }
      }
    });
    
    // loadMoreData(); // Load the first page of data
    
    $('#search-input').on('keyup', function() {
      // Get the search query from the input
      query = $(this).val();
      // Send the query to the PHP script using AJAX
      if(query.trim() === ''){
          page = 1;
          loadMoreData(true);
          isSearchData = false;
      } else {
          search(query);
          isSearchData = true;
      }
      

    });
    
    function search(query) {
      num_rows_loaded = 0;
      $.ajax({
        url: 'search.php',
        type: 'GET',
        data: { query: query, num_rows_loaded:num_rows_loaded },
        success: function(response) {
          // Update the search results container with the returned data
          $('#card-container').empty().append(response);
          if(num_rows_loaded <= 10){
              loader(true, query);
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    }
</script>