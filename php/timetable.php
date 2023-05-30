<?php
try {
    include 'php/sseas.php';
} catch (Exception $e) {
}

?>
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
    if (!strpos($str, ':')) {
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
    } else {
        $dvoj = false;
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str[$i] == ':') {
                $dvoj = true;
            }
            if ($dvoj) {
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
        return true;
    } else {
        return false;
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
        'header' => 'Authorization: Basic U2tvbGFfNDkyNTp4N0U5MDdDMkJFOEM1',
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
                    if (is_array($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedGroups']['ChangedGroup'])) {
                        array_push($class, akce($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedGroups']['ChangedGroup'][0]));
                    } else {
                        array_push($class, akce($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedGroups']['ChangedGroup']));
                    }
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
if (is_array($array['Classes']['Class'])) {
    for ($i = 0; $i < count($array['Classes']['Class']); $i++) {
        if (findIfResslovka($array['Classes']['Class'][$i]['Abbrev'][0]) && checkClasses($classes, $array['Classes']['Class'][$i]['ID']) && $array['Classes']['Class'][$i]['Abbrev'] != '1DS') {
            array_push($classes, [[$array['Classes']['Class'][$i]['ID'], $array['Classes']['Class'][$i]['Abbrev']], [], []]);
        }
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
    if (is_array($array3['Cells']['TimetableCell'])) {
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
                            if (is_array($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedGroups']['ChangedGroup'])) {
                                array_push($class, akce($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedGroups']['ChangedGroup'][0]));
                            } else {
                                array_push($class, akce($array2['ChangesForClasses']['ChangesForClass'][$i]['ChangedGroups']['ChangedGroup']));
                            }
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
            if (is_array($array3['Cells']['TimetableCell'])) {
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
<script type="text/javascript">
    var supl = <?php echo json_encode($array2SORT); ?>;
    var supl2 = <?php echo json_encode($arraySORT); ?>;
    var suplakos = <?php echo json_encode($array21); ?>;
    //console.log(supl);
    //console.log(supl2);
    //console.log(suplakos);
    var suplSseas = <?php echo json_encode($sseasSupl); ?>;
    var oznSseas = <?php echo json_encode($sseasOzn); ?>;
    console.log(suplakos);
    console.log(supl);
    /*var suplSseas = [];
    var oznSseas = [];*/
</script>
