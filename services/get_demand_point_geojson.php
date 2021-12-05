


<?php
include("connection.php");

class Tehsil extends connection {
    function __construct()
    {
        $this->connectionDB();

    }

    public function getquerydata() {

        $lid=$_REQUEST['lid'];
        $phase=$_REQUEST['phase'];
        $fd_no=$_REQUEST['fd_no'];
        if ($lid=='%' && $phase=='%' && $fd_no=='%'){
            $sql = "SELECT json_build_object('type', 'FeatureCollection','crs',  json_build_object('type','name', 'properties', json_build_object('name', 'EPSG:4326'  )),'features', json_agg(json_build_object('type','Feature','gid',gid,'geometry',ST_AsGeoJSON(geom)::json,
                'properties', json_build_object(
                'gid', gid,
                'cd_id', cd_id,
                'pe_name',pe_name ,
                'l1_id',l1_id,
                'l2_id', l2_id,
                'l3_id', l3_id,
                'acc_no', acc_no,
                'address', address,
                'install_id',install_id,
                'meter_type', meter_type,
                'bcrm_eqp', bcrm_eqp,
                'site_eqp', site_eqp,
                'phase', phase,
                'images', images,
                'fd_no', fd_no,
                'id1', id1,
                'device_id', device_id,
                'image2', image2,
                'image3', image3,
                'image4', image4,
                'image5', image5
                ))))
                FROM (SELECT gid, cd_id, pe_name, l1_id, l2_id, l3_id, acc_no, address, install_id, meter_type, bcrm_eqp, site_eqp, phase, fd_no, images, id1, device_id, image2, image3, image4, image5, geom
                    FROM public.demand_point where cd_id is not null) as tbl1;";
        }else if ($phase=='%' && $fd_no=='%'){
            $sql = "SELECT json_build_object('type', 'FeatureCollection','crs',  json_build_object('type','name', 'properties', json_build_object('name', 'EPSG:4326'  )),'features', json_agg(json_build_object('type','Feature','gid',gid,'geometry',ST_AsGeoJSON(geom)::json,
                'properties', json_build_object(
                'gid', gid,
                'cd_id', cd_id,
                'pe_name',pe_name ,
                'l1_id',l1_id,
                'l2_id', l2_id,
                'l3_id', l3_id,
                'acc_no', acc_no,
                'address', address,
                'install_id',install_id,
                'meter_type', meter_type,
                'bcrm_eqp', bcrm_eqp,
                'site_eqp', site_eqp,
                'phase', phase,
                'images', images,
                'fd_no', fd_no,
                'id1', id1,
                'device_id', device_id,
                'image2', image2,
                'image3', image3,
                'image4', image4,
                'image5', image5
                ))))
                FROM (SELECT gid, cd_id, pe_name, l1_id, l2_id, l3_id, acc_no, address, install_id, meter_type, bcrm_eqp, site_eqp, phase, fd_no, images, id1, device_id, image2, image3, image4, image5, geom
                    FROM public.demand_point where (l3_id='$lid' or l2_id='$lid' or l1_id='$lid')) as tbl1;";
        }else{
            $sql = "SELECT json_build_object('type', 'FeatureCollection','crs',  json_build_object('type','name', 'properties', json_build_object('name', 'EPSG:4326'  )),'features', json_agg(json_build_object('type','Feature','gid',gid,'geometry',ST_AsGeoJSON(geom)::json,
                'properties', json_build_object(
                'gid', gid,
                'cd_id', cd_id,
                'pe_name',pe_name ,
                'l1_id',l1_id,
                'l2_id', l2_id,
                'l3_id', l3_id,
                'acc_no', acc_no,
                'address', address,
                'install_id',install_id,
                'meter_type', meter_type,
                'bcrm_eqp', bcrm_eqp,
                'site_eqp', site_eqp,
                'phase', phase,
                'images', images,
                'fd_no', fd_no,
                'id1', id1,
                'device_id', device_id,
                'image2', image2,
                'image3', image3,
                'image4', image4,
                'image5', image5
                ))))
                FROM (SELECT gid, cd_id, pe_name, l1_id, l2_id, l3_id, acc_no, address, install_id, meter_type, bcrm_eqp, site_eqp, phase, fd_no, images, id1, device_id, image2, image3, image4, image5, geom
               FROM public.demand_point where phase='$phase' and (l3_id='$lid' or l2_id='$lid' or l1_id='$lid') and fd_no::TEXT LIKE '$fd_no') as tbl1;";
        }




        //    echo $sql;
        //     exit();
        $output = array();
        $result_query = pg_query($sql);
        if ($result_query) {
             $arrq = pg_fetch_all($result_query);
             // print_r($arrq);
             // exit();
             $arr = $arrq;
                    $g=implode("",$arr[0]);
                    $geojson=$g;
                    $output['geojson'] = $geojson;
                    
        }
        if($lid=='a333' || $lid=='a444'){
            $q="select lvf1_fd,lvf2_fd from sfp_l2 where lid='$lid'";
            $result_query = pg_query($q);
            if ($result_query) {
                $arrq = pg_fetch_all($result_query);
                $arr =$arrq;
                $output['incoming'] = $arr;
            }
        }

        if($lid=='a555' || $lid=='a666'){
            $q="select lvf1_fd,lvf2_fd from mfp_l3 where lid='$lid'";
            $result_query = pg_query($q);
            if ($result_query) {
                $arrq = pg_fetch_all($result_query);
                $arr =$arrq;
                $output['incoming'] = $arr;
            }
        }

        

        return json_encode($output);

        $this->closeConnection();
    }
}

$json = new Tehsil();
//$json->closeConnection();
echo $json->getquerydata();

