<?php 
include 'admin/db_connect.php'; 
 $topic = $conn->query("SELECT *,u.name from forum_topics f inner join users u on u.id = f.user_id  where f.id = ".$_GET['id']);
 foreach($topic->fetch_array() as $k=>$v){
 	if(!is_numeric($k))
 		$$k = $v;
 }
?>
<style>
/* Base styling */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f0f2f5;
    color: #1c1e21;
}

/* Card and container styling */
.main-container {
    max-width: 900px;
    margin: 0 auto;
}

.topic-card {
    border-radius: 8px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    background: white;
    margin-bottom: 1.5rem;
    border: none;
    overflow: hidden;
}

/* Header styling */
header.masthead, header.masthead:before {
    min-height: 15vh !important;
    height: 18vh !important;
}

.masthead {
    min-height: 18vh !important;
    height: 18vh !important;
}

.masthead:before {
    min-height: 18vh !important;
    height: 18vh !important;
}

.page-title h3 {
    font-weight: 700;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}

/* Topic content styling */
.topic-header {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.topic-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #3b5998;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 10px;
    font-size: 18px;
}

.topic-info {
    flex-grow: 1;
}

.topic-author {
    font-weight: 600;
    margin-bottom: 0;
    font-size: 15px;
}

.topic-meta {
    color: #65676b;
    font-size: 13px;
}

.topic-content {
    padding: 16px;
    font-size: 15px;
    line-height: 1.5;
}

/* Comments section styling */
.comments-section {
    border-top: 1px solid #e4e6eb;
    padding: 12px 16px;
    background-color: #f8f9fa;
}

.comments-header {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e4e6eb;
}

.comments-header h5 {
    margin: 0;
    font-weight: 600;
    color: #444;
}

.comment-item {
    display: flex;
    margin-bottom: 16px;
    position: relative;
}

.comment-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #dfe3ee;
    color: #3b5998;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 10px;
    font-size: 14px;
    flex-shrink: 0;
}

.comment-bubble {
    background-color: #ffffff;
    border-radius: 18px;
    padding: 8px 12px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    flex-grow: 1;
    position: relative;
}

.comment-author {
    font-weight: 600;
    font-size: 13px;
    margin-bottom: 2px;
}

.comment-username {
    color: #65676b;
    font-size: 12px;
    font-weight: normal;
    margin-left: 5px;
}

.comment-content {
    font-size: 14px;
    line-height: 1.4;
}

.comment-actions {
    position: absolute;
    right: 0;
    top: 0;
}

/* Comment form styling */
.comment-form-container {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    background-color: white;
    border-top: 1px solid #e4e6eb;
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #dfe3ee;
    color: #3b5998;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 10px;
    font-size: 14px;
    flex-shrink: 0;
}

.comment-input-container {
    flex-grow: 1;
    position: relative;
}

.comment-input {
    width: 100%;
    border-radius: 20px;
    border: 1px solid #ccd0d5;
    padding: 8px 40px 8px 12px;
    font-size: 14px;
    resize: none;
    max-height: 200px;
    min-height: 36px;
}

.comment-input:focus {
    outline: none;
    border-color: #3b5998;
    box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
}

.comment-submit {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #3b5998;
    cursor: pointer;
    padding: 0;
}

.comment-submit:hover {
    color: #1d3c78;
}

/* Badge styling */
.badge {
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    font-weight: 500;
    border-radius: 4px;
    margin-left: 8px;
}

.badge-primary {
    background-color: #3b5998;
    color: white;
}

/* Dropdown styling */
.dropdown-toggle {
    background: none;
    border: none;
    color: #65676b;
    cursor: pointer;
    padding: 4px;
}

.dropdown-toggle:hover {
    background-color: rgba(0, 0, 0, 0.05);
    border-radius: 50%;
}

.dropdown-menu {
    border-radius: 8px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
    border: none;
    padding: 8px 0;
    min-width: 120px;
}

.dropdown-item {
    font-size: 14px;
    padding: 8px 16px;
}

.dropdown-item:hover {
    background-color: #f0f2f5;
}

/* Rich text editor styling */
.jqte {
    border: 1px solid #ccd0d5;
    border-radius: 8px;
    margin-bottom: 12px;
}

.jqte_toolbar {
    border-bottom: 1px solid #e4e6eb;
    background-color: #f8f9fa;
    border-radius: 8px 8px 0 0;
}

/* Button styling */
.btn-primary {
    background-color: #1877f2;
    border-color: #1877f2;
    border-radius: 6px;
    font-weight: 500;
    padding: 8px 16px;
    font-size: 14px;
}

.btn-primary:hover {
    background-color: #166fe5;
    border-color: #166fe5;
}

/* Utility classes */
.divider {
    margin: 12px 0;
    border-top: 1px solid #e4e6eb;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .main-container {
        padding: 0 12px;
    }
    
    .topic-content {
        padding: 12px;
    }
    
    .comment-item {
        margin-bottom: 12px;
    }
    
    .comment-bubble {
        padding: 6px 10px;
    }
}

/* Gallery and image styling preserved from original */
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
    border-radius: 5px;
    min-height: 50vh;
    max-width: calc(100%);
}

span.hightlight {
    background: yellow;
}

.carousel, .carousel-inner, .carousel-item {
    min-height: calc(100%)
}

.row-items {
    position: relative;
}
</style>

<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white"><?php echo $title ?></h3>
            </div>
        </div>
    </div>
</header>

<div class="container main-container mt-4 pt-2">
    <!-- Topic Card -->
    <div class="card topic-card">
        <!-- Topic Header -->
        <div class="topic-header">
            <div class="topic-avatar">
                <?php echo substr($name, 0, 1); ?>
            </div>
            <div class="topic-info">
                <p class="topic-author">
                    <?php echo $name ?>
                    <span class="badge badge-primary">Topic Creator</span>
                </p>
                <p class="topic-meta">
                    <i class="fa fa-clock-o"></i> <?php echo date('F d, Y h:i A', strtotime($date_created)) ?>
                </p>
            </div>
        </div>
        
        <!-- Topic Content -->
        <div class="topic-content">
            <?php echo html_entity_decode($description) ?>
        </div>
        
        <!-- Comments Section -->
        <?php 
        $comments = $conn->query("SELECT f.*,u.name,u.username FROM forum_comments f inner join users u on u.id = f.user_id where f.topic_id = $id order by f.id asc");
        ?>
        <div class="comments-section">
            <div class="comments-header">
                <h5><i class="fa fa-comments"></i> Comments (<?php echo $comments->num_rows ?>)</h5>
            </div>
            
            <?php 
            if($comments->num_rows > 0):
                while($row = $comments->fetch_assoc()):
            ?>
            <div class="comment-item">
                <div class="comment-avatar">
                    <?php echo substr($row['name'], 0, 1); ?>
                </div>
                <div class="comment-bubble">
                    <div class="comment-author">
                        <?php echo $row['name'] ?>
                        <span class="comment-username">@<?php echo $row['username'] ?></span>
                    </div>
                    <div class="comment-content">
                        <?php echo html_entity_decode($row['comment']) ?>
                    </div>
                    
                    <?php if($_SESSION['login_id'] == $row['user_id']): ?>
                    <div class="comment-actions dropdown">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item edit_comment" data-id="<?php echo $row['id'] ?>" href="javascript:void(0)">
                                <i class="fa fa-edit mr-2"></i> Edit
                            </a>
                            <a class="dropdown-item delete_comment" data-id="<?php echo $row['id'] ?>" href="javascript:void(0)">
                                <i class="fa fa-trash mr-2"></i> Delete
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php 
                endwhile; 
            else:
            ?>
            <div class="text-center py-4">
                <p class="text-muted">No comments yet. Be the first to comment!</p>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Comment Form -->
        <div class="comment-form-container">
            <div class="user-avatar">
                <?php 
                // Get current user's first letter for avatar
                $user_query = $conn->query("SELECT name FROM users WHERE id = ".$_SESSION['login_id']);
                $user = $user_query->fetch_assoc();
                echo substr($user['name'] ?? 'U', 0, 1);
                ?>
            </div>
            <form action="" id="manage-comment" class="w-100">
                <input type="hidden" name="topic_id" value="<?php echo isset($id) ? $id : '' ?>">
                <div class="comment-input-container mb-2">
                    <textarea class="comment-input jqte" name="comment" placeholder="Write a comment..."></textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane mr-1"></i> Post Comment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.jqte').jqte({
        color: false,
        source: false,
        linktypes: ['Web Address'],
        b: true,
        i: true,
        u: true,
        ol: true,
        ul: true,
        strike: false,
        rule: false,
        sub: false,
        sup: false,
        remove: false,
        indent: false,
        outdent: false
    });

    $('#new_forum').click(function(){
        uni_modal("New Topic","manage_forum.php",'mid-large')
    })
    
    $('.edit_comment').click(function(){
        uni_modal("Edit Comment","manage_comment.php?id="+$(this).attr('data-id'),'mid-large')
    })
    
    $('.view_topic').click(function(){
        uni_modal("Career Opportunity","view_Forums.php?id="+$(this).attr('data-id'),'mid-large')
    })

    $('#search').click(function(){
        var txt = $(this).val()
        start_load()
        $('.Forum-list').each(function(){
            var content = $(this).text()
            if((content.toLowerCase()).includes(txt.toLowerCase) == true){
                $(this).toggle('true')
            }else{
                $(this).toggle('false')
            }
        })
        end_load()
    })
    
    $('#manage-comment').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'admin/ajax.php?action=save_comment',
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp == 1){
                    alert_toast("Comment successfully posted.",'success')
                    setTimeout(function(){
                        location.reload()
                    },1000)
                }
            }
        })
    })
    
    $('.delete_comment').click(function(){
        _conf("Are you sure to delete this comment?","delete_comment",[$(this).attr('data-id')],'mid-large')
    })

    function delete_comment($id){
        start_load()
        $.ajax({
            url:'admin/ajax.php?action=delete_comment',
            method:'POST',
            data:{id:$id},
            success:function(resp){
                if(resp==1){
                    alert_toast("Comment successfully deleted",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)
                }
            }
        })
    }
</script>