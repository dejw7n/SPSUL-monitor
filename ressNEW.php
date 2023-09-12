<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        .day-item {
            background-color: white;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


    <title>SUPLOVÁNÍ</title>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>
    <!--
Console.WARNING:
jQuery.Deferred exception: Cannot read property '0' of undefined TypeError: Cannot read property '0' of undefined
    at createEverything (http://192.168.1.203/fullhd/js/informaceNEW.js:548:43)
    at HTMLDocument.<anonymous> (http://192.168.1.203/fullhd/js/informaceNEW.js:693:9)
    at j (http://192.168.1.203/fullhd/js/jquery-3.2.1.min.js:2:29999)
    at k (http://192.168.1.203/fullhd/js/jquery-3.2.1.min.js:2:30313) undefined

Console.ERROR:
jquery-3.2.1.min.js:2 Uncaught TypeError: Cannot read property '0' of undefined
    at createEverything (informaceNEW.js:548)
    at HTMLDocument.<anonymous> (informaceNEW.js:693)
    at j (jquery-3.2.1.min.js:2)
    at k (jquery-3.2.1.min.js:2)
 <script src="js/informaceNEW.js"></script>-->

    <script src="js/informaceF.js"></script>


    <style type="text/css">
        #schedule {
            max-width: 824px !important;
        }

        #hours .day-name,
        .day-row .day-name {
            width: 4.98% !important;
        }

        #hours .item,
        .day-row .day-item {
            width: 8.62% !important;
        }

        .day-item-volno {
            width: 94.78%;
            float: left;
            border-left-width: 1px;
            border-right: 1px;
            min-height: 71px;
            background-color: #61B0FF;
        }
    </style>
    <link rel="stylesheet" href="css/rozvrhyNEW.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mainNEW.css" type="text/css" media="screen" />

</head>

<body>
    <?php include 'php/sseasR.php'; ?>
    <?php
    function findSupl($cancel, $hour)
    {
        for ($i = 0; $i < count($cancel); $i++) {
            if (strcmp($cancel[$i], $hour) == 0) {
                return false;
            }
        }
        return true;
    }
    function akce($str)
    {
        $f = '';
        $tmp = [];
        $s = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if (is_numeric($str[$i])) {
                $f .= $str[$i];
            } elseif ($str[$i] == '.') {
                $s++;
                array_push($tmp, $f);
                $f = '';
            }
    
            if ($s == 2) {
                break;
            }
        }
        if (count($tmp) != 2) {
            array_push($tmp, $tmp[0]);
        }
        if (strpos($str, 'Obecná absence třídy')) {
            array_push($tmp, 'absc');
        } elseif (strpos($str, 'kulturní akce')) {
            array_push($tmp, 'kult');
        } elseif (strpos($str, 'přednáška')) {
            array_push($tmp, 'před');
        } elseif (strpos($str, 'exkurze')) {
            array_push($tmp, 'exku');
        } else {
            array_push($tmp, 'akce');
        }
        return $tmp;
    }
    function findIt($a, $b)
    {
        for ($i = 0; $i < count($a); $i++) {
            if ($a[$i] == $b) {
                return true;
            }
        }
        return false;
    }
    function findIfResslovka($char)
    {
        if (is_numeric($char)) {
            return false;
        } else {
            return true;
        }
    }
    function copyArrayTo($ar1, $ar2)
    {
        for ($i = 0; $i < count($ar2); $i++) {
            array_push($ar1, $ar2[$i]);
        }
    }
    function compareChange($array, $what)
    {
        for ($i = 0; $i < count($array); $i++) {
            if (strcmp($array[$i], $what) == 0) {
                return true;
            }
        }
        return false;
    }
    function checkinArray($ar, $check)
    {
        for ($i = 0; $i < count($check); $i++) {
            if ($check[$i] == $ar) {
                return false;
            }
        }
        return true;
    }
    function checkClasses($classes, $class)
    {
        for ($i = 0; $i < count($classes); $i++) {
            if ($classes[$i][0][0] == $class) {
                return false;
            }
        }
        return true;
    }
    $suplovani = [];
    $array2;
    $suplclasses = [];
    $suplovani = [];
    $array = [];
    $array2 = [];
    $array3 = [];
    $tmpS = [];
    $today = date('Ymd');
    $tommorow = date('Ymd', strtotime(' +1 day'));
    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => 'Authorization: Basic dGVzdDp0ZXN0dGVzdHRlc3Q=',
        ],
    ];
    
    $context = stream_context_create($opts);
    
    // Open the file using the HTTP headers set above
    $file = file_get_contents('https://spsul.bakalari.cz/if/2/common/classes', false, $context);
    //print_r($file);
    $xml = simplexml_load_string($file);
    $json = json_encode($xml);
    $array = json_decode($json, true);
    /*
            for($i = 0; $i < count($array['Classes']['Class']); $i++){
                iffindIfResslovka($array['Classes']['Class'][$i]['Abbrev'][0]) && checkClasses($classes, [$array['Classes']['Class'][$i]['ID'])){
                    array_push($classes, [[$array['Classes']['Class'][$i]['ID'],$array['Classes']['Class'][$i]['Abbrev']],[],[]]);
                }
            }
            */
    
    /*                                                 Zmenene hodiny + akce(praxe)                                                               */
    
    $classes = [];
    $file2 = file_get_contents('https://spsul.bakalari.cz/if/2/substitutions/public/' . $today /*.date("Y").date("m").(date("d"))*/, false, $context);
    //print_r($file);
    $xml2 = simplexml_load_string($file2);
    $json2 = json_encode($xml2);
    $array2 = json_decode($json2, true);
    $array21 = json_decode($json2, true);
    if (isset($array2['ChangesForClasses']['ChangesForClass'])) {
        if (!isset($array2['ChangesForClasses']['ChangesForClass']['Hour'])) {
            for ($i = 0; $i < count($array2['ChangesForClasses']['ChangesForClass']); $i++) {
                $class = [];
                if (findIfResslovka($array2['ChangesForClasses']['ChangesForClass'][$i]['Class']['Abbrev'][0])) {
                    array_push($class, [$array2['ChangesForClasses']['ChangesForClass'][$i]['Class']['Id'], $array2['ChangesForClasses']['ChangesForClass'][$i]['Class']['Abbrev']]);
                    $cancel = [];
                    if (count($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']) > 0) {
                        if (isset($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson'][0]['Hour'])) {
                            for ($j = 0; $j < count($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson']); $j++) {
                                if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson'][$j]['Hour'])) {
                                    array_push($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson'][$j]['Hour']);
                                }
                            }
                        } else {
                            array_push($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson']['Hour']);
                        }
                    }
    
                    if (count($array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']) > 0) {
                        if (isset($array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson'][0]['Hour'])) {
                            for ($j = 0; $j < count($array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson']); $j++) {
                                if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson'][$j]['Hour'])) {
                                    array_push($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson'][$j]['Hour']);
                                }
                            }
                        } else {
                            if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson']['Hour'])) {
                                array_push($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson']['Hour']);
                            }
                        }
                    }
                    array_push($class, $cancel);
    
                    if (isset($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedGroups']['ChangedGroup'])) {
                        array_push($class, akce($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedGroups']['ChangedGroup']));
                    } else {
                        array_push($class, []);
                    }
    
                    array_push($classes, $class);
                }
            }
        } else {
            $cancel = [];
            if (count($array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']) > 0) {
                if (isset($array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']['ChangedLesson'][0]['Hour'])) {
                    for ($j = 0; $j < count($array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']['ChangedLesson']); $j++) {
                        if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']['ChangedLesson'][$j]['Hour'])) {
                            array_push($cancel, $array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']['ChangedLesson'][$j]['Hour']);
                        }
                    }
                } else {
                    array_push($cancel, $array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']['ChangedLesson']['Hour']);
                }
            }
    
            if (count($array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']) > 0) {
                if (isset($array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson'][0]['Hour'])) {
                    for ($j = 0; $j < count($array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson']); $j++) {
                        if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson'][$j]['Hour'])) {
                            array_push($cancel, $array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson'][$j]['Hour']);
                        }
                    }
                } else {
                    if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson']['Hour'])) {
                        array_push($cancel, $array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson']['Hour']);
                    }
                }
            }
            array_push($class, $cancel);
    
            if (isset($array2['ChangesForClasses']['ChangesForClass']['ChangedGroups']['ChangedGroup'])) {
                array_push($class, [$array2['ChangesForClasses']['ChangesForClass']['ChangedGroups']['ChangedGroup']]);
            } else {
                array_push($class, []);
            }
    
            array_push($classes, $class);
        }
    }
    for ($i = 0; $i < count($array['Classes']['Class']); $i++) {
        if (findIfResslovka($array['Classes']['Class'][$i]['Abbrev'][0]) && checkClasses($classes, $array['Classes']['Class'][$i]['ID']) && $array['Classes']['Class'][$i]['Abbrev'] != '1DS') {
            array_push($classes, [[$array['Classes']['Class'][$i]['ID'], $array['Classes']['Class'][$i]['Abbrev']], [], []]);
        }
    }
    
    /*                                               Konec Zmenene hodiny + akce(praxe)                                                            */
    
    /*                                                  Ziskani rozvrh pro dany den                                                                */
    $day_of_week = date('N', strtotime(date('l')));
    $dayIndex = $day_of_week - 1;
    
    for ($i = 0; $i < count($classes); $i++) {
        $file3 = file_get_contents('https://spsul.bakalari.cz/if/2/timetable/actual/class/' . $classes[$i][0][0], false, $context);
        $xml3 = simplexml_load_string($file3);
        $json3 = json_encode($xml3);
        $array3 = json_decode($json3, true);
        $day = [];
        for ($j = 0; $j < count($array3['Cells']['TimetableCell']); $j++) {
            if ($array3['Cells']['TimetableCell'][$j]['DayIndex'] == $dayIndex) {
                $tmp = [];
                array_push($tmp, $array3['Cells']['TimetableCell'][$j]['HourIndex'] - 2);
                if (isset($array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Subject']['Abbrev'])) {
                    array_push($tmp, 1);
                    $tmp2 = [];
                    array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Subject']['Abbrev']);
                    array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Teacher']['Abbrev']);
                    array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Room']['Abbrev']);
                    array_push($tmp, $tmp2);
                } else {
                    array_push($tmp, count($array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']));
                    $tmp2 = [];
                    for ($k = 0; $k < count($array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']); $k++) {
                        array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][$k]['Subject']['Abbrev']);
                        array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][$k]['Teacher']['Abbrev']);
                        array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][$k]['Room']['Abbrev']);
                        array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][$k]['Group']['Abbrev']);
                        array_push($tmp, $tmp2);
                        $tmp2 = [];
                    }
                }
    
                array_push($day, $tmp);
            }
        }
        if (count($classes[$i][2]) > 0) {
            for ($j = $classes[$i][2][0]; $j <= $classes[$i][2][1]; $j++) {
                $tmp = [];
                array_push($tmp, intval($j));
                array_push($tmp, 1);
                $tmp2 = [];
                array_push($tmp2, $classes[$i][2][2]);
                array_push($tmp2, '');
                array_push($tmp2, '');
                array_push($tmp, $tmp2);
    
                array_push($day, $tmp);
            }
        }
        $day2 = [];
        $check = [];
        for ($j = 0; $j < count($day); $j++) {
            $tmpS = [];
            for ($k = 0; $k < count($day); $k++) {
                if (checkinArray($k, $check)) {
                    $min = $k;
                }
            }
            for ($k = 0; $k < count($day); $k++) {
                if ($day[$min][0] > $day[$k][0]) {
                    if (checkinArray($k, $check)) {
                        $min = $k;
                    }
                }
            }
            array_push($day2, $day[$min]);
            array_push($check, $min);
        }
    
        array_push($classes[$i], $day2);
    }
    $classes2 = [];
    
    for ($i = 0; $i < count($classes); $i++) {
        array_push($classes2, $classes[$i]);
    }
    
    /*                                               Konec Ziskani rozvrh pro dany den                                                              */
    if (count($sseasSupl) == 0) {
        $classes = [];
        /*                                                 Zmenene hodiny + akce(praxe)                                                               */
        $day_of_week = date('N', strtotime(date('l')));
        $dayIndex = $day_of_week;
        if ($dayIndex != 7 && $dayIndex != 6 && $dayIndex != 5) {
            $file2 = file_get_contents('https://spsul.bakalari.cz/if/2/substitutions/public/' . $tommorow /*.date("Y").date("m").(date("d"))*/, false, $context);
            //print_r($file);
            $xml2 = simplexml_load_string($file2);
            $json2 = json_encode($xml2);
            $array2 = json_decode($json2, true);
            if (isset($array2['ChangesForClasses']['ChangesForClass'])) {
                if (!isset($array2['ChangesForClasses']['ChangesForClass']['Hour'])) {
                    for ($i = 0; $i < count($array2['ChangesForClasses']['ChangesForClass']); $i++) {
                        $class = [];
                        if (findIfResslovka($array2['ChangesForClasses']['ChangesForClass'][$i]['Class']['Abbrev'][0])) {
                            array_push($class, [$array2['ChangesForClasses']['ChangesForClass'][$i]['Class']['Id'], $array2['ChangesForClasses']['ChangesForClass'][$i]['Class']['Abbrev']]);
                            $cancel = [];
                            if (count($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']) > 0) {
                                if (isset($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson'][0]['Hour'])) {
                                    for ($j = 0; $j < count($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson']); $j++) {
                                        if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson'][$j]['Hour'])) {
                                            array_push($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson'][$j]['Hour']);
                                        }
                                    }
                                } else {
                                    array_push($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson']['Hour']);
                                }
                            }
    
                            if (count($array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']) > 0) {
                                if (isset($array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson'][0]['Hour'])) {
                                    for ($j = 0; $j < count($array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson']); $j++) {
                                        if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson'][$j]['Hour'])) {
                                            array_push($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson'][$j]['Hour']);
                                        }
                                    }
                                } else {
                                    if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson']['Hour'])) {
                                        array_push($cancel, $array2['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson']['Hour']);
                                    }
                                }
                            }
                            array_push($class, $cancel);
    
                            if (isset($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedGroups']['ChangedGroup'])) {
                                array_push($class, akce($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedGroups']['ChangedGroup']));
                            } else {
                                array_push($class, []);
                            }
    
                            array_push($classes, $class);
                        }
                    }
                } else {
                    $cancel = [];
                    if (count($array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']) > 0) {
                        if (isset($array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']['ChangedLesson'][0]['Hour'])) {
                            for ($j = 0; $j < count($array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']['ChangedLesson']); $j++) {
                                if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']['ChangedLesson'][$j]['Hour'])) {
                                    array_push($cancel, $array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']['ChangedLesson'][$j]['Hour']);
                                }
                            }
                        } else {
                            array_push($cancel, $array2['ChangesForClasses']['ChangesForClass']['ChangedLessons']['ChangedLesson']['Hour']);
                        }
                    }
    
                    if (count($array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']) > 0) {
                        if (isset($array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson'][0]['Hour'])) {
                            for ($j = 0; $j < count($array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson']); $j++) {
                                if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson'][$j]['Hour'])) {
                                    array_push($cancel, $array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson'][$j]['Hour']);
                                }
                            }
                        } else {
                            if (!findIt($cancel, $array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson']['Hour'])) {
                                array_push($cancel, $array2['ChangesForClasses']['ChangesForClass']['CancelledLessons']['CancelledLesson']['Hour']);
                            }
                        }
                    }
                    array_push($class, $cancel);
    
                    if (isset($array2['ChangesForClasses']['ChangesForClass']['ChangedGroups']['ChangedGroup'])) {
                        array_push($class, [$array2['ChangesForClasses']['ChangesForClass']['ChangedGroups']['ChangedGroup']]);
                    } else {
                        array_push($class, []);
                    }
    
                    array_push($classes, $class);
                }
            }
            for ($i = 0; $i < count($array['Classes']['Class']); $i++) {
                if (findIfResslovka($array['Classes']['Class'][$i]['Abbrev'][0]) && checkClasses($classes, $array['Classes']['Class'][$i]['ID']) && $array['Classes']['Class'][$i]['Abbrev'] != '1DS') {
                    array_push($classes, [[$array['Classes']['Class'][$i]['ID'], $array['Classes']['Class'][$i]['Abbrev']], [], []]);
                }
            }
    
            /*                                               Konec Zmenene hodiny + akce(praxe)                                                            */
    
            /*                                                  Ziskani rozvrh pro dany den                                                                */
    
            for ($i = 0; $i < count($classes); $i++) {
                $file3 = file_get_contents('https://spsul.bakalari.cz/if/2/timetable/actual/class/' . $classes[$i][0][0], false, $context);
                $xml3 = simplexml_load_string($file3);
                $json3 = json_encode($xml3);
                $array3 = json_decode($json3, true);
                $day = [];
                for ($j = 0; $j < count($array3['Cells']['TimetableCell']); $j++) {
                    if ($array3['Cells']['TimetableCell'][$j]['DayIndex'] == $dayIndex) {
                        $tmp = [];
                        array_push($tmp, $array3['Cells']['TimetableCell'][$j]['HourIndex'] - 2);
                        if (isset($array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Subject']['Abbrev'])) {
                            array_push($tmp, 1);
                            $tmp2 = [];
                            array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Subject']['Abbrev']);
                            array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Teacher']['Abbrev']);
                            array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Room']['Abbrev']);
                            array_push($tmp, $tmp2);
                        } else {
                            array_push($tmp, count($array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']));
                            $tmp2 = [];
                            for ($k = 0; $k < count($array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']); $k++) {
                                array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][$k]['Subject']['Abbrev']);
                                array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][$k]['Teacher']['Abbrev']);
                                array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][$k]['Room']['Abbrev']);
                                array_push($tmp2, $array3['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][$k]['Group']['Abbrev']);
                                array_push($tmp, $tmp2);
                                $tmp2 = [];
                            }
                        }
    
                        array_push($day, $tmp);
                    }
                }
                if (count($classes[$i][2]) > 0) {
                    for ($j = $classes[$i][2][0]; $j <= $classes[$i][2][1]; $j++) {
                        $tmp = [];
                        array_push($tmp, intval($j));
                        array_push($tmp, 1);
                        $tmp2 = [];
                        array_push($tmp2, $classes[$i][2][2]);
                        array_push($tmp2, '');
                        array_push($tmp2, '');
                        array_push($tmp, $tmp2);
    
                        array_push($day, $tmp);
                    }
                }
                $day2 = [];
                $check = [];
                for ($j = 0; $j < count($day); $j++) {
                    $tmpS = [];
                    for ($k = 0; $k < count($day); $k++) {
                        if (checkinArray($k, $check)) {
                            $min = $k;
                        }
                    }
                    for ($k = 0; $k < count($day); $k++) {
                        if ($day[$min][0] > $day[$k][0]) {
                            if (checkinArray($k, $check)) {
                                $min = $k;
                            }
                        }
                    }
                    array_push($day2, $day[$min]);
                    array_push($check, $min);
                }
    
                array_push($classes[$i], $day2);
            }
        }
    }
    
    $tmpArr = [];
    for ($i = 0; $i < count($classes2); $i++) {
        array_push($tmpArr, $classes2[$i][0][1]);
    }
    sort($tmpArr);
    $array2SORT = [];
    
    for ($i = 0; $i < count($tmpArr); $i++) {
        for ($j = 0; $j < count($classes2); $j++) {
            if ($tmpArr[$i] == $classes2[$j][0][1]) {
                array_push($array2SORT, $classes2[$j]);
                break;
            }
        }
    }
    
    $tmpArr = [];
    for ($i = 0; $i < count($classes); $i++) {
        array_push($tmpArr, $classes[$i][0][1]);
    }
    sort($tmpArr);
    $arraySORT = [];
    
    for ($i = 0; $i < count($tmpArr); $i++) {
        for ($j = 0; $j < count($classes); $j++) {
            if ($tmpArr[$i] == $classes[$j][0][1]) {
                array_push($arraySORT, $classes[$j]);
                break;
            }
        }
    }
    
    ?>
    <div class="page">
        <div class="navbar">
            <div class="logo" style="width:291,5px; height:70px">
                <img src="pics/logo_spsul.png" width="291,5px" height="70px">
            </div>
            <div id='ringing'></div>
            <div class="time">
                <p id="actualtime"></p>
            </div>
        </div>
        <div class="container">
            <div class="row" style="min-height: 527px;">
                <div class="col-xs-1"></div>
                <div class="col-xs-6">
                    <div id="school" class="rozvrh rozvrhR" style="color: black">
                        <div style="height: 35px;">
                            <p class="rozvrhName" style="width: 87%; float: left;">Dnes:
                            <p style="font-size: 10px;width: 100%; height: 35px; line-height: 48px; text-align: right;">(středisko Resslova)</p>
                            </p>
                        </div>
                        <div id="schedule" style="min-width: auto; visibility: visible; float: left;">
                            <div class="clearfix clearfix1">
                                <div id="hours" class="clearfix clearfix1">
                                    <div class="day-name"></div>
                                    <div class="item">
                                        <div class="num">0</div>
                                        <div class="hour"><span class="from">7:10</span> - <span class="to">7:55</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">1</div>
                                        <div class="hour"><span class="from">8:00</span> - <span class="to">8:45</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">2</div>
                                        <div class="hour"><span class="from">8:55</span> - <span class="to">9:40</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">3</div>
                                        <div class="hour"><span class="from">9:50</span> - <span class="to">10:35</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">4</div>
                                        <div class="hour"><span class="from">10:50</span> - <span class="to">11:35</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">5</div>
                                        <div class="hour"><span class="from">11:45</span> - <span class="to">12:30</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">6</div>
                                        <div class="hour"><span class="from">12:40</span> - <span class="to">13:25</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">7</div>
                                        <div class="hour"><span class="from">13:35</span> - <span class="to">14:20</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">8</div>
                                        <div class="hour"><span class="from">14:25</span> - <span class="to">15:10</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">9</div>
                                        <div class="hour"><span class="from">15:15</span> - <span class="to">16:00</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">10</div>
                                        <div class="hour"><span class="from">16:05</span> - <span class="to">16:50</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6">
                    <?php if(count($sseasSupl) > 0) : ?>
                    <div id="training" class="rozvrh">
                        <p class="rozvrhName">Mimořádné změny:</p>
                        <div style="z-index: 5;">
                            <table class="substitutetable" style="width: 100%;z-index: 2; margin-top: -13.5px">
                                <tr style="color: #00A2E2; font-weight: bold; ">
                                    <td style="font-size: 14px;font-weight: bold;">Třída</td>
                                    <td style="font-size: 14px;font-weight: bold;">Hodina</td>
                                    <td style="font-size: 14px;font-weight: bold;">Vyučijící</td>
                                    <td style="font-size: 14px;font-weight: bold;">Učebna</td>
                                    <td style="font-size: 14px;font-weight: bold;">Poznámka</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php else : ?>
                    <div id="schoolTommorow" class="rozvrh rozvrhR" style="color: black">
                        <div style="height: 35px;">
                            <p class="rozvrhName" style="width: 27%; float: left;">Příští školní den:
                            <p style="font-size: 10px;width: 100%; height: 35px; line-height: 48px; text-align: right;">(středisko Resslova)</p>
                            </p>
                        </div>
                        <div id="schedule" style="min-width: auto; visibility: visible; float: left;">
                            <div class="clearfix clearfix2">
                                <div id="hours" class="clearfix clearfix2">
                                    <div class="day-name"></div>
                                    <div class="item">
                                        <div class="num">0</div>
                                        <div class="hour"><span class="from">7:10</span> - <span class="to">7:55</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">1</div>
                                        <div class="hour"><span class="from">8:00</span> - <span class="to">8:45</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">2</div>
                                        <div class="hour"><span class="from">8:55</span> - <span class="to">9:40</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">3</div>
                                        <div class="hour"><span class="from">9:50</span> - <span class="to">10:35</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">4</div>
                                        <div class="hour"><span class="from">10:50</span> - <span class="to">11:35</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">5</div>
                                        <div class="hour"><span class="from">11:45</span> - <span class="to">12:30</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">6</div>
                                        <div class="hour"><span class="from">12:40</span> - <span class="to">13:25</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">7</div>
                                        <div class="hour"><span class="from">13:35</span> - <span class="to">14:20</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">8</div>
                                        <div class="hour"><span class="from">14:25</span> - <span class="to">15:10</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">9</div>
                                        <div class="hour"><span class="from">15:15</span> - <span class="to">16:00</span></div>
                                    </div>

                                    <div class="item">
                                        <div class="num">10</div>
                                        <div class="hour"><span class="from">16:05</span> - <span class="to">16:50</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!--<div class="notificationR">
                <div style="background-image: url('pics/zeme.png');"></div>
                <p style="font-weight: bold">Oznámení</p>
            </div>-->
            <div class="row" style="padding: 1%">

            </div>
            <div class="row">
                <div class="col-xs-10F">
                    <div class="notificationRbar">
                        <table id='nadpis'>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var supl = <?php echo json_encode($array2SORT); ?>;
        var supl2 = <?php echo json_encode($arraySORT); ?>;
        var suplakos = <?php echo json_encode($array21); ?>;
        //console.log(supl);
        //console.log(supl2);
        //console.log(suplakos);
        var suplSseas = <?php echo json_encode($sseasSupl); ?>;
        var oznSseas = <?php echo json_encode($sseasOzn); ?>;
        //console.log(suplakos);
        /*var suplSseas = [];
        var oznSseas = [];*/
    </script>
</body>

</html>
