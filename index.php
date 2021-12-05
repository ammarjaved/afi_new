<!doctype html>
<?php
session_start();
$loc = 'http://' . $_SERVER['HTTP_HOST'];
if (isset($_SESSION['logedin'])) {

} 
else {
    header("Location:" . $loc . "/afi/login/loginform.php");
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>AFI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://coryasilva.github.io/Leaflet.ExtraMarkers/css/leaflet.extra-markers.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css"/>
    <link href="libs/material-design/css/ripples.min.css" rel="stylesheet">


    <link rel="stylesheet" href="styles/custom_style.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://coryasilva.github.io/Leaflet.ExtraMarkers/js/leaflet.extra-markers.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <script type="text/javascript" src="libs/html5pano.js"></script>

    <style>
        #panorama {
            width: 400px;
            height: 400px;
        }
    </style>
</head>
<body class="claro">
 <nav class="navbar navbar-expand-lg py-1 navbar-light bg-light shadow-sm fixed-top" style="margin-bottom: 0px !important;">

            <div class="col-lg-12 npnm">
                <div class="row npnm">

                    <div class="col-lg-12 npnm">
                   
                        <img src="images/logo.png" width="150"  height="47" alt=""
                             class="d-inline-block align-middle mr-2">

                        <span class="text-uppercase font-weight-bold text-muted">AFI</span>
                        <a href="services/logout.php" class="pull-right btn btn-danger" style="color: white; margin-top: 3px !important;">Logout</a>
<!--                        <a class="pull-right btn btn-danger btn-sm" style="color: white; margin-top: 10px !important;margin-right: 10px;" onclick="getProperties()">Enable Customer</a>-->
                        <a class="pull-right btn btn-danger btn-sm" style="color: white; margin-top: 10px !important;margin-right: 10px;" onclick="exportExcel()">Export Complete Excel</a>
                        <a href="afi_report.php" class="pull-right btn btn-danger btn-sm" style="color: white; margin-top: 10px !important;margin-right: 10px;" target="_blank">Export FP Excel</a>

                        <a class="cenablebtn pull-right btn btn-basic btn-sm" style="margin-top: 10px !important;margin-right: 10px;" onclick="getProperties()">Unsurveyed DP</a>


                    </div>



                   
                </div>

            </div>

    </nav>
<div class="container-fluid" style="padding:0 0 0 0;">
   

    
    <div id="content">
       
        <!-- Header -->
        <div class="row" id="filter_div" style="margin-left: 0px !important; margin-right: 0px !important;">
            <!-- <div class="col-md-3 remove_right_padding">
                <div class="panel panel-default">
                    <div class="panel-body panel_body_style">
                        <label style="font-weight: bold;">Phase Color</label>
                        <select class="form-control formControlWIdth" name="phase_color" id="phase_color">
                        <option selected disabled>--Select Color--</option>
                            <option value="R">Red</option>
                            <option value="Y">Yellow</option>
                            <option value="B">Blue</option>
                            <option value="RYB">RYB</option>
                        </select>
                    </div>
                </div>
            </div> -->
            <div class="col-md-3 remove_right_padding">
                <div class=" panel panel-default">
                    <div class="panel-body panel_body_style">
                        <label style="font-weight: bold;">FP</label>
                        <select class="form-control formControlWIdth" name="fp" id="fpdropdown">
                        <option selected disabled value="0">--Select ID--</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-md-3 remove_right_padding">
                <div class="panel panel-default">
                    <div class="panel-body panel_body_style">
                        <label style="font-weight: bold;">SFP</label>
                        <select class="form-control formControlWIdth" name="sfp" id="sfpdropdown">
                            <option selected disabled value="0">--Select ID--</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3 remove_right_padding">
                    <div class="panel panel-default">
                        <div class="panel-body panel_body_style">
                            <label style="font-weight: bold;">MFP</label>
                            <select class="form-control formControlWIdth" name="mfp" id="mfpdropdown">
                                <option selected disabled value="0">--Select ID--</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="col-md-3 ">
                <div class="row">
                    
                    <div class="col-md-2 " >
                        <div class="radio">
                        <label><input type="radio" name="optradio" onchange="typeaheadsearch()" id="fpradiobtn" value="fpl1" checked>FP</label>
                        </div>
                        <div class="radio">
                        <label><input type="radio" name="optradio" onchange="typeaheadsearch()" id="sfpradiobtn" value="sfp_l2">SFP</label>
                        </div>
                        <div class="radio">
                        <label><input type="radio" name="optradio" onchange="typeaheadsearch()" id="mfpradiobtn" value="mfp_l3">MFP</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="optradio" onchange="typeaheadsearch()" id="mfpradiobtn" value="dp">DP</label>
                        </div>
                    </div>
                    <div id="search-bar" class="col-md-6" style="margin-top:30px; margin-left:10px margin-right:10px;">
                            <input type="text" id="search_input1" name="search1" placeholder="Search DeviceID..." class="typeahead" style="display:none">
                            <input type="text" id="search_input2" name="search2" placeholder="Search DeviceID..." class="typeahead" style="display:none; margin-top:-20px !important;">
                            <input type="text" id="search_input3" name="search3" placeholder="Search DeviceID..." class="typeahead" style="display:none; margin-top:-20px !important;">
                            <input type="text" id="search_input4" name="search4" placeholder="Search DeviceID..." class="typeahead" style="display:none; margin-top:-20px !important;">


                    </div>
                    <div class="col-md-2" style="margin-top:25px;">
                        <button  style="margin-right:50px;" id="ser" onclick="search_deviceid()" class="pull-left btn btn-success">Search</button>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-2 remove_right_padding">
                <div class="panel panel-default">
                    <div class="panel-body panel_body_style">
                    <button class="btn btn-success btn-lg" id="filterbtn"><i class="fa fa-filter"></i> Filter Data</button>
                    </div>
                </div>
            </div> -->
        </div>   
     
		<div class="row">
                <div class="col-md-2">
                    <div style="cursor:pointer" class="countdiv card-counter info" id="RYB">
                            <i class="fa fa-bolt"></i>
                            <span class="count-numbers" id="tryb"></span>
                            <span class="count-name">Three Phase RYB</span>
                    </div>
                </div>	
                <div class="col-md-2">
                    
                    <div style="cursor:pointer" class="countdiv card-counter color1" id="R">
                    <i class="fa fa-bolt"></i>
                    <span class="count-numbers" id="sred"></span>
                    <span class="count-name">Single Phase Red</span>
                    </div>

                </div>
                
                <div class="col-md-2">
                    <div style="cursor:pointer;" class=" countdiv card-counter color2" id="Y">
                        <i class="fa fa-bolt"></i>
                        <span class="count-numbers" id="syellow"></span>
                        <span class="count-name">Single Phase Yellow</span>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div style="cursor:pointer" class="countdiv card-counter color3" id="B">
                        <i class="fa fa-bolt"></i>
                        <span class="count-numbers" id="sblue"></span>
                        <span class="count-name">Single Phase Blue</span>
                    </div>
                </div>
            
                
                <div class="col-md-2">
                    <div style="cursor:pointer" class="countdiv card-counter total_counts" id="total">
                            <i class="fa fa-bolt"></i>
                            <span class="count-numbers" id="total_count" ></span>
                            <span class="count-name" >Total</span>
                    </div>
                </div>

            <div class="col-md-2">
                <div style="cursor:pointer" class="countdiv card-counter total_counts_p" id="total">
                    <i class="fa fa-bolt"></i>
                    <span class="count-numbers" id="total_count_p" ></span>
                    <span class="count-name" >Total Complete Percent</span>
                </div>
            </div>
              
        </div>

        <div class="row"  >
            <div class="col-md-12 remove_right_padding" id="">
                <div style="display:none; margin-left: 20px !important; margin-top: 5px !important; margin-bottom: 10px !important;" id="fd_details_div">
    
                    <p id="fd_p1" class="fd_p" style="cursor:pointer">Feder_No.1: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_1">0</span></p>&nbsp&nbsp
                    <p id="fd_p2" class="fd_p" style="cursor:pointer">Feder_No.2: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_2">0</span></p>&nbsp&nbsp
                    <p id="fd_p3" class="fd_p" style="cursor:pointer">Feder_No.3: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_3">0</span></p>&nbsp&nbsp
                    <p id="fd_p4" class="fd_p" style="cursor:pointer">Feder_No.4: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_4">0</span></p>&nbsp&nbsp
                    <p id="fd_p5" class="fd_p" style="cursor:pointer">Feder_No.5: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_5">0</span></p>&nbsp&nbsp
                    <p id="fd_p6" class="fd_p" style="cursor:pointer">Feder_No.6: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_6">0</span></p>&nbsp&nbsp
                    <p id="fd_p7" class="fd_p" style="cursor:pointer">Feder_No.7: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_7">0</span></p>&nbsp&nbsp
                    <p id="fd_p8" class="fd_p" style="cursor:pointer">Feder_No.8: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_8">0</span></p>&nbsp&nbsp
                    <p id="fd_p9" class="fd_p" style="cursor:pointer">Feder_No.9: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_9">0</span></p>&nbsp&nbsp
                    <p id="fd_p10" class="fd_p" style="cursor:pointer">Feder_No.10: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_10">0</span></p>&nbsp&nbsp
                    <p id="fd_p11" class="fd_p" style="cursor:pointer">Feder_No.11: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_11">0</span></p>&nbsp&nbsp
                    <p id="fd_p12" class="fd_p" style="cursor:pointer">Feder_No.12: &nbsp<span class="badge bg-danger ms-2" style="background-color: gray;" class="fd_detail" id="fd_12">0</span></p>&nbsp&nbsp
                </div>
            </div>
        </div>
        


        <div class="row">
            <div class="col-md-12 " style="z-index: 1;">
                <div class="panel panel-default">
                    <!--<a data-toggle="collapse" data-parent="#accordionBar2" href="#r1p1" style="color: #000;">-->
                    <!--<div class="panel-heading" style="background: #EEEEEE; font-weight: bold;">Choropleth Map-->
                    <!--( <span id="nav_stage"></span> )-->
                    <!--</div>-->
                    <!--</a>-->
                    <div id="r1p1" class="panel-collapse collapse in">
                        <div class="panel-body" id="map_div" style="padding: 0;  margin-bottom: 0px !important;z-index: 1;">

                            <div id="clearlinesbtn" style="display:none; z-index: 1000000;position: relative;">
                                <a class="pull-left btn btn-danger btn-sm" onclick="mapreset()" style="z-index: 1000 !important; color: white; margin-top: 20px !important;margin-left: 50px;">Clear Lines</a>
                            </div>

                            <!--Panel content-->
                            <!--Map will be here-->
                            <!-- Modal for non surved department-->
                            <div class="modal" id="nonsurvedmodal" role="dialog" style="">
                                <div class="modal-dialog">
                                
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Non surveyed Demand Point</h4>
                                    </div>
                                    <div class="modal-body" id="modalbody_id">
                                    
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        <div id="wg" class="windowGroup">

        </div>

        <div id="wg1" class="windowGroup">

        </div>
        </div>


    </div>

</div>


<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="display: none;" id="model_btn_click">Open Modal</button>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="layer_title" ></h4>
                <!--<p style="text-align: right;"><img src="images/cornoa.jpg" width="80" height="75" alt=""/></p>-->
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-responsive" id="layers_infos">
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script src="libs/jquery-1.8.3.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="libs/images_slider/css-view/lightbox.css" type="text/css" />
<script src="libs/images_slider/js-view/lightbox-2.6.min.js"></script>
<script src="libs/images_slider/js-view/jQueryRotate.js"></script>
 <link rel="stylesheet" href="libs/window-engine.css" />
 <script src="libs/window-engine.js"></script>





<script src="scripts/map.js"></script>
<script src="libs/typeahead.min.js"></script>

<script>

    $(document).ready(function () {
        // $("#search_input").on('keyup', function(){
           
        // });
        typeaheadsearch()
        
            
          //  setTimeout(function(){
                // alert(tblname);
                
            //}, 400);
           setTimeout(() => {
               //alert($(window).height());
               //alert($("#content").height());
            $("#map_div").height($(window).height()-266);
            map.invalidateSize();
           }, 100);
            
        
       
    });
    
    function typeaheadsearch(){
        $('.typeahead').unbind('typeahead');
        var tblname;
        var radioValue = $("input[name='optradio']:checked").val();
        // alert(radioValue)
            if(radioValue=='fpl1'){
                $('#search_input1').show();
                $('#search_input2').hide();
                $('#search_input3').hide();
                $('#search_input4').hide();
            }
            if(radioValue=='sfp_l2'){
                $('#search_input1').hide();
                $('#search_input2').show();
                $('#search_input3').hide();
                $('#search_input4').hide();
            }
            if(radioValue=='mfp_l3'){
                $('#search_input1').hide();
                $('#search_input2').hide();
                $('#search_input3').show();
                $('#search_input4').hide();
            }
            if(radioValue=='dp'){
                $('#search_input1').hide();
                $('#search_input2').hide();
                $('#search_input3').hide();
                $('#search_input4').show();
            }

            $('#search_input1').typeahead({
                name: 'hce1',
                remote:'services/search.php?key=%QUERY'+ "&tblname=fpl1",
                limit: 5
            });

            $('#search_input2').typeahead({
                name: 'hce2',
                remote:'services/search.php?key=%QUERY'+ "&tblname=sfp_l2",
                limit: 5
            });

            $('#search_input3').typeahead({
                name: 'hce3',
                remote:'services/search.php?key=%QUERY'+ "&tblname=mfp_l3",
                limit: 5
            });

            $('#search_input4').typeahead({
                name: 'hce4',
                remote:'services/search.php?key=%QUERY'+ "&tblname=dp                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ",
                limit: 5
            });
        }

  

    function search_deviceid(){
        var deviceid='';
        var chktblname = $("input[name='optradio']:checked").val();

        if(chktblname=='fpl1'){
             deviceid = $("#search_input1").val(); 
        }
        if(chktblname=='sfp_l2'){
             deviceid = $("#search_input2").val(); 
        }
        if(chktblname=='mfp_l2'){
             deviceid = $("#search_input3").val();
        }
        if(chktblname=='dp'){
            deviceid = $("#search_input4").val();
        }
       
        // alert(chktblname)

            $.ajax({
                url: "services/returnxy.php?did="+ deviceid + "&lyr=" + chktblname,
                type: "GET",
                async: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function callback(response) {
                   console.log(response);
                   var latlng=[response[0].y, response[0].x]
                    map.setView(latlng,19);
                    L.marker(latlng).addTo(map);
                }
            });
    }
    function mapreset(){
        if (point_polylines_arr !== undefined && point_polylines_arr.length !== 0) {
            for(var i=0; i<point_polylines_arr.length; i++){
                map.removeLayer(point_polylines_arr[i])
                }
        }

        if (filter_polylines_arr.length !== 0) {
            for(var i=0; i<filter_polylines_arr.length; i++){
                map.removeLayer(filter_polylines_arr[i])
            }
        }
        filter_polylines_arr=[];
        point_polylines_arr=[];
        $('#clearlinesbtn').hide();
        // map.addLayer(demand_point)
    }

    // function typeaheadsearch(){
    //     // $('.typeahead').unbind('typeahead');
    //     var radioValue = $("input[name='optradio']:checked").val();
    //     // alert(radioValue)
    //         $('.typeahead').typeahead({
    //             name: 'hce',
    //             remote:'services/search.php?key=%QUERY'+ "&tblname="+radioValue,
    //             limit: 5
    //         });
          
    // }
   
   


</script>
 <div id="myDiv" style="display: none;"></div>
</body>
</html>