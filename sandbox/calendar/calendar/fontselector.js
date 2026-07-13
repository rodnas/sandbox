// Title: Tigra Color Picker
// URL: http://www.softcomplex.com/products/tigra_color_picker/
// Version: 1.1
// Date: 06/26/2003 (mm/dd/yyyy)
// Feedback: feedback@softcomplex.com (specify product title in the subject)
// Note: Permission given to use this script in ANY kind of applications if
//    header lines are left unchanged.
// Note: Script consists of two files: picker.js and picker.html
// About us: Our company provides offshore IT consulting services.
//    Contact us at sales@softcomplex.com if you have any programming task you
//    want to be handled by professionals. Our typical hourly rate is $20.

var FSelector = new TFontSelector();

function TFPopup(field, table) {
	this.field = field;
	this.initTable = !table || table > 2 ? 0 : table;
	var w = 211, h = 206,
	move = screen ?
		',left=' + ((screen.width - w) >> 1) + ',top=' + ((screen.height - h) >> 1) : '',
	o_colWindow = window.open('fontpicker.html', null, "help=no,status=no,scrollbars=yes,resizable=no" + move + ",width=" + w + ",height=" + h + ",dependent=yes", true);
	o_colWindow.opener = window;
	o_colWindow.focus();
}

function TCBuildCell (R, G, B, w, h) {
        var	s='';
	for (j = 0; j < this.fonts.length; j ++) {
		s += "<tr>";
		s +='<td >font:'+this.fonts[j]+'<br><a class="text" href="javascript:P.S(\'' + this.fonts[j] + '\')" ><font face="'+this.fonts[j] +'">'+this.testStr+'</font></a></td>';
		s += "</tr>";
	}
	return s;

}

function TCSelect(c) {
	this.field.value = c;
	this.win.close();
}

function TCPaint(c, b_noPref) {
//	if (this.o_samp)
//		this.o_samp.innerHTML = '<font face="'+c+'">' + this.testStr +'</font';
}

function TCGenerateWin() {
	this.fonts.length=0;
	this.fonts[0]='arial';
	this.fonts[1]='arial black';
	this.fonts[2]='arial narrow';
	this.fonts[3]='book antiqua';
	this.fonts[4]='century gothic';
	this.fonts[5]='century schoolbook';
	this.fonts[6]='courier';
	this.fonts[7]='courier new';
	this.fonts[8]='fixedsys';
	this.fonts[9]='garamond';
	this.fonts[10]='times new roman';
	this.fonts[11]='verdana';
	return this.bldCell();
}

function TCGenerateMac() {
	this.fonts.length=0;
	this.fonts[0]='chicago';
	this.fonts[1]='courier';
	this.fonts[2]='geneva';
	this.fonts[3]='helvetica';
	this.fonts[4]='monaco';
	this.fonts[5]='palatino';
	this.fonts[6]='times';
	return this.bldCell();
}

function TCGenerateGeneric() {
	this.fonts.length=0;
	this.fonts[0]='serif';
	this.fonts[1]='sans-serif';
	this.fonts[2]='cursive';
	this.fonts[3]='monospace';
	this.fonts[4]='fantasy';
	return this.bldCell();
}

function TCDec2Hex(v) {
	v = v.toString(16);
	for(; v.length < 6; v = '0' + v);
	return v;
}

function TCChgMode(v) {
	for (var k in this.divs) this.hide(k);
	this.show(v);
}

function TFontSelector(field) {
	this.testStr='Testing string';
	this.build0 = TCGenerateWin;
	this.build1 = TCGenerateMac;
	this.build2 = TCGenerateGeneric;
	this.fonts=new Array();
	this.show = document.layers ? 
		function (div) { this.divs[div].visibility = 'show' } :
		function (div) { this.divs[div].visibility = 'visible' };
	this.hide = document.layers ? 
		function (div) { this.divs[div].visibility = 'hide' } :
		function (div) { this.divs[div].visibility = 'hidden' };
	// event handlers
	this.C       = TCChgMode;
	this.S       = TCSelect;
	this.P       = TCPaint;
	this.popup   = TFPopup;
	this.draw    = TCDraw;
	this.dec2hex = TCDec2Hex;
	this.bldCell = TCBuildCell;
	this.divs = [];
}

function TCDraw(o_win, o_doc) {
	this.win = o_win;
	this.doc = o_doc;
	var 
	s_tag_openT  = o_doc.layers ? 
		'layer visibility=hidden top=54 left=5 width=180' : 
		'div style=visibility:hidden;position:absolute;left:6px;top:54px;width:180px;height:0',
	s_tag_openS  = o_doc.layers ? 'layer top=32 left=6' : 'div',
	s_tag_close  = o_doc.layers ? 'layer' : 'div'

//	this.doc.write('<' + s_tag_openS + ' id=sam name=sam><table cellpadding=0 cellspacing=0 border=1 width=181 align=center class=bd><tr><td align=center height=18><div id="samp"><font face=Tahoma size=2>sample</font></div></td></tr></table></' + s_tag_close + '>');
//	this.sample = o_doc.layers ? o_doc.layers['sam'] :
//		o_doc.getElementById ? o_doc.getElementById('sam').style : o_doc.all['sam'].style

	for (var k = 0; k < 3; k ++) {
		this.doc.write('<' + s_tag_openT + ' id="p' + k + '" name="p' + k + '"><table cellpadding=0 cellspacing=0 border=1 align=center>' + this['build' + k]() + '</table></' + s_tag_close + '>');
		this.divs[k] = o_doc.layers
			? o_doc.layers['p' + k] : o_doc.all
				? o_doc.all['p' + k].style : o_doc.getElementById('p' + k).style
	}
//	if (!o_doc.layers && o_doc.body.innerHTML)
//		this.o_samp = o_doc.all
//			? o_doc.all.samp : o_doc.getElementById('samp');
	this.C(this.initTable);
	if (this.field.value) this.P(this.field.value, true)
}