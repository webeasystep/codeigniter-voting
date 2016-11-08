<div id="middleContent">
    <!-- Bread Crumb Start -->
    <div class="breadCrumb">
        <span><a class="home" href="<?= base_url(); ?>"></a></span>
        <span class="current">Votes</span>
    </div>
    <!-- Bread Crumb End -->
    <?php if(isset($rows) && $rows != NULL && $mainTotal != 0){?>
        <?php  foreach($rows as $row){       ?>
            <div class="block lrg">
                <div class="title">Vote results</div>
                <div class="info">The number who participated in the Vote yet<?php echo $total; ?> voter</div>
                <div class="content text">
                    <ul class="voting-results">

                        <li><span class="answer"><?php echo $row->dv_choose_one; ?></span><span class="precent"><?php echo substr($total_one, 0, 4); ?>%</span><span class="indicator" style="width:<?php echo $total_one; ?>px">&nbsp;</span></li>

                        <li><span class="answer"><?php echo $row->dv_choose_two; ?></span><span class="precent"><?php echo substr($total_two, 0, 4); ?>%</span><span class="indicator" style="width:<?php echo $total_two; ?>px">&nbsp;</span></li>

                        <li><span class="answer"><?php echo $row->dv_choose_three; ?></span><span class="precent"><?php echo substr($total_three, 0, 4); ?>%</span><span class="indicator" style="width:<?php echo $total_three; ?>px">&nbsp;</span></li>

                        <?php $four=$row->dv_choose_four; if($four){ ?> <li><span class="answer">
                        <?php echo $row->dv_choose_four; ?></span><span class="precent"><?php echo substr($total_four, 0, 4); ?>%</span><span class="indicator" style="width:<?php echo $total_four; ?>px">&nbsp;</span></li><?php } ?>
                    </ul>
                </div>
            </div>
    <?php } // end of each  ?>
    <?php }else{?>
        <p class="notice error">Sorry but there are so far no Vote</p>
    <?php } ?>
</div>

