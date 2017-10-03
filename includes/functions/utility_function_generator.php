<?php

    function makeArrayIntoJsonArray($availableTagsDN){
        print_r($availableTagsDN);exit();
        $availableTags_jsonDN = '[';
            foreach ($availableTagsDN as $at) {
                $availableTags_json .= "'" . $at['id'] ."',";
                $at2 = str_replace("'", " ", $at);
                $availableTags_jsonDN .= "'" . $at2 . "',";
            }
            $availableTags_jsonDN = substr($availableTags_jsonDN, 0, -1);
            $availableTags_jsonDN .= ']';
            
            return $availableTags_jsonDN;
    }
