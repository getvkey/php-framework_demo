<div class="container">
	<p>Home Page</p>

	<?php foreach ($news as $val) : ?>
		<h3><?php echo $val['title']; ?></h3>
		<p><?php echo $val['description']; ?></p>
		<hr>
	<?php endforeach; ?>
</div>