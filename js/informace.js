$(document).ready(function(){
    var k = 0;
    var s;
    var r;
    var rozvrh = '';
    function Subject(name,teacher,classNumber,lessonNumber){
        this.name = name;
        this.teacher = teacher;
        this.classNumber = classNumber;
        this.lessonNumber = lessonNumber;
    }
    function addClass(name,lessons){
        var x = '';
        if(k >= 4)
            x += '<div class="day-row row'+k+'" style="height:88px;display:none">';
        else
            x += '<div class="day-row row'+k+'" style="height:88px;">';

        x += '<div class="">';
        x += '<div class="clearfix">';
        x += '<div class="day-name odd-name" style="height:88px;">';
        x += '<div>'+name+'</div>';
        x += '</div>';
        for(var i = 0; i < 10; i++){
            if(lessons[i].length == 4)
                x += addSubject(lessons[i][0], lessons[i][1], lessons[i][2], lessons[i][3] ,'','','','','');
            else
                x += addSubject(lessons[i][0], lessons[i][2], lessons[i][1], lessons[i][3] ,lessons[i][5],lessons[i][4],lessons[i][6],lessons[i][7],lessons[i][8]);

        }
        x += '<span>';                                  
        x += '</span>';                                   
        x += '</div>';
        x += '</div>';
        x += '</div>';
        rozvrh += x;
        k++;
    }
    function addSubject(id,classNumber,subject,teacher, classNumber2, subject2, teacher2,squad1,squad2){
        if(id == 0){
            return emptySubject();
        }
        else if(id == 1){
            return knowSubjectLiche(classNumber, subject, teacher);
        }
        else if(id == 2){
            return knowSubjectSude(classNumber, subject, teacher);
        }
        else if(id == 3){
            return knowSubjectSupl(classNumber, subject, teacher);
        }
        else if(id == 4){
            return emptyOdpadla();
        }
        else if(id == 5){
            return groupSubject(classNumber, subject, teacher, classNumber2, subject2, teacher2, squad1, squad2);
        }
        else{
            return groupSubjectSupl(classNumber, subject, teacher, classNumber2, subject2, teacher2, squad1, squad2);
        }
    }
    function emptySubject(){
        var x = '';
        x += '<span>';
        x += '<div class="day-item  border-levy border-spodni ">';
        x += '    <div class="empty" style="height:88px;"></div>';
        x += '</div>';
        x += '</span>';
        return x;
    }
    function emptyOdpadla(){
        var x = '';
        x += '<span>';
        x += '<div class="day-item day-item-hover  border-spodni pink" style="height:88px;" data-detail="{&quot;type&quot;:&quot;removed&quot;,&quot;subjecttext&quot;:&quot;Pá 13.4. | 6 (12:40 - 13:25)&quot;,&quot;absentinfo&quot;:&quot;&quot;,&quot;removedinfo&quot;:&quot;zrušeno (Český jazyk a literatura, Mádle Josef)&quot;}">';
        x += '    <div style="height:88px;">';
        x += '        <div class="top clearfix"></div>';
        x += '        <div class="middle "></div>';
        x += '    </div>';
        x += '</div>';
        x += '</span>';
        return x;
    }
    function knowSubjectLiche(classNumber, subject, teacher){
        var x = '';
        x += '<span>';
        x += '<div class="day-item  border-spodni odd " style="height:88px;">';                                         
        x += '            <div class="day-item-hover " style="height:88px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Matematika | Pá 13.4. | 1 (8:00 - 8:45)&quot;,&quot;teacher&quot;:&quot;Mgr. Aleš Kučera&quot;,&quot;room&quot;:&quot;S222&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
        x += '                <div>';
        x += '                    <div class="top clearfix">';
        x += '                        <div class="left roll-vertical">';
        x += '                            <div></div>';
        x += '                        </div>';
        x += '                        <div class="right">';
        x += '                            <div class="first">'+classNumber+'</div>';                                                                
        x += '                        </div>';
        x += '                    </div>';
        x += '                    <div class="middle " style="padding-top: 33px;">'+subject+'</div>';
        x += '                    <div class="bottom">'+teacher+'</div>';
        x += '                    <div class="absence _NoAbsent"></div>';
        x += '                </div>';
        x += '            </div>';                                                 
        x += '</div>';
        x += '</span>';
        return x;
    }
    function knowSubjectSude(classNumber, subject, teacher){
        var x = '';                                  
        x += '                                        <span>';
        x += '                                        <div class="day-item  border-spodni  " style="height:88px;">';                                              
        x += '                                                    <div class="day-item-hover " style="height:88px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Anglický jazyk | Pá 13.4. | 2 (8:55 - 9:40)&quot;,&quot;teacher&quot;:&quot;Mgr. Ivana Kršňáková&quot;,&quot;room&quot;:&quot;S425&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
        x += '                                                        <div>';
        x += '                                                            <div class="top clearfix">';
        x += '                                                                <div class="left roll-vertical">';
        x += '                                                                    <div></div>';
        x += '                                                               </div>';
        x += '                                                                <div class="right">';
        x += '                                                                    <div class="first">'+classNumber+'</div>';                                                                        
        x += '                                                                </div>';
        x += '                                                            </div>';
        x += '                                                            <div class="middle " style="padding-top: 33px;">'+subject+'</div>';
        x += '                                                            <div class="bottom">'+teacher+'</div>';
        x += '                                                            <div class="absence _NoAbsent"></div>';
        x += '                                                        </div>';
        x += '                                                    </div>';                                                   
        x += '                                        </div>';
        x += '                                        </span>';
        return x;
    }
    function groupSubject(teacher, subject, classNumber, teacher2, subject2, classNumber2, squad1, squad2){
        var x = '';
        x += '<span>';
        x += '            <div class="day-item  border-horni odd " style="height: 88px;">';
                                                
        x += '                                                <div class="day-item-hover multi" style="height:107px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Elektrotechnika | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Ing. Petr Haberzettl&quot;,&quot;room&quot;:&quot;S327&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
        x += '                                                    <div>';
        x += '                                                        <div class="top clearfix">';
        x += '                                                            <div class="left roll-vertical">';
        x += '                                                                <div>'+squad1+'</div>';
        x += '                                                            </div>';
        x += '                                                            <div class="right">';
        x += '                                                                <div class="first">'+classNumber+'</div>';
                                                                        
        x += '                                                            </div>';
        x += '                                                        </div>';
        x += '                                                        <div class="middle ">'+subject+'</div>';
        x += '                                                        <div class="bottom">'+teacher+'</div>';
        x += '                                                        <div class="absence _NoAbsent"></div>';
        x += '                                                    </div>';
        x += '                                                </div>';
                                                    
        x += '                                                <div class="day-item-hover multi" style="height:107px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Datové sítě | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Bc. Zdeněk Vazač&quot;,&quot;room&quot;:&quot;C24&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
        x += '                                                    <div>';
        x += '                                                        <div class="top clearfix">';
        x += '                                                            <div class="left roll-vertical">';
        x += '                                                                <div>'+squad2+'</div>';
        x += '                                                            </div>';
        x += '                                                            <div class="right">';
        x += '                                                                <div class="first">'+classNumber2+'</div>';
                                                                        
        x += '                                                            </div>';
        x += '                                                        </div>';
        x += '                                                        <div class="middle ">'+subject2+'</div>';
        x += '                                                        <div class="bottom">'+teacher2+'</div>';
        x += '                                                        <div class="absence _NoAbsent"></div>';
        x += '                                                    </div>';
        x += '                                                </div>';
                                                    
        x += '                                    </div>';

        return x;
    }

    function groupSubjectSupl(teacher, subject, classNumber, teacher2, subject2, classNumber2, squad1, squad2){
        var x = '';
        x += '<span>';
        x += '            <div class="day-item  border-horni odd pink" style="height: 88px;">';
                                                
        x += '                                                <div class="day-item-hover multi" style="height:107px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Elektrotechnika | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Ing. Petr Haberzettl&quot;,&quot;room&quot;:&quot;S327&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
        x += '                                                    <div>';
        x += '                                                        <div class="top clearfix">';
        x += '                                                            <div class="left roll-vertical">';
        x += '                                                                <div>'+squad1+'</div>';
        x += '                                                            </div>';
        x += '                                                            <div class="right">';
        x += '                                                                <div class="first">'+classNumber+'</div>';
                                                                        
        x += '                                                            </div>';
        x += '                                                        </div>';
        x += '                                                        <div class="middle ">'+subject+'</div>';
        x += '                                                        <div class="bottom">'+teacher+'</div>';
        x += '                                                        <div class="absence _NoAbsent"></div>';
        x += '                                                    </div>';
        x += '                                                </div>';
                                                    
        x += '                                                <div class="day-item-hover multi" style="height:107px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Datové sítě | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Bc. Zdeněk Vazač&quot;,&quot;room&quot;:&quot;C24&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
        x += '                                                    <div>';
        x += '                                                        <div class="top clearfix">';
        x += '                                                            <div class="left roll-vertical">';
        x += '                                                                <div>'+squad2+'</div>';
        x += '                                                            </div>';
        x += '                                                            <div class="right">';
        x += '                                                                <div class="first">'+classNumber2+'</div>';
                                                                        
        x += '                                                            </div>';
        x += '                                                        </div>';
        x += '                                                        <div class="middle ">'+subject2+'</div>';
        x += '                                                        <div class="bottom">'+teacher2+'</div>';
        x += '                                                        <div class="absence _NoAbsent"></div>';
        x += '                                                    </div>';
        x += '                                                </div>';
                                                    
        x += '                                    </div>';

        return x;
    }
    function knowSubjectSupl(classNumber, subject, teacher){
        var x = '';
        x += '<span>';
        x += '<div class="day-item  border-spodni  pink" style="height:88px;">';
       
        x += '           <div class="day-item-hover " style="height:88px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Fyzika | Pá 13.4. | 4 (10:50 - 11:35)&quot;,&quot;teacher&quot;:&quot;Mgr. Petr Rys&quot;,&quot;room&quot;:&quot;S129&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;suplování (Databáze, Sýkorová Květuše, C3)&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
        x += '                        <div>';
        x += '                            <div class="top clearfix">';
        x += '                                <div class="left roll-vertical">';
        x += '                                    <div></div>';
        x += '                                </div>';
        x += '                                <div class="right">';
        x += '                                   <div class="first">'+classNumber+'</div>';                                                                           
        x += '                                </div>';
        x += '                            </div>';
        x += '                            <div class="middle " style="padding-top: 33px;">'+subject+'</div>';
        x += '                            <div class="bottom">'+teacher+'</div>';
        x += '                            <div class="absence _NoAbsent"></div>';
        x += '                        </div>';
        x += '                  </div>';
                                                        
        x += '</div>';
        x += '</span>';
        return x;
    }
    function sseasSupl(liche,id,trida,hodina,vyucujici,ucebna,poznamka){
        var x = '';
        if(liche){
            x += '<tr class="liche sup'+id+' suplov"';
            if(id > 6){
                x += ' style="display: none;"';
            }
            x+= '>';
        }
        else{
            x += '<tr class="sude sup'+id+' suplov"';
            if(id > 6){
                x += ' style="display: none;"';
            }
            x+= '>';
        }

        x += '    <td><strong>'+trida+'</strong></td>';
        x += '    <td>'+hodina+'</td>';
        x += '    <td>'+vyucujici+'</td>';
        x += '    <td>'+ucebna+'</td>';
        x += '    <td>'+poznamka+'</td>';
        x += '</tr>';
        return x;
    }
    function addsseasSupl(){
        if (suplSseas.length > 0){
            for(var i = 0; i < suplSseas.length; i++){
                if(i%2 == 0)
                    $(".substitutetable").html($(".substitutetable").html()+sseasSupl(false,i,suplSseas[i][0],suplSseas[i][1],suplSseas[i][2],suplSseas[i][3],suplSseas[i][4]));
                else
                    $(".substitutetable").html($(".substitutetable").html()+sseasSupl(true,i,suplSseas[i][0],suplSseas[i][1],suplSseas[i][2],suplSseas[i][3],suplSseas[i][4]));
            }
        }
        else{
            $(".substitutetable").html($(".substitutetable").html()+'<tr class="sude sup0 suplov" style="background-color: transparent;height: 150px;"><td colspan="5"><strong>Žádné suplování není pro dnešní den plánováno.</strong></td></tr>'); 
        }
    }
    function scrollRozvrh(){
        if(k > 4){
            if(s >= k)
                s = 0;

            $(".day-row").hide();
            for(var i = s; i < s+4; i++){
                if(i < k){
                    $(".row"+i).show();
                }
            }
            s += 4;
        }
        if(sup > 7){
            if(r >= sup)
                r = 0;

            for(var i = 0; i < sup; i++){
                $(".sup"+i).hide();
            }

            for(var i = r; i < r+7; i++){
                if(i < sup){
                    $(".sup"+i).show();
                }
            }
            r += 7;
        }
    }
    function canceled(cancel, hour){
        for(var i = 0; i < cancel.length; i++){
            if(cancel[i] == hour)
                return true;
        }
        return false;
    }
    function oznameni(){
        for(var i = 0; i < oznSseas.length; i++){
            $("#nadpis").html($("#nadpis").html()+"<li><span>"+oznSseas[i]+"</span></li>");
        }
    }
    function runos(){
        var lessons = [];
        var lesson = [];
        if(supl.length > 0){
            for(var i = 0; i < supl.length; i++){
                lessons = [];
                lesson = [];
                if(supl[i][1].length > 0){
                    //if(supl[i][2][0]){
                        for(var k = 0; k < supl[i][2][1]; k++){
                            if(canceled(supl[i][1],k))
                                lesson.push(4);
                            else
                                lesson.push(0);

                            lesson.push('');
                            lesson.push('');
                            lesson.push('');
                            lessons.push(lesson);
                            lesson = [];
                        }
                    /*}
                    else{
                        for(var k = 0; k < supl[i][2][1]; k++){
                            if(canceled(supl[i][1],k))
                                lesson.push(4);
                            else
                                lesson.push(0);

                            lesson.push('');
                            lesson.push('');
                            lesson.push('');
                            lessons.push(lesson);
                            lesson = [];
                        }
                    }*/
                    for(var j = 2; j < supl[i].length; j++){
                        if(supl[i][j][0]){
                            if(canceled(supl[i][1],supl[i][j][1]))
                                lesson.push(6);
                            else
                                lesson.push(5);

                            lesson.push(supl[i][j][2][0]);
                            lesson.push(supl[i][j][2][1]);
                            lesson.push(supl[i][j][2][2]);
                            lesson.push(supl[i][j][3][0]);
                            lesson.push(supl[i][j][3][1]);
                            lesson.push(supl[i][j][3][2]);

                            lesson.push(supl[i][j][2][3]);
                            lesson.push(supl[i][j][3][3]);
                            lessons.push(lesson);
                            lesson = [];
                        }
                        else{
                            if(canceled(supl[i][1],supl[i][j][1]))
                                lesson.push(3);
                            else if(supl[i][j][1]%2 == 0)
                                lesson.push(2);
                            else
                                lesson.push(1);

                            lesson.push(supl[i][j][4]);
                            lesson.push(supl[i][j][2]);
                            lesson.push(supl[i][j][3]);
                            lessons.push(lesson);
                            lesson = [];
                        }

                        if(j < supl[i].length-1){
                            if(supl[i][j][1]+1 != supl[i][j+1][1]){
                                lesson.push(0);
                                lesson.push('');
                                lesson.push('');
                                lesson.push('');
                                lessons.push(lesson);
                                lesson = [];
                            }
                        }
                    }
                    for(var j = lessons.length; j < 10; j++){
                        if(canceled(supl[i][1],j))
                            lesson.push(4);
                        else        
                            lesson.push(0);

                        lesson.push('');
                        lesson.push('');
                        lesson.push('');
                        lessons.push(lesson);
                        lesson = [];
                    }
                    addClass(supl[i][0], lessons);
                    lessons = [];
                }
            }
        }
        else{
            var font= "font-family: 'Open Sans', sans-serif;"
            rozvrh += '<table style="width: 700px;margin-left: 60px;margin-top: 63px;'+font+'"><tr class="sude sup0 suplov"style="background-color: transparent;"><td><strong>Žádné suplování není pro dnešní den plánováno.</strong></td></tr></table>';
        }
    }
        runos();
        addsseasSupl();
        oznameni();
        var sup = $(".suplov").length;
        
        if(k >= 4)
            s = 4;
        else
            s = k;

        if(sup >= 7)
            r = 7;
        else
            r = sup;
        
        $(".clearfix").html($(".clearfix").html()+rozvrh);
        
        var tm = setInterval(scrollRozvrh, 8000);
        
        findZvoneni();
        for(var i = 0; i < sup; i++){
            if(i > 6)
                $(".sup"+i).hide();
        }
});

        var d = new Date();
        function Zvoneni (bHour,bMinute,eHour,eMinute) {
            this.bHour = bHour;
            this.bMinute = bMinute;
            this.eHour = eHour;
            this.eMinute = eMinute;
            this.bMinutes = this.bMinute + this.bHour*60;
            this.eMinutes = this.eMinute + this.eHour*60;
        }
        var zvoneni = [];
        zvoneni.push(new Zvoneni(7,10,7,55));
        zvoneni.push(new Zvoneni(8,0,8,45));
        zvoneni.push(new Zvoneni(8,55,9,40));
        zvoneni.push(new Zvoneni(9,50,10,35));
        zvoneni.push(new Zvoneni(10,50,11,35));
        zvoneni.push(new Zvoneni(11,45,12,30));
        zvoneni.push(new Zvoneni(12,40,13,25));
        zvoneni.push(new Zvoneni(13,35,14,20));
        zvoneni.push(new Zvoneni(14,25,15,10));
        zvoneni.push(new Zvoneni(15,15,16,0));
        zvoneni.push(new Zvoneni(16,5,16,50));
        function findZvoneni(){
            d = new Date();
            var hour = d.getHours();
            var minute = d.getMinutes();
            var minutes = minute + hour*60;
        //document.getElementById("datum").innerHTML = "Dnes je <strong>"+d.getDate()+"."+(d.getMonth()+1)+"."+d.getFullYear()+"</strong>";
            var lesson = false;
            if(minutes >= 950 || minutes < 400){
                document.getElementById("ringing").innerHTML = "Na další hodinu zvoní až v 7:10";
            }
            else{
                for(var i = 0; i < zvoneni.length; i++){
                    if(zvoneni[i].bMinutes <= minutes && minutes < zvoneni[i].eMinutes){
                        document.getElementById("ringing").innerHTML = "Je "+i+".hodina a zvoní na přestávku za "+(zvoneni[i].eMinutes-minutes)+" minut.";
                        lesson = true;
                        break;
                    }
                }

                if (!lesson) {
                    var zvon = findNear(minutes);
                    document.getElementById("ringing").innerHTML = "<b>Zvoní za "+(zvoneni[zvon].bMinutes-minutes)+" minuty na "+zvon+".hodinu.</b>";
                }
            }
        }
        function findNear(minutes){
            var zvon = 0;
            for(var i = 1; i < zvoneni.length; i++){
                if((zvoneni[zvon].bMinutes - minutes) < 0){
                    zvon++;
                }
                else if((zvoneni[zvon].bMinutes - minutes) > (zvoneni[i].bMinutes - minutes)){
                    zvon = i;
                }
            }
            return zvon;
        }
        var myVar = setInterval(findZvoneni, 5000);