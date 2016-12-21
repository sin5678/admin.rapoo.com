<?php

    ini_set('max_execution_time', '0');
    include('phpQuery-onefile.php');



    $DB_HOST="rdspqgsk1zdrvl4k5d3spublic.mysql.rds.aliyuncs.com";
    $DB_DATABASE="rapoo";
    $DB_USERNAME="rapoo";
    $DB_PASSWORD="rapooweb2015";

    $connect = mysqli_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE) or die('Unale to connect');
    $sql = "select * from rap_product";
    $result = mysqli_query($connect,$sql);




    while($row = mysqli_fetch_assoc($result)) {
        $maidian = [];
        $doc = phpQuery::newDocumentHTML($row['ProductShow']);

        $list = pq("div[style='width: 980px; height: 500px; margin: 0 auto;']");

        for ($i = 0; $i < $list->length(); $i++) {
            $firstDiv = pq($list)->eq($i)->find(":first");
            $bgstyle = pq($firstDiv)->attr("style");
            $bgstyleArr = explode(";", $bgstyle);
            foreach ($bgstyleArr as $styleItem) {
                $tArr = explode(":", $styleItem);
                if ($tArr[0] == "background") {

                    $backgroundArr = explode(" ", $tArr[1]);

                    $arr=explode("/",$backgroundArr[2]);

                    $maidian['file'][] = str_replace("')","",$arr[2]);
                    $maidian['titlebackground'][] = $backgroundArr[5];
                    $maidian['titleverposition'][] = $backgroundArr[3];
                    $maidian['titlehorposition'][] = $backgroundArr[4];
                }
            };

            $title = pq($firstDiv)->children()->eq(0)->text();
            $maidian['title'][] = $title;

            $titleStyle = pq($firstDiv)->children()->eq(0)->attr("style");
            $titleStyleArr = explode(";", $titleStyle);

            foreach ($titleStyleArr as $styleItem) {
                $tArr = explode(":", $styleItem);

                if($tArr[0] == 'font-size')
                {
                    $maidian['titlefontsize'][]= $tArr[1];
                }elseif($tArr[0] =='color')
                {
                    $maidian['titlefontcolor'][]= $tArr[1];
                }
                elseif($tArr[0] =='font-weight')
                {
                    $maidian['titlefontstyle'][]= $tArr[1];
                }
                elseif($tArr[0] =='text-align')
                {
                    $maidian['titlefontalign'][]= $tArr[1];
                }
                elseif($tArr[0] =='width')
                {
                    $maidian['titlewidth'][]= $tArr[1];
                }
                elseif($tArr[0] =='height')
                {
                    $maidian['titleheight'][]= $tArr[1];
                }
                elseif($tArr[0] =='padding-left') {
                    $maidian['titlemarginleft'][] = $tArr[1];
                }
                elseif($tArr[0] =='padding-top')
                {
                    $maidian['titlemargintop'][]= $tArr[1];
                }
            };

            $des = pq($firstDiv)->children()->eq(1)->text();
            $maidian['description'][] = $des;

            $desStyle = pq($firstDiv)->children()->eq(1)->attr("style");
            $desStyleArr = explode(";", $desStyle);
            foreach ($desStyleArr as $styleItem) {
                $tArr = explode(":", $styleItem);

                if($tArr[0] == 'font-size')
                {
                    $maidian['description_fontsize'][]= $tArr[1];
                }elseif($tArr[0] =='color')
                {
                    $maidian['description_fontcolor'][]= $tArr[1];
                }
                elseif($tArr[0] =='font-weight')
                {
                    $maidian['description_fontstyle'][]= $tArr[1];
                }
                elseif($tArr[0] =='text-align')
                {
                    $maidian['description_fontalign'][]= $tArr[1];
                }
                elseif($tArr[0] =='width')
                {
                    $maidian['description_fontwidth'][]= $tArr[1];
                }
                elseif($tArr[0] =='height')
                {
                    $maidian['description_fontheight'][]= $tArr[1];
                }
                elseif($tArr[0] =='padding-left')
                {
                    $maidian['description_left'][]= $tArr[1];
                }         elseif($tArr[0] =='padding-top')
                {
                    $maidian['description_top'][]= $tArr[1];
                }
            };
        }


        $maidainJson= base64_encode(serialize($maidian));
        $sql = "update rap_product set ProductShowJSON =\"".$maidainJson."\" where PID=".$row['PID'];



        mysqli_query($connect,$sql);
    }

    echo "success";
     mysqli_close($connect);



?>