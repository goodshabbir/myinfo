<style>
    a.goog-logo-link {
        display: none;
    }
    
    li#google_translate_element {
        margin: 15px 0 0 0;
    }
    
    .goog-te-gadget {
        font-family: arial;
        font-size: 11px;
        color: #820506;
        white-space: nowrap;
    }
    
    .goog-te-banner-frame {
        left: 0px;
        top: 0px;
        height: 39px;
        width: 100%;
        z-index: 10000001;
        position: fixed;
        border: none;
        border-bottom: 1px solid #6b90da;
        margin: 0;
        -moz-box-shadow: 0 0 8px 1px #999999;
        -webkit-box-shadow: 0 0 8px 1px #999999;
        box-shadow: 0 0 8px 1px #999999;
        _position: absolute;
        display: none;
    }
</style>
<?php

//print_r($this->session->userdata['user']); die;

$id=$this->session->userdata['user']['id'];

$obj= new welcome_model();

$record=$obj->getsinglerow('normal_information',['user_id' => $id]);
$profileRecord = $obj->getsinglerow('user', ['id' => $id]);

?>

    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="our_usr_ma">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left waves-effect waves-light"> <i class="md md-menu"></i> </button>
                    <span class="clearfix"></span> </div>
                <div class="both_all_user">

                </div>

                <div class="user_nav">

                    <ul class="nav navbar-nav navbar-right pull-right ">

                        <li class="dropdown top-menu-item-xs"> 
                          <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                              <?php 
                              if(!empty($record))
                               {
                                 $profileImg= unserialize($record->photo_1);
                                

                              ?>
                              <img src="<?= base_url('uploads/profile/').$profileImg[0]; ?>" alt="user-img" class="img-circle">
                              <?php } else{ ?>
                              <img src="<?php echo base_url('profile/').$profileRecord->image; ?>" alt="user-img" class="img-circle">
                              <?php } ?>
                          </a>

                            <ul class="dropdown-menu">

                                <li><a href="<?= profiles ?>"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>

                            </ul>

                        </li>
                        <li class="" id="google_translate_element"> </li>

                    </ul>

                </div>

            </div>

        </div>

        <!--/.nav-collapse -->

    </div>

    </div>