
<?php
$output = shell_exec('python img_resize.py uploads/IMG_3251.jpeg');

?>

<img src="uploads/IMG_3251.jpeg" alt="">
<img src="<?php echo $output; ?>" alt="">