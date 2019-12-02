<h1>
	Test
</h1>

<p>
	<a href="<?php echo site_url(); ?>">accueil</a>
	<br />
	
	<a href="<?php echo site_url('test'); ?>">accueil</a> du test
	<br />
	
	<a href="<?php echo site_url('test/accueil'); ?>">page secrète</a>
	<br />
	
	<a href="<?php echo site_url(array('test', 'accueil')); ?>"><?= site_url() ?>()</a>
	<br />

	<a href="<?php echo site_url(array('test', 'accueil')); ?>"><?= current_url() ?></a>
	<br />

	<a href="<?php echo site_url(array('test', 'accueil')); ?>"><?= base_url() ?></a>

</p>