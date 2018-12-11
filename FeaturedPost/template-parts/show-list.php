<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">





<h1 class="fp_title">Featured Post</h1>

<div id="featured_post_wapper">
	<div class="container">
		
			<?php global $wp_query; $wp_query->in_the_loop = true; ?>
				<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
					<?php 
						if ($check_all_list == 1)
						{
							update_post_meta( get_the_id(), 'meta-checkbox', 'yes' );
						} 
					?>
					<div class="row">
						<div class="col-lg-12">
							<div class="row item">
								<div class="col-lg-12 img">
									<?php the_post_thumbnail(); ?>
								</div>
								<div class="col-lg-12 content_left">
									<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt(); ?>

									<!-- <span class="author"><?php the_author(); ?></span>
									<span class="date"><?php echo get_the_date(); ?></span> -->
									
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
		
	</div>
</div>
<!-- Get post News Query -->



<style>
	@media (max-width: 991px)
	{
		.content_left h3{
			margin-top: 10px!important;
		}
	}
	.fp_title{
		margin-left: 43px!important;
	}
	#featured_post_wapper .item{
		margin-bottom: 30px!important;
		background: #f4f4f4 !important;
	}
	#featured_post_wapper .item img{
		width: 100%!important;
		height: 300px!important;
		object-fit: cover!important;
		margin: 10px auto !important;
	}
	.content_left{
		margin-top: 0px!important;
	}
	.content_left h3{
		font-family: sans-serif, Arial, sans-serif !important;
	    letter-spacing: 0px !important;
	        font-size: 22px !important;
	        margin-top: 5px !important;
	}
	.content_left h3 a{
		color: #111 !important;
		    font-family: arial !important;
		    text-decoration: none !important;
		    font-size: 22px !important;
		    font-weight: normal !important;
		    box-shadow: none !important;
		    border: none !important;
	}
	.content_left h3 a:hover{
		color: #007bff !important;
		transition: 0.4s;
	}
	.content_left p{
		font-family: arial !important;
		font-size: 16px !important;
	}
	.author{
		font-weight: 600 !important;
    	margin-right: 10px !important;
    	color: #111;
	}
	.date{
		color: #999 !important;
		letter-spacing: 2px !important;
	}
</style>