<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = 'Homepage';
?>
<link href="/web/css/admin.css?<?=time()?>" rel="stylesheet"> 
<div class="site-index">

    <div class="body-content">

        <h1>Resolved List</h1>

        <table class="table table-hover" id= "table">
			<tr>
				<td>Case No.</td>
				<td>User</td>
				<td>Recipe Title</td>
				<td>Description</td>
				<td>Reporter Name</td>
				<td>Time</td>
				<td>Handled</td>
			</tr>
			<?php foreach($report as $key => $reports): ?>
			<tr class="active">
				<td><?= $count++ ?></td>
				<td><?= Html::encode($username[$reports->reportUserId])?>
					<?php if ($active[$reports->reportUserId] != 0):?>
						<a href= "banuser?userId=<?= $reports->reportUserId ?>"><img src="../img/profileImg/banbutton.jpg" class="img-rounded" alt="ban button" title="ban button" width="20px" height="20px"  style="filter:alpha(opacity=50); opacity:.50; "></a>
						<?php else: ?>
						<a href= "unbanuser?userId=<?= $reports->reportUserId ?>"><img src="../img/profileImg/unbanbutton.png" class="img-rounded" alt="unban button" title="unban button" width="20px" height="20px"  style="filter:alpha(opacity=50); opacity:.50; "></a>
						<?php endif; ?>
						</td>
				<td><?= Html::encode($recipeTitle[$reports->recipeId])?><?php if ($recipeTitle[$reports->recipeId]!='Recipe deleted'):?><a href= "removerecipeb?recipeId=<?= $reports->recipeId ?>"><img src="../img/profileImg/banbutton.jpg" class="img-rounded" alt="delete button" title="delete button" width="20px" height="20px"  style="filter:alpha(opacity=50); opacity:.50; "><?php endif; ?></a></td>
				<td><?= Html::encode($reports->description)?></td>
				<td><?= Html::encode($reporter[$reports->reporterId])?></td>
				<td><?= $reports->time?></td>
				<td> <a href= "resolvedcase?caseId=<?= $reports->caseNo ?>" ><img src="../img/profileImg/handlebutton.jpg" class="img-rounded" alt="handle button" title="handle button" width="20px" height="20px"  style="filter:alpha(opacity=50); opacity:.50; "></a></td>
			</tr>
			<?php endforeach;?>
		</table>

    </div>
</div>
