<form role="search" method="get" class="search-form" action="http://localhost/wordpress/">
    <div class="search-field--wrap">
        <input type="search" class="search-field--input" placeholder="Search&hellip;" value="<?php echo get_search_query(); ?>" name="s" />
        <div class="search-field--icon">
            <i class="fas fa-search"></i>
        </div>
    </div>
    <input type="submit" class="search-submit" value="Search" />
</form>