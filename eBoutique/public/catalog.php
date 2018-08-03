<?php
include('../app/template/global/header.php');
?>
<section class="container-fluid">
	<div class="row">
		<?php
		echo Article::getAllArticles($bdd);
		?>
	</div>
</section>
<?php
include('../app/template/global/footer.php');
?>