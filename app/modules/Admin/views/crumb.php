<div class="panel panel-default panel-border-color panel-border-color-primary" style="margin-bottom:-10px">
<div class="panel-body">
<h4><?= $title; ?></h4>
<span class="panel-subtitle">
<ol class="breadcrumb page-head-nav">
<li class=""><a href="<?php echo base_url(ADMINURI); ?>dashboard">Dashboard</a></li>
<?php $url = ""; foreach($crumbdata as $index=>$c){ if($index != 0 ) {$url = $url."/".slugifyToString($c); } else{ $url = slugifyToString($c); } ?>
<li class="<?php if(count($crumbdata) == $index+1) { echo  'active';} ?>">
    <a href="<?php echo base_url(ADMINURI.$url);  ?>"><?=$c?></a></li>
<?php } ?>
</ol>
</span>
</div>
</div>
<div class="clearfix"></div>