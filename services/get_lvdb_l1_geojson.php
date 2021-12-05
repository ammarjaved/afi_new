


<?php
include("connection.php");

class Tehsil extends connection {
    function __construct()
    {
        $this->connectionDB();

    }

    public function getfp_l1() {
        $l1_id=$_REQUEST['l1_id'];
        if ($l1_id=="%"){
            $sql = "SELECT json_build_object('type', 'FeatureCollection','crs',  json_build_object('type','name', 'properties', json_build_object('name', 'EPSG:4326'  )),'features', json_agg(json_build_object('type','Feature','id',id,'geometry',ST_AsGeoJSON(geom)::json,
            'properties', json_build_object(
            'id', id,
            'l1_id', l1_id,
            'status',status ,
            'pe_name',pe_name,
            'pe_fl', pe_fl,
            'tx1_fl', tx1_fl,
            'tx2_fl', tx2_fl,
            'cd_id', cd_id,
            'lvf1_fd',lvf1_fd, 
            'lvf2_fd',lvf2_fd, 
            'lvf3_fd',lvf3_fd, 
            'lvf4_fd',lvf4_fd, 
            'lvf5_fd',lvf5_fd, 
            'lvf6_fd',lvf6_fd, 
            'lvf7_fd',lvf7_fd, 
            'lvf8_fd',lvf8_fd, 
            'lvf9_fd',lvf9_fd, 
            'lvf10_fd',lvf10_fd,
            'lvf11_fd',lvf11_fd,
            'lvf12_fd',lvf12_fd,
            'image_1', image_1,'image_2', image_2,'image_3', image_3,'image_4', image_4,'image_5', image_5,'image_6', image_6,'image_7', image_7,'image_8', image_8,'image_9', image_9,'image_10', image_10
            ))))
            FROM (SELECT id, l1_id, status, pe_name, pe_fl, tx1_fl, tx2_fl, cd_id, lvf1_fd, lvf2_fd, lvf3_fd, lvf4_fd, lvf5_fd, lvf6_fd, lvf7_fd, lvf8_fd, lvf9_fd, lvf10_fd, lvf11_fd, lvf12_fd, image_1, image_2, image_3, image_4, image_5, image_6, image_7, image_8, image_9, image_10, geom
                    FROM public.fpl1) as tbl1;";
        }else{
            $sql = "SELECT json_build_object('type', 'FeatureCollection','crs',  json_build_object('type','name', 'properties', json_build_object('name', 'EPSG:4326'  )),'features', json_agg(json_build_object('type','Feature','id',id,'geometry',ST_AsGeoJSON(geom)::json,
            'properties', json_build_object(
            'id', id,
            'l1_id', l1_id,
            'status',status ,
            'pe_name',pe_name,
            'pe_fl', pe_fl,
            'tx1_fl', tx1_fl,
            'tx2_fl', tx2_fl,
            'cd_id', cd_id,
            'lvf1_fd',lvf1_fd, 
            'lvf2_fd',lvf2_fd, 
            'lvf3_fd',lvf3_fd, 
            'lvf4_fd',lvf4_fd, 
            'lvf5_fd',lvf5_fd, 
            'lvf6_fd',lvf6_fd, 
            'lvf7_fd',lvf7_fd, 
            'lvf8_fd',lvf8_fd, 
            'lvf9_fd',lvf9_fd, 
            'lvf10_fd',lvf10_fd,
            'lvf11_fd',lvf11_fd,
            'lvf12_fd',lvf12_fd,
            'image_1', image_1,'image_2', image_2,'image_3', image_3,'image_4', image_4,'image_5', image_5,'image_6', image_6,'image_7', image_7,'image_8', image_8,'image_9', image_9,'image_10', image_10
            ))))
            FROM (SELECT id, l1_id, status, pe_name, pe_fl, tx1_fl, tx2_fl, cd_id, lvf1_fd, lvf2_fd, lvf3_fd, lvf4_fd, lvf5_fd, lvf6_fd, lvf7_fd, lvf8_fd, lvf9_fd, lvf10_fd, lvf11_fd, lvf12_fd, image_1, image_2, image_3, image_4, image_5, image_6, image_7, image_8, image_9, image_10, geom
                FROM public.fpl1 where l1_id='$l1_id') as tbl1;";
        }

        $output = array();
        $result_query = pg_query($sql);
        if ($result_query) {
             $arrq = pg_fetch_all($result_query);
             // print_r($arrq);
             // exit();
             $arr = json_decode(json_encode($arrq), true);
                    $g=implode("",$arr[0]);
                    $geojson=$g;
                    $output = $geojson;
        }

        return $output;

        $this->closeConnection();
    }
}

$json = new Tehsil();
//$json->closeConnection();
echo $json->getfp_l1();

