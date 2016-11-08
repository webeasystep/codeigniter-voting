<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="fields[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field">' +
            '<i class="fa fa-minus btn btn-danger" aria-hidden="true"></i> </a></div>'; //New input field html
        var x = 1; //Initial field counter is 1
        $(addButton).click(function(e){ //Once add button is clicked
            e.preventDefault();
            if(x < maxField){ //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>
<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <li class="active"><a class="btn btn-primary" href="<?= base_url() ?>admin_voting/create">Add Vote</a></li>
            <li><a class="btn btn-success" href="<?= base_url() ?>admin_voting">Vote lists</a></li>
            <li><a class="btn btn-info" href="<?= base_url() ?>voting">Show Votes</a></li>
        </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-6 col-md-offset-2 main">
        <h1 class="page-header">Edit Vote</h1>

        <?= form_open_multipart('admin_voting/edit/' . $vote->dv_id, array('class' => 'form-horizontal')) ?>
        <div class="form-group">
            <label class="control-label col-sm-4">Vote Title</label>
            <input class="form-control " name="dv_title"
                   value="<?= set_value('dv_title', $vote->dv_title) ?>"/>
            <?php echo form_error('dv_title'); ?>
        </div>

            <div class="field_wrapper">

            <?php $counter = 1 ;foreach($columns as $key=>$value){ ?>
                <div>
                    <input type="text" name="fields[]" value="<?= set_value($key, $value) ?>"/>
                    <a href="javascript:void(0);" class='remove_button' title="Add field">
                        <i class="fa fa-minus btn btn-danger" aria-hidden="true"></i>
                    </a>
                </div>
        <?php $counter++; } ?>
                <div>
                    <input type="text" name="fields[]" value=""/>
                    <button id="add" class="btn btn-sm btn-success add_button"><i class="fa fa-plus " aria-hidden="true"></i></button>
                </div>
            </div>
        <br />
        <label class="control-label col-sm-4">Active ?</label>
        <input type="checkbox" name="dv_state" id="chk1" value="1" <?php echo set_checkbox("dv_state", "1", ($vote->dv_state == 1) ? TRUE : FALSE); ?> />
        <br />

        <input class="btn btn-primary" type="submit" name="save" value="Edit Vote"/>

        <?php echo form_close(); ?>
    </div>
</div>

