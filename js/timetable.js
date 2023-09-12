$(document).ready(function () {
	var k = 0;
	var k2 = 0;
	var s = 5;
	var s2 = 5;
	var ozn = true;
	var see = [];
	var hid = [];
	var r;
	var rozvrh = "";
	function findSubject(ar, num) {
		for (var i = 0; i < ar.length; i++) {
			if (ar[i][0] == num) return i;
		}
	}
	function Subject(name, teacher, classNumber, lessonNumber) {
		this.name = name;
		this.teacher = teacher;
		this.classNumber = classNumber;
		this.lessonNumber = lessonNumber;
	}
	function addClass(name) {
		var x = "";
		if (k >= 5) x += '<div class="day-row day-rowf rowf' + k + '" style="height:88px;display:none">';
		else x += '<div class="day-row day-rowf rowf' + k + '" style="height:88px;">';

		x += '<div class="">';
		x += '<div class="clearfix">';
		x += '<div class="day-name odd-name" style="height:88px;">';
		x += "<div>" + name + "</div>";
		x += "</div>";
		k++;
		return x;
	}
	function addClass2(name) {
		var x = "";
		if (k2 >= 5) x += '<div class="day-row day-rows rows' + k2 + '" style="height:88px;display:none">';
		else x += '<div class="day-row day-rows rows' + k2 + '" style="height:88px;">';

		x += '<div class="">';
		x += '<div class="clearfix">';
		x += '<div class="day-name odd-name" style="height:88px;">';
		x += "<div>" + name + "</div>";
		x += "</div>";
		k2++;
		return x;
	}
	function addSubject(id, classNumber, subject, teacher, classNumber2, subject2, teacher2, squad1, squad2, classNumber3, subject3, teacher3, squad3) {
		if (id == 0) {
			return emptySubject();
		} else if (id == 1) {
			return knowSubjectLiche(classNumber, subject, teacher);
		} else if (id == 2) {
			return knowSubjectSude(classNumber, subject, teacher);
		} else if (id == 3) {
			return knowSubjectSupl(classNumber, subject, teacher);
		} else if (id == 4) {
			return emptyOdpadla();
		} else if (id == 5) {
			return groupSubject(classNumber, subject, teacher, classNumber2, subject2, teacher2, squad1, squad2);
		} else if (id == 6) {
			return groupSubjectSupl(classNumber, subject, teacher, classNumber2, subject2, teacher2, squad1, squad2);
		} else if (id == 7) {
			return groupSubjectThree(classNumber, subject, teacher, classNumber2, subject2, teacher2, squad1, squad2, classNumber3, subject3, teacher3, squad3);
		} else {
			return groupSubjectThreeSupl(classNumber, subject, teacher, classNumber2, subject2, teacher2, squad1, squad2, classNumber3, subject3, teacher3, squad3);
		}
	}
	function emptySubject() {
		var x = "";
		x += "<span>";
		x += '<div class="day-item  border-levy border-spodni ">';
		x += '    <div class="empty" style="height:88px;"></div>';
		x += "</div>";
		x += "</span>";
		return x;
	}
	function emptyOdpadla() {
		var x = "";
		x += "<span>";
		x += '<div class="day-item day-item-hover  border-spodni" style="height:88px;" data-detail="{&quot;type&quot;:&quot;removed&quot;,&quot;subjecttext&quot;:&quot;Pá 13.4. | 6 (12:40 - 13:25)&quot;,&quot;absentinfo&quot;:&quot;&quot;,&quot;removedinfo&quot;:&quot;zrušeno (Český jazyk a literatura, Mádle Josef)&quot;}">';
		x += '    <div style="height:88px;" class="pink">';
		x += '        <div class="top clearfix"></div>';
		x += '        <div class="middle "></div>';
		x += "    </div>";
		x += "</div>";
		x += "</span>";
		return x;
	}
	function knowSubjectLiche(classNumber, subject, teacher) {
		var x = "";
		x += "<span>";
		x += '<div class="day-item  border-spodni  " style="height:88px; background-color:#f2f2f2">';
		x += '            <div class="day-item-hover odd" style="height:88px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Matematika | Pá 13.4. | 1 (8:00 - 8:45)&quot;,&quot;teacher&quot;:&quot;Mgr. Aleš Kučera&quot;,&quot;room&quot;:&quot;S222&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                <div>";
		x += '                    <div class="top clearfix">';
		x += '                        <div class="left roll-vertical">';
		x += "                            <div></div>";
		x += "                        </div>";
		x += '                        <div class="right">';
		x += '                            <div class="first">' + classNumber + "</div>";
		x += "                        </div>";
		x += "                    </div>";
		x += '                    <div class="middle " style="padding-top: 33px;">' + subject + "</div>";
		x += '                    <div class="bottom">' + teacher + "</div>";
		x += '                    <div class="absence _NoAbsent"></div>';
		x += "                </div>";
		x += "            </div>";
		x += "</div>";
		x += "</span>";
		return x;
	}
	function knowSubjectSude(classNumber, subject, teacher) {
		var x = "";
		x += "                                        <span>";
		x += '                                        <div class="day-item  border-spodni " style="height:88px;background-color:#f2f2f2">';
		x += '                                                    <div class="day-item-hover odl" style="height:88px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Anglický jazyk | Pá 13.4. | 2 (8:55 - 9:40)&quot;,&quot;teacher&quot;:&quot;Mgr. Ivana Kršňáková&quot;,&quot;room&quot;:&quot;S425&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                        <div>";
		x += '                                                            <div class="top clearfix">';
		x += '                                                                <div class="left roll-vertical">';
		x += "                                                                    <div></div>";
		x += "                                                               </div>";
		x += '                                                                <div class="right">';
		x += '                                                                    <div class="first">' + classNumber + "</div>";
		x += "                                                                </div>";
		x += "                                                            </div>";
		x += '                                                            <div class="middle " style="padding-top: 33px;">' + subject + "</div>";
		x += '                                                            <div class="bottom">' + teacher + "</div>";
		x += '                                                            <div class="absence _NoAbsent"></div>';
		x += "                                                        </div>";
		x += "                                                    </div>";
		x += "                                        </div>";
		x += "                                        </span>";
		return x;
	}
	function knowAkce(subject) {
		var x = "";
		x += "                                        <span>";
		x += '                                        <div class="day-item  border-spodni odl" style="height:88px; background-color:#f2f2f2;background:rgba(88,148,44,0.20)">';
		x += '                                                    <div class="day-item-hover" style="height:88px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Anglický jazyk | Pá 13.4. | 2 (8:55 - 9:40)&quot;,&quot;teacher&quot;:&quot;Mgr. Ivana Kršňáková&quot;,&quot;room&quot;:&quot;S425&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                        <div>";
		x += '                                                            <div class="top clearfix">';
		x += '                                                                <div class="left roll-vertical">';
		x += "                                                                    <div></div>";
		x += "                                                               </div>";
		x += '                                                                <div class="right">';
		x += '                                                                    <div class="first"></div>';
		x += "                                                                </div>";
		x += "                                                            </div>";
		x += '                                                            <div class="middle " style="padding-top: 33px;color: #59942C !important;">' + subject + "</div>";
		x += '                                                            <div class="bottom"></div>';
		x += '                                                            <div class="absence _NoAbsent"></div>';
		x += "                                                        </div>";
		x += "                                                    </div>";
		x += "                                        </div>";
		x += "                                        </span>";
		return x;
	}
	function groupSubject(teacher, subject, classNumber, squad1, teacher2, subject2, classNumber2, squad2) {
		var x = "";
		x += "<span>";
		x += '            <div class="day-item  border-horni " style="height: 88px; background-color:#f2f2f2">';

		x += '                                                <div class="day-item-hover multi odd" style="height:107px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Elektrotechnika | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Ing. Petr Haberzettl&quot;,&quot;room&quot;:&quot;S327&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                    <div>";
		x += '                                                        <div class="top clearfix">';
		x += '                                                            <div class="left roll-vertical">';
		x += "                                                                <div>" + squad1 + "</div>";
		x += "                                                            </div>";
		x += '                                                            <div class="right">';
		x += '                                                                <div class="first">' + teacher + "</div>";

		x += "                                                            </div>";
		x += "                                                        </div>";
		x += '                                                        <div class="middle ">' + subject + "</div>";
		x += '                                                        <div class="bottom" style="line-height:41px;">' + classNumber + "</div>";
		x += '                                                        <div class="absence _NoAbsent"></div>';
		x += "                                                    </div>";
		x += "                                                </div>";

		x += '                                                <div class="day-item-hover multi" style="height:107px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Datové sítě | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Bc. Zdeněk Vazač&quot;,&quot;room&quot;:&quot;C24&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                    <div>";
		x += '                                                        <div class="top clearfix">';
		x += '                                                            <div class="left roll-vertical">';
		x += "                                                                <div>" + squad2 + "</div>";
		x += "                                                            </div>";
		x += '                                                            <div class="right">';
		x += '                                                                <div class="first">' + teacher2 + "</div>";

		x += "                                                            </div>";
		x += "                                                        </div>";
		x += '                                                        <div class="middle ">' + subject2 + "</div>";
		x += '                                                        <div class="bottom" style="line-height:41px;">' + classNumber2 + "</div>";
		x += '                                                        <div class="absence _NoAbsent"></div>';
		x += "                                                    </div>";
		x += "                                                </div>";

		x += "                                    </div>";

		return x;
	}
	function groupSubjectThree(teacher, subject, classNumber, squad1, teacher2, subject2, classNumber2, squad2, teacher3, subject3, classNumber3, squad3) {
		var x = "";
		x += "<span>";
		x += '            <div class="day-item  border-horni" style="height: 88px; background-color:#f2f2f2">';

		x += '                                                <div class="day-item-hover multi odd" style="height: 29px !important;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Elektrotechnika | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Ing. Petr Haberzettl&quot;,&quot;room&quot;:&quot;S327&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                    <div>";
		x += '                                                        <div class="top clearfix">';
		x += '                                                            <div class="left roll-vertical">';
		x += "                                                                <div>" + squad1 + "</div>";
		x += "                                                            </div>";
		x += '                                                            <div class="right">';
		x += '                                                                <div class="first">' + teacher + "</div>";

		x += "                                                            </div>";
		x += "                                                        </div>";
		x += '                                                        <div class="middle " style="padding-top:6px;font-size:12px;">' + subject + "</div>";
		x += '                                                        <div class="bottom" style="line-height:75px;font-size:9px">' + classNumber + "</div>";
		x += '                                                        <div class="absence _NoAbsent"></div>';
		x += "                                                    </div>";
		x += "                                                </div>";

		x += '                                                <div class="day-item-hover multi" style="height: 29px !important;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Datové sítě | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Bc. Zdeněk Vazač&quot;,&quot;room&quot;:&quot;C24&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                    <div>";
		x += '                                                        <div class="top clearfix">';
		x += '                                                            <div class="left roll-vertical">';
		x += "                                                                <div>" + squad2 + "</div>";
		x += "                                                            </div>";
		x += '                                                            <div class="right">';
		x += '                                                                <div class="first">' + teacher2 + "</div>";

		x += "                                                            </div>";
		x += "                                                        </div>";
		x += '                                                        <div class="middle " style="padding-top:6px;font-size:12px;">' + subject2 + "</div>";
		x += '                                                        <div class="bottom" style="line-height:75px;font-size:9px">' + classNumber2 + "</div>";
		x += '                                                        <div class="absence _NoAbsent"></div>';
		x += "                                                    </div>";
		x += "                                                </div>";

		x += '                                                <div class="day-item-hover multi" style="height: 29px !important;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Datové sítě | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Bc. Zdeněk Vazač&quot;,&quot;room&quot;:&quot;C24&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                    <div>";
		x += '                                                        <div class="top clearfix">';
		x += '                                                            <div class="left roll-vertical">';
		x += "                                                                <div>" + squad3 + "</div>";
		x += "                                                            </div>";
		x += '                                                            <div class="right">';
		x += '                                                                <div class="first">' + teacher3 + "</div>";

		x += "                                                            </div>";
		x += "                                                        </div>";
		x += '                                                        <div class="middle " style="padding-top:6px;font-size:12px;">' + subject3 + "</div>";
		x += '                                                        <div class="bottom" style="line-height:75px;font-size:9px">' + classNumber3 + "</div>";
		x += '                                                        <div class="absence _NoAbsent"></div>';
		x += "                                                    </div>";
		x += "                                                </div>";

		x += "                                    </div>";

		return x;
	}
	function groupSubjectSupl(teacher, subject, classNumber, squad1, teacher2, subject2, classNumber2, squad2) {
		var x = "";
		x += "<span>";
		x += '            <div class="day-item  border-horni odd " style="height: 88px;">';

		x += '                                                <div class="day-item-hover multi pink" style="height:107px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Elektrotechnika | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Ing. Petr Haberzettl&quot;,&quot;room&quot;:&quot;S327&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                    <div>";
		x += '                                                        <div class="top clearfix">';
		x += '                                                            <div class="left roll-vertical">';
		x += "                                                                <div>" + squad1 + "</div>";
		x += "                                                            </div>";
		x += '                                                            <div class="right">';
		x += '                                                                <div class="first">' + teacher + "</div>";

		x += "                                                            </div>";
		x += "                                                        </div>";
		x += '                                                        <div class="middle ">' + subject + "</div>";
		x += '                                                        <div class="bottom" style="line-height:41px;">' + classNumber + "</div>";
		x += '                                                        <div class="absence _NoAbsent"></div>';
		x += "                                                    </div>";
		x += "                                                </div>";

		x += '                                                <div class="day-item-hover multi pink" style="height:107px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Datové sítě | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Bc. Zdeněk Vazač&quot;,&quot;room&quot;:&quot;C24&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                    <div>";
		x += '                                                        <div class="top clearfix">';
		x += '                                                            <div class="left roll-vertical">';
		x += "                                                                <div>" + squad2 + "</div>";
		x += "                                                            </div>";
		x += '                                                            <div class="right">';
		x += '                                                                <div class="first">' + teacher2 + "</div>";

		x += "                                                            </div>";
		x += "                                                        </div>";
		x += '                                                        <div class="middle ">' + subject2 + "</div>";
		x += '                                                        <div class="bottom" style="line-height:41px;">' + classNumber2 + "</div>";
		x += '                                                        <div class="absence _NoAbsent"></div>';
		x += "                                                    </div>";
		x += "                                                </div>";

		x += "                                    </div>";

		return x;
	}
	function groupSubjectThreeSupl(teacher, subject, classNumber, squad1, teacher2, subject2, classNumber2, squad2, teacher3, subject3, classNumber3, squad3) {
		var x = "";
		x += "<span>";
		x += '            <div class="day-item  border-horni odd" style="height: 88px;">';

		x += '                                                <div class="day-item-hover multi pink" style="height: 29px !important;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Elektrotechnika | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Ing. Petr Haberzettl&quot;,&quot;room&quot;:&quot;S327&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                    <div>";
		x += '                                                        <div class="top clearfix">';
		x += '                                                            <div class="left roll-vertical">';
		x += "                                                                <div>" + squad1 + "</div>";
		x += "                                                            </div>";
		x += '                                                            <div class="right">';
		x += '                                                                <div class="first">' + teacher + "</div>";

		x += "                                                            </div>";
		x += "                                                        </div>";
		x += '                                                        <div class="middle " style="padding-top:6px;font-size:12px;">' + subject + "</div>";
		x += '                                                        <div class="bottom" style="line-height:75px;font-size:9px">' + classNumber + "</div>";
		x += '                                                        <div class="absence _NoAbsent"></div>';
		x += "                                                    </div>";
		x += "                                                </div>";

		x += '                                                <div class="day-item-hover multi pink" style="height: 29px !important;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Datové sítě | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Bc. Zdeněk Vazač&quot;,&quot;room&quot;:&quot;C24&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                    <div>";
		x += '                                                        <div class="top clearfix">';
		x += '                                                            <div class="left roll-vertical">';
		x += "                                                                <div>" + squad2 + "</div>";
		x += "                                                            </div>";
		x += '                                                            <div class="right">';
		x += '                                                                <div class="first">' + teacher2 + "</div>";

		x += "                                                            </div>";
		x += "                                                        </div>";
		x += '                                                        <div class="middle " style="padding-top:6px;font-size:12px;">' + subject2 + "</div>";
		x += '                                                        <div class="bottom" style="line-height:75px;font-size:9px">' + classNumber2 + "</div>";
		x += '                                                        <div class="absence _NoAbsent"></div>';
		x += "                                                    </div>";
		x += "                                                </div>";

		x += '                                                <div class="day-item-hover multi pink" style="height: 29px !important;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Datové sítě | po  | 3 (9:50 - 10:35)&quot;,&quot;teacher&quot;:&quot;Bc. Zdeněk Vazač&quot;,&quot;room&quot;:&quot;C24&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                                                    <div>";
		x += '                                                        <div class="top clearfix">';
		x += '                                                            <div class="left roll-vertical">';
		x += "                                                                <div>" + squad3 + "</div>";
		x += "                                                            </div>";
		x += '                                                            <div class="right">';
		x += '                                                                <div class="first">' + teacher3 + "</div>";

		x += "                                                            </div>";
		x += "                                                        </div>";
		x += '                                                        <div class="middle " style="padding-top:6px;font-size:12px;">' + subject3 + "</div>";
		x += '                                                        <div class="bottom" style="line-height:75px;font-size:9px">' + classNumber3 + "</div>";
		x += '                                                        <div class="absence _NoAbsent"></div>';
		x += "                                                    </div>";
		x += "                                                </div>";

		x += "                                    </div>";

		return x;
	}
	function knowSubjectSupl(classNumber, subject, teacher) {
		var x = "";
		x += "<span>";
		x += '<div class="day-item  border-spodni  " style="height:88px;">';

		x += '           <div class="day-item-hover pink" style="height:88px;" data-detail="{&quot;type&quot;:&quot;atom&quot;,&quot;subjecttext&quot;:&quot;Fyzika | Pá 13.4. | 4 (10:50 - 11:35)&quot;,&quot;teacher&quot;:&quot;Mgr. Petr Rys&quot;,&quot;room&quot;:&quot;S129&quot;,&quot;group&quot;:&quot;&quot;,&quot;theme&quot;:&quot;&quot;,&quot;notice&quot;:&quot;&quot;,&quot;changeinfo&quot;:&quot;suplování (Databáze, Sýkorová Květuše, C3)&quot;,&quot;homeworks&quot;:[],&quot;absencetext&quot;:&quot;&quot;}">';
		x += "                        <div>";
		x += '                            <div class="top clearfix">';
		x += '                                <div class="left roll-vertical">';
		x += "                                    <div></div>";
		x += "                                </div>";
		x += '                                <div class="right">';
		x += '                                   <div class="first">' + classNumber + "</div>";
		x += "                                </div>";
		x += "                            </div>";
		x += '                            <div class="middle " style="padding-top: 33px;">' + subject + "</div>";
		x += '                            <div class="bottom">' + teacher + "</div>";
		x += '                            <div class="absence _NoAbsent"></div>';
		x += "                        </div>";
		x += "                  </div>";

		x += "</div>";
		x += "</span>";
		return x;
	}
	function sseasSupl(liche, id, trida, hodina, vyucujici, ucebna, poznamka) {
		var x = "";
		if (liche) {
			x += '<tr class="liche sup' + id + ' suplov"';
			if (id > 9) {
				x += ' style="display: none;"';
			}
			x += ">";
		} else {
			x += '<tr class="sude sup' + id + ' suplov"';
			if (id > 9) {
				x += ' style="display: none;"';
			}
			x += ">";
		}

		x += "    <td><strong>" + trida + "</strong></td>";
		x += "    <td>" + hodina + "</td>";
		x += "    <td>" + vyucujici + "</td>";
		x += "    <td>" + ucebna + "</td>";
		x += "    <td>" + poznamka + "</td>";
		x += "</tr>";
		return x;
	}
	function addsseasSupl() {
		if (suplSseas.length > 0) {
			for (var i = 0; i < suplSseas.length; i++) {
				if (i % 2 == 0) $(".substitutetable").html($(".substitutetable").html() + sseasSupl(false, i, suplSseas[i][0], suplSseas[i][1], suplSseas[i][2], suplSseas[i][3], suplSseas[i][4]));
				else $(".substitutetable").html($(".substitutetable").html() + sseasSupl(true, i, suplSseas[i][0], suplSseas[i][1], suplSseas[i][2], suplSseas[i][3], suplSseas[i][4]));
			}
		} else {
			$(".substitutetable").html($(".substitutetable").html() + '<tr class="sude sup0 suplov" style="background-color: transparent;height: 150px;"><td colspan="5"><strong>Žádné suplování není pro dnešní den plánováno.</strong></td></tr>');
		}
	}
	// function oznameni() {
	// 	var oznT = '<tr class="tabletitle"><td class="tabletitle">Oznámení</td></tr>';
	// 	for (var i = 0; i < oznSseas.length; i++) {
	// 		if (i % 2 == 0) oznT += "<tr class='sude'><td>" + oznSseas[i] + "</td></tr>";
	// 		else oznT += "<tr class='liche'><td>" + oznSseas[i] + "</td></tr>";
	// 	}
	// 	$("#nadpis").html(oznT);
	// }
	function canceled(cancel, hour) {
		for (var i = 0; i < cancel.length; i++) {
			if (cancel[i] == hour) return true;
		}
		return false;
	}
	function fndsbj(ar, indx) {
		for (var i = 0; i < ar.length; i++) {
			if (ar[i][0] == indx) return i;
		}
		return -5;
	}
	function createEverything(ar, is) {
		var lessons = [];
		var lesson = [];
		var r = false;
		for (var i = 0; i < ar.length; i++) {
			lesson = [];
			r = false;
			var tmpS = "";
			if (is) tmpS += addClass(ar[i][0][1]);
			else tmpS += addClass2(ar[i][0][1]);

			for (var j = 0; j <= 10; j++) {
				var tmpSb = fndsbj(ar[i][3], j);
				if (tmpSb == -5) {
					if (canceled(ar[i][1], j)) tmpS += emptyOdpadla();
					else tmpS += emptySubject();
				} else {
					if (canceled(ar[i][1], j)) {
						if (ar[i][3][tmpSb][2][1] == "" && ar[i][3][tmpSb][2][2] == "") {
							if (ar[i][3][tmpSb][2][0] == "ODV") {
								r = true;
								break;
							} else {
								tmpS += knowAkce(ar[i][3][tmpSb][2][0]);
							}
						} else if (ar[i][3][tmpSb][1] == 1) {
							if (ar[i][3][tmpSb][2][0] == "ODV") {
								r = true;
								break;
							} else {
								tmpS += knowSubjectSupl(ar[i][3][tmpSb][2][2], ar[i][3][tmpSb][2][0], ar[i][3][tmpSb][2][1]);
							}
						} else if (ar[i][3][tmpSb][1] == 2) {
							if (ar[i][3][tmpSb][2][0] == "ODV") {
								r = true;
								break;
							} else {
								tmpS += groupSubjectSupl(ar[i][3][tmpSb][2][2], ar[i][3][tmpSb][2][0], ar[i][3][tmpSb][2][1], ar[i][3][tmpSb][2][3], ar[i][3][tmpSb][3][2], ar[i][3][tmpSb][3][0], ar[i][3][tmpSb][3][1], ar[i][3][tmpSb][3][3]);
							}
						} else if (ar[i][3][tmpSb][1] == 3) {
							if (ar[i][3][tmpSb][2][0] == "ODV") {
								r = true;
								break;
							} else {
								tmpS += groupSubjectThreeSupl(ar[i][3][tmpSb][2][2], ar[i][3][tmpSb][2][0], ar[i][3][tmpSb][2][1], ar[i][3][tmpSb][2][3], ar[i][3][tmpSb][3][2], ar[i][3][tmpSb][3][0], ar[i][3][tmpSb][3][1], ar[i][3][tmpSb][3][3], ar[i][3][tmpSb][4][2], ar[i][3][tmpSb][4][0], ar[i][3][tmpSb][4][1], ar[i][3][tmpSb][4][3]);
							}
						} else {
							if (ar[i][3][tmpSb][2][0] == "ODV") {
								r = true;
								break;
							} else {
							}
						}
					} else {
						if (ar[i][3][tmpSb][1] == 1) {
							if (ar[i][3][tmpSb][2][1] == "" && ar[i][3][tmpSb][2][2] == "") {
								if (ar[i][3][tmpSb][2][0] == "ODV") {
									r = true;
									break;
								} else {
									tmpS += knowAkce(ar[i][3][tmpSb][2][0]);
								}
							} else if (ar[i][3][tmpSb][0] % 2 == 0) {
								if (ar[i][3][tmpSb][2][0] == "ODV") {
									r = true;
									break;
								} else {
									tmpS += knowSubjectSude(ar[i][3][tmpSb][2][2], ar[i][3][tmpSb][2][0], ar[i][3][tmpSb][2][1]);
								}
							} else {
								if (ar[i][3][tmpSb][2][0] == "ODV") {
									r = true;
									break;
								} else {
									tmpS += knowSubjectLiche(ar[i][3][tmpSb][2][2], ar[i][3][tmpSb][2][0], ar[i][3][tmpSb][2][1]);
								}
							}
						} else if (ar[i][3][tmpSb][1] == 2) {
							if (ar[i][3][tmpSb][2][0] == "ODV") {
								r = true;
								break;
							} else {
								tmpS += groupSubject(ar[i][3][tmpSb][2][2], ar[i][3][tmpSb][2][0], ar[i][3][tmpSb][2][1], ar[i][3][tmpSb][2][3], ar[i][3][tmpSb][3][2], ar[i][3][tmpSb][3][0], ar[i][3][tmpSb][3][1], ar[i][3][tmpSb][3][3]);
							}
						} else if (ar[i][3][tmpSb][1] == 3) {
							if (ar[i][3][tmpSb][2][0] == "ODV") {
								r = true;
								break;
							} else {
								tmpS += groupSubjectThree(ar[i][3][tmpSb][2][2], ar[i][3][tmpSb][2][0], ar[i][3][tmpSb][2][1], ar[i][3][tmpSb][2][3], ar[i][3][tmpSb][3][2], ar[i][3][tmpSb][3][0], ar[i][3][tmpSb][3][1], ar[i][3][tmpSb][3][3], ar[i][3][tmpSb][4][2], ar[i][3][tmpSb][4][0], ar[i][3][tmpSb][4][1], ar[i][3][tmpSb][4][3]);
							}
						} else {
							if (ar[i][3][tmpSb][2][0] == "ODV") {
								r = true;
								break;
							} else {
							}
						}
					}
				}
			}
			if (!r) {
				tmpS += "<span></span></div></div></div>";
				rozvrh += tmpS;
			} else {
				k--;
				k2--;
			}
		}
	}
	if (supl.length > 0) {
		createEverything(supl, true);
	} else {
		rozvrh += '<table style="width: 700px;margin-left: 60px;margin-top: 63px;"><tr class="sude sup0 suplov"style="background-color: transparent;"><td><strong>Žádné suplování není pro dnešní den plánováno.</strong></td></tr></table>';
	}
	$(".clearfix1").html($(".clearfix1").html() + rozvrh);
	rozvrh = "";
	var tmpK = k;
	if (suplSseas.length > 0) {
		addsseasSupl();
	} else {
		k2 = 0;
		if (supl2.length > 0) {
			createEverything(supl2, false);
		} else {
			rozvrh += '<table style="width: 700px;margin-left: 60px;margin-top: 63px;"><tr class="sude sup0 suplov"style="background-color: transparent;"><td><strong>Žádné suplování není pro další den plánováno.</strong></td></tr></table>';
		}
		$(".clearfix2").html($(".clearfix2").html() + rozvrh);
	}
	k = tmpK;

	// oznameni();
	// var x = 0;
	// var tmpX = [];
	// for (var i = 0; i < $("#nadpis").children().length; i++) {
	// 	if (isVisible($("#nadpis").children().eq(i))) {
	// 		see.push($("#nadpis").children().eq(i).text());
	// 	} else {
	// 		x++;
	// 		if (x == 1) {
	// 			hid.push(
	// 				$("#nadpis")
	// 					.children()
	// 					.eq(i - 1)
	// 					.text()
	// 			);
	// 			tmpX.push(
	// 				$("#nadpis")
	// 					.children()
	// 					.eq(i - 1)
	// 			);
	// 		}
	// 		hid.push($("#nadpis").children().eq(i).text());
	// 		tmpX.push($("#nadpis").children().eq(i));
	// 	}
	// }
	// for (var i = 0; i < tmpX.length; i++) {
	// 	tmpX[i].remove();
	// }

	function scrollRozvrh() {
		if (k > 5) {
			if (s >= k) s = 0;

			$(".day-rowf").hide();

			for (var i = s; i < s + 5; i++) {
				if (i < k) {
					$(".rowf" + i).show();
				}
			}

			s += 5;
		}
		if (suplSseas.length > 0) {
			if (sup > 10) {
				if (r >= sup) r = 0;

				for (var i = 0; i < sup; i++) {
					$(".sup" + i).hide();
				}

				for (var i = r; i < r + 10; i++) {
					if (i < sup) {
						$(".sup" + i).show();
					}
				}
				r += 10;
			}
		} else {
			if (k2 > 5) {
				if (s2 >= k2) s2 = 0;

				$(".day-rows").hide();

				for (var i = s2; i < s2 + 5; i++) {
					if (i < k2) {
						$(".rows" + i).show();
					}
				}

				s2 += 5;
			}
		}
		// $(".col-xs-10F").css({ marginLeft: ($(window).width() - 1200) / 2 + "px" });
	}
	let timetableCycle = 1;
	let timetableTimer = 0;
	let timetableNextTime = 8000;
	let timetableProgressElements = document.querySelectorAll("#timetableProgress");
	let timetableProgressNowElements = document.querySelectorAll("#timetableProgressNow");
	let timetableProgressMaxElement = document.querySelectorAll("#timetableProgressMax");
	function refreshTimetableSpans() {
		timetableProgressNowElements.forEach((element) => {
			element.innerHTML = timetableCycle;
		});
		timetableProgressMaxElement.forEach((element) => {
			element.innerHTML = Math.ceil(k / 5);
		});
	}
	function initTimetableProgress() {
		timetableProgressElements.forEach((element) => {
			element.style.width = "0%";
			element.style.transitionDuration = timetableNextTime + "ms";
		});
		refreshTimetableSpans();
	}
	function everyTimetableProgress() {
		console.log(k);
		timetableTimer += 1000;
		if (timetableTimer > timetableNextTime) {
			scrollRozvrh();
			if (timetableCycle >= Math.ceil(k / 5)) {
				timetableCycle = 0;
			}
			timetableCycle++;
			timetableTimer = 0;
			timetableProgressElements.forEach((element) => {
				element.style.transitionDuration = "0ms";
				element.style.width = 0 + "%";
			});
		} else {
			timetableProgressElements.forEach((element) => {
				element.style.transitionDuration = timetableNextTime + "ms";
				element.style.width = 100 + "%";
			});
		}
		refreshTimetableSpans();
	}

	initTimetableProgress();
	setInterval(everyTimetableProgress, 1000);

	var sup = $(".suplov").length;

	if (k >= 6) s = 6;
	else s = k;

	if (sup >= 10) r = 10;
	else r = sup;

	// $(".col-xs-10F").css({ marginLeft: ($(window).width() - 1200) / 2 + "px" });
});

function isVisible($obj) {
	var elementTop = $obj.offset().top;
	var elementBottom = elementTop + $obj.outerHeight();
	var viewportTop = $(window).scrollTop();
	var viewportBottom = viewportTop + $(window).height();
	return elementBottom > viewportTop && elementTop < viewportBottom;
}
