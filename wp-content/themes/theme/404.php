<?php


/**
 * Условие для редиректа на страницу всех категорий.
 * $return_url - получаю текущий Url страницы
 * stristr() - проверяет, есть ли в текущем Url странице слово products.
 * В условии говорится что если есть слово products то сделай перенаправление на страницу категорий
 * если нет то открой страницу 404
 */
$return_url = $_SERVER['REQUEST_URI'];
if(stristr($return_url, 'products') == true) {
    header('Location: /riza/categories/');
    exit();
}else{
    get_header();
}


?>
<section class="sec_404">
	<div class="left_404">
		<div class="title_404">
			SORRY!
		</div>
		<p class="text_404">
			Unfortunately, we couldn't find the page you were looking for. Please try again later or check the URL
		</p>
		<div class="buttons_404">
			<a href="/">
			<div class="btn">Go Back</div>
			</a>
			<a href="/categories">
			<div class="btn btn_2">Categories</div>
			</a>
		</div>
	</div>
	<div class="rigth_404">
		<div class="big_404">
			404
		</div>
	</div>	
</section>
<?php
get_footer();
?>