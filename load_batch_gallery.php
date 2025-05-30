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

    // Graduation Class Picture section - Full Section View grouped by course
    // Combine and group both Graduation Class Picture and Graduation by course
    $combinedByCourse = [];

    // Group class pictures
    if (isset($grouped['Graduation Class Picture'])) {
        foreach ($grouped['Graduation Class Picture'] as $row) {
            $course = trim($row['contributor']) ?: 'Unspecified Course';
            $combinedByCourse[$course]['class_picture'][] = $row;
        }
        unset($grouped['Graduation Class Picture']);
    }

    // Group portraits
    if (isset($grouped['Graduation'])) {
        foreach ($grouped['Graduation'] as $row) {
            $course = trim($row['contributor']) ?: 'Unspecified Course';
            $combinedByCourse[$course]['portraits'][] = $row;
        }
        unset($grouped['Graduation']);
    }

    // Now render each course with class picture and portraits
    echo '<section class="grad-combined-section py-5" style="background-color: #f9f9f9;">';
    echo '<div class="container">';
    echo '<h2 class="text-center text-success mb-5">🎓 Graduation by Course</h2>';

    foreach ($combinedByCourse as $course => $data):
        echo '<div class="mb-5">';
        echo '<h3 class="text-center text-primary mb-4">📘 ' . htmlspecialchars($course) . '</h3>';

        // Class Picture (full-width card)
        if (!empty($data['class_picture'])):
            foreach ($data['class_picture'] as $row): ?>
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-lg">
                            <img src="<?php echo isset($img[$row['id']]) ? $fpath . '/' . $img[$row['id']] : 'assets/images/no-image.png'; ?>" class="card-img-top w-100" style="max-height: 600px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                                <p class="card-text text-muted"><?php echo htmlspecialchars($row['caption']); ?></p>
                                <?php if ($row['contributor']): ?>
                                    <p class="card-text"><i class="fas fa-user"></i> <?php echo htmlspecialchars($row['contributor']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;
        endif;

        // Graduation Portraits (grid)
        if (!empty($data['portraits'])):
            echo '<div class="row">';
            foreach ($data['portraits'] as $row): ?>
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="img-container">
                            <img src="<?php echo isset($img[$row['id']]) ? $fpath . '/' . $img[$row['id']] : 'assets/images/no-image.png'; ?>" class="card-img-top full-img">
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
            echo '</div>';
        endif;

        echo '</div><hr>';
    endforeach;

    echo '</div></section>';

    // Other event sections
    foreach($grouped as $event => $rows):
        $sectionClass = 'event-'.strtolower(str_replace(' ', '-', $event));
        $eventSlug = strtolower($event);

        echo '<div class="yearbook-section '.$sectionClass.'" data-event="'.$eventSlug.'">';
        echo '<h4 class="text-secondary">'.htmlspecialchars($event).'</h4>';

        // "Field Trip" – timeline style
        if (in_array($eventSlug, [
            'field trip',
            'educational tour',
            'retreat',
            'recognition',
            'intrams',
            'foundation week',
            'graduation ball',
            'others'
        ])) {
            echo '<div class="row">';
            foreach ($rows as $index => $row):
                $isEven = $index % 2 === 0;
                ?>
                <div class="col-md-12 mb-4 d-flex flex-column flex-md-row <?php echo $isEven ? '' : 'flex-md-row-reverse'; ?> align-items-center border rounded p-3">
                    <div class="col-md-4 p-0">
                        <img src="<?php echo isset($img[$row['id']]) ? $fpath.'/'.$img[$row['id']] : 'assets/images/no-image.png'; ?>" class="img-fluid rounded w-100">
                    </div>
                    <div class="col-md-8 ps-md-3 pe-md-3">
                        <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p class="text-muted"><?php echo htmlspecialchars($row['caption']); ?></p>
                        <?php if ($row['contributor']): ?>
                            <small class="text-muted"><i class="fas fa-user"></i> <?php echo htmlspecialchars($row['contributor']); ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach;
            echo '</div>';
        } else {
            echo '<div class="row">';
            foreach ($rows as $row): ?>
                <div class="col-md-12 mb-3 text-center">
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
