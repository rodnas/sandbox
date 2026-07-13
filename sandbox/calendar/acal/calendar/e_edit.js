function popUp(URL) {
var windowReference;
day = new Date();
id = day.getTime();
windowReference = window.open(URL,"", 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=400,height=400,left = 312,top = 184');
if (!windowReference.opener)
windowReference.opener = self;
}