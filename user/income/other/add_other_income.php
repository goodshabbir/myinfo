<script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script>
<link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Other Income</b></h4>
                <div class="row">
                <form method="post" action="<?= edit_other_income;?>">
                    <input type="hidden" name="id" value="<?php if(isset($IdBy->id)){echo $IdBy->id; }?>">
                    <div class='col-lg-3'>
                        <div class="form-group">
                            <label for="">Source of income</label>
                               
                            <input type="text" name="income_source" value="<?php if(isset($IdBy->income_source)){echo $IdBy->income_source; }?>" placeholder="Source Of Income" class="form-control " style="">
                            <span class="text-danger"><?= form_error('income_source');?></span>
                        </div>
                    </div>
                    <div class='col-lg-3'>
                        <div class="form-group">
                            <label for="">Title Of income </label>
                               
                            <input type="text" name="income_name" value="<?php if(isset($IdBy->income_name)){echo $IdBy->income_name; }?>" placeholder="Name Of Income" class="form-control " style="">
                            
                        </div>
                    </div>
                    <div class='col-lg-3'>
                        <div class="form-group">
                            <label for="">Amount of income</label>
                               
                            <input type="text" name="incom_amount" value="<?php if(isset($IdBy->incom_amount)){echo $IdBy->incom_amount; }?>" placeholder="Amount Of Income"  class="form-control ">
                            <span class="text-danger"><?= form_error('incom_amount');?></span>
                        </div>
                    </div>
                    <div class='col-lg-3'>
                        <div class="form-group">
                            <label for="">Date of income</label>
                             <script>
                                var datepicker = new ej.calendars.DatePicker({ width: "255px" });
                                datepicker.appendTo('#datepicker');
                            </script>  
                            <input type="date" id="datepicker" name="date" value="<?php if(isset($IdBy->date)){echo $IdBy->date; }?>" class="form-control ">
                            <span class="text-danger"><?= form_error('date');?></span>
                        </div>
                    </div>
                    <div class='col-lg-12'>
                        <div class="form-group">
                            <label for="">Reason of Income</label>
                              
                            <textarea type="text" id="datepicker" name="remark"  class="form-control "><?php if (isset($IdBy->remark)) {echo $IdBy->remark;}?></textarea>
                            
                        </div>
                    </div>
                     <button type="submit" class="btn btn-info">Add</button>
                </div>
                </form>