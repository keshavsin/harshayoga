<?php
session_start();
$currentPage = "index";
include 'common/header.php';
?>
   <section>
      <div id="myCarousel" class="carousel slide main_slider" data-ride="carousel">
        <div  class="carousel-inner " role="listbox">
            <div class="item active">
              <img src="assets/images/slider/1.png" alt="">
            </div>
            <div class="item">
              <img src="assets/images/slider/2.png" alt="">
            </div>
            <div class="item">
              <img src="assets/images/slider/3.png" alt="">
            </div>
            <div class="item">
              <img src="assets/images/slider/4.png" alt="">
            </div>
			  <div class="item">
              <img src="assets/images/slider/5.png" alt="">
            </div>
			 <div class="item">
              <img src="assets/images/slider/6.png" alt="">
            </div>
        </div>
        <div class="slide_caption">
        </div>
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
              <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
             <span class="sr-only">Next</span>
          </a>
    </div>
  </section>

  <section class="gradiant_bg" style="padding:5px">
    <div class="innr_container" style="max-width:100%">
    	<p style="text-align:center">Classic pose, when practiced with discrimination and awareness, brings the body , mind and consciousness into a single , harmonious whole.
    </div>
  </section>
  <section>
    <div class="container-fluid">
      <div class="row table_container">
      <div class="col-sm-6" style="padding:0;">
			 <img src="assets/images/abhyasa-bg.jpg" alt="">
        </div>
        <div class="col-sm-6 table_cell cell1">
        	<h2 class="heading1 colr_h">ABHYASA</h2>
            <p>Hunger in my heart to know the whence and whither, the why's &amp; where's made me to perceive the realities &amp; potentials of myself. Hence, I decided to enrich my surroundings with many sided greatness. Then the principles of yoga started to shine forth with in. realizing that the beginning end is silent, I decided to my journey worthwhile.
</p>
        </div>
        
      </div>
    </div>
  </section>
  <section class="training_wrapper">
    	<div class="innr_container">
        <h2 class="heading1 cntr_h">TEACHER TRAINING</h2>
            <p>For all those souls who have been craving for the most authentic teaching of yoga, This indeed is a must to deepen the knowledge base &amp; practice. The level 1 &amp; level 2 of teacher training will help you gain enough knowledge to carry on with your yogic practice &amp; studies for almost a decade.<br/><br/>

After the completion of the studies, Interested students will have hands on experience in teaching at the shala under the watchful of the teacher for almost 2 months. This ensures that the graduating teacher will have enough experience in handling the classes in the future.<br/><br/>

Along with the above, the students will get to experience the best teachings.
</p>
        </div>
  </section>
<section class="container-fluid">
      <div class="row table_container" style="padding:20px 20px 20px 20px">
      
        <div class="col-sm-6  ">
        	<h2 class="heading1 colr_h">WHY US?</h2>
            <p>Harsha has practiced the Iyengar’s teachings techniques &amp; the traditional Ashtanga Vinyasa along with years of hatha yoga practice. With the strong knowledge base of the major scriptures backed with the therapeutic knowledge is indeed a blessing for an aspiring teacher to learn. With a decade worth of studies &amp; practice, the experience is unmatched.
            <br/><br/>
            Asana practice, Yoga philosophy, Anatomy, Hatha yoga, Yoga sutras, you name it &amp; you'll get answer to all ur questions. With a strong foundation of all the above, participants will able to chart their own path in this journey of yoga.
            </p>
            <br><br><br><br><br>
        </div>
        <div class="col-sm-6  ">
        <img src="assets/images/whyus-bg.jpg" alt="" style="width:100%;height:auto">
        </div>
      </div>
</section>
<section class="gradiant_bg">
  	<div class="innr_container">
    	<h2 class="heading1 cntr_h">DHARMA</h2>
            <p>To spread the knowledge of yoga in its authentic form, As taught by the Maharshies.
<br/><br/>
To reach each and every honest soul out there who are in thirst for the understanding the realities of oneself & make their journey worthwhile.
</p>
    </div>
  </section>
