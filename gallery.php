<?php 
include 'admin/db_connect.php'; 
?>
<style>
:root {
  --primary-color: #2980b9;
  --secondary-color: #3498db;
  --accent-color: #f39c12;
  --text-color: #333;
  --light-bg: #f8f9fa;
  --card-shadow: 0 4px 6px rgba(0,0,0,0.1);
  --card-radius: 12px;
  --section-padding: 3rem 0;
}

body {
  background-color: var(--light-bg);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: var(--text-color);
}

header.masthead {
  background: var(--primary-color);
  color: white;
  min-height: 50vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.search-container {
  background-color: #fff;
  border-radius: var(--card-radius);
  box-shadow: var(--card-shadow);
  padding: 2rem;
  margin-top: -3rem;
  position: relative;
  z-index: 10;
}

.card.gallery-list {
  background-color: #fff;
  border: none;
  border-radius: var(--card-radius);
  box-shadow: var(--card-shadow);
  margin-bottom: 2rem;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
  height: 370px;
}

.card.gallery-list:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}

.card.batch-card {
  background-color: #fff;
  border: none;
  border-radius: var(--card-radius);
  box-shadow: var(--card-shadow);
  margin-bottom: 2rem;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
  height: 250px; /* Increased height to accommodate image */
  position: relative;
}

.card.batch-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}

.batch-cover-image {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-top-left-radius: var(--card-radius);
  border-top-right-radius: var(--card-radius);
}

.batch-info {
  padding: 1rem;
  text-align: center;
  height: 100px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.batch-year {
  font-size: 1.5rem;
  font-weight: bold;
  color: var(--primary-color);
  margin-bottom: 0.5rem;
}

.batch-count {
  font-size: 0.9rem;
  color: #666;
}

/* Fallback styling for batches without cover images */
.batch-card.no-cover {
  height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.batch-card.no-cover:hover {
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  color: white;
}

.batch-card.no-cover:hover .batch-year {
  color: white;
}

.batch-card.no-cover:hover .batch-count {
  color: rgba(255,255,255,0.9);
}

.batch-card.no-cover .batch-year {
  font-size: 2.5rem;
}

.gallery-img img {
  width: 100%;
  height: 300px;
  object-fit: cover;
  border-top-left-radius: var(--card-radius);
  border-top-right-radius: var(--card-radius);
}

.card-body {
  padding: 1rem;
  text-align: center;
}

.truncate {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

.btn-primary {
  background-color: var(--primary-color);
  border-color: var(--primary-color);
}

.btn-primary:hover {
  background-color: var(--secondary-color);
  border-color: var(--secondary-color);
}

.btn-secondary {
  background-color: #6c757d;
  border-color: #6c757d;
}

.input-group-text {
  background-color: var(--primary-color);
  color: white;
  border: none;
}

.breadcrumb {
  background-color: transparent;
  padding: 0;
  margin-bottom: 2rem;
}

.breadcrumb-item a {
  color: var(--primary-color);
  text-decoration: none;
}

.breadcrumb-item a:hover {
  text-decoration: underline;
}

.breadcrumb-item.active {
  color: #6c757d;
}

#batch-selection {
  display: block;
}

#gallery-view {
  display: none;
}
</style>

<br><br><br><br><br>

<!-- Batch Selection View -->
<div id="batch-selection">
  <div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <h4 class="text-center mb-4"><strong>Through the Years – MemoraBook Gallery</strong></h4>
      </div>
    </div>
<div class="row">
      <?php
      $batch_query = $conn->query("
          SELECT id, year, img AS batch_cover 
          FROM batch 
          ORDER BY year DESC
      ");

      while ($batch_row = $batch_query->fetch_assoc()):
          $cover_path = 'Admin/assets/uploads/batch/' . $batch_row['batch_cover'];
          $cover_img = is_file($cover_path) ? $cover_path : 'assets/images/no-image.png';
      ?>
        <div class="col-md-4 col-lg-3 mb-4">
          <div class="card text-white shadow batch-card"
              data-batch-id="<?php echo $batch_row['id'] ?>"
              data-batch-year="<?php echo $batch_row['year'] ?>"
              style="
                background: url('<?php echo $cover_img ?>') center center / cover no-repeat;
                min-height: 200px;
                border-radius: 10px;
                overflow: hidden;
                position: relative;
              ">
            <div class="card-body d-flex flex-column justify-content-end">
              <h5 class="batch-year mb-1 font-weight-bold">Batch <?php echo $batch_row['year'] ?></h5>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>



  </div>
</div>

<!-- Gallery View (Initially Hidden) -->
<div id="gallery-view">
  <div class="container search-container">
    <div class="row">
      <div class="col-12 mb-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" id="back-to-batches">Gallery</a></li>
            <li class="breadcrumb-item active" aria-current="page" id="current-batch">Batch Year</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
          </div>
          <input type="text" class="form-control" id="filter" placeholder="Search by Name, Memories or description" aria-label="Filter" aria-describedby="filter-field">
        </div>
      </div>
      <div class="col-md-3">
        <button class="btn btn-primary btn-block" id="search">Search</button>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row" id="gallery-container">
      <!-- Gallery images will be loaded here dynamically -->
    </div>
    
    <!-- No results message -->
    <div class="row" id="no-results" style="display: none;">
      <div class="col-12 text-center">
        <div class="alert alert-info">
          <h5>No photos found</h5>
          <p>There are no photos available for the selected batch or search criteria.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Handle batch selection
$(document).on('click', '.batch-card', function() {
  var batchId = $(this).data('batch-id');
  var batchYear = $(this).data('batch-year');
  
  // Update breadcrumb
  $('#current-batch').text('Batch ' + batchYear);
  
  // Hide batch selection and show gallery view
  $('#batch-selection').hide();
  $('#gallery-view').show();
  
  // Load gallery for selected batch
  loadGallery(batchId, batchYear);
});

// Handle back to batches
$(document).on('click', '#back-to-batches', function(e) {
  e.preventDefault();
  $('#gallery-view').hide();
  $('#batch-selection').show();
  $('#filter').val(''); // Clear search
});

// Function to load gallery for specific batch
function loadGallery(batchId, batchYear) {
  $.ajax({
    url: 'load_batch_gallery.php',
    method: 'POST',
    data: { batch_id: batchId },
    success: function(response) {
      $('#gallery-container').html(response);
      
      // Check if any results were returned
      if ($('#gallery-container .gallery-list').length === 0) {
        $('#no-results').show();
      } else {
        $('#no-results').hide();
      }
    },
    error: function() {
      $('#gallery-container').html('<div class="col-12"><div class="alert alert-danger">Error loading gallery. Please try again.</div></div>');
    }
  });
}

// Image click handler (will be applied to dynamically loaded content)
$(document).on('click', '.gallery-img img', function() {
  viewer_modal($(this).attr('src'));
});

// Search filter function
function filterGallery() {
  let query = $('#filter').val().toLowerCase();
  $('.card.gallery-list').each(function() {
    let aboutText = $(this).find('.truncate').data('about') ? $(this).find('.truncate').data('about').toLowerCase() : '';
    let eventText = $(this).find('.event').text() ? $(this).find('.event').text().toLowerCase() : '';
    let titleText = $(this).find('.image-title').text() ? $(this).find('.image-title').text().toLowerCase() : '';
    let captionText = $(this).find('.image-caption').text() ? $(this).find('.image-caption').text().toLowerCase() : '';
    
    if (aboutText.includes(query) || eventText.includes(query) || titleText.includes(query) || captionText.includes(query)) {
      $(this).parent().show();
    } else {
      $(this).parent().hide();
    }
  });
  
  // Check if any results are visible after filtering
  let visibleResults = $('.card.gallery-list:visible').length;
  if (visibleResults === 0 && query !== '') {
    $('#no-results').show();
  } else {
    $('#no-results').hide();
  }
}

// Trigger search on input change or button click
$('#filter').on('input', filterGallery);
$('#search').on('click', filterGallery);
</script>