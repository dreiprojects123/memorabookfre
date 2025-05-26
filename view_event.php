<?php include 'admin/db_connect.php' ?>
<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM events where id= ".$_GET['id']);
    foreach($qry->fetch_array() as $k => $val){
        $$k=$val;
    }
    $commits = $conn->query("SELECT * FROM event_commits where event_id = $id");
    $cids= array();
    while($row = $commits->fetch_assoc()){
        $cids[] = $row['user_id'];
    }
}
?>

<style type="text/css">
    :root {
        --primary-color: #3b82f6;
        --primary-dark: #2563eb;
        --success-color: #10b981;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --bg-light: #f8fafc;
        --border-light: #e5e7eb;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* Header Styles */
    .event-header {
        position: relative;
        height: 60vh;
        overflow: hidden;
        border-radius: 20px;
        margin: 2rem 0;
        box-shadow: var(--shadow-lg);
    }

    <?php if(!empty($banner)): ?>
    .event-header {
        background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url(admin/assets/uploads/<?php echo $banner ?>);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    <?php else: ?>
    .event-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    <?php endif; ?>

    .event-header-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        padding: 3rem 2rem 2rem;
        color: white;
    }

    .event-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        line-height: 1.2;
    }

    .event-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        font-weight: 300;
    }

    /* Main Content */
    .main-content {
        background: white;
        border-radius: 20px;
        margin: -4rem 1rem 2rem;
        position: relative;
        z-index: 10;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }

    .content-header {
        background: var(--bg-light);
        padding: 2rem;
        border-bottom: 1px solid var(--border-light);
    }

    .event-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: white;
        padding: 0.75rem 1.25rem;
        border-radius: 50px;
        box-shadow: var(--shadow-sm);
        font-weight: 500;
        color: var(--text-primary);
    }

    .meta-item i {
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    .event-description {
        padding: 2.5rem;
        line-height: 1.8;
        font-size: 1.1rem;
        color: var(--text-primary);
    }

    .event-description p {
        margin-bottom: 1.5rem;
    }

    /* Participation Section */
    .participation-section {
        background: var(--bg-light);
        padding: 2.5rem;
        text-align: center;
        border-top: 1px solid var(--border-light);
    }

    .participation-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
    }

    .btn-participate {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        position: relative;
        overflow: hidden;
    }

    .btn-participate:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
    }

    .btn-participate:active {
        transform: translateY(0);
    }

    .btn-participate::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-participate:hover::before {
        left: 100%;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, var(--success-color), #059669);
        color: white;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
    }

    .status-badge i {
        font-size: 1.2rem;
    }

    /* Image Gallery */
    .imgs {
        margin: 0.5rem;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: transform 0.3s ease;
    }

    .imgs:hover {
        transform: scale(1.05);
    }

    .imgs img {
        width: 100%;
        height: auto;
        cursor: pointer;
        transition: filter 0.3s ease;
    }

    .imgs img:hover {
        filter: brightness(1.1);
    }

    /* Carousel Improvements */
    #imagesCarousel {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        margin: 2rem 0;
    }

    #imagesCarousel, #imagesCarousel .carousel-inner, #imagesCarousel .carousel-item {
        height: 40vh !important;
        background: #000;
    }

    #imagesCarousel .carousel-item.active,
    #imagesCarousel .carousel-item-next {
        display: flex !important;
    }

    #imagesCarousel .carousel-item img {
        margin: auto;
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        cursor: pointer;
    }

    #banner {
        display: flex;
        justify-content: center;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        margin: 1rem 0;
    }

    #banner img {
        max-width: 100%;
        max-height: 50vh;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    #banner img:hover {
        transform: scale(1.02);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .event-title {
            font-size: 2rem;
        }
        
        .event-meta {
            flex-direction: column;
            align-items: stretch;
        }
        
        .meta-item {
            justify-content: center;
        }
        
        .main-content {
            margin: -2rem 0.5rem 1rem;
        }
        
        .content-header,
        .event-description,
        .participation-section {
            padding: 1.5rem;
        }
    }

    /* Loading Animation */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .loading {
        animation: pulse 1.5s ease-in-out infinite;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--bg-light);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
    }
</style>

<br><br><br>
<div class="container-fluid px-0">
    <!-- Event Header -->
    <div class="container">
        <div class="event-header">
            <div class="event-header-content">
                <h1 class="event-title"><?php echo isset($title) ? $title : ''; ?></h1>
                <?php if(isset($description)): ?>
                <p class="event-subtitle"><?php echo $description; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="main-content">
            <!-- Content Header -->
            <div class="content-header">
                <div class="event-meta">
                    <div class="meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span><?php echo date("F d, Y", strtotime($schedule)); ?></span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span><?php echo date("h:i A", strtotime($schedule)); ?></span>
                    </div>
                    <?php if(isset($venue)): ?>
                    <div class="meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?php echo $venue; ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Event Description -->
            <div class="event-description">
                <?php echo html_entity_decode($content); ?>
            </div>

            <!-- Participation Section -->
            <div class="participation-section">
                <h3 class="participation-title">Ready to Join Us?</h3>
                <?php if(isset($_SESSION['login_id'])): ?>
                    <?php if(in_array($_SESSION['login_id'], $cids)): ?>
                        <div class="status-badge">
                            <i class="fas fa-check-circle"></i>
                            <span>You're Registered for This Event!</span>
                        </div>
                    <?php else: ?>
                        <button class="btn-participate" id="participate" type="button">
                            <i class="fas fa-heart" style="margin-right: 0.5rem;"></i>
                            Join the Retreat
                        </button>
                    <?php endif; ?>
                <?php else: ?>
                    <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">Please log in to register for this event</p>
                    <a href="login.php" class="btn-participate" style="text-decoration: none; display: inline-block;">
                        <i class="fas fa-sign-in-alt" style="margin-right: 0.5rem;"></i>
                        Login to Participate
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Image modal functionality
    $('#imagesCarousel img, #banner img').click(function(){
        viewer_modal($(this).attr('src'))
    })

    // Participation functionality
    $('#participate').click(function(){
        _conf("Ready to embark on this amazing retreat experience?", "participate", [<?php echo $id ?>], 'mid-large')
    })

    function participate($id){
        start_load()
        $.ajax({
            url:'admin/ajax.php?action=participate',
            method:'POST',
            data:{event_id:$id},
            success:function(resp){
                if(resp==1){
                    alert_toast("Welcome aboard! You're now registered for the retreat!", 'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)
                }
            }
        })
    }

    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';

    // Add loading states for better UX
    document.addEventListener('DOMContentLoaded', function() {
        const participateBtn = document.getElementById('participate');
        if (participateBtn) {
            participateBtn.addEventListener('click', function() {
                this.classList.add('loading');
                this.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 0.5rem;"></i>Processing...';
            });
        }
    });
</script>