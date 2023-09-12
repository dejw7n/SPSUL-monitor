<?php
// Disable error reporting
ini_set('display_errors', 0);
error_reporting(0);
?>
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
    <script src="js/timetable.js"></script>


    <style type="text/css">
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
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#de401a',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="css/timetable.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="css/mainNEW.css" type="text/css" media="screen" /> -->

</head>

<body>
    <?php
    require_once 'php/stribrniky.php';
    ?>
    <div class="w-screen h-screen flex flex-col gap-8">
        <div class="grid grid-cols-3 bg-gray-100 py-2 px-8">
            <div class="flex">
                <img src="images/logo.png" class="my-auto">
            </div>
            <div class="flex mx-auto">
                <div class="my-auto flex flex-col">
                    <div id="lessonState" class="mx-auto text-2xl font-bold leading-none "></div>
                    <div id='ringing' class="mx-auto text-xl font-normal"></div>
                </div>
            </div>
            <div class="ml-auto">
                <div class="my-auto flex flex-col">
                    <p id="actualtime" class="text-6xl leading-none ml-auto"></p>
                    <div class="flex gap-2 ml-auto">
                        <p id="dayOfWeek" class="ml-auto text-2xl leading-none"></p>
                        <p id="date" class="ml-auto text-2xl leading-none"></p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="flex justify-around px-8">
                <?php
                    $timetable = [
                            [
                                "elementId" => "school",
                                "title" => "DNEŠNÍ ROZVRHY"
                            ],
                            [
                                "elementId" => "schoolTomorrow",
                                "title" => "PŘÍŠTÍ ŠKOLNÍ DEN"
                            ]
                        ];
                    foreach ($timetable as $item) {
                        ?>
                <div id="<?php echo $item['elementId']; ?>" class="grid gap-2">
                    <div>
                        <p class="font-bold text-2xl text-neutral-700"><?php echo $item['title']; ?></p>
                    </div>
                    <div class="shadow-2xl">
                        <div class="h-8 w-full px-4 flex relative" style="background: #ee9e8a;">
                            <span class="my-auto text-white font-semibold z-10">ROZVRHY <span id="timetableProgressNow">0</span>. ČÁST (<span id="timetableProgressNow">0</span>/<span id="timetableProgressMax">0</span>)</span>
                            <div id="timetableProgress" class="absolute top-0 left-0 h-full bg-primary transition-all"></div>
                        </div>
                        <div id="schedule" class="bg-white pt-2" style="width: 824px; height: 489px; visibility: visible; float: left;">
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
                <?php
                    }
                    ?>
            </div>
        </div>
        <div class="grid gap-4">
            <div class="px-8">
                <p class="font-bold text-2xl text-neutral-700 uppercase">OZNÁMENÍ</p>
            </div>
            <div class="flex flex-wrap gap-10 px-8">
                <?php
            require_once 'php/sis.php';
            $sis = new sis();
            $posts = json_decode($sis->getPosts(2));
            foreach ($posts as $post) {
                $dateString = $post->created_at;
                $dateTime = new DateTime($dateString);
                $createdAt = $dateTime->format('d.m.Y H:i');
            ?>
                <div class="flex flex-grow h-auto rounded-lg overflow-hidden shadow-lg bg-white" *ngFor="let post of posts | postFilter : center">
                    <div class="testt max-w-[8px] w-full isolate <?php if ($post->priority_id == 3) {
                        echo 'bg-red-500';
                    } elseif ($post->priority_id == 2) {
                        echo 'bg-yellow-400';
                    } ?>"></div>
                    <div class="w-full p-8">
                        <div class="w-full h-fit grid gap-4">
                            <div class="flex">
                                <div class="flex">
                                    <p class="text-lg font-semibold"><?php echo $post->title; ?></p>
                                </div>
                                <div class="ml-4">
                                    <div class="flex gap-2 text-white font-semibold">
                                        <?php
                                    if ($post->center_id == 1 || $post->center_id == 3) {
                                    ?>
                                        <span *ngIf="post.center_id == 1 || post.center_id == 3" class="px-3 py-1 rounded-full isolate bg-orange-600">RES</span>
                                        <?php
                                    }
                                    if ($post->center_id == 2 || $post->center_id == 3) {
                                    ?>
                                        <span *ngIf="post.center_id == 2 || post.center_id == 3" class="px-3 py-1 rounded-full isolate bg-blue-600">STŘ</span>
                                        <?php
                                    }
                                    ?>
                                        <!-- <span *ngIf="post.monitors == true" class="px-3 py-1 rounded-full isolate bg-red-600">MONITORY</span> -->
                                    </div>
                                </div>
                            </div>
                            <div class="pr-5 overflow-x-auto">
                                <div class="text-black">
                                    <?php echo $post->content; ?>
                                </div>
                            </div>
                            <div class="flex border-t-2 py-4">
                            </div>
                        </div>
                        <div class="flex h-10 mt-auto">
                            <div class="flex gap-2 w-full">
                                <div class="h-full overflow-hidden rounded-full">
                                    <img src="./images/profile.webp" alt="" class="h-full" />
                                </div>
                                <div class="flex flex-col py-1">
                                    <p class="text-sm text-zinc-500 font-semibold leading-none"><?php echo $post->author->name . ' ' . $post->author->lname; ?></p>
                                    <div class="mt-auto">
                                        <p class="text-sm text-stone-400 leading-none"><?php echo $createdAt; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </div>
    </div>
</body>

</html>
