
	<div class='addcomments'>
		<div class='spacebetween'>
			<div class='nickname'><?php echo $data2["username"];?></div>
			<div class='time'><?php echo $data2["created_at"];?></div>
		</div>
		<hr>
		<div class='content'><?php echo htmlspecialchars($data2["content"], ENT_QUOTES,'utf-8');?></div>
