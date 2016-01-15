<div id="kboard-customer-editor">
	<form method="post" action="<?php echo $url->set('mod', $_GET['mod'])->set('uid', $_GET['uid'])->toString()?>">
		<div class="kboard-header"></div>
		
		<div class="kboard-attr-row kboard-attr-title">
			<label class="attr-name"><?php echo __('Password', 'kboard')?></label>
			<div class="attr-value"><input type="password" name="password"></div>
		</div>
		
		<div class="kboard-control">
			<div class="left">
				<?php if($content->uid):?>
				<a href="<?php echo $url->set('uid', $content->uid)->set('mod', 'document')->toString()?>" class="kboard-customer-button-small"><?php echo __('Document', 'kboard')?></a>
				<?php endif?>
				<a href="<?php echo $url->toString()?>" class="kboard-customer-button-small"><?php echo __('List', 'kboard')?></a>
			</div>
			<div class="right">
				<button type="submit" class="kboard-customer-button-small"><?php echo __('Password confirm', 'kboard')?></button>
			</div>
		</div>
	</form>
</div>