<?php
// Fallback requerido por WordPress. El tema usa page templates.
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        the_content();
    }
}
