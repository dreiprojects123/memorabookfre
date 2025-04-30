<?php 
include 'admin/db_connect.php'; 
?>
<style>
/* Base styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa;
}

/* Card and list styling */
.card {
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
    margin-bottom: 1.5rem;
    border: none;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.Forum-list {
    overflow: hidden;
}

/* Image styling */
#portfolio .img-fluid {
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}

.gallery-list {
    cursor: pointer;
    border: unset;
    flex-direction: inherit;
}

.gallery-img, .gallery-list .card-body {
    width: calc(50%)
}

.gallery-img img {
    border-radius: 8px;
    min-height: 50vh;
    max-width: calc(100%);
    object-fit: cover;
}

/* Header styling */
header.masthead, header.masthead:before {
    min-height: 20vh !important;
    height: 20vh !important;
}

.masthead {
    min-height: 20vh !important;
    height: 20vh !important;
}

.masthead:before {
    min-height: 20vh !important;
    height: 20vh !important;
}

.page-title h3 {
    font-weight: 700;
    letter-spacing: 0.5px;
}

/* Button styling */
.btn {
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s;
}

.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0b5ed7;
}

#new_forum {
    padding: 8px 20px;
    font-weight: 500;
    letter-spacing: 0.5px;
}

/* Search section styling */
.search-area {
    background-color: #fff;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
}

.input-group {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border-radius: 6px;
    overflow: hidden;
}

.input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-right: none;
}

#filter {
    border-left: none;
    height: 45px;
}

/* Forum post styling */
.forum-item {
    padding: 1.5rem;
}

.forum-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: #212529;
    margin-bottom: 0.8rem;
}

.forum-desc {
    color: #555;
    margin-bottom: 1rem;
    line-height: 1.6;
}

.divider {
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    width: 100%;
    margin: 1rem 0;
}

.badge {
    font-weight: 500;
    padding: 0.5em 0.8em;
    margin-right: 0.5rem;
    border-radius: 4px;
}

.badge-info {
    background-color: #0dcaf0;
    color: #fff;
}

.badge-secondary {
    background-color: #6c757d;
    color: #fff;
}

.view_topic {
    padding: 0.375rem 1rem;
}

/* Dropdown styling */
.dropdown-menu {
    border-radius: 6px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
    border: none;
    padding: 0.5rem 0;
}

.dropdown-item {
    padding: 0.5rem 1.5rem;
    font-size: 0.9rem;
}

.dropdown-item:hover {
    background-color: #f0f7ff;
}

/* Utility classes */
.truncate {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

span.hightlight {
    background: yellow;
}

/* Carousel styling */
.carousel, .carousel-inner, .carousel-item {
    min-height: calc(100%)
}

/* Container margin fixes */
.main-container {
    margin-top: -1rem;
}

/* Topic action buttons */
.topic-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .badge {
        display: inline-block;
        margin-bottom: 0.5rem;
    }
    
    .view_topic {
        margin-top: 1rem;
        width: 100%;
    }
    
    .topic-actions {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Forum Topics</h3>
                <hr class="divider my-4" style="background-color: rgba(255,255,255,0.5); max-width: 100px;" c/>
                <div class="row col-md-12 mb-2 justify-content-center">
                    <button class="btn btn-light btn-block col-sm-4" type="button" id="new_forum">
                        <i class="fa fa-plus-circle mr-2"></i> Create New Topic
                    </button>
                </div>   
            </div>
        </div>
    </div>
</header>

<div class="container main-container mt-4 pt-2">
    <div class="card search-area mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group mb-md-0 mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" id="filter" placeholder="Search topics..." aria-label="Filter" aria-describedby="filter-field">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-block" id="search">Search</button>
                </div>
            </div>
        </div>
    </div>
   
   <?php
    $event = $conn->query("SELECT f.*,u.name from forum_topics f inner join users u on u.id = f.user_id order by f.id desc");
    while($row = $event->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']),$trans);
        $desc=str_replace(array("<li>","</li>"), array("",","), $desc);
        $count_comments=0;
        $count_comments = $conn->query("SELECT * FROM forum_comments where topic_id = ".$row['id'])->num_rows;
    ?>
    <div class="card Forum-list" data-id="<?php echo $row['id'] ?>">
        <div class="card-body forum-item">
            <div class="row align-items-start">
                <div class="col-12">
                    <?php if($_SESSION['login_id'] == $row['user_id']): ?>
                    <div class="dropdown float-right">
                        <a class="text-muted" href="javascript:void(0)" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fa fa-ellipsis-v"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item edit_forum" data-id="<?php echo $row['id'] ?>" href="javascript:void(0)">
                                <i class="fa fa-edit mr-2"></i> Edit
                            </a>
                            <a class="dropdown-item delete_forum" data-id="<?php echo $row['id'] ?>" href="javascript:void(0)">
                                <i class="fa fa-trash mr-2"></i> Delete
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <h3 class="forum-title filter-txt"><?php echo ucwords($row['title']) ?></h3>
                    <p class="forum-desc filter-txt"><?php echo strip_tags($desc) ?></p>
                    
                    <hr class="divider">
                    
                    <div class="topic-actions">
                        <div>
                            <span class="badge badge-info">
                                <i class="fa fa-user mr-1"></i> <span class="filter-txt"><?php echo $row['name'] ?></span>
                            </span>
                            <span class="badge badge-secondary">
                                <i class="fa fa-comments mr-1"></i> <?php echo $count_comments ?> Comments
                            </span>
                        </div>
                        <button class="btn btn-primary view_topic" data-id="<?php echo $row['id'] ?>">
                            View Topic <i class="fa fa-angle-right ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    
    <?php if($event->num_rows == 0): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fa fa-comment-slash fa-4x text-muted mb-3"></i>
            <h4>No forum topics available</h4>
            <p class="text-muted">Be the first to create a topic!</p>
            <button class="btn btn-primary mt-2" id="empty_new_forum">
                <i class="fa fa-plus-circle mr-2"></i> Create New Topic
            </button>
        </div>
    </div>  
    <?php endif; ?>
</div>

<script>
    // $('.card.gallery-list').click(function(){
    //     location.href = "index.php?page=view_gallery&id="+$(this).attr('data-id')
    // })
    $('#new_forum, #empty_new_forum').click(function(){
        uni_modal("New Topic","manage_forum.php",'mid-large')
    })
    $('.view_topic').click(function(){
       location.replace('index.php?page=view_forum&id='+$(this).attr('data-id'))
    })
    $('.edit_forum').click(function(){
        uni_modal("Edit Topic","manage_forum.php?id="+$(this).attr('data-id'),'mid-large')
    })
    $('.gallery-img img').click(function(){
        viewer_modal($(this).attr('src'))
    })
     $('.delete_forum').click(function(){
        _conf("Are you sure to delete this Topic?","delete_forum",[$(this).attr('data-id')],'mid-large')
    })

    function delete_forum($id){
        start_load()
        $.ajax({
            url:'admin/ajax.php?action=delete_forum',
            method:'POST',
            data:{id:$id},
            success:function(resp){
                if(resp==1){
                    alert_toast("Data successfully deleted",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)

                }
            }
        })
    }
    $('#filter').keypress(function(e){
    if(e.which == 13)
        $('#search').trigger('click')
   })
    $('#search').click(function(){
        var txt = $('#filter').val()
        start_load()
        if(txt == ''){
        $('.Forum-list').show()
        end_load()
        return false;
        }
        $('.Forum-list').each(function(){
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