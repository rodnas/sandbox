var aktTag=new Array();
var bb_feld=null;

function setTag1(tag) {
	tmp="";
	tmp=prompt('Make your Input!','');
	if(tmp) {
		tmp="<"+tag+">"+tmp+"</"+tag+">";
		bb_feld.value+=tmp;
	}
}

function setTag1c(t) {
	var tmp="";
	var tmp1="";
	var tmp2="";
	var val;
	if(t=="URL") {
		tt="Enter the Location";
		val="http://";
	}
	tmp1=prompt(tt,val);
	if(tmp1) {
		tmp2=prompt('Enter the Text to be displayed Link!','');
	}
	if(tmp1 && tmp2) {
		tmp="<a href\=\""+tmp1+"\">"+tmp2+"</a>";
		bb_feld.value+=tmp;
		bb_feld.focus();
	}
}

function BB_down(ob,tag) {
	if(tag) {
		setTag1(tag);
	} else {
		closeTag();
	}
}

function BB_down3(ob) {
	setTag1c("URL");
}