<script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script>
<link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Expenses</b></h4>
                <div class="row">
                <form method="post" action="<?= edit_expenses;?>">
                    <input type="hidden" name="id" value="<?php if(isset($IdBy->id)){echo $IdBy->id; }?>">
                    <div class='col-lg-4'>
                        <div class="form-group">
                            <label for="">Name of expenses</label>
                               
                            <input type="text" name="expenses_name" value="<?php if(isset($IdBy->expenses_name)){echo $IdBy->expenses_name; }?>" placeholder="Name Of Expenses" class="form-control " style="">
                            <span class="text-danger"><?= form_error('expenses_name');?></span>
                        </div>
                    </div>
                    
                    <div class='col-lg-4'>
                        <div class="form-group">
                            <label for="">Amount of expenses</label>
                               
                            <input type="text" name="expenses_amount" value="<?php if(isset($IdBy->expenses_amount)){echo $IdBy->expenses_amount; }?>" placeholder="Expenses Amount"  class="form-control ">
                            <span class="text-danger"><?= form_error('expenses_amount');?></span>
                        </div>
                    </div>
                    <div class='col-lg-4'>
                        <div class="form-group">
                            <label for="">Date of Expenses</label>
                               
                            <input type="date" id="datepicker" name="expenses_date" value="<?php if(isset($IdBy->expenses_date)){echo $IdBy->expenses_date; }?>" class="form-control ">
                            <span class="text-danger"><?= form_error('expenses_date');?></span>
                        </div>
                    </div>
                    <div class='col-lg-12'>
                        <div class="form-group">
                            <label for="">Reason of expenses </label>
                              
                            <textarea type="text" id="datepicker" name="remark"  class="form-control "><?php if (isset($IdBy->remark)) {echo $IdBy->remark;}?></textarea>
                            
                        </div>
                    </div>
                     <button type="submit" class="btn btn-info">Add</button>
                </div>
                </form>