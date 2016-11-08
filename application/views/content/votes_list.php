
<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <li class="active"><a class="btn btn-primary" href="<?= base_url() ?>admin_voting/create">Add Vote</a></li>
            <li><a class="btn btn-success" href="<?= base_url() ?>admin_voting">Vote lists</a></li>
            <li><a class="btn btn-info" href="<?= base_url() ?>voting">Show Votes</a></li>
        </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>


        <div class="table-responsive table-bordered" >
            <!-- Notification boxes -->
            <?php if($this->session->flashdata('success_msg')){ ?>
                <p class="alert alert-info">
                    <?php echo $this->session->flashdata('success_msg'); ?>
                </p>
            <?php } ?>
            <?php if ($categories == FALSE) : ?>
                <p class="alert alert-danger"><a href="javascript:void(0)" class="close"></a><b>Alert!</b > no votes available<p>
            <?php else : ?>
                <form method="post" action="<?= base_url() ?>admin_voting/operation/">
                    <!-- Example table -->
                    <table class="table table-striped" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                        <tr>
                            <th><input type="checkbox" name="check_nf2" id="selectall" /></th>
                            <th>Order</th>
                            <th >title</th>
                            <th >created</th>
                            <th >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $counter = 1;
                        foreach ($categories as $cat) :
                            ?>
                            <tr <?php
                            if ($counter % 2 == 1) {
                                echo "class='odd'";
                            }
                            ?>>
                                <td><input type="checkbox" name="check_nf[]" value="<?= $cat['dv_id'] ?>" id="group" /></td>
                                <td class="align-center"><?php echo $counter; ?></td>
                                <td>
                                    <a href="<?= base_url() ?>admin_voting/edit/<?= $cat['dv_id']; ?>"><?= $cat['dv_title'] ?></a>
                                </td>
                                 <td><?= date('d-m-Y', $cat['dv_created']) ?></td>
                                <td class="align-center">
                                    <a href="<?= base_url() ?>admin_voting/edit/<?= $cat['dv_id']; ?>"><img
                                            src="<?= base_url() ?>global/admin/images/edit-icon.png" width="16"
                                            height="16" title="edit" alt="edit"/></a>&nbsp;&nbsp; | &nbsp;&nbsp;
                                    <a href="<?= base_url() ?>admin_voting/remove/<?= $cat['dv_id']; ?>"
                                       class="tool boxStyle" onclick="return confirm('do you want to delete ?');"><img
                                            src="<?= base_url() ?>global/admin/images/delete-icon.png" width="16"
                                            height="16" title="remove" alt="remove"/></a>
                                    &nbsp;&nbsp; | &nbsp;&nbsp;
                                    <?php if ($cat['dv_state'] == 0): ?>
                                        <a href="<?= base_url() ?>admin_voting/activate_vote/<?= $cat['dv_id']; ?>"><img src="<?= base_url() ?>global/admin/images/tick-circle.gif" width="16" height="16"  title="<?php echo $this->lang->line('act'); ?>" alt="خيارات النشر" /></a>
                                    <?php else : ?>
                                        <a href="<?= base_url() ?>admin_voting/deactivate_vote/<?= $cat['dv_id']; ?>"><img src="<?= base_url() ?>global/admin/images/minus-circle.gif" width="16" height="16" title="<?php echo $this->lang->line('inact'); ?>" alt="خيارات النشر النشر" /></a>
                                    <?php endif; ?>
                                </td>

                            </tr>
                            <?php
                            $counter++;
                        endforeach;
                        ?>
                        </tbody>
                    </table>


                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
