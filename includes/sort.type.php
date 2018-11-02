<?php
/**
 * Created by PhpStorm.
 * User: Microsoft
 * Date: 17/10/2018
 * Time: 12:47
 */

function sorttype($b, $select=null)
{
    if($b == null){
        $query = query(
            "SELECT
            child.id,
            child.type,
            child.parent_id,
            parent.type as parentname
            FROM barang_type child
            JOIN barang_type parent
            ON child.Parent_Id = parent.id
        ");
    }else{
        $query = $b['query'];
    }

    $before = null;
    while($fetch = fetch($query)){
        //var_dump($fetch)
        if($fetch['parentname'] !== null && $before !== $fetch['parentname']){
            echo '<option value="' . $fetch['parentname'] . '"';
            if($select == $fetch['parentname']){
                echo ' selected ';
            }
            echo '>' . strtoupper($fetch['parentname']) . '</option>';
            $before = $fetch['parentname'];
        }
        echo '<option value="' . $fetch['type'] . '"';
        if($select == $fetch['type']){
            echo ' selected ';
        }
        echo '>---' . strtoupper($fetch['type']) . '</option>';
    }
}