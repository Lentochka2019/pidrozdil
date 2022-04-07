<?php get_header(''); ?>
<?php setPostViews(get_the_ID()); 
$tit= esc_html( get_the_title() ) ;
//echo $tit;
?>

<section id="primary" class="site-content clearfix">
    <div class="middle-menu">
        <div><?php wp_nav_menu(array('theme_location' => 'middle', 'fallback_cb' => '')); ?></div>
    </div>

<?  $pidrozdil=get_the_terms($post->ID, 'pidrozdil'); $tupe_p= $pidrozdil[0]->slug;  if (is_array($pidrozdil)) {  $pidrozdil = array_shift($pidrozdil);	} ?>
<?php if (get_bloginfo('language')=='uk')
			{?>
			<p id="breadcrumbs"><span><span typeof="v:Breadcrumb"><a href="http://donntu.edu.ua/" property="v:title" rel="v:url">ДонНТУ</a> / <span rel="v:child" typeof="v:Breadcrumb"><a href="https://donntu.edu.ua/kerivnictvo" property="v:title" rel="v:url"><?echo $pidrozdil->name; ?></a> / <?php  
			if (is_subpage()) {?>
			   <span rel="v:child" typeof="v:Breadcrumb"><a href="<?php echo get_permalink( $post->post_parent );?>"><?php echo get_the_title($post->post_parent); ?> </a> </span> / <span class="breadcrumb_last"> <?php echo get_the_title() ?> </span>
			<?} else {?>
			    <span class="breadcrumb_last"> <?php echo get_the_title() ?> </span>
			<?}
			?></span></span></span></p><?}else{$tit="News";?>
			<p id="breadcrumbs"><span><span typeof="v:Breadcrumb"><a href="http://donntu.edu.ua/" property="v:title" rel="v:url">DonNTU</a> / <span rel="v:child" typeof="v:Breadcrumb"><a href="http://donntu.edu.ua/en/structure" property="v:title" rel="v:url">Structure</a> / <span class="breadcrumb_last"><?the_title();?>
			</span></span></span></span></p><?}?>
<div id="content" role="main" class="two-column">

<div class="left">

<?php while (have_posts()) : the_post(); ?>

				

				<?
			function struct_info($id)
			{
				
					$mypages = get_pages( [
						'child_of' => $id,
						'sort_column' => 'post_date',
						'post_type'    => 'pidrozdily',
						'sort_order' => 'desc'
					] );
					?>
				<div>
					<?if (!empty($mypages)):?>
					<p>Структура факультету:</p>
					<?
					foreach( $mypages as $page ) {
						// пропустим страницу без контента
						
						$pib=trim( get_post_meta( $page->ID, 'pib', true));
							$posada=trim( get_post_meta( $page->ID, 'posada', true));
							$stupin=trim( get_post_meta( $page->ID, 'stupin', true));
							$site_donntu=trim( get_post_meta( $post_id, 'site_donntu', true));			
						
						
						?>
						<p><a href="<?php echo  get_permalink( $page->ID ); ?>"><?php echo $page->post_title; ?></a> <?php echo $posada.' - '.$stupin.'&nbsp;'.$pib.'</p>';?>
						
						<?php
					}endif;?>
				</div>	
			<?
			}?>


		<?		
		$order=trim( get_post_meta($post->ID, 'pib', true));
		$posada=trim( get_post_meta($post->ID, 'posada', true));
		$stupin=trim( get_post_meta($post->ID, 'stupin', true));
		$foto = get_post_meta($post->ID, 'foto_ker', true);
		
		
		$pibz1=trim( get_post_meta($post->ID, 'zam1', true));
		$posadaz1=trim( get_post_meta($post->ID, 'posada', true));
		$stupinz1=trim( get_post_meta($post->ID, 'stupinz1', true));
		$fotoz1 = get_post_meta($post->ID, 'foto_zam1', true);
		
		$pibz2=trim( get_post_meta($post->ID, 'zam2', true));
		$posadaz2=trim( get_post_meta($post->ID, 'posada', true));
		$stupinz2=trim( get_post_meta($post->ID, 'stupinz2', true));
		$fotoz2 = get_post_meta($post->ID, 'foto_zam2', true);
		
		$adresa=trim( get_post_meta($post->ID, 'adresa', true));
		$phone=trim( get_post_meta($post->ID, 'phone', true));
		$mail=trim( get_post_meta($post->ID, 'mail', true));
		$site=trim( get_post_meta($post->ID, 'site', true));
		$selectOb = get_post_custom_values('select_ob', $post->ID)[0];
		$wiki=trim( get_post_meta( $post->ID, 'wiki', true));
		$site_donntu=trim( get_post_meta( $post->ID, 'site_donntu', true));
		$fb = trim(get_post_meta($post->ID, 'fb', true));
		$inst = trim(get_post_meta($post->ID, 'inst', true));
		$small_title = trim(get_post_meta($post->ID, 'small_title', true));
		$telegramm = trim(get_post_meta($post->ID, 'telegramm', true));
		$telegramm1 = trim(get_post_meta($post->ID, 'telegramm1', true));
		?>
		<h3><?php the_title(); ?></h3>
		
		
<?if	($tupe_p=='struct'):?>	
		
									<div class="titul-faculty">	
										<div class="t1">
											<?if ( has_post_thumbnail() ): 
											 $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
												echo '<a  class="fancybox" href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
												the_post_thumbnail('medium');
												echo '</a>';
											endif;?>
										</div>
										<div class="dannie">
																			<p><b>Адреса:</b> пл. Шибанкова, 2,
																				м. Покровськ, Донецької обл., Україна, 85300.</p>
																			<? if (!empty($adresa)) : ?>

																				<p> <b><?php echo $selectOb; ?>:</b> <?php echo $adresa; ?> </p> <? endif; ?>
																			<? if (!empty($phone)) : ?>
																				<p><b> Номер(и) телефону:</b> <?php echo $phone; ?></p>
																			<? endif; ?>
																			<? if (!empty($mail)) : ?>
																				<p><b> E-mail:</b> <? echo do_shortcode('[mailto]' . $mail . '[/mailto]'); ?></p>
																			<? endif; ?>

																			<? if (!empty($site)) : ?>
																				<p><b> Сайт:</b> <a href="<? echo $site; ?>"><? echo $site; ?></a></p>
																			<? else : ?>
																				<? if (!empty($site_donntu)) : ?>
																					<p><b> Сайт:</b><a href="<? echo $site_donntu; ?>"> <? echo $site_donntu; ?></a></p>
																				<? endif; ?>
																			<? endif; ?>
																			<? if (!empty($wiki)) : ?>
																				<p> <b>Wiki-сторінка: </b> <a href="<?php echo $wiki; ?>"> <?php echo $small_title; ?></a></p>
																			<? endif; ?>
																			<? if (!empty($fb)) : ?>
																				<p> <b>Cторінка на FB: </b> <a href="<?php echo $fb; ?>"> <?php echo $fb; ?></a></p>
																			<? endif; ?>
																			<? if (!empty($inst)) : ?>
																				<p> <b>Instagram: </b> <a href="<?php echo $inst; ?>"> <?php echo $inst; ?></a></p>
																			<? endif; ?>

																			<? if (!empty($telegramm)) : ?>
																				<p> <b>Telegram: </b> <a href="<?php echo $telegramm; ?>"> <?php echo $telegramm; ?></a></p>
																			<? endif; ?>
																			<? if (!empty($telegramm1)) : ?>
																				<p> <b>Telegram для абітурієнтів: </b> <a href="<?php echo $telegramm1; ?>"> <?php echo $telegramm1; ?></a></p>
																			<? endif; ?>

										</div>
									</div>
		
			
			
			<div class="tabs">
				<ul>
				<li id="t1"><a name="t1"> 
				Cтруктура
				</a>
				</li>
				<li id="t2"><a name="t2"> 
				Структура
				</a>
				</li>
				</ul>	
					<div>
						<?//shtatt_info($posada,$stupin,$order);?>
						
						<section class="staf_card">
							<?if(!empty($order)):?>
								<div class="staf_card_member" >
								<?if(!empty($foto)):?> <div class="staf_card__thumb"><img src="<?echo $foto;?>"></div><?endif;?>
								
											<?
																				
											if(!empty($posada)):?><p><b><?php  echo $posada; ?>:</b></p><?endif;?>
															<?if(!empty($stupin)):?><span><small><?php  echo $stupin; ?></small> </span><?endif;?>
															<?if(!empty($order)):?><span><?php  echo $order; ?></span><?endif;?>
								</div>
							<?endif;?>
							<?if(!empty($pibz1)):?>
								<div class="staf_card_member" >
								<?if(!empty($fotoz1)):?> <div class="staf_card__thumb"><img src="<?echo $fotoz1;?>"></div><?endif;?>
							
								<p><b>Перший заступник декана:</b></p>
															<?if(!empty($stupinz1)):?><span><small><?php  echo $stupinz1; ?></small> </span><?endif;?>
															<?if(!empty($pibz1)):?><span><?php  echo $pibz1; ?></span><?endif;?>
								</div>
							<?endif;?>
							<?if(!empty($pibz2)):?>
								<div class="staf_card_member" >
									<?if(!empty($fotoz2)):?> <div class="staf_card__thumb"><img src="<?echo $fotoz2;?>"></div><?endif;?>
								<p><b>Заступник декана:</b></p>
															<?if(!empty($stupinz2)):?><span><small><?php  echo $stupinz2; ?> </small></span><?endif;?>
															<?if(!empty($pibz2)):?><span><?php  echo $pibz2; ?></span><?endif;?>
								</div>
							<?endif;?>
						</section>

						
						<?//	echo do_shortcode( '[struct2]' );?>
					</div>
					<div>
						<section class="struct">						
							<?$id=$post->ID; struct_info($id);?>
						</section>
					</div>
			</div>
							<? 
							$post_obj = $wp_query->get_queried_object();
							if (get_bloginfo('language') == 'uk'):$post_slug = $post_obj->post_name . '-uk';else:$post_slug = $post_obj->post_name; endif;					

									$true_args = array(
										'post_type' => 'specialty',
										'posts_per_page' => -1 ,
										'struct_spec' => '' . $post_slug
									);
									$query = new WP_query($true_args);
									//print_r($query);
									?>
									<?php if ($query->have_posts()) : ?>
										<h3>Напрями підготовки:</h3>
										<p>Здійснюється підготовка бакалаврів і магістрів за наступними спеціальностями:</p>
										<div class="around-tabl c111">
											<table class="speciality">
												<tr>
													<th>Спеціалізація (освітня програма)</th>
													<th>Кафедра</th>
													<th>Youtube</th>
												</tr>
												<?php while ($query->have_posts()) : $query->the_post(); ?>
												<tr>
													<td class="sp-name"><a href="<? echo get_post_permalink() ?>"><? the_title() ?></a></td>
														<td><? $terms = get_the_terms($post->ID, 'struct_spec');//print_r($terms);														
															if ($terms):																
																foreach ($terms as $struc) {
																	if ($struc->parent!= "0"):																
																		if ($struc->description != ""):echo "<div> " . $struc->description . "</div>";else: echo "<p> " . $struc->name . "</p>";endif;
																	endif;
																}																
																													
															// теперь можно можно вывести название термина
																echo $term->description;
															endif; ?>
														</td>													
														<td class="sp-fs">
															<? $video = trim(get_post_meta($post->ID, 'video', true)); ?>
															<? if (!empty($video)) : ?>
																<div class="video"><a href="<? echo $video; ?>" target="_blank" title="Переглянути відео"><i class="fa fa-youtube fa-2x" style="color: red;"></i></a></div>
															<? else : ?>
																<p> - </p>
															<? endif; ?>
														</td>
												</tr>
												<?php endwhile;///вывод специализации ?>
											</table>
										</div>
									<? endif; ?>
									<? wp_reset_postdata(); ?>
<?endif;?>

						
	
		<?the_content();?>					
</div>
<div class="right">

<?if	($tupe_p!='struct'):?>
			<h4>	<?if(!empty($posada)):?><span><?php  echo $posada; ?>: </span><?endif;?>
							<?if(!empty($stupin)):?><span><?php  echo $stupin; ?> </span><?endif;?>
							<?if(!empty($order)):?><span><?php  echo $order; ?></span><?endif;?>
						</h4>
						
						<?if ( has_post_thumbnail() ) 
{
	 $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
   echo '<a  class="fancybox" href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
   the_post_thumbnail('medium');
   echo '</a>';
}?>
<div class="clearfix"></div>
<?if(!empty($wiki)):?>
						<p>	<b>Wiki-сторінка: </b> <a href="<?php  echo $wiki; ?>">	<?php  echo $order; ?></a></p>	
						<?endif;?>						
						
												<?if(!empty($phone)):?>
						<p><b>	Номер телефону:</b> 	<?php  echo $phone; ?></p>	
						<?endif;?>
						<?if(!empty($adresa)):?>
						<p>	<b>Кабінет:</b> <?php  echo $adresa; ?></p>	
						<?endif;?>
						<?if(!empty($mail)):?>
						<p><b>	E-mail:</b> <?echo do_shortcode('[mailto]'. $mail .'[/mailto]');?></p>	
						<?endif;?>
						<?if(!empty($site_donntu)):?>
						<p><b>	Сайт ДонНТУ:</b><a href="<?echo $site_donntu;?>"> <?echo $site_donntu;?></a></p>	
						
						<?endif;?>
						<?if(!empty($site)):?>
						<p><b>	Сайт:</b> <a href="<?echo $site;?>"><?echo $site;?></a></p>	
						<?endif;?>
	<?endif;?>					
						
						
   <?php endwhile;  wp_reset_postdata(); ?>
	
	
	<?$tru_args = array('post_type' => 'pidrozdily','posts_per_page' => -1,  'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'pidrozdil',
				'terms' => $tit,
				'field' => 'name'
			)
			
		), 
'orderby' => 'title',
'order'   => 'ASC',
		
		
		);
		
$loop = new WP_Query( $tru_args  );


if ( $loop->have_posts() ) :?>

<ul>
<? while ( $loop->have_posts() ) : $loop->the_post();
?>

<li>
<?
$post_id = get_the_ID();
$site_donntu=trim( get_post_meta( $post_id, 'site_donntu', true));
?>
	<?if(!empty($site_donntu)):?><a href="<?echo $site_donntu;?>"><?the_title()?></a><?else:?><a href="<?echo get_post_permalink()?>"><?the_title()?></a><?endif;?>			
</li>

 

 <?endwhile;?>
 </ul>



 <? endif; 
 
 $oldMetas = get_post_meta($post->ID, PIDROZDIL_DOCUMENTI_META_ID, false);
//print_r($oldMetas);
 if($oldMetas):
 echo "<h3>Документи</h3>"; 
 ?>
 <ul>
  <?  foreach ($oldMetas as $om) {
        // выводим блоки item-address с уже добавленными документами
       // pidrozdil_documenti_form_body($om);
	   $attachment_id = attachment_url_to_postid($om);
	  // $array = wp_get_attachment_metadata($attachment_id);
	  
	   ?>
	  
		<li> <?php the_attachment_link(  $attachment_id,  true); ?></li>
    <?}?>
 
 </ul>

<?endif; wp_reset_postdata();?>
	
	
 	
</div> 
 </div>   				

 <div class="clearfix"></div>
	 <?php wp_reset_query(); ?> 
              <!-- Похожие записи -->
                <?php $tags = wp_get_post_tags($post->ID);
				if ($tags) {
                    $tag_ids = array();
                    foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                    $args = array(
                        'tag__in' => $tag_ids, // Сортировка происходит по тегам (меткам)
						'paged'=>get_query_var('paged'),
                        'orderby' => 'date', // Добавляем условие сортировки рандом (случайный подбор)
                        'caller_get_posts' => 1, // Запрещаем повторение ссылок
                        'post__not_in' => array($post->ID),
						'posts_per_page'=>10
                    );

                    $my_query = new wp_query($args);
                    if ($my_query->have_posts()) {
                        echo '<div class="related">';
                        $currentLang = pll_current_language('slug');
                        if ($currentLang == 'ru') {
                            echo '<h3>Материалы по теме:</h3>';
                        } elseif ($currentLang == 'uk') {
                            echo '<h3>Статті по темі</h3>';
                        } elseif ($currentLang == 'en') {
                            echo '<h3>More</h3>';
                        }

                        
                        while ($my_query->have_posts()): $my_query->the_post();
                            ?>
							
							<div class="struct-new" style="width:100%">
				<h4 ><a href="<?echo the_permalink();?>" ><?php the_title(); ?></a></h4>
				<div class="m_info_arhiv">
					<span><i class="fa fa-calendar"></i> <?php echo get_the_date('j-n-Y'); ?></span> &nbsp;&nbsp; <?php the_category(' , ', 'multiple'); ?> &nbsp;&nbsp;<span><i class="fa fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?> &nbsp;&nbsp;</span>
				</div>
				<div class="post" style="background:transparent;">
					<div class="postcnt">
						<a href="<?echo the_permalink();?>"><?  if ( has_post_thumbnail() ) {
						     the_post_thumbnail('middle'); 
						} else {?>
						 <img alt="ДонНТУ" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?echo bloginfo('template_url');?>/images/logo_news.jpg"> <?}?>
						</a>
						<div class="ex">
							<?php the_excerpt(); ?>
						</div>
					</div>
					<div class="postall">
						<p style="float:left"><a href="<?echo the_permalink();?>">Читати далі</a></p>
					</div>
				</div>
			</div>                      
                    <?php endwhile;?>
					 <?php if(function_exists('wp_paginate')) {
    wp_paginate('range=4&anchor=2&nextpage=Next&previouspage=Previous');
}else{echo "1";} ?>	   
						<?php 
						
												
						if (  $my_query->max_num_pages > 1 ) : ?>
			    <script>
			    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
			    var true_posts = '<?php echo serialize($my_query->query_vars); ?>';
			    var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
			    var max_pages = '<?php echo $my_query->max_num_pages; ?>';
			    </script>
			    <div id="true_loadmore" style="margin-bottom:50px">Переглянути ще</div>
				<?else:echo error;?>
			<?php endif; ?>
                   </div>
               <? }
                wp_reset_query();
            }
            ?>
                <!-- Похожие записи /-->
				
				<!-- Для охорони праці-->
			<?	if ($tit=='Відділ охорони праці'):   echo '<h3>Статті по темі</h3>';
			
			  $my_query = new wp_query('category_name=op');
			    while ($my_query->have_posts()): $my_query->the_post();?>
											<div class="struct-new" style="width:100%">
				<h4 ><a href="<?echo the_permalink();?>" ><?php the_title(); ?></a></h4>
				<div class="m_info_arhiv">
					<span><i class="fa fa-calendar"></i> <?php echo get_the_date('j-n-Y'); ?></span> &nbsp;&nbsp; <?php the_category(' , ', 'multiple'); ?> &nbsp;&nbsp;<span><i class="fa fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?> &nbsp;&nbsp;</span>
				</div>
				<div class="post" style="background:transparent;">
					<div class="postcnt">
						<a href="<?echo the_permalink();?>"><?  if ( has_post_thumbnail() ) {
						     the_post_thumbnail('middle'); 
						} else {?>
						 <img alt="ДонНТУ" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?echo bloginfo('template_url');?>/images/logo_news.jpg"> <?}?>
						</a>
						<div class="ex">
							<?php the_excerpt(); ?>
						</div>
					</div>
					<div class="postall">
						<p style="float:left"><a href="<?echo the_permalink();?>">Читати далі</a></p>
					</div>
				</div>
			</div>  
				
			<?	endwhile;
			  if(function_exists('wp_paginate')) {
    wp_paginate('range=4&anchor=2&nextpage=Next&previouspage=Previous');
}else{echo "1";}    
			
			
			if (  $my_query->max_num_pages > 1 ) : ?>
			    <script>
			    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
			    var true_posts = '<?php echo serialize($my_query->query_vars); ?>';
			    var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
			    var max_pages = '<?php echo $my_query->max_num_pages; ?>';
			    </script>
			    <div id="true_loadmore" style="margin-bottom:50px">Переглянути ще</div>
				<?//else:echo error;?>
			<?php endif;                
                
			
			endif;
			?>
				
						
	</div>	

</section>

<?php get_footer(''); ?>