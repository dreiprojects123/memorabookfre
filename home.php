<?php 
include 'admin/db_connect.php'; 
?>

<style>
/* Improved masthead styling */
.masthead {
    height: 1vh !important;
    margin-bottom: 2rem;
}

.welcome-text {
    padding: 0 20px;
}

.welcome-text h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.welcome-text hr.divider {
    max-width: 100px;
    margin: 1.5rem auto;
    height: 3px;
    background-color:rgb(4, 4, 4);
    border: none;
}

/* Events section styling */
.section-heading {
    font-size: 2rem;
    font-weight: 600;
    text-align: center;
    color: #000;
    margin-bottom: 2rem;
    position: relative;
    padding-bottom: 15px;
}

.section-heading:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background-color:rgb(4, 4, 4);
}

/* Carousel layout */
.events-carousel-container {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 40px;
}

.events-carousel {
    display: flex;
    overflow: hidden;
    padding: 20px 0;
    scroll-behavior: smooth;
}

.carousel-slide {
    display: flex;
    transition: transform 0.5s ease;
    width: 100%;
}

.compact-event {
    flex: 0 0 calc(33.333% - 20px);
    margin: 0 10px;
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    cursor: pointer;
}

.compact-event .banner {
    width: 100%;
    height: 180px;
    min-height: auto;
    overflow: hidden;
}

.compact-event .banner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.compact-event:hover .banner img {
    transform: scale(1.05);
}

.compact-event .card-body {
    padding: 1.25rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.compact-event h4 {
    margin-top: 0;
    margin-bottom: 0.75rem;
    font-weight: 600;
    color: #333;
    font-size: 1.25rem;
}

.compact-event .event-date {
    font-size: 0.85rem;
    color: #666;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
}

.compact-event .event-date i {
    margin-right: 5px;
    color: #007bff;
}

.compact-event .event-desc {
    max-height: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    color: #555;
}

.compact-event .read_more {
    margin-top: auto;
    align-self: center;
    padding: 0.375rem 1rem;
    transition: all 0.3s ease;
}

/* Carousel navigation arrows */
.carousel-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    background-color: rgba(28, 28, 29, 0.8);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.carousel-arrow:hover {
    background-color: rgb(41, 47, 54);
}

.carousel-arrow.prev {
    left: 0;
}

.carousel-arrow.next {
    right: 0;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .compact-event {
        flex: 0 0 calc(50% - 20px);
    }
}

@media (max-width: 768px) {
    .masthead {
        height: 40vh;
    }
    
    .welcome-text h1 {
        font-size: 2rem;
    }
    
    .compact-event {
        flex: 0 0 calc(100% - 20px);
    }
}

@media (max-width: 576px) {
    .masthead {
        height: 30vh;
    }
    
    .welcome-text h1 {
        font-size: 1.75rem;
    }
    
    .events-carousel-container {
        padding: 0 30px;
    }
}
</style>

<!-- Improved Header Section -->
<header class="masthead d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center welcome-text">
                <h1 class="text-white">Welcome to <?php echo $_SESSION['system']['name']; ?></h1>
                <hr class="divider">
            </div>
        </div>
    </div>
</header>

<!-- Events Section -->
<div class="container my-5">
    <h2 class="section-heading">Upcoming Events</h2>
    
    <!-- Carousel Layout for Events -->
    <div class="events-carousel-container">
        <div class="carousel-arrow prev">
            <i class="fa fa-chevron-left"></i>
        </div>
        
        <div class="events-carousel">
            <div class="carousel-slide">
                <?php
                $event = $conn->query("SELECT * FROM events where date_format(schedule,'%Y-%m%-d') >= '".date('Y-m-d')."' order by unix_timestamp(schedule) asc");
                while($row = $event->fetch_assoc()):
                    $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                    $desc = strtr(html_entity_decode($row['content']),$trans);
                    $desc=str_replace(array("<li>","</li>"), array("",","), $desc);
                    $short_desc = substr(strip_tags($desc), 0, 100) . (strlen(strip_tags($desc)) > 100 ? "..." : "");
                ?>
                <div class="compact-event">
                    <div class="banner">
                        <?php if(!empty($row['banner'])): ?>
                            <img src="admin/assets/uploads/<?php echo($row['banner']) ?>" alt="<?php echo ucwords($row['title']) ?>" class="banner-img">
                        <?php else: ?>
                            <div style="background:#007bff;height:100%;width:100%;display:flex;align-items:center;justify-content:center;">
                                <h3 class="text-white"><?php echo ucwords(substr($row['title'], 0, 1)); ?></h3>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h4 class="filter-txt"><?php echo ucwords($row['title']) ?></h4>
                        <div class="event-date"><i class="fa fa-calendar"></i> <?php echo date("F d, Y h:i A",strtotime($row['schedule'])) ?></div>
                        <div class="event-desc filter-txt"><?php echo $short_desc ?></div>
                        <button class="btn btn-primary btn-sm read_more" data-id="<?php echo $row['id'] ?>">Read More</button>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        
        <div class="carousel-arrow next">
            <i class="fa fa-chevron-right"></i>
        </div>
    </div>
</div>

<script>
    // Original scripts
    $('.read_more').click(function(){
        location.href = "index.php?page=view_event&id="+$(this).attr('data-id')
    })
    
    $('.banner-img').click(function(){
        viewer_modal($(this).attr('src'))
    })
    
    $('#filter').keyup(function(e){
        var filter = $(this).val()

        $('.compact-event .filter-txt').each(function(){
            var txto = $(this).html();
            txt = txto
            if((txt.toLowerCase()).includes((filter.toLowerCase())) == true){
                $(this).closest('.compact-event').show()
            }else{
                $(this).closest('.compact-event').hide()
            }
        })
    })
    
    // Make entire card clickable except the read more button
    $('.compact-event').click(function(e) {
        if (!$(e.target).hasClass('read_more') && !$(e.target).hasClass('banner-img')) {
            $(this).find('.read_more').click();
        }
    });
    
    // Carousel functionality
    $(document).ready(function() {
        const carousel = $('.carousel-slide');
        const eventCards = $('.compact-event');
        const cardWidth = eventCards.outerWidth(true);
        const visibleCards = 3;
        let currentPosition = 0;
        const totalCards = eventCards.length;
        const maxPosition = Math.max(0, totalCards - visibleCards);
        
        // Hide navigation arrows if not needed
        function updateArrowVisibility() {
            if (totalCards <= visibleCards) {
                $('.carousel-arrow').hide();
            } else {
                $('.carousel-arrow').show();
                
                if (currentPosition <= 0) {
                    $('.carousel-arrow.prev').css('opacity', '0.5');
                } else {
                    $('.carousel-arrow.prev').css('opacity', '1');
                }
                
                if (currentPosition >= maxPosition) {
                    $('.carousel-arrow.next').css('opacity', '0.5');
                } else {
                    $('.carousel-arrow.next').css('opacity', '1');
                }
            }
        }
        
        // Initial check
        updateArrowVisibility();
        
        // Next button click handler
        $('.carousel-arrow.next').click(function() {
            if (currentPosition < maxPosition) {
                currentPosition++;
                carousel.css('transform', `translateX(-${currentPosition * cardWidth}px)`);
                updateArrowVisibility();
            }
        });
        
        // Previous button click handler
        $('.carousel-arrow.prev').click(function() {
            if (currentPosition > 0) {
                currentPosition--;
                carousel.css('transform', `translateX(-${currentPosition * cardWidth}px)`);
                updateArrowVisibility();
            }
        });
        
        // Update on window resize
        $(window).resize(function() {
            // Reset position
            currentPosition = 0;
            carousel.css('transform', 'translateX(0)');
            updateArrowVisibility();
        });
    });
</script>