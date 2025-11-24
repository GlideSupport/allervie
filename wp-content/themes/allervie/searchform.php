<form action="<?php echo site_url(); ?>" method="get" class="search-form">
	<input type="text" name="s" id="search" placeholder="Search …" class="search-field" value="<?php the_search_query(); ?>" />
	<input type="submit" class="search-button" value="Search" />
</form>
