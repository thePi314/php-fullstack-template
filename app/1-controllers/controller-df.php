<?php

namespace Controllers;

class DataFetcher
{
    protected static function fetch_queryString() {
        $data = [];
        
        if($_SERVER['QUERY_STRING'] != null) {
            $temp = explode(';',$_SERVER['QUERY_STRING']);
            foreach ($temp as $piece){
                $temp2 = explode('=',$piece);
                $data[$temp2[0]] = $temp2[1];
            }
        }

        return $data;
    }

    protected static function fetch_requestData(){
        $tdata = file_get_contents('php://input');
        if ($tdata[0] !== '{') {
            $tdata = [];
            $temp1 = file_get_contents('php://input');
            $temp = explode('&',$temp1);
            foreach( $temp as $thingy ) {
                $hej = explode('=',$thingy);
                $tdata[$hej[0]] = $hej[1];
            }
        }
        else {
            $tdata = json_decode($tdata,true);
        }
        
        $data = [];
        foreach( $tdata as $key => $value ){
            $data[$key] = $value;
        }

        return $data;
    }

    public static function fetch_data(){
        $data = self::fetch_queryString();
        $data = array_merge($data,self::fetch_requestData());
    
        foreach( $data as $key => $value ) {
            if ($value === '' || $value == null) {
                unset($data[$key]);
            }
        }
        
        return $data;
    }
}