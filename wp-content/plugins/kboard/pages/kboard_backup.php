<?php if(!defined('ABSPATH')) exit;?>
<div class="wrap">
	<div class="kboard-header-logo"></div>
	<h1>
		<?php echo __('KBoard : 백업 및 복구', 'kboard')?>
		<a href="http://www.cosmosfarm.com/products/kboard" class="add-new-h2" onclick="window.open(this.href);return false;"><?php echo __('홈페이지', 'kboard')?></a>
		<a href="http://www.cosmosfarm.com/threads" class="add-new-h2" onclick="window.open(this.href);return false;"><?php echo __('커뮤니티', 'kboard')?></a>
		<a href="http://www.cosmosfarm.com/support" class="add-new-h2" onclick="window.open(this.href);return false;"><?php echo __('고객지원', 'kboard')?></a>
		<a href="http://blog.cosmosfarm.com/" class="add-new-h2" onclick="window.open(this.href);return false;"><?php echo __('블로그', 'kboard')?></a>
	</h1>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for=""><?php echo __('백업파일 다운로드', 'kboard')?></label></th>
				<td>
					<form action="<?php echo admin_url('admin-post.php')?>" method="post">
						<?php wp_nonce_field('kboard-backup-download', 'kboard-backup-download-nonce');?>
						<input type="hidden" name="action" value="kboard_backup_download">
						<input type="submit" class="button-primary" value="<?php echo __('백업파일 다운로드', 'kboard')?>">
						<p class="description"><?php echo __('백업파일을 다운로드 받습니다. 파일은 xml 파일이며 복구하기를 통해 백업된 상태로 되돌릴 수 있습니다.', 'kboard')?></p>
					</form>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for=""><?php echo __('백업파일 선택', 'kboard')?></label></th>
				<td>
					<form action="<?php echo admin_url('admin-post.php')?>" method="post" enctype="multipart/form-data">
						<?php wp_nonce_field('kboard-restore-execute', 'kboard-restore-execute-nonce');?>
						<input type="hidden" name="action" value="kboard_restore_execute">
						<input type="file" name="kboard_backup_xml_file" accept=".xml">
						<input type="submit" class="button-primary" value="<?php echo __('복구하기', 'kboard')?>">
						<p class="description"><?php echo __('xml 파일을 선택하고 복구하기 버튼을 누르세요. 지금까지의 데이터는 삭제되고 복원파일 데이터를 입력합니다.', 'kboard')?></p>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</div>