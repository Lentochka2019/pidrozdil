<?php
  $post = $wp_query->post;
    $par=$post->post_parent;  
get_header('');
?>
<div id="content" class="site-content" role="main">
<h3 style="background:transparent; margin-top: 20px; margin-bottom: 20px">Керівництво</h3>
<h2>Ректорат</h2>
<div class="content-rectorat" >
<?$true_args = array('post_type' => 'pidrozdily','posts_per_page' => -1, 'order'=>'ASC','tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'pidrozdil',
				'terms' => 'rectorat',
				'field' => 'slug'
			)
		) );
$loop = new WP_Query( $true_args  );
if ( $loop->have_posts() ) : 
 while ( $loop->have_posts() ) : $loop->the_post();
?>

<div class="rectorat-struct">
<?
$post_id = get_the_ID();
$small_title=trim( get_post_meta( $post_id, 'small_title', true));
$pib=trim( get_post_meta( $post_id, 'pib', true));
$posada=trim( get_post_meta( $post_id, 'posada', true));
$stupin=trim( get_post_meta( $post_id, 'stupin', true));
$adresa=trim( get_post_meta( $post_id, 'adresa', true));
$phone=trim( get_post_meta( $post_id, 'phone', true));
$mail=trim( get_post_meta( $post_id, 'mail', true));
$site=trim( get_post_meta( $post_id, 'site', true));
$wiki=trim( get_post_meta( $post_id, 'wiki', true));
$site_donntu=trim( get_post_meta( $post_id, 'site_donntu', true));
 $selectOb = get_post_custom_values('select_ob', $post->ID)[0];
?>
<div class="photo-str">
<?	if ( has_post_thumbnail() ) 
{
	 $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
   echo '<a  class="fancybox" href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
   the_post_thumbnail('middle');
   echo '</a>';
} ?>
</div>
<div class="dannie">

<?if(!empty($pib)):?> <p><b><?echo $pib;?></b></p>	 <?endif;?>
<?if(!empty($stupin)):?> <p><?echo $stupin;?></p> <?endif;?>
<?if(!empty($posada)): ?><p><a href="<?echo the_permalink();?>"><?echo $posada; ?></a></p><?endif;?>
<br>
<br>
<?if(!empty($adresa)):?> 
<p>	<b><?php  echo $selectOb; ?>:</b> <?php  echo $adresa; ?></p>	<?endif;?>
<?if(!empty($phone)):?>
						<p><b>	Номер(и) телефону:</b> 	<?php  echo $phone; ?></p>	
						<?endif;?>
						<?if(!empty($mail)):?>
						<p><b>	E-mail:</b> <?echo do_shortcode('[mailto]'. $mail .'[/mailto]');?></p>	
						<?endif;?>
						<?if(!empty($site)):?>
						<p>	<b>Wiki-сторінка: </b> <a href="<?php  echo $site; ?>">	CV</a></p>	
						<?endif;?>
					
</div>



</div>
 <?endwhile; endif; wp_reset_postdata();?>
</div>
<?	$custom_field_keys = array('Інститути та факультети','Загальноуніверситетські підрозділи','Відокремлені структурні підрозділи');?>
	<h2>Керівники структурних підрозділів</h2>
					
				<table style="width: 90%;" cellspacing="0" cellpadding="0">
					<tr>
					<td><b>Підрозділ</b></td>	
					<td><b>Керівник</b> </td>	
					<td><b>Кабінет</b></td>
					</tr>
	<?	//	print_r($custom_field_keys);
			foreach ( $custom_field_keys as $key => $value ) 
			{
				$valuet = trim($value);
				if ( '_' == $valuet{0} )
					continue;
			
			
			$true_args = array('post_type' => 'pidrozdily', 'post_parent'=>0,'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC','tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'pidrozdil',
				'terms' => $value,
				'field' => 'name'
			)
		) );
			
				$loop = new WP_Query( $true_args  );
				
				if ( $loop->have_posts() ) :
//print_r($loop);
$value1=trim( get_post_meta( $post_id, 'pidrozdil', true));
			?>

<tr>
					<td colspan="3"><?echo "<b>" . $value . "</b>";?></td>	
					
					</tr>
					<?  while ( $loop->have_posts() ) : $loop->the_post(); 
//echo $loop->the_post();
$post_id = get_the_ID();
$pib=trim( get_post_meta( $post_id, 'pib', true));
$small_title=trim( get_post_meta( $post_id, 'small_title', true));
$posada=trim( get_post_meta( $post_id, 'posada', true));
$stupin=trim( get_post_meta( $post_id, 'stupin', true));
$adresa=trim( get_post_meta( $post_id, 'adresa', true));
$phone=trim( get_post_meta( $post_id, 'phone', true));
$mail=trim( get_post_meta( $post_id, 'mail', true));
$site=trim( get_post_meta( $post_id, 'site', true));
$wiki=trim( get_post_meta( $post_id, 'wiki', true));
$site_donntu=trim( get_post_meta( $post_id, 'site_donntu', true));
 $selectOb = get_post_custom_values('select_ob', $post->ID)[0];
?>

						
<?if(!empty($pib)):?>

					<tr>
					<td>
<?$terms = get_the_terms( $post->ID, 'pidrozdil' );
if( $terms ){
	$term = array_shift( $terms );
	// теперь можно можно вывести название термина
//	echo $term->term_id;
}?>

<?if(!empty($small_title)):?>
						<a href="<?echo the_permalink();?>">	<?php echo $small_title;?></a>
						<?else:?>
								<a href="<?echo the_permalink();?>">	<?echo  the_title();?></a>
						<?endif;?>



					
					
						
					</td>
					<td>
						<?if(!empty($pib)):?>
							<?php echo "<span class='posada-text'>".$posada."</span> ".$pib;?>
						
						<?endif;?>
					</td>
					<td><?echo $adresa; ?></td>
					
										
					</tr>
					<?php endif;  endwhile;?> 
				
				
				<?else:?>
					<table class="bez-granic">
						<tr>
							<td >
								<p style="background: #eeeff1;text-align: center;padding: 1em;margin: 20px 50px;font-weight: bold;"> 	За вашим запитом не знайдено варіантів</p>
							</td>
						</tr>
					</table>
				<?php endif;
			
				 wp_reset_postdata();
			} 

 ?>


</table>
				
			

  </div>
<? get_footer('');?>
