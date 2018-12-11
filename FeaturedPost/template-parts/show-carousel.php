<!-- slick slide -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">




<?php 
	// if -1 then popup category not found and else then display cat checked 
	if ($cate == -1)
	{
		echo "<h2>Category not found !!</h2>";
	}
	else
	{ ?>
		
		<?php global $wp_query; $wp_query->in_the_loop = true; ?>
		<h1 class="fp_title">Featured Post</h1>

		<div id="featured_post_wapper">
			<div class="owl-carousel">			
				<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
					<?php 
						if ($check_all_list == 1)
						{
							update_post_meta( get_the_id(), 'meta-checkbox', 'yes' );
						} 
					?>
					<div class="wap_item">
						<div class="_item">
							<div class="text-center center-block post">
								<div class="img">
									<?php the_post_thumbnail(); ?>
								</div>						
								<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								
							</div>	
						</div>
						
					</div>
						
				<?php endwhile; wp_reset_postdata(); ?>									
			</div>
		</div>
	<?php }

?>

	
	
<!-- mystyle -->
<style>
		#featured_post_wapper{
			background: #f1f1f1 !important;
			padding: 10px 0px !important;
		}
		._item{
			width: 94% !important;
			margin: auto !important;
			background: #fff !important;
		}
		.img{
			overflow: hidden !important;
		}
		.img img{
			width: 100% !important;
			height: 90% !important;
			object-fit: cover !important;
			transition: 0.4s !important;
		}
		.img:hover{
			opacity: 0.6 !important;
		}
		.img:hover img{
			transform: scale(1.1) !important;
		}
		.owl-nav{
			text-align: center !important;
		}
		.owl-nav button{

		}
		.owl-nav button span{
			content:"" !important;
		}
		.owl-nav button {
			    background: #7d7b7b !important;
			    height: 10px !important;
			    width: 10px !important;
			    margin: 5px !important;
			}
		.owl-nav button span {
		    display: none !important;
		}
		.wap_item{
			width: 90% !important;
			margin: auto !important;
		}
		button.owl-prev.disabled {
		    background: #73cf67 !important;
		}
		.wap_item .post h5{
			margin-top:5px !important;
			padding: 0px !important;
			padding: 5px !important;
			box-shadow: none !important;

		}
		.wap_item .post h5 a{
			text-decoration: none !important;
		    font-family: arial;
		    box-shadow: none !important;
		    text-align: center !important;
		    font-weight: normal !important;
		    font-size: 18px;
		    color: #181818 !important;
		    letter-spacing: 0px !important;
		    text-transform: capitalize !important;
		    border: none !important;

		}
		.wap_item .post h5 a:hover{
			color: #007bff !important;
			transition: 0.4s;
		}
		.post p{
			padding:10px !important;
		}
</style>
 <!-- slick slide -->
 <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	<script>
		$(document).ready(function(){
		  $('.owl-carousel').owlCarousel({
			    loop:true,
			    margin:10,
			    responsiveClass:true,
			    responsive:{
			        0:{
			            items:1,
			            nav:false
			        },
			        600:{
			            items:2,
			            nav:false
			        },
			        1000:{
			            items:3,
			            nav:false,
			            loop:false
			        }
			    }
			})
		});
	</script>



	