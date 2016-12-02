<section class="search-area">
  <button type="button" name="activesearch" id="closeSearch">Search</button>
  <div class="popup-nav">
    <button type="button" name="closesearch" id="closeSearch">Close</button>
    <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
      <label class="screen-reader-text" for="s">Search for:</label>
      <input type="text" name="s" value="" id="s" placeholder="Search">
      <input type="submit" value="submit" id="searchsubmit">
    </form>
  </div>
</section>
