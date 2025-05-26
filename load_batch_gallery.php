<?php 
include 'admin/db_connect.php';

if (isset($_POST['batch_id'])) {
    $batch_id = $_POST['batch_id'];
    
    // Get images for specific batch
    $img = array();
    $fpath = 'admin/assets/uploads/gallery';
    $files = is_dir($fpath) ? scandir($fpath) : array();
    foreach($files as $val){
        if(!in_array($val, array('.', '..'))){
            $n = explode('_', $val);
            $img[$n[0]] = $val;
        }
    }
    
    // Query gallery items for specific batch
    $gallery = $conn->query("
        SELECT g.*, b.year as batch_year 
        FROM gallery g 
        INNER JOIN batch b ON g.batch_id = b.id 
        WHERE g.batch_id = '$batch_id' 
        ORDER BY g.id DESC
    ");
    
    if ($gallery->num_rows > 0) {
        while($row = $gallery->fetch_assoc()):
        ?>
        <div class="col-md-4">
            <div class="card gallery-list" data-id="<?php echo $row['id'] ?>">
                <div class="gallery-img">
                    <img src="<?php echo isset($img[$row['id']]) && is_file($fpath.'/'.$img[$row['id']]) ? $fpath.'/'.$img[$row['id']] : 'assets/images/no-image.png' ?>" alt="Gallery Photo">
                </div>
                <div class="card-body">
                    <?php if (!empty($row['event_name'])): ?>
                        <div class="event-name" style="font-weight: bold; color: #2980b9; margin-bottom: 5px;">
                            <?php echo htmlspecialchars($row['event_name']) ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($row['title'])): ?>
                        <div class="image-title" style="font-weight: 600; margin-bottom: 3px;">
                            <?php echo htmlspecialchars($row['title']) ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($row['caption'])): ?>
                        <div class="image-caption" style="font-style: italic; color: #666; margin-bottom: 5px; font-size: 0.9em;">
                            <?php echo htmlspecialchars($row['caption']) ?>
                        </div>
                    <?php endif; ?>
                    
                    <span class="truncate" data-about="<?php echo strtolower($row['about']) ?>">
                        <small><?php echo ucwords($row['about']) ?></small>
                    </span>
                    
                    <?php if (!empty($row['contributor'])): ?>
                        <div class="contributor" style="margin-top: 8px; font-size: 0.8em; color: #888;">
                            <i class="fas fa-user"></i> <?php echo htmlspecialchars($row['contributor']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
        endwhile;
    } else {
        echo '<div class="col-12 text-center"><div class="alert alert-info">No photos found for this batch.</div></div>';
    }
} else {
    echo '<div class="col-12 text-center"><div class="alert alert-danger">Invalid batch selection.</div></div>';
}
?>