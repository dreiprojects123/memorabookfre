<?php 
include 'admin/db_connect.php'; 
?>
<style>
/* Base styles */
:root {
  --primary-color: #2980b9;
  --secondary-color: #3498db;
  --accent-color: #f39c12;
  --text-color: #333;
  --light-bg: #f8f9fa;
  --card-shadow: 0 4px 6px rgba(0,0,0,0.1);
  --card-radius: 8px;
  --section-padding: 3rem 0;
}

body {
  font-family: 'Roboto', 'Segoe UI', sans-serif;
  background-color: #f5f5f5;
  color: var(--text-color);
}

/* Masthead styling */
.masthead {
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  position: relative;
  overflow: hidden;
  padding: 2rem 0;
}

.masthead:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('admin/assets/uploads/banner.jpg') center center;
  background-size: cover;
  opacity: 0.15;
  z-index: 0;
}

.masthead .container-fluid {
  position: relative;
  z-index: 1;
}

.masthead h3 {
  font-weight: 700;
  letter-spacing: 1px;
  font-size: 2.2rem;
  text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
}

.divider {
  height: 3px;
  width: 80px;
  background-color: black;
  margin: 1rem auto;
  border: none;
}

/* Search section */
.search-container {
  background-color: white;
  border-radius: var(--card-radius);
  box-shadow: var(--card-shadow);
  padding: 2rem;
  margin-top: -2rem;
  position: relative;
  z-index: 10;
}

#filter {
  height: 48px;
  border-radius: 4px;
  border: 1px solid #ddd;
}

.search-btn {
  height: 48px;
  background: var(--primary-color);
  border: none;
  font-weight: 600;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  transition: all 0.3s ease;
}

.search-btn:hover {
  background: var(--secondary-color);
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Alumni cards */
.alumni-container {
  padding: var(--section-padding);
}

.item {
  margin-bottom: 2rem;
}

.alumni-list {
  cursor: pointer;
  border: none;
  border-radius: var(--card-radius);
  box-shadow: var(--card-shadow);
  overflow: hidden;
  transition: all 0.3s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
}


.alumni-header {
  background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
  padding: 1.5rem;
  text-align: center;
}

.alumni-img {
  width: 150px;
  height: 150px;
  margin: 0 auto;
  position: relative;
  border-radius: 50%;
  overflow: hidden;
  border: 4px solid white;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.alumni-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.card-body {
  padding: 1.5rem;
  flex-grow: 1;
}

.alumni-name {
  font-size: 1.4rem;
  font-weight: 700;
  color: var(--primary-color);
  margin-bottom: 0.5rem;
  text-align: center;
}

.alumni-details {
  list-style: none;
  padding: 0;
  margin: 1.5rem 0 0 0;
}

.alumni-details li {
  padding: 0.5rem 0;
  border-bottom: 1px solid #eee;
}

.alumni-details li:last-child {
  border-bottom: none;
}

.detail-label {
  font-weight: 600;
  color: #555;
  width: 100px;
  display: inline-block;
}

/* Contact section */
.contact-section {
  background-color: white;
  padding: 4rem 0;
  text-align: center;
}

.contact-section h2 {
  font-size: 2.2rem;
  margin-bottom: 2rem;
  font-weight: 700;
  color: var(--primary-color);
}

.contact-methods {
  display: flex;
  justify-content: center;
  gap: 3rem;
  margin-top: 2rem;
}

.contact-method {
  text-align: center;
}

.contact-icon {
  font-size: 2.5rem;
  color: var(--primary-color);
  margin-bottom: 1rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .alumni-img {
    width: 120px;
    height: 120px;
  }
  
  .alumni-name {
    font-size: 1.2rem;
  }
  
  .contact-methods {
    flex-direction: column;
    gap: 1.5rem;
  }
}

/* Preserve original functionality classes */
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}

span.hightlight{
    background: yellow;
}

.carousel,.carousel-inner,.carousel-item{
   min-height: calc(100%)
}

.row-items{
    position: relative;
}

.card-left{
    left:0;
}

.card-right{
    right:0;
}

.rtl{
    direction: rtl;
}

.alumni-text{
    justify-content: center;
    align-items: center;
}

.alumni-list p {
    margin: 0 0 0.5rem 0;
}
</style>

<!-- Masthead Section -->
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Alumni Directory MemoraBook</h3>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>

<!-- Search Section -->
<div class="container search-container">
    <div class="row">
        <div class="col-md-9">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
                </div>
                <input type="text" class="form-control" id="filter" placeholder="Search by name, course, batch or workplace..." aria-label="Filter" aria-describedby="filter-field">
            </div>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary btn-block search-btn" id="search">Search</button>
        </div>
    </div>
</div>

<!-- Alumni Directory Section -->
<div class="container alumni-container">
    <div class="row-items">
        <div class="col-lg-12">
            <div class="row">
                <?php
                $fpath = 'admin/assets/uploads';
                $alumni = $conn->query("SELECT a.*,c.course,Concat(a.lastname,', ',a.firstname,' ',a.middlename) as name from alumnus_bio a inner join courses c on c.id = a.course_id order by Concat(a.lastname,', ',a.firstname,' ',a.middlename) asc");
                while($row = $alumni->fetch_assoc()):
                ?>
                <div class="col-md-4 item">
                    <div class="card alumni-list" data-id="<?php echo $row['id'] ?>">
                        <div class="alumni-header">
                            <div class="alumni-img">
                                <img src="<?php echo $fpath.'/'.$row['avatar'] ?>" alt="<?php echo $row['name'] ?>">
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="alumni-name filter-txt"><?php echo $row['name'] ?></h5>
                            <ul class="alumni-details">
                                <li>
                                    <span class="detail-label">Email:</span>
                                    <span class="filter-txt"><?php echo $row['email'] ?></span>
                                </li>
                                <li>
                                    <span class="detail-label">Course:</span>
                                    <span class="filter-txt"><?php echo $row['course'] ?></span>
                                </li>
                                <li>
                                    <span class="detail-label">Batch:</span>
                                    <span class="filter-txt"><?php echo $row['batch'] ?></span>
                                </li>
                                <li>
                                    <span class="detail-label">Working as:</span>
                                    <span class="filter-txt"><?php echo $row['connected_to'] ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>


<script>
    // $('.card.alumni-list').click(function(){
    //     location.href = "index.php?page=view_alumni&id="+$(this).attr('data-id')
    // })
    $('.book-alumni').click(function(){
        uni_modal("Submit Booking Request","booking.php?alumni_id="+$(this).attr('data-id'))
    })
    $('.alumni-img img').click(function(){
        viewer_modal($(this).attr('src'))
    })
    $('#filter').keypress(function(e){
        if(e.which == 13)
            $('#search').trigger('click')
    })
    $('#search').click(function(){
        var txt = $('#filter').val()
        start_load()
        if(txt == ''){
            $('.item').show()
            end_load()
            return false;
        }
        $('.item').each(function(){
            var content = "";
            $(this).find(".filter-txt").each(function(){
                content += ' '+$(this).text()
            })
            if((content.toLowerCase()).includes(txt.toLowerCase()) == true){
                $(this).toggle(true)
            }else{
                $(this).toggle(false)
            }
        })
        end_load()
    })
</script>