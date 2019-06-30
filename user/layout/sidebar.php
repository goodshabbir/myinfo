<?php
$id = $this->session->userdata['user']['id'];

$obj = new welcome_model();

$record = $obj->getsinglerow(TBL_USER, ['id' => $id]);
//echo '<pre>';print_r($record);die;
?>
<div id="sidebar-menu">
<div style="text-align:center" >
<img src="http://myinformation.in/myinformation/assets/front/images/logo.png" height="auto" width="50%"alt="">
 </div>             
    <ul>
        <li class="text-muted menu-title"></li>
        
        <?php if($record->status !=NULL && $record->status==1) { 
            
        ?>
        <li class="has_sub">
            <a href="<?= site_url('user'); ?>" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span></a>
        </li>
        <?php if($record->profile_type ==1 || $record->profile_type==0) { ?>
        <li class="has_sub">
            <a href="<?= my_information;?>" class="waves-effect"><i class="fa fa-info"></i> <span>My Information</span></a>
            
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-inr"></i> <span>Income & Expenses</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">
                <li><a href="<?= other_income; ?>">Income List</a></li>
                <li><a href="<?= expenses; ?>">Expenses List</a></li>
            </ul>
        </li>
        <li class="has_sub">
            <a href="<?= all_document;?>" class="waves-effect"><i class="fa fa-file"></i> <span>View All Documents</span></a>
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-share-alt"></i> <span>Share And Earn</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">
                <li><a href="<?= steps_income;?>">My Step Income (Date Wise)</a></li>
                <li><a href="<?= matching_incomes;?>">My Matching Income (Date Wise)</a></li>
                <li><a href="downline">My Step Plan Wise Downline List</a></li>
                <li><a href="downline">My Matching Plan Wise Downline List</a></li>
                <li><a href="<?= tree ?>">My Step Plan Wise Tree Report</a></li>
                <li><a href="<?= tree ?>">My Matching Plan Wise Tree Report</a></li>\
                <li><a href="mydirect">My Direct Downline Wise Earning Report</a></li>
                <li><a href="downline">My Total Downline Wise Earning Report</a></li>
                <li><a href="<?= create_pin; ?>">Create Epin</a></li>
                <li><a href="<?= transfer_epin; ?>">Transfer Epin List</a></li>
                <li><a href="<?= level ?>">Level Of Member</a></li>
                <li><a href="<?= activation ?>">Upgrade My Plan</a></li>
                <li><a href="<?= site_url('user/tree_demo'); ?>">Demo Tree</a></li>
            </ul>
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-image"></i> <span>Special Biodata</span><span class="menu-arrow"></span></a>
            <ul class="list-unstyled">
                <li>
                    <a href="<?= special;?>" class="waves-effect subdrop"><span> Special Biodata</span></a>
                </li> 
                 <li>
                    <a href="<?= resume;?>" class="waves-effect subdrop"><span> Job Related Biodata</span></a>
                </li>
                <li>
                    <a href="<?= special;?>" class="waves-effect subdrop"><span>Marriage Ralated Biodata</span></a>
                </li>
                <li>
                    <a href="<?= profile_matching;?>" class="waves-effect subdrop"><span> Marriage Matching Biodata</span></a>
                </li>
                
                <!-- <li>
                    <a href="<?= profile_matching;?>" class="waves-effect subdrop"><span> Matching Profile </span></a>
                </li>
                <li> 
                    <a href="<?= resume;?>" class="waves-effect subdrop"><span>Download Resume </span></a>
                </li> -->
            </ul>
        </li>
        <li class="has_sub">
            <a href="<?= setting ?>" class="waves-effect"><i class="fa fa-key"></i> <span>Change My Password</span></a>
            
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file"></i> <span>Promotional Materials</span> </a>
            
        </li>
        <li class="has_sub">
            <a href="<?=base_url('user/refferal_signup?id=') . $this->session->userdata['user']['sponsor_id'];?>" class="waves-effect"><i class="fa fa-users"></i> <span>New Registration</span></a>
            
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-envelope"></i> <span>Message Box</span></a>
            
        </li>
        
        <li class="has_sub">
            <a href="<?= logout;?>" class="waves-effect"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
            
        </li>
        <!--
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i> <span>Profile Manager</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">

                <li><a href="<?= profiles ?>">Profile Detail</a></li>
                <li><a href="<?= setting ?>">Setting</a></li>
            </ul>
        </li>
        
        <li class="has_sub">      
            <a href="javascript:void(0);" class="waves-effect subdrop"><i class="fa fa-file"></i><span>Unemployed Profile </span></a>
        </li>						
        <li class="has_sub">      
            <a href="<?= profile_matching;?>" class="waves-effect subdrop"><i class="fa fa-user"></i><span> Matching Profile </span></a>
        </li>
         <li class="has_sub">      
            <a href="<?= plan;?>" class="waves-effect subdrop"><i class="fa fa-inr"></i><span>Plan </span></a>
        </li>
        
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-level-down"></i> <span>Level</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">
                <li><a href="<?= level ?>">Level Of Member</a></li>
                <li><a href="javascript:void(0)">Direct Member</a></li>
            </ul>
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cubes"></i> <span>Geneoalogy</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">
                <li><a href="<?= tree ?>">Graphical View</a></li>
                <li><a href="downline">My Downline</a></li>
                <li><a href="mydirect">My Direct</a></li>
            </ul>
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i> <span>Id Activation</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">

                <li><a href="<?= activation ?>">Activation/Upgration Self</a></li>
                <li><a href="<?= upgration ?>">Activation/Upgration Other</a></li>
             </ul>
        </li>
         <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-history"></i> <span>ePin History</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">
                <li><a href="<?= create_pin; ?>">Create Pin</a></li>
                <li><a href="<?= transfer_epin; ?>">Transfer ePin List</a></li>
                
            </ul> 
        </li> 
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-info-circle"></i> <span>Income</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">
                <li><a href="<?= steps_income; ?>">Step Income</a></li>
                <li><a href="<?= matching_incomes; ?>">Matching Income</a></li>
            </ul> 
        </li> 
        
        -->
        <?php } elseif($record->profile_type==2){?>
            <li class="has_sub">
            <a href="<?php //= all_document;?>" class="waves-effect"><i class="fa fa-user"></i> <span>Member Type</span></a>
        </li>
            <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-inr"></i> <span>Income & Expenses</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">
                <li><a href="<?= steps_income; ?>">Step Income</a></li>
                <li><a href="<?= matching_incomes; ?>">Matching Income</a></li>
                <li><a href="<?= edit_expenses; ?>">Expenses</a></li>
                <li><a href="<?= expenses; ?>">Expenses List</a></li>
                <li><a href="<?= other_income; ?>">Other Income</a></li>
            </ul>
        </li>
        <li class="has_sub">
            <a href="<?= all_document;?>" class="waves-effect"><i class="fa fa-file"></i> <span>View All Documents</span></a>
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-share-alt"></i> <span>Share And Earn ggg</span> <span class="menu-arrow"></span> </a>
            <ul class="list-unstyled">


                <li><a href="<?= level ?>">Level Of Member</a></li>
                <li><a href="<?= tree ?>">Graphical View</a></li>
                <li><a href="downline">My Downline</a></li>
                <li><a href="mydirect">My Direct</a></li>
                <li><a href="<?= create_pin; ?>">Create Epin</a></li>
                <li><a href="<?= transfer_epin; ?>">Transfer ePin List</a></li>
                <li><a href="<?= activation ?>">Upgrade My Plan</a></li>
               
            </ul>
        </li>
        <li class="has_sub">
            <a href="<?= special;?>" class="waves-effect"><i class="fa fa-image"></i> <span>Special Biodata</span></a>
        </li>
        <li class="has_sub">
            <a href="<?= setting ?>" class="waves-effect"><i class="fa fa-key"></i> <span>Change My Password</span></a>
            
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file"></i> <span>Promotional Materials</span> </a>
            
        </li>
        <li class="has_sub">
            <a href="<?=base_url('user/refferal_signup?id=') . $this->session->userdata['user']['sponsor_id'];?>" class="waves-effect"><i class="fa fa-users"></i> <span>New Registration</span></a>
            
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-envelope"></i> <span>Massage Box</span></a>
            
        </li>
        
        <li class="has_sub">
            <a href="<?= logout;?>" class="waves-effect"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
            
        </li>
        <?php } }else{ ?>
        <li class="has_sub">
            <a href="<?= logout; ?>" class="waves-effect"><i class="fa fa-arrow-right"></i> <span> Logout </span></a>
        </li>
        <li class="has_sub">
            <li><a href="<?= create_pin; ?>"> Epin List</a></li>
        </li>
         
        <?php } ?>

    </ul>
    <div class="clearfix"></div>
</div>
