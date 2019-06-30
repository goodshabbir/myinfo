<div class="row" style="background-color:white;">
                    <!-- ngView:  --><div ng-view="" class="ng-scope">

<link href="css/datetimepicker.min.css" rel="stylesheet" class="ng-scope">
<div id="page-wrapper" ng-app="TabularViewApp" ng-controller="TabularViewCtrl" class="ng-scope" style="min-height: 324px;">
    <div class="form-table">
        <div class="row ">
            <div class="col-lg-12">
                <div class="col-lg-10">
                    <h2 class="page-header">
                        Tabular View
                    </h2>
                </div>
                <div class="col-lg-2 page-header">
                    <a class="btn btn-default center-block btn-clear" data-toggle="modal" data-target="#myModal">Filter</a>
                    <!--<input type="button" value="Back To Cart" ng-click="BackToCart()" class="btn btn-default center-block btn-clear">-->
                </div>
            </div>
            <!-- /.col-lg-12 -->
            <!--<div class="col-md-1"><img ng-click="exportToExcel()" src="../Images/excel.png" /></div>-->
            <!--<div class="col-md-1"></div>-->

            <div class="col-md-2">
                <div class="col-md-12">
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <form name="MenuForm" ng-submit="CheckUserID()" novalidate="" class="ng-valid ng-dirty">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Tabular View</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!--<div class="row" ng-class="{ 'has-error' : MenuForm.txtidno.$invalid && !MenuForm.txtidno.$pristine }">
                                            <div class="col-md-4">
                                                <span class="control-label">
                                                    Distributor ID
                                                </span>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="txtidno" ng-model="txtidno" class="form-control" ng-required="true">
                                                <div ng-show="MenuForm.txtidno.$invalid && !MenuForm.txtidno.$pristine" class="validation_info">
                                                    <ul class="ulvalid">
                                                        <li class="invalid" ng-show="MenuForm.txtidno.$invalid">Distributor ID is required.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <span class="control-label">
                                                    Date Filtration
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="rbcontent" ng-model="rbcontent" value="rball" ng-checked="true" ng-click="AssignValidations()" class="ng-pristine ng-valid" checked="checked">
                                                        All
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="radio">
                                                    <label class="control-label">
                                                        <input type="radio" name="rbcontent" ng-model="rbcontent" value="rbon" pala="" ng-click="AssignValidations()" class="ng-pristine ng-valid">
                                                        On
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control ng-valid hasDatepicker ng-dirty" ng-model="txtOndate" placeholder="Select On Date" datepicker="" id="dp1511960542583">
                                                <!--<input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="txtOndate" is-open="ondatests.opened" ng-click="OnRequired &&  openondatests($event)"
                                                       min-date="minDate" max-date="maxDate" datepicker-options="dateOptions" placeholder="Select Ondate"
                                                       show-button-bar="false" show-weeks="false" formatyear="yyyy" ng-readonly="true" ng-required="OnRequired" />-->

                                            </div>
                                        </div>
                                        <div class="row" ng-class="{ 'has-error' : MenuForm.txtFromdate.$invalid &amp;&amp; !MenuForm.txtFromdate.$pristine &amp;&amp; MenuForm.txtTodate.$invalid &amp;&amp; !MenuForm.txtTodate.$pristine }">
                                            <div class="col-md-2">
                                                <div class="radio">
                                                    <label class="control-label">
                                                        <input type="radio" name="rbcontent" ng-model="rbcontent" value="FromTo" ng-click="AssignValidations()" class="ng-pristine ng-valid">
                                                        From
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control ng-valid hasDatepicker ng-dirty" ng-model="txtFromdate" placeholder="Select From Date" datepicker="" ng-change="assigntomaxdate" id="dp1511960542584">
                                                <!--<input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="txtFromdate" is-open="fromdatests.opened" ng-click=" fromtoRequired && openfromdatests($event)"
                                                       min-date="minDate" max-date="frommaxDate" datepicker-options="dateOptions" placeholder="Select Fromdate"
                                                       show-button-bar="false" show-weeks="false" formatyear="yyyy" ng-readonly="true" ng-required="fromtoRequired" />-->

                                            </div>
                                            <div class="col-md-1"><label class="control-label">To </label></div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control ng-valid hasDatepicker ng-dirty" ng-model="txtTodate" placeholder="Select To Date" datepicker="" ng-change="Assignfrommaxdate()" id="dp1511960542585">
                                                <!--<input type="text" class="form-control" uib-datepicker-popup="dd/MM/yyyy" ng-model="txtTodate" is-open="todatests.opened" ng-click="fromtoRequired && opentodatests($event)"
                                                       min-date="minDate" max-date="maxDate" datepicker-options="dateOptions" placeholder="Select Todate"
                                                       show-button-bar="false" show-weeks="false" formatyear="yyyy" ng-readonly="true" ng-required="fromtoRequired" ng-change="Assignfrommaxdate()" />-->

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <button type="submit" id="btngetrpt" class="btn btn-primary btn-sm" ng-disabled="MenuForm.$invalid">
                                                    SUBMIT
                                                </button>
                                            </div>
                                            <div class="col-md-1">
                                                <img ng-show="loader" src="../Images/loading.gif" class="loading ng-hide">
                                            </div>
                                            <div class="col-md-offset-2 col-md-2">
                                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-8">
                <ul class="nav nav-tabs">
                    <li ng-class="leftdiv==true ? 'active':''" class="active"><a href="" ng-click="TabActive(true,false)">Left Team</a></li>
                    <li ng-class="rightdiv==true ? 'active':''"><a href="" ng-click="TabActive(false,true)">Right Team</a></li>
                </ul>
            </div>
            <div class="col-md-2" ng-show="leftdiv==true">
                <select ng-model="LitemsPerPage" class="form-control ng-pristine ng-valid">
                    <option value="" style="display:none">Items Per Page</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="col-md-2 ng-hide" ng-show="rightdiv==true">
                <select ng-model="RitemsPerPage" class="form-control ng-pristine ng-valid">
                    <option value="" style="display:none">Items Per Page</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" id="btnexportleft" class="btn btn-default center-block btn-clear" ng-click="exportToExcel()">
                    ExportToExcel
                </button>
                <!--<button type="submit" id="btnexportright" class="btn btn-default center-block btn-clear" ng-click="ExportRight()" ng-show="rightdiv">
                    ExportToExcel
                </button>-->
            </div>
        </div>
        <!-- ngIf: leftdiv --><div class="row ng-scope" ng-if="leftdiv">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th class="label-center"><a style="text-decoration: none">SNo</a></th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='IDNo'; reverseSort = !reverseSort">
                                Associate ID <span ng-show="orderByField == 'IDNo'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='Name'; reverseSort = !reverseSort">
                                Name <span ng-show="orderByField == 'Name'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='city'; reverseSort = !reverseSort">
                                City <span ng-show="orderByField == 'city'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='state'; reverseSort = !reverseSort">
                                State <span ng-show="orderByField == 'state'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='PV'; reverseSort = !reverseSort">
                                SV <span ng-show="orderByField == 'PV'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='SponsorID'; reverseSort = !reverseSort">
                                Sponsor ID <span ng-show="orderByField == 'SponsorID'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='SPName'; reverseSort = !reverseSort">
                                Sponsor Name <span ng-show="orderByField == 'SPName'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='JoinDate'; reverseSort = !reverseSort">
                                Join Date <span ng-show="orderByField == 'JoinDate'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>
                        <th class="label-center">
                            <a style="cursor: pointer; text-decoration: none" ng-click="orderByField='status'; reverseSort = !reverseSort">
                                Status <span ng-show="orderByField == 'status'" class="ng-hide"><span ng-show="!reverseSort" class=""><i class="fa fa-sort-asc" aria-hidden="true"></i></span><span ng-show="reverseSort" class="ng-hide"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                            </a>
                        </th>

                       
                    </tr>
                    </tbody><tbody>
                        <!-- ngRepeat: LPView in LPrintView | itemsPerPage:LitemsPerPage|orderBy:orderByField:reverseSort track by $index -->
                        <tr>
                            <td colspan="6" class="label-right fontred">
                                Page Total
                            </td>
                            <td class="label-center fontred ng-binding">0</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="label-right fontred">
                                Grand Total
                            </td>
                            <td class="label-center fontred ng-binding">0</td>
                            <td colspan="3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-11">
                    <dir-pagination-controls direction-links="true" boundary-links="true" ng-model="LcurrentPage" on-page-change="LeftpageChanged()" class="ng-isolate-scope ng-pristine ng-valid"><!-- ngIf: 1 < pages.length --></dir-pagination-controls>
                </div>
            </div>
        </div><!-- end ngIf: leftdiv -->
        <!-- ngIf: rightdiv -->
    </div>
</div></div>
                    <div id="footer" ng-controller="FooterGetLastLogin" class="ng-scope">
                        <div class="container">
                            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-8 text-p ng-binding">
                                Last Login: Nov 29 2017  3:25PM
                            </div>
                            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 text-p hidden-xs" style="text-align:right;">
                                Powered by
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-4 logo">
                                <img src="images/smartsoft-logo.png" class="img-responsive" alt="">
                            </div>
                            <!-- <p class="text-muted credit">Example courtesy <a href="http://martinbean.co.uk">Martin Bean</a> and <a href="http://ryanfait.com/sticky-footer/">Ryan Fait</a>.</p>-->
                        </div>
                    </div>
                </div>