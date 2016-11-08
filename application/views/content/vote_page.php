<style>
    /* vote */
    .box-vote {
        background: #fafafa;
        -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.18);
        -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.18);
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.18);
        border-radius: 3px;
        float: right;
        width: 100%;
    }

    .box-vote-head {
        background: #922c39;
        font-size: 20px;
        color: #ffffff;
        float: right;
        padding: 20px;
        font-family: 'Droid Arabic Kufi', sans-serif;
        width: 100%;
    }

    .box-vote-content {
        float: right;
        padding: 20px;
        width: 100%;
    }

    .box-vote-content label {
        font-family: 'Droid Arabic Kufi', sans-serif;
        font-size: 20px;
        color: #5e5e5e;
        font-weight: bold;
    }

    .box-vote-content .radio input[type=radio] {
        margin-top: 10px;
    }

    /* footer */
</style>
<script type="text/javascript">

    $(document).ready(function () {
        $("#voting_categories").submit(function () {

            var dvId = $("#dv_id").val();
            var v_column = $('input[name="v_column"]:checked').val();
            var v_data = $('input[name="v_data"]').val();
            var sendData = {"v_column": v_column,"v_data": v_data};

            $.ajax({
                url: "<?= base_url(); ?>voting/voted/" + dvId,
                type: "post",
                data: sendData,
                success: function (data) {
                    $("#box-vote").fadeOut(1000);
                    $("#vote-results").html(data).delay(1000).fadeIn(1000);
                }
            });

            return false;

        })

    })

</script>
<!-- Vote Start -->
        <?php if($columns !=null){?>
        <?= form_open_multipart('voting/voted/'.$vote->dv_id, array('id' => 'voting_categories'))?>

        <div  class="col-md-4 margin-top-30">
            <div id="box-vote" class="box-vote">

                <div class="box-vote-head"><?= $vote->dv_title?></div>
                <div class="box-vote-content">
                    <input type="hidden" id="dv_id" value="<?= $vote->dv_id; ?>"/>
            <?php foreach($columns as $key=>$value):  ?>
            <div class="radio">
                <label class="voting_blog">
                <input name="v_column" type="radio" value="<?= $key ?>,<?= $value ?>" checked="checked" >
                <?= $value ?>
                </label>
            </div>
              <?php  endforeach;  ?>
              <button type="submit" name="votes"  class="btn btn-custom btn-block">Vote Now!</button>
                </div>

            </div>
        </div>
        </form>
    <?php }else{?> <p class="notice error">sorry,there no votes</p>  <?php } ?>
<!-- Vote End -->

<div id="vote-results" style="display:none;"></div>