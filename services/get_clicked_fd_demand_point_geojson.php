


<?php
include("connection.php");

class Tehsil extends connection {
    function __construct()
    {
        $this->connectionDB();

    }

    public function getTehsilExtent() {

        $cd_id=$_GET['cd_id'];
        $phase=$_GET['phase'];
        $fd_no=$_GET['fd_no'];

    $sql = "SELECT json_build_object('type', 'FeatureCollection','crs',  json_build_object('type','name', 'properties', json_build_object('name', 'EPSG:4326'  )),'features', json_agg(json_build_object('type','Feature','id',id,'geometry',ST_AsGeoJSON(geom)::json,
            'properties', json_build_object(
                'id', id,
            'p_id', p_id,
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
            'fd_no', fd_no))))
            FROM (SELECT id, p_id, cd_id, pe_name, l1_id, l2_id, l3_id, acc_no, address, install_id, meter_type, bcrm_eqp, site_eqp, phase,images, fd_no, geom
               FROM public.demand_point where cd_id='$cd_id' and phase='$phase' and fd_no='$fd_no') as tbl1;";

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
        if($cd_id=='a333' || $cd_id=='a444'){
            $q="select lvf1_fd,lvf2_fd from sfp_l2 where cd_id='$cd_id'";
            $result_query = pg_query($q);
            if ($result_query) {
                $arrq = pg_fetch_all($result_query);
                $arr =$arrq;
                $output['incoming'] = $arr;
            }
        }

        if($cd_id=='a555' || $cd_id=='a666'){
            $q="select lvf1_fd,lvf2_fd from mfp_l3 where cd_id='$cd_id'";
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
echo $json->getTehsilExtent();

