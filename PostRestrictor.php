<?php  

/* 

Plugin Name: Post Restrictor 

Plugin URI: http://CygnusH33L.tk/restrict-posts 

Description: Plugin for restricting posts from public view that are posted in a category called 'private', Does this by requiring the user to be logged in to view. 

Author: CygnusH33L

Version: 1.2

Author URI: http://CygnusH33L.tk/ 

License: GPL2



##########################################################################



Copyright 2012  CygnusH33L  (Contact me at : http://cygnush33l.tk/)



    This program is free software; you can redistribute it and/or modify

    it under the terms of the GNU General Public License, version 2, as 

    published by the Free Software Foundation.



    This program is distributed in the hope that it will be useful,

    but WITHOUT ANY WARRANTY; without even the implied warranty of

    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

    GNU General Public License for more details.



    You should have received a copy of the GNU General Public License

    along with this program; if not, write to the Free Software

    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

if(!function_exists("postRestrictorMenu") && !function_exists("postRestrictorOptionspage")) {

add_action('admin_menu','postRestrictorMenu');

function postRestrictorMenu() {
add_options_page("Post Restrictor Settings", 'Post Restrictor', 8, 'admin.php?page=postRestrictorOptions', 'postRestrictorOptionspage');
}


function postRestrictorOptionspage() {
?>
<div class=”wrap”>
<h2>Post Restrictor Settings</h2>
<p>To use just create a category called 'private' then any posts posted into this category will be hidden from public view (not logged in users).</p>
<form action="options.php" method="post" id="restrictor_category">
<h3><label>Category</label>
<input type="text" id="postRestrictor_category" name="postRestrictor_category" value=""/></h3>
<p><input type="submit" name="submit" value="Save" /></p>
</form>
</div>
<?php
}

}

/* to avoid name collisions check this function is not already defined. */
if (!function_exists("post_restrictor")) {

/* start function */
function post_restrictor($query) {

	/* check if user is not logged in */
	if(!is_user_logged_in()) {
					
			/* get category id for private, here you change the category name or even add names to a new vairable then add them to the query */
			$cate = get_cat_id('private');
				
				/* new query */
        		$query->set( 'cat', '-'.$cate );

	} // endif user not logged in

} // end function

/* hook into 'pre_get_posts' */
add_action( 'pre_get_posts', 'post_restrictor' );

} // end collision check



?>