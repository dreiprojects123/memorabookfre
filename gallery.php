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
  transform: translateY(-0.5px);
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

.input-group-text {
  background-color: var(--primary-color);
  color: white;
  border: none;
}
</style>

<header class="masthead d-flex align-items-center">
    <div class="container">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Year Book</h3>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>

<div class="container search-container">
  <div class="row">
    <div class="col-md-9">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
        </div>
        <input type="text" class="form-control" id="filter" placeholder="Search by Name, Memories or date" aria-label="Filter" aria-describedby="filter-field">
      </div>
    </div>
    <div class="col-md-3">
      <button class="btn btn-primary btn-block" id="search">Search</button>
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <?php
    $ci = 0;
    $img = array();
    $fpath = 'admin/assets/uploads/gallery';
    $files = is_dir($fpath) ? scandir($fpath) : array();
    foreach($files as $val){
        if(!in_array($val, array('.', '..'))){
            $n = explode('_', $val);
            $img[$n[0]] = $val;
        }
    }
    $gallery = $conn->query("SELECT * from gallery order by id desc");
    while($row = $gallery->fetch_assoc()):
    ?>
    <div class="col-md-4">
      <div class="card gallery-list" data-id="<?php echo $row['id'] ?>">
        <div class="gallery-img">
          <img src="<?php echo isset($img[$row['id']]) && is_file($fpath.'/'.$img[$row['id']]) ? $fpath.'/'.$img[$row['id']] : '' ?>" alt="Graduation Photo">
        </div>
        <div class="card-body">
          <span class="truncate" data-about="<?php echo strtolower($row['about']) ?>"><small><?php echo ucwords($row['about']) ?></small></span>

        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<script>
  $('.gallery-img img').click(function() {
    viewer_modal($(this).attr('src'));
  });

  $('.book-gallery').click(function() {
    uni_modal("Submit Booking Request", "booking.php?gallery_id=" + $(this).attr('data-id'));
  });

  $('.gallery-img img').click(function() {
    viewer_modal($(this).attr('src'));
  });

  // Booking
  $('.book-gallery').click(function() {
    uni_modal("Submit Booking Request", "booking.php?gallery_id=" + $(this).attr('data-id'));
  });

  // Search filter function
  function filterGallery() {
    let query = $('#filter').val().toLowerCase();
    $('.card.gallery-list').each(function() {
      let aboutText = $(this).find('.truncate').data('about').toLowerCase();
      if (aboutText.includes(query)) {
        $(this).parent().show();
      } else {
        $(this).parent().hide();
      }
    });
  }

  // Trigger search on input change or button click
  $('#filter').on('input', filterGallery);
  $('#search').on('click', filterGallery);
</script>
