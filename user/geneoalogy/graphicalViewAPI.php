

<style>
    /*Now the CSS*/
    * {margin: 0; padding: 0;}

    .graphicalView ul {
        padding-top: 20px; position: relative;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    .graphicalView li {
        float: left; text-align: center;
        list-style-type: none;
        position: relative;
        padding: 20px 4px 0 0px;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    /*We will use ::before and ::after to draw the connectors*/

    .graphicalView li::before, .graphicalView li::after{
        content: '';
        position: absolute; top: 0; right: 50%;
        border-top: 1px solid #ccc;
        width: 50%; height: 20px;
    }
    .graphicalView li::after{
        right: auto; left: 50%;
        border-left: 1px solid #ccc;
    }

    /*We need to remove left-right connectors from elements without
    any siblings*/
    .graphicalView li:only-child::after, .graphicalView li:only-child::before {
        display: none;
    }

    /*Remove space from the top of single children*/
    .graphicalView li:only-child{ padding-top: 0;}

    /*Remove left connector from first child and
    right connector from last child*/
    .graphicalView li:first-child::before, .graphicalView li:last-child::after{
        border: 0 none;
    }
    /*Adding back the vertical connector to the last nodes*/
    .graphicalView li:last-child::before{
        border-right: 1px solid #ccc;
        border-radius: 0 5px 0 0;
        -webkit-border-radius: 0 5px 0 0;
        -moz-border-radius: 0 5px 0 0;
    }
    .graphicalView li:first-child::after{
        border-radius: 5px 0 0 0;
        -webkit-border-radius: 5px 0 0 0;
        -moz-border-radius: 5px 0 0 0;
    }

    /*Time to add downward connectors from parents*/
    .graphicalView ul ul::before{
        content: '';
        position: absolute; top: 0; left: 50%;
        border-left: 1px solid #ccc;
        width: 0; height: 20px;
    }

    .graphicalView li a{
        /*border: 1px solid #ccc;
        padding: 5px 10px;*/
        text-decoration: none;
        color: #fff;
        font-family: arial, verdana, tahoma;
        font-size: 9px;
        display: inline-block;
        /*font-weight: bold;*/
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        padding:10px;
    }

    /*Time for some hover effects*/
    /*We will apply the hover effect the the lineage of the element also*/
    .graphicalView li a{
        background: #003264;
        color: #fff;
        /*border: 1px solid #f05050;*/

    }
	.graphicalView li a{

		background: #003264;
        color: #fff;
	} ul li a{

		background: #003264;
        color: #fff;
	}
    /*Connector styles on hover*/
    .graphicalView li a:hover+ul li::after,
    .graphicalView li a:hover+ul li::before,
    .graphicalView li a:hover+ul::before,
    .graphicalView li a:hover+ul ul::before{
        border-color:  #94a0b4;
    }

    /*Thats all. I hope you enjoyed it.
    Thanks :)*/
    .test + .tooltip > .tooltip-inner {
        background-color: #9e371e;
        color: #FFFFFF;
        border: 1px solid 9e371e;
    //padding: 15px;
    //font-size: 20px;
    }
    .test + .tooltip.top > .tooltip-arrow {
        border-top: 5px solid #9e371e !important;
    }
</style>
<?php
$userid=$this->uri->segment(3);
if($userid!=null){
    $sponserid=$userid;
    $getID=$this->db->get_where('tree',array('self_id'=>$sponserid))->row();
    $id=$getID->user_id;
}
if($id){
    $this->db->select('tree.user_id, user.*');
    $this->db->from('user');
    $this->db->join("tree","tree.user_id=user.id","left");
    $this->db->where('tree.user_id',$id);
    $name=$this->db->get()->row();
    //echo "<pre>"; print_r($name);
    $this->db->where(array('self_id'=> $sponserid));
    $getdata= $this->db->get('tree')->row();


    ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <a href="<?php echo site_url("front/graphicalView/".$sponserid); ?>" class="btn btn-primary" >Home</a>

                <div class="graphicalView" style="    overflow-x: scroll; padding-bottom: 26px;" >
                    <ul style="width:882px;">
                        <li>
                                  <?php $getdata->is_active==1 ? $png ="green.png" : $png = "red.png";  ?>
                            <a href="<?php echo site_url('frontgraphicalView/'.$getdata->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%;" class="test" data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $getdata->self_id; ?> ] <br>[<?= $name->first_name. " ". $name->last_name; ?>]</a>
                            <?php
                            if($getdata->child_left!=null || $getdata->child_right!=null)
                            {
                                ?>
                                <ul>
                                    <?php if($getdata->child_left!=null )
                                    {

                                        //$this->db->where('sponser_id', $getdata->child_left);

                                        $this->db->where(array('self_id'=>$getdata->child_left));
                                        $getdata1= $this->db->get('tree')->row();

                                        // ==========================join=============================
                                        $this->db->select('tree.user_id,tree.is_active, user.*');
                                        $this->db->from('user');
                                        $this->db->join("tree","tree.user_id=user.id","left");
                                        $this->db->where('tree.user_id',$getdata1->user_id);
                                        $name1=$this->db->get()->row();

                                        $name1->is_active==1 ? $png="green.png" : $png="red.png";
                                        //==============================================================
                                        ?>
                                        <li>
                                            <a href="<?php echo site_url('front/graphicalView/'.$getdata1->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; " data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $getdata1->self_id; ?> ]<br>[<?= $name1->first_name. " ".$name1->last_name; ?>]</a>
                                            <?php
                                            if($getdata1->child_left!=null || $getdata1->child_right!=null)
                                            {
                                                ?>
                                                <ul>
                                                    <?php if($getdata1->child_left!=null)
                                                    {
                                                        $this->db->where(array('self_id'=>$getdata1->child_left));
                                                        $row= $this->db->get('tree')->row();

                                                        // ==========================join=============================
                                                        $this->db->select('tree.user_id,tree.is_active, user.*');
                                                        $this->db->from('user');
                                                        $this->db->join("tree","tree.user_id=user.id","left");
                                                        $this->db->where('tree.user_id',$row->user_id);
                                                        $name2=$this->db->get()->row();
                                                        $name2->is_active==1 ? $png="green.png" : $png="red.png";
                                                        //==============================================================
                                                        ?>
                                                        <li>
                                                        <a href="<?php echo site_url('front/graphicalView/'.$row->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; " data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $row->self_id; ?> ]<br>[<?= $name2->first_name. " ".$name2->last_name;  ?>]</a>
                                                        <?php
                                                        //===========================================================
                                                        if($row->child_left!=null || $row->child_right!=null)
                                                        {
                                                            ?>
                                                            <ul>
                                                                <?php
                                                                if($row->child_left!=null)
                                                                {
                                                                    $this->db->where(array('self_id'=>$row->child_left));
                                                                    $getdata2= $this->db->get('tree')->row();
                                                                    // ==========================join=============================
                                                                    $this->db->select('tree.user_id,tree.is_active, user.*');
                                                                    $this->db->from('user');
                                                                    $this->db->join("tree","tree.user_id=user.id","left");
                                                                    $this->db->where('tree.user_id',$getdata2->user_id);
                                                                    $name3=$this->db->get()->row();
                                                                    $name3->is_active==1 ? $png="green.png" : $png="red.png";
                                                                    //==============================================================
                                                                    ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'.$getdata2->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $getdata2->self_id; ?> ]<br>[<?= $name3->first_name. " ".$name3->last_name; ?>]</a></li>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                    <?php
                                                                }
                                                                if($row->child_right!=null)
                                                                {
                                                                    $this->db->where(array('self_id'=>$row->child_right));
                                                                    $getdata22= $this->db->get('tree')->row();
                                                                    // ==========================join=============================
                                                                    $this->db->select('tree.user_id,tree.is_active, user.*');
                                                                    $this->db->from('user');
                                                                    $this->db->join("tree","tree.user_id=user.id","left");
                                                                    $this->db->where('tree.user_id',$getdata22->user_id);
                                                                    $name4=$this->db->get()->row();
                                                                    $name4->is_active==1 ? $png="green.png" : $png="red.png";
                                                                    //==============================================================
                                                                    ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'.$getdata22->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $getdata22->self_id; ?> ]<br>[<?= $name4->first_name." ".$name4->last_name;  ?>]</a></li>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </ul>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <ul>
                                                                <?php if($row->child_left==null) { ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                <?php } ?>
                                                                <?php if($row->child_right==null) { ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                <?php } ?>

                                                            </ul>
                                                            <?php
                                                        }

                                                        //===========================================================

                                                    }
                                                    else{
                                                        ?>
                                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    </li>

                                                    <?php
                                                    if($getdata1->child_right!=null ){
                                                        $this->db->where(array('self_id'=>$getdata1->child_right));
                                                        $row= $this->db->get('tree')->row();
                                                        // ==========================join=============================
                                                        $this->db->select('tree.user_id,tree.is_active, user.*');
                                                        $this->db->from('user');
                                                        $this->db->join("tree","tree.user_id=user.id","left");
                                                        $this->db->where('tree.user_id',$row->user_id);
                                                        $name5=$this->db->get()->row();
                                                        $name5->is_active==1 ? $png="green.png" : $png="red.png";
                                                        //==============================================================
                                                        ?>
                                                        <li><a href="<?php echo site_url('front/graphicalView/'.$row->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $row->self_id; ?> ]<br>[<?= $name5->first_name." ".$name5->last_name;  ?>]</a>
                                                        <?php
                                                        if($row->child_left!=null || $row->child_right!=null)
                                                        {
                                                            ?>
                                                            <ul>
                                                                <?php
                                                                if($row->child_left!=null)
                                                                {
                                                                    $this->db->where(array('self_id'=>$row->child_left));
                                                                    $getdata12= $this->db->get('tree')->row();
                                                                    // ==========================join=============================
                                                                    $this->db->select('tree.user_id,tree.is_active, user.*');
                                                                    $this->db->from('user');
                                                                    $this->db->join("tree","tree.user_id=user.id","left");
                                                                    $this->db->where('tree.user_id',$getdata12->user_id);
                                                                    $name6=$this->db->get()->row();
                                                                    $name6->is_active==1 ? $png="green.png" : $png="red.png";
                                                                    //==============================================================
                                                                    ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'.$getdata12->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $getdata12->self_id; ?> ]<br>[<?= $name6->first_name." ".$name6->last_name;  ?>]</a></li>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                    <?php
                                                                }
                                                                if($row->child_right!=null)
                                                                {
                                                                    $this->db->where(array('self_id'=>$row->child_right));
                                                                    $getdata12= $this->db->get('tree')->row();
                                                                    // ==========================join=============================
                                                                    $this->db->select('tree.user_id, tree.is_active, user.*');
                                                                    $this->db->from('user');
                                                                    $this->db->join("tree","tree.user_id=user.id","left");
                                                                    $this->db->where('tree.user_id',$getdata12->user_id);
                                                                    $name7=$this->db->get()->row();
                                                                    $name7->is_active==1 ? $png="green.png" : $png="red.png";
                                                                    //==============================================================
                                                                    ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'.$getdata12->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $getdata12->self_id; ?> ]<br>[<?= $name7->first_name." ".$name7->last_name;  ?>]</a></li>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <ul>
                                                                <?php if($row->child_left==null){
                                                                    ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                    <?
                                                                }?>
                                                                <?php if($row->child_right==null){
                                                                    ?>
                                                                    <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                    <?
                                                                }?>
                                                            </ul>
                                                            <?php
                                                        }
                                                    }
                                                    else{
                                                        ?>
                                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    </li>

                                                </ul>
                                            <?php }
                                            else{
                                                ?>
                                                <ul>
                                                    <?php if($getdata1->child_left==null )
                                                    { ?>
                                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php if($getdata1->child_right==null )
                                                    { ?>
                                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                                <?php
                                            }
                                            ?>
                                        </li>
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if($getdata->child_right!=null )
                                    {

                                        //$this->db->where('sponser_id', $getdata->child_right);
                                        $this->db->where(array('self_id'=> $getdata->child_right));
                                        $getdata1= $this->db->get('tree')->row();
                                        // ==========================join=============================
                                        $this->db->select('tree.user_id, tree.is_active, user.*');
                                        $this->db->from('user');
                                        $this->db->join("tree","tree.user_id=user.id","left");
                                        $this->db->where('tree.user_id',$getdata1->user_id);
                                        $name8=$this->db->get()->row();
                                        $name8->is_active==1 ? $png="green.png" : $png="red.png";
                                        //==============================================================

                                        ?>
                                        <li>
                                            <a href="<?php echo site_url('front/graphicalView/'.$getdata1->self_id.'/'.$sponserid); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $getdata1->self_id; ?> ]<br>[<?= $name8->first_name." ".$name8->last_name;  ?>]</a>
                                            <?php
                                            if($getdata1->child_left!=null || $getdata1->child_right!=null)
                                            {
                                                ?>
                                                <ul>
                                                    <?php if($getdata1->child_left!=null )
                                                    {
                                                        $this->db->where(array('self_id'=> $getdata1->child_left));
                                                        $row= $this->db->get('tree')->row();
                                                        // ==========================join=============================
                                                        $this->db->select('tree.user_id, tree.is_active, user.*');
                                                        $this->db->from('user');
                                                        $this->db->join("tree","tree.user_id=user.id","left");
                                                        $this->db->where('tree.user_id',$row->user_id);
                                                        $name9=$this->db->get()->row();
                                                        $name9->is_active==1 ? $png="green.png" : $png="red.png";
                                                        //==============================================================
                                                        ?>
                                                        <li><a href="<?php echo site_url('front/graphicalView/'.$row->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $row->self_id; ?> ]<br>[<?= $name9->first_name. " ".$name9->last_name;  ?>]</a>
                                                            <?php
                                                            if($row->child_left!=null || $row->child_right!=null)
                                                            {
                                                                ?>
                                                                <ul>
                                                                    <?php
                                                                    if($row->child_left!=null)
                                                                    {
                                                                        $this->db->where(array('self_id'=> $row->child_left));
                                                                        $getdata23= $this->db->get('tree')->row();
                                                                        // ==========================join=============================
                                                                        $this->db->select('tree.user_id, tree.is_active, user.*');
                                                                        $this->db->from('user');
                                                                        $this->db->join("tree","tree.user_id=user.id","left");
                                                                        $this->db->where('tree.user_id',$getdata23->user_id);
                                                                        $name10=$this->db->get()->row();
                                                                        $name10->is_active==1 ? $png="green.png" : $png="red.png";
                                                                        //==============================================================
                                                                        ?>
                                                                        <li><a href="<?php echo site_url('front/graphicalView/'.$getdata23->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $getdata23->self_id; ?> ]<br>[<?= $name10->first_name." ".$name10->last_name; ?>]</a></li>
                                                                        <?php
                                                                    }
                                                                    else{
                                                                        ?>
                                                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                        <?php
                                                                    }
                                                                    if($row->child_right!=null)
                                                                    {
                                                                        $this->db->where(array('self_id'=> $row->child_right));
                                                                        $getdata23= $this->db->get('tree')->row();
                                                                        // ==========================join=============================
                                                                        $this->db->select('tree.user_id, tree.is_active, user.*');
                                                                        $this->db->from('user');
                                                                        $this->db->join("tree","tree.user_id=user.id","left");
                                                                        $this->db->where('tree.user_id',$getdata23->user_id);
                                                                        $name11=$this->db->get()->row();
                                                                        $name11->is_active==1 ? $png="green.png" : $png="red.png";
                                                                        //==============================================================
                                                                        ?>
                                                                        <li><a href="<?php echo site_url('front/graphicalView/'.$getdata23->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $getdata23->self_id; ?> ]<br>[<?= $name11->first_name. " ".$name11->last_name;  ?>]</a></li>
                                                                        <?php
                                                                    }
                                                                    else{
                                                                        ?>
                                                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </ul>
                                                                <?php

                                                            }
                                                            ?>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if($getdata1->child_right!=null ){

                                                        $this->db->where(array('self_id'=> $getdata1->child_right));
                                                        $row= $this->db->get('tree')->row();
                                                        // ==========================join=============================
                                                        $this->db->select('tree.user_id, tree.is_active, user.*');
                                                        $this->db->from('user');
                                                        $this->db->join("tree","tree.user_id=user.id","left");
                                                        $this->db->where('tree.user_id',$row->user_id);
                                                        $name12=$this->db->get()->row();
                                                        $name12->is_active==1 ? $png="green.png" : $png="red.png";
                                                        //==============================================================

                                                        ?>
                                                        <li><a href="<?php echo site_url('front/graphicalView/'.$row->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $row->self_id; ?> ]<br>[<?= $name12->first_name." ".$name12->last_name;  ?>]</a>
                                                            <?php
                                                            if($row->child_left!=null || $row->child_right!=null)
                                                            {
                                                                ?>
                                                                <ul>
                                                                    <?php
                                                                    if($row->child_left!=null)
                                                                    {
                                                                        $this->db->where(array('self_id'=> $row->child_left));
                                                                        $getdata22= $this->db->get('tree')->row();
                                                                        // ==========================join=============================
                                                                        $this->db->select('tree.user_id,tree.is_active, user.*');
                                                                        $this->db->from('user');
                                                                        $this->db->join("tree","tree.user_id=user.id","left");
                                                                        $this->db->where('tree.user_id',$getdata22->user_id);
                                                                        $name13=$this->db->get()->row();
                                                                        $name13->is_active==1 ? $png="green.png" : $png="red.png";
                                                                        //==============================================================
                                                                        ?>
                                                                        <li><a href="<?php echo site_url('front/graphicalView/'.$getdata22->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $getdata22->self_id; ?> ]<br>[<?= $name13->first_name." ".$name13->last_name; ?>]</a></li>
                                                                        <?php
                                                                    }
                                                                    else{
                                                                        ?>
                                                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                        <?php
                                                                    }
                                                                    if($row->child_right!=null)
                                                                    {
                                                                        $this->db->where(array('self_id'=> $row->child_right));
                                                                        $getdata22= $this->db->get('tree')->row();
                                                                        // ==========================join=============================
                                                                        $this->db->select('tree.user_id, tree.is_active, user.*');
                                                                        $this->db->from('user');
                                                                        $this->db->join("tree","tree.user_id=user.id","left");
                                                                        $this->db->where('tree.user_id',$getdata22->user_id);
                                                                        $name14=$this->db->get()->row();
                                                                        $name14->is_active==1 ? $png="green.png" : $png="red.png";
                                                                        //==============================================================
                                                                        ?>
                                                                        <li><a href="<?php echo site_url('front/graphicalView/'.$getdata22->self_id); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo $getdata22->self_id; ?> ]<br>[<?= $name14->first_name. " ".$name14->last_name;  ?>]</a></li>
                                                                        <?php
                                                                    }
                                                                    else{
                                                                        ?>
                                                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </ul>
                                                                <?php

                                                            }
                                                            ?>

                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } else{
                                                ?>
                                                <ul>
                                                    <?php if($getdata1->child_left==null) { ?>
                                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                    <?php } ?>
                                                    <?php if($getdata1->child_right==null) { ?>
                                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                                    <?php } ?>
                                                </ul>
                                                <?php
                                            }?>
                                        </li>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            <?php }
                            else{
                                ?>
                                <ul>
                                    <?php if($getdata->child_left==null) { ?>
                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                    <?php } ?>
                                    <?php if($getdata->child_right==null) { ?>
                                        <li><a href="<?php echo site_url('front/graphicalView/'); ?>"><image type="image"  src="<?= base_url('assets/images/'.$png);?>" style="border-width:0px;width: 30%; "data-toggle="tooltip" data-placement="top" title=""><br><br>[ <?php echo "NULL"; ?> ]<br>[<?= "NULL";  ?>]</a></li>
                                    <?php } ?>
                                </ul>
                                <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } else {
    redirect('notfound');
}?>
