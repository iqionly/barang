<?php
/**
 * Created by PhpStorm.
 * User: Microsoft
 * Date: 17/10/2018
 * Time: 11:37
 */

if( isset($_POST) || isset($_GET)){

    $STATUS = true;

    $date_exp = $_POST['tahun-exp'] . '-' . $_POST['bulan-exp'] . '-' . $_POST['hari-exp'] . ' 00:00:00';

    //Checking Value Length Valid Or Not
    if(
        strlen($_POST['name']) > 128 ||
        strlen($_POST['type']) > 64 ||
        strlen($_POST['count']) > 4 ||
        strlen($_POST['owner']) > 64 ||
        $_POST['hari-exp'] > 31 ||
        $_POST['bulan-exp'] > 12 ||
        $_POST['tahun-exp'] < 2018 ||
        $_POST['name'] == null ||
        $_POST['type'] == null ||
        $_POST['count'] == null ||
        $_POST['owner'] == null
    )
    {
        $STATUS = false;
    }

    // Check $STATUS is valid or not
    if($STATUS == true){
        $b = array(
            'name'=>$_POST['name'],
            'type'=>$_POST['type'],
            'count'=>$_POST['count'],
            'owner'=>$_POST['owner'],
            'description'=>$_POST['description'],
            'date_now'=>datenow(),
            'date_exp'=>$date_exp
        );
        $total = 1 + numr(query("SELECT * FROM barang"));

        $id_code = str_replace("-", "", $b['date_now']);

        //echo $date_exp;

        query("INSERT INTO barang VALUES('$total', '$id_code', '$b[name]', '$b[type]', '$b[count]', '$b[owner]', '$b[date_now]', '$b[date_now]', '$date_exp', '$b[description]', 'TRUE')");

        redirect();
    }
    else
    {
        redirect();
    }
}
else
{
    redirect();
}
