<style>
    .yearbook-section { 
        margin-bottom: 40px; 
    }
    
    .graduation-section .card { 
        border: 2px solid #2980b9; 
    }
    
    /* .event-field-trip .card { 
        border-left: 4px solid #27ae60; 
    }
    
    .event-retreat .card { 
        border-left: 4px solid #8e44ad; 
    } */

    .fixed-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
    
    .img-container {
        width: 100%;
        height: 300px;
        overflow: hidden;
    }

    .full-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .timeline-item {
        min-height: 200px; /* Reduced from 300px */
    }

    .graduation-class-picture-section .card {
        border: none;
        background-color: #f8f9fa;
        padding: 1rem;
    }

    .graduation-class-picture-section .img-container {
        width: 100%;
        text-align: center;
        height: auto;
    }

    .graduation-class-picture-section img {
        width: 100%;
        height: auto;
        object-fit: contain;
        border-radius: 0.5rem;
        max-height: 80vh;
    }

    /* Consistent image sizing for all layouts */
    .consistent-img-container {
        width: 100%;
        height: 250px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }

    .consistent-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Timeline specific image containers - MADE SMALLER */
    .timeline-img-container {
        width: 100%;
        height: 200px; /* Reduced from 300px */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Horizontal layout image containers - MADE SMALLER */
    .horizontal-img-container {
        width: 100%;
        height: 200px; /* Reduced from 280px */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Compact card styling for Educational Tour and Field Trip */
    .compact-card {
        margin-bottom: 1.5rem !important; /* Reduced spacing */
    }

    .compact-card .card-body {
        padding: 1rem !important; /* Reduced padding */
    }

    .compact-card .card-title {
        font-size: 1rem !important; /* Slightly smaller title */
        margin-bottom: 0.3rem !important;
    }

    .compact-card .card-caption {
        font-size: 0.875rem !important;
        margin-bottom: 0.5rem !important;
    }

    /* Additional fixes for better positioning */
    .section-header {
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e9ecef;
    }

    .contributor-info {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .card-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        line-height: 1.3;
        text-align: center;
    }

    .card-caption {
        color: #6c757d;
        margin-bottom: 0.75rem;
        line-height: 1.4;
        text-align: center;
    }

    .card-body-centered {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        justify-content: center;
        padding: 1rem;
    }

    .filter-container {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        margin-right: 2rem;
    }

    .filter-container label {
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .section-divider {
        border: 0;
        height: 2px;
        background: linear-gradient(to right, transparent, #dee2e6, transparent);
        margin: 2rem 0;
    }

    /* Hide empty states */
    .no-photos-message {
        display: none !important;
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
        // Instead of showing "no photos found", show a more user-friendly message or hide it
        echo '<div class="alert alert-info text-center" style="display: none;">Loading gallery content...</div>';
        return;
    }

    $grouped = [];

    while ($row = $result->fetch_assoc()) {
        $event = $row['event_name'] ?: 'Uncategorized';
        $grouped[$event][] = $row;
    }

    // Only show filter if there are actually photos
    if (!empty($grouped)) {
        // Filter dropdown
        echo '<div class="filter-container">';
        echo '<label for="eventFilter"><strong>Filter Events:</strong></label>';
        echo '<select id="eventFilter" class="form-control">';
        echo '<option value="all">All Events</option>';
        foreach(array_keys($grouped) as $event){
            echo '<option value="'.htmlspecialchars(strtolower($event)).'">'.htmlspecialchars($event).'</option>';
        }
        echo '</select>';
        echo '</div>';
    }

    // Graduation Class Picture section above Graduation Portraits
    if (isset($grouped['Graduation Class Picture'])):
        echo '<div class="yearbook-section graduation-class-picture-section" data-event="graduation-class-picture">';
        echo '<div class="section-header">';
        echo '<h3 class="text-secondary mb-2">🎓 Class of '.$grouped['Graduation Class Picture'][0]['batch_year'].' – Class Picture</h3>';
        if (!empty($grouped['Graduation Class Picture'][0]['contributor'])) {
            echo '<div class="contributor-info"><i class="fas fa-graduation-cap"></i> Contributed by ' . htmlspecialchars($grouped['Graduation Class Picture'][0]['contributor']) . '</div>';
        }
        echo '</div>';
        echo '<div class="row">';

        foreach ($grouped['Graduation Class Picture'] as $row): ?>
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="img-container text-center p-3">
                        <img src="<?php echo isset($img[$row['id']]) ? $fpath.'/'.$img[$row['id']] : 'assets/images/no-image.png'; ?>" 
                            class="img-fluid rounded" 
                            style="max-height: 500px; object-fit: contain;" 
                            alt="Graduation Class Picture">
                    </div>
                    <div class="card-body-centered">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                        <?php if (!empty($row['caption'])): ?>
                            <p class="card-caption"><?php echo htmlspecialchars($row['caption']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($row['contributor'])): ?>
                            <div class="contributor-info justify-content-center">
                                <i class="fas fa-user"></i> 
                                <?php echo htmlspecialchars($row['contributor']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach;

        echo '</div></div>';
        unset($grouped['Graduation Class Picture']);
    endif;

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
    echo '<h2 class="text-center text-success mb-5">🎓Graduates</h2>';

    foreach ($combinedByCourse as $course => $data):
        echo '<div class="mb-5">';
        echo '<h3 class="text-center text-black mb-4">📘 ' . htmlspecialchars($course) . '</h3>';

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

        echo '<div class="yearbook-section ' . $sectionClass . '" data-event="' . $eventSlug . '">';
        echo '<div class="section-header">';
        echo '<h3 class="text-secondary">' . htmlspecialchars($event) . '</h3>';
        echo '</div>';

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
            // Generic fallback layout
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

        echo '<hr class="section-divider">';
        echo '</div>'; // End section
    endforeach;

} else {
    // Instead of showing error message, just show nothing or a subtle loading state
    echo '<div class="text-center" style="display: none;">Please select a batch to view photos.</div>';
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

    // Hide any "no photos found" messages that might appear
    $('.alert-warning, .alert-danger').each(function() {
        if ($(this).text().toLowerCase().includes('no photos') || 
            $(this).text().toLowerCase().includes('no gallery') ||
            $(this).text().toLowerCase().includes('invalid batch')) {
            $(this).hide();
        }
    });
});
</script>