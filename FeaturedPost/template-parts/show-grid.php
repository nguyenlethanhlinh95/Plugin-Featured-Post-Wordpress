<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


<h1 class="fp_title">Featured Post</h1>


<div id="featured_post_wapper">
	<div class="container">
		<?php global $wp_query; $wp_query->in_the_loop = true; ?>
		<div class="row">
		<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>	
					<?php 
						if ($check_all_list == 1)
						{
							update_post_meta( get_the_id(), 'meta-checkbox', 'yes' );
						} 
					?>	
				<div class="col-md-4 col-sm-6 text-lg-left item">
					<div class="post_img static small">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail(); ?>
						</a>
					</div>
					<div class="post_header">
						<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					</div>
					
					<div class="post_detail post_date">
						<span class="post_info_author">
							<?php the_author(); ?>
						</span>
						<span class="post_info_date">
							Posted On <?php echo get_the_date( 'd-m-Y' ); ?>
						</span>
					</div>
					<?php  ?>
				</div>			
		<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</div>



<style>
	.fp_title{
		margin-left: 42px !important;
	}
	#featured_post_wapper .post_img a img{
		width: 100% !important;
		height: 90% !important; 
		object-fit: cover !important;
	}
	.post_img{
		margin-bottom: 8px !important;
	}
	.post_header{
		margin-bottom: 10px !important;
	}
	.post_header h5{
	    font-family: Montserrat, Helvetica, Arial, sans-serif !important;
	    text-transform: none !important;
	    font-weight: 600 !important;
	    letter-spacing: 0px !important;
	        margin: 0px !important;
	}
	.post_header h5 a{
		color: #111111 !important;
		text-decoration: none !important;
		box-shadow: none !important;
		font-weight: normal !important; 
		border: none !important;
		    
	}
	.post_header h5 a:hover{
		color:#006BA0 !important;
		text-decoration: none !important;
	}

	.post_info_author{
		    color: #111111 !important;
		    font-weight: bold !important;
		    opacity: 0.6 !important;
		        font-family: arial;
   			 font-size: 12px;
	}
	.post_info_date{
		color: #999 !important;
		letter-spacing: 1px !important;
		margin-left: 5px !important;
		margin-bottom: 10px !important;
		    font-family: arial;
    	font-size: 12px;
	}
	.item{
		margin-bottom: 3% !important;
	}
</style>