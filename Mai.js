document.getElementById("Theory")
.addEventListener("click", function() {
	document.getElementById("TheoryNav").hidden = document.getElementById("TheoryNav").hidden === false;
	document.getElementById("TasksNav").hidden = true;
}, false);

document.getElementById("Tasks")
.addEventListener("click", function() {
	document.getElementById("TasksNav").hidden = document.getElementById("TasksNav").hidden === false;
	document.getElementById("TheoryNav").hidden = true;
}, false);

function th_cookie(name){ //создание куки с id темы
	var a = name;
	var b = "th_topic_id";
	document.cookie=b+'='+a+";path=/"+";max-age=3600";
};

var description = document.getElementById("Text");

function viewDiv(){ 
document.getElementById("Test").style.display = "block"; 
description.remove(); 
};

function delete_cookie( name, path ) { //Удаляет куки
	if( get_cookie( name ) ) {
	  document.cookie = name + "=" +
		((path) ? ";path="+path:"")+
		";expires=Thu, 01 Jan 1970 00:00:01 GMT";
	}
  }

  function setCookie(cname, cvalue, exdays) { //
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) { //Получаем значение куки
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function switchcl() { //Функция смены 10 и 11 класса
	if (getCookie('class')== 10) {
		setCookie('class','11','1');
	} else setCookie('class','10','1');
	location. reload()
}