<section class="container-fluid1">
  <div class="row yoga_type">
    <div class="col-sm-4 gridimage yoga_grid"> 
	<img src="assets/images/asthangaYogaHome - 1.jpg" class="img-responsive"/>
	<h2 class="heading1 colr_h">ASHTANGA YOGA</h2>
        			<ul>
          			<li>Primary Series </li>
          			<li>Intermediate Series</li> 
          			<li>Advanced Series</li>
        			</ul>
    </div>
	
	<div class="col-sm-4 gridimage yoga_grid"> 
	<img src="assets/images/hathaYogaHome - 1.jpg" class="img-responsive"/>
<h2 class="heading1 colr_h">HATHA YOGA</h2>
        			<ul>
          			<li>Shatkarma </li>
          			<li>Asana & pranayama</li> 
          			<li>Mudra & bandha</li>
        			</ul>
    </div>
	<div class="col-sm-4 gridimage yoga_grid"> 
	<img src="assets/images/yogaTherapyHome - 1.jpg" class="img-responsive"/>
		<h2 class="heading1 colr_h">YOGA THERAPY</h2>
        			<ul>
					<li>Yoga anatomy</li>
          			<li>Yoga for motherhood</li> 
          			<li>Yoga for women's health</li>
        			</ul>
    </div>
   
    </div>
  </section>


  <section class="gradiant_bg">
  	<div class="testimonial_wrap">
    	<h2 class="heading1 cntr_h">TESTIMONIALS</h2>
		
   
  <div class='row'>
    <div class='col-md-offset-2 col-md-8'>
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->
        <ol class="carousel-indicators">
		   <?php
			$sql_testimonals_cnt    = "SELECT * FROM testimonials where is_active=1";
			$result_testimonals_cnt = $db->query($sql_testimonals_cnt);
			if ($result_testimonals_cnt->num_rows > 0) {		
				$indx = 0;
				while ($row_testimonals_cnt = $result_testimonals_cnt->fetch_assoc()) {
						if($indx == 0){
							echo '<li data-target="#quote-carousel" data-slide-to="0" class="active"></li>';
							$indx++;
						}else{
							echo '<li data-target="#quote-carousel" data-slide-to="'.$indx.'"></li>';
							$indx++;
						}
				}
			} ?> 
        </ol>
        
	
        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner">
        
		  <?php
			$sql_testimonals    = "SELECT * FROM testimonials where is_active=1";
			$result_testimonals = $db->query($sql_testimonals);
			if ($result_testimonals->num_rows > 0) {		
				$indx = 0;
				while ($row_testimonals = $result_testimonals->fetch_assoc()) {
						if($indx == 0){
							echo '<div class="item active">';
								echo '<blockquote>';
									echo '<div class="row">';										
										echo '<div class="col-sm-3 text-center">';
											echo '<img class="img-circle" src="assets/images/testimonial/'.$row_testimonals["photo"].'" alt="" style="width: 100px;height:100px;">';
										echo '</div>';
										echo '<div class="col-sm-9">';
											echo '<p>'.$row_testimonals["remarks"].'</p>';
										echo '<small>'.$row_testimonals["username"].'</small>';
										echo '</div>';
									echo '</div>';
								echo '</blockquote>';
							echo '</div>';
							$indx++;
						}else{
							echo '<div class="item">';
								echo '<blockquote>';
									echo '<div class="row">';										
										echo '<div class="col-sm-3 text-center">';
											echo '<img class="img-circle" src="assets/images/testimonial/'.$row_testimonals["photo"].'" alt="" style="width: 100px;height:100px;">';
										echo '</div>';
										echo '<div class="col-sm-9">';
											echo '<p>'.$row_testimonals["remarks"].'</p>';
										echo '<small>'.$row_testimonals["username"].'</small>';
										echo '</div>';
									echo '</div>';
								echo '</blockquote>';
							echo '</div>';
							$indx++;
						}
				}
			} ?> 
		
        </div>
        
        <!-- Carousel Buttons Next/Prev -->
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
      </div>                          
    </div>
  </div>
    </div>
  </section>
  <?php include 'common/footer.php';?>
 </body>
 <script>
 // When the DOM is ready, run this function
$(document).ready(function() {
  //Set the carousel options
  $('#quote-carousel').carousel({
    pause: true,
    interval: 8000,
  });
});
</script>
</html>