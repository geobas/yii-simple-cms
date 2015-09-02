<?php /* @var $this RecentArticlesWidget */ ?>

<ul>
<?php foreach ( $this->getData() as $article ): ?>
		<div class="author">
			User <?php echo $article->user->username; ?> added <?php echo CHtml::link($article->title, array('view', 'id'=>$article->id)); ?>
		</div>
		<br />
<?php endforeach; ?>
</ul>