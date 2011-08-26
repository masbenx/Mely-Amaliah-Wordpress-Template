		<!-- grab footer -->
		<div id="footer" class="clearfix">
			<div class="frame">
				<div class="bar">
					<p class="copyright">&copy; 2011 <a href="http://masbenx.net">Mely Amaliahs WordPress Theme</a></p>
					<div class="menu-footer-container">
						<ul id="menu-footer" class="footernav">
							<?php menu_list('footer-menu', 'menu-item menu-item-type-taxonomy menu-item-object-category'); ?>
						</ul>
					</div>
				</div><!--bar-->
			</div><!--frame-->
		</div><!--footer-->
	</div><!-- wrapper -->

	<!-- google analytics code -->
		
	<script type="text/javascript">
		/* <![CDATA[  */   	
		$(document).ready(function(){		
			
			// Fade Icons
			$("img.a").hover(
				function() {
				$(this).stop().animate({"opacity": "0"}, "fast");
				},
				function() {
				$(this).stop().animate({"opacity": "1"}, "fast");
			});
			
			// Fade Hover Links
			$(".entry-title a").hover(
			function() {
				$(this).animate({"opacity": ".7"}, "fast");
					},
				function() {
					$(this).animate({"opacity": "1"}, "fast");
			});
			
			// Remove Margins
			$(".flickrPhotos > li:nth-child(2n)").addClass('remove-margin');
			$('#sidebar > div').last().addClass('last-sidebar');
			
			// Sticky Sidebar
			$('#sticky > div').last().addClass('last-sidebar');
			$("#sticky").sticky({topSpacing:90,className:'sticky'});
			
			$(".lightbox").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#ddd',
				'overlayOpacity'	: 0.9,
				'titleShow'			: 'false',
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'speedIn' : '1400', 
				'speedOut' : '1400',
				'easingIn' : 'easeOutBounce',
				'easingOut' : 'easeOutBounce'
			});
			
			// Quicksand Filtering
			var $data = $(".filter-posts").clone();
			
			$('.filter-list li').click(function(e) {
				J(".filter li").removeClass("active");	
				// Use the last category class as the category to filter by.
				var filterClass= $(this).attr('class').split(' ').slice(-1)[0];
				
				if (filterClass == 'all-projects') {
					var $filteredData = $data.find('.project');
				} else {
					var $filteredData = $data.find('.project[data-type=' + filterClass + ']');
				}
				$(".filter-posts").quicksand($filteredData, {
					duration: 700,
					easing: 'jswing',
					adjustHeight: 'dynamic'
				});		
				$(this).addClass("active"); 			
				return false;
			});
		});
		/* ]]> */  
	</script>
	<?php wp_footer(); ?>
	
</body>
</html>