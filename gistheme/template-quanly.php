<?php
/*
Template Name: Quản Lý
*/
?> <?php get_header(); ?> 
<?php get_header(); 
    if (is_user_logged_in()){
        echo '<div class="content-ql">';
        echo do_shortcode('[wpcfu_form]');
        echo do_shortcode('[show_table]');
        echo '</div>';
    }
    else{
        echo '<div class="notice-ql"><h3>Quyền quản lý mới được truy cập trang này</h3>';
        echo 'Vui lòng đăng nhập ';
        echo '<a href="/login">tại đây</a>';
        echo '</div>';
    }

?> 

<?php
get_footer();
