<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/rozvrhy.css" type="text/css" media="screen"/>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <style type="text/css">
            #schedule {max-width:824px !important; }
            #hours .day-name, .day-row .day-name {width: 4.98% !important;}
            #hours .item, .day-row .day-item {width: 8.62% !important;}
            .day-item-volno {width:94.78%; float:left; border-left-width: 1px; border-right: 1px; min-height: 71px; background-color: #61B0FF; }
        </style>

        <link rel="stylesheet" href="css/main.css" type="text/css" media="screen"/>
        <title>SUPLOVÁNÍ</title> 
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/informace.js"></script>
        
    </head> 
    <body>
        <?php include 'php/sseas.php';?>
        <?php
            function findSupl($cancel,$hour){
                for($i = 0; $i < count($cancel); $i++){
                    //echo $cancel[$i].'| |'.$hour.'|'.strcmp($cancel[$i], $hour)."<br>";
                    if(strcmp($cancel[$i], $hour) == 0)
                        return false;
                }
                return true;
            }
            function findIfResslovka($char){
                if (is_numeric($char)) {
                    return false;
                } else {
                    return true;
                }
            }

            $day_of_week = date('N', strtotime(date("l")));
            $dayIndex = $day_of_week - 1;
            $suplovani = [];
            $array2;

            $optsR = [
                "http" => [
                    "method" => "GET",
                    "header" => "Authorization: Basic dGVzdDp0ZXN0dGVzdHRlc3Q="
                ]
            ];

            $contextR = stream_context_create($optsR);

            // Open the file using the HTTP headers set above
            $fileR = file_get_contents('https://spsul.bakalari.cz/if/2/common/rooms', false, $contextR);
            //print_r($file);
            $xmlR = simplexml_load_string($fileR);
            $jsonR = json_encode($xmlR);
            $arrayr = json_decode($jsonR,TRUE);
            $rooms = [];
            for($i = 0; $i < count($arrayr['Rooms']['Room']); $i++){
                if($arrayr['Rooms']['Room'][$i]['Building'] == '02')
                    array_push($rooms, $arrayr['Rooms']['Room'][$i]['Abbrev']);
            }




            $opts = [
                "http" => [
                    "method" => "GET",
                    "header" => "Authorization: Basic dGVzdDp0ZXN0dGVzdHRlc3Q="
                ]
            ];

            $context = stream_context_create($opts);

            // Open the file using the HTTP headers set above
            $file = file_get_contents('https://spsul.bakalari.cz/if/2/substitutions/public/'.date("Y").date("m").date("d"), false, $context);
            //print_r($file);
            $xml = simplexml_load_string($file);
            $json = json_encode($xml);
            $array1 = json_decode($json,TRUE);
            for($i = 0; $i < count($array1['ChangesForClasses']['ChangesForClass']); $i++){
                $day = [];
                array_push($day, $array1['ChangesForClasses']['ChangesForClass'][$i]['Class']['Abbrev']);
                $cancel = [];
                if(isset($array1['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson'])){
                    if(isset($array1['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson'][0])){
                        for($j = 0; $j < count($array1['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson']); $j++){
                            array_push($cancel, $array1['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson'][$j]['Hour']);
                        }
                    }
                    else{
                        array_push($cancel, $array1['ChangesForClasses']['ChangesForClass'][$i]['CancelledLessons']['CancelledLesson']['Hour']);
                    }
                }
                if(isset($array1['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson'])){
                    if(isset($array1['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson'][0])){
                        for($j = 0; $j < count($array1['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson']); $j++){
                            if(findSupl($cancel, $array1['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson'][$j]['Hour'])){
                                array_push($cancel, $array1['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson'][$j]['Hour']);
                            }
                        }
                    }
                    else{
                        if(findSupl($cancel, $array1['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson']['Hour'])){
                                array_push($cancel, $array1['ChangesForClasses']['ChangesForClass'][$i]['ChangedLessons']['ChangedLesson']['Hour']);
                        }
                    }
                }
                array_push($day, $cancel);
                $opts2 = [
                    "http" => [
                        "method" => "GET",
                        "header" => "Authorization: Basic dGVzdDp0ZXN0dGVzdHRlc3Q="
                    ]
                ];

                $context2 = stream_context_create($opts);


                $url = "https://spsul.bakalari.cz/if/2/timetable/actual/class/" . $array1['ChangesForClasses']['ChangesForClass'][$i]['Class']['Id'];
                $file2 = file_get_contents($url, false, $context2);
                $xml2 = simplexml_load_string($file2);
                $json2 = json_encode($xml2);
                $array2 = json_decode($json2,TRUE);
                for($j = 0; $j < count($array2['Cells']['TimetableCell']); $j++){
                    if($array2['Cells']['TimetableCell'][$j]['DayIndex'] == $dayIndex){
                        $subject = [];
                        if(isset($array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Subject'])){
                            array_push($subject, false);
                            array_push($subject, ($array2['Cells']['TimetableCell'][$j]['HourIndex']-2));
                            array_push($subject, $array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Subject']['Abbrev']);
                            array_push($subject, $array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Teacher']['Abbrev']);
                            array_push($subject, $array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom']['Room']['Abbrev']);
                        }
                        else{
                            array_push($subject, true);
                            array_push($subject, ($array2['Cells']['TimetableCell'][$j]['HourIndex']-2));

                            $subjects = [];
                            array_push($subjects, $array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][0]['Subject']['Abbrev']);
                            array_push($subjects, $array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][0]['Teacher']['Abbrev']);
                            array_push($subjects, $array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][0]['Room']['Abbrev']);
                            array_push($subjects, $array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][0]['Group']['Abbrev']);
                            array_push($subject, $subjects);

                            $subjects = [];
                            array_push($subjects, $array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][1]['Subject']['Abbrev']);
                            array_push($subjects, $array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][1]['Teacher']['Abbrev']);
                            array_push($subjects, $array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][1]['Room']['Abbrev']);
                            array_push($subjects, $array2['Cells']['TimetableCell'][$j]['Atoms']['TimetableAtom'][1]['Group']['Abbrev']);
                            array_push($subject, $subjects);
                        }
                        array_push($day, $subject);
                    }
                }
                if(!findIfResslovka($day[0][0])){
                    if(isset($day[2][0])){
                        if(!$day[2][0]){
                            if($day[2][2] != 'ODV'){
                                array_push($suplovani,$day);
                            }
                        }
                        else{
                            if($day[2][2][0] != 'ODV'){
                                array_push($suplovani,$day);
                            }
                        }
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
        <div id="school" class="rozvrh" style="color: black">
        <p class="rozvrhName">Hlavní budova:<span style="font-size: 10px;margin-left: 489px">(středisko Stříbrníky)</span></p>  
            <div id="schedule" style="min-width: auto; visibility: visible; float: left; margin-left: 10px">
                <div class="clearfix">
                    <div id="hours" class="clearfix">
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
                    </div>
                </div>     
            </div>
        </div>
        <div id="training" class="rozvrh">  
        <p class="rozvrhName">Mimořádné změny:</p>  
            <div style="z-index: 5;">
                      <table class="substitutetable" style="width: 100%;z-index: 2;"><!-- maximalne 6 suplovani po te se musi sliderovat -->
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
        <div class="notification">
            <div style="background-image: url('pics/zeme.png');"></div>
            <p style="font-weight: bold">Oznámení</p>
        </div>
        <div class="notificationbar">
            <ul id='nadpis'>
                <li><span>Všechna suplování platí pouze pro dnešní den.</span></li>
            </ul>
        </div> 
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var supl = <?php echo json_encode($suplovani); ?>;
        var rooms = <?php echo json_encode($rooms) ?>;
        console.log(supl);
        var suplSseas = <?php echo json_encode($sseasSupl) ?>;
        var oznSseas = <?php echo json_encode($sseasOzn) ?>;

        /*var suplSseas = [];
        var oznSseas = [];*/
    </script>
</body>
</html>