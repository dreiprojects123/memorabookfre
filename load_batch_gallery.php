<style>
.yearbook-section { margin-bottom: 40px; }
.graduation-section .card { border: 2px solid #2980b9; }
.event-field-trip .card { border-left: 4px solid #27ae60; }
.event-retreat .card { border-left: 4px solid #8e44ad; }
/* Add more styling per event if desired */

.fixed-img {
    height: 100%;
    width: auto;
    object-fit: cover;
}
.img-container {
    width: 100%;
    height: 300px; /* You can increase/decrease as needed */
    overflow: hidden;
}

.full-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

</style>


<?php
include 'admin/db_connect.php';

if (isset($_POST['batch_id'])) {
    $batch_id = $_POST['batch_id'];

    $fpath = 'admin/assets/uploads/gallery';
    $files = is_dir($fpath) ? scandir($fpath) : array();
    $img = [];

    foreach($files as $val){
        if (!in_array($val, ['.', '..'])) {
            $n = explode('_', $val);
            $img[$n[0]] = $val;
        }
    }

    // Fetch all event data for the batch
    $result = $conn->query("
        SELECT g.*, b.year as batch_year 
        FROM gallery g 
        INNER JOIN batch b ON g.batch_id = b.id 
        WHERE g.batch_id = '$batch_id'
        ORDER BY g.event_name, g.id DESC
    ");

    if ($result->num_rows === 0) {
        echo '<div class="alert alert-warning text-center">No gallery photos found for this batch.</div>';
        return;
    }

    $grouped = [];

    while ($row = $result->fetch_assoc()) {
        $event = $row['event_name'] ?: 'Uncategorized';
        $grouped[$event][] = $row;
    }

    // Filter dropdown
    echo '<div class="mb-3">';
    echo '<label><strong>Filter Events:</strong></label>';
    echo '<select id="eventFilter" class="form-control" style="width: auto; display: inline-block;">';
    echo '<option value="all">All</option>';
    foreach(array_keys($grouped) as $event){
        echo '<option value="'.htmlspecialchars(strtolower($event)).'">'.htmlspecialchars($event).'</option>';
    }
    echo '</select>';
    echo '</div>';

    // Graduation section first
    if (isset($grouped['Graduation'])):
        echo '<div class="yearbook-section graduation-section" data-event="graduation">';
        echo '<h3 class="text-primary">🎓 Class of '.$grouped['Graduation'][0]['batch_year'].' – Graduation Portraits</h3><div class="row">';
        foreach ($grouped['Graduation'] as $row): ?>
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="img-container">
                        <img src="<?php echo isset($img[$row['id']]) ? $fpath.'/'.$img[$row['id']] : 'assets/images/no-image.png'; ?>" class="card-img-top full-img">
                    </div>
                    <div class="card-body">
                        <strong><?php echo htmlspecialchars($row['title']); ?></strong><br>
                        <small class="text-muted"><?php echo htmlspecialchars($row['caption']); ?></small><br>
                        <?php if ($row['contributor']): ?>
                            <div class="mt-1"><i class="fas fa-user"></i> <?php echo htmlspecialchars($row['contributor']); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach;
        echo '</div></div>';
        unset($grouped['Graduation']);
    endif;

    // Other event sections
    // Other event sections
    foreach($grouped as $event => $rows):
        $sectionClass = 'event-'.strtolower(str_replace(' ', '-', $event));
        $eventSlug = strtolower($event);

        echo '<div class="yearbook-section '.$sectionClass.'" data-event="'.$eventSlug.'">';
        echo '<h4 class="text-secondary">'.htmlspecialchars($event).'</h4>';

        // "Field Trip" – timeline style
        if ($eventSlug === 'field trip') {
            echo '<div class="timeline">';
            foreach ($rows as $row): ?>
                <div class="timeline-item mb-4 p-3 border rounded">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?php echo isset($img[$row['id']]) ? $fpath.'/'.$img[$row['id']] : 'assets/images/no-image.png'; ?>" class="img-fluid rounded">
                        </div>
                        <div class="col-md-8">
                            <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="text-muted"><?php echo htmlspecialchars($row['caption']); ?></p>
                            <?php if ($row['contributor']): ?>
                                <small><i class="fas fa-user"></i> <?php echo htmlspecialchars($row['contributor']); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach;
            echo '</div>'; // end timeline

        // "Educational Tour" – full-width layout without card
        } elseif ($eventSlug === 'educational tour') {
            echo '<div class="row">';
            foreach ($rows as $row): ?>
                <div class="col-md-12 mb-4 d-flex align-items-center border rounded p-3">
                    <div class="col-md-4 p-0">
                        <img src="<?php echo isset($img[$row['id']]) ? $fpath.'/'.$img[$row['id']] : 'assets/images/no-image.png'; ?>" class="img-fluid rounded">
                    </div>
                    <div class="col-md-8 ps-3">
                        <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p class="text-muted"><?php echo htmlspecialchars($row['caption']); ?></p>
                        <?php if ($row['contributor']): ?>
                            <small class="text-muted"><i class="fas fa-user"></i> <?php echo htmlspecialchars($row['contributor']); ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach;
            echo '</div>';

        // Default grid for all other events without card
        } else {
            echo '<div class="row">';
            foreach ($rows as $row): ?>
                <div class="col-md-3 mb-3 text-center">
                    <img src="<?php echo isset($img[$row['id']]) ? $fpath.'/'.$img[$row['id']] : 'assets/images/no-image.png'; ?>" class="img-fluid rounded mb-2" style="height: 200px; object-fit: cover;">
                    <div>
                        <strong><?php echo htmlspecialchars($row['title']); ?></strong><br>
                        <small class="text-muted"><?php echo htmlspecialchars($row['caption']); ?></small><br>
                        <?php if ($row['contributor']): ?>
                            <div class="mt-1"><i class="fas fa-user"></i> <?php echo htmlspecialchars($row['contributor']); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach;
            echo '</div>';
        }

        echo '<hr class="my-4">';  // Add horizontal line between sections
        echo '</div>'; // End event section
    endforeach;


} else {
    echo '<div class="alert alert-danger text-center">Invalid batch selection.</div>';
}
?>


<script>
$(document).ready(function(){
    $('#eventFilter').on('change', function(){
        var selected = $(this).val();
        if (selected === 'all') {
            $('.yearbook-section').show();
        } else {
            $('.yearbook-section').hide();
            $('.yearbook-section[data-event="'+selected+'"]').show();
        }
    });
});
</script>
