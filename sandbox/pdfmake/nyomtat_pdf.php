<?php
/**** adatok felt”lt‚se ****/
$dataFromDIM[ugyfelidElem]='1111';
$dataFromDIM[alulirottCimkeElem]='alulirottCimkeAkarki';
$dataFromDIM[alulirottAdatElem]='alilirottAdat';
$dataFromDIM[ajanlatSzovegElem]='ajanlatszovagBarmi';
$dataFromDIM[keltDatumElem]='2008.09.20';
$dataFromDIM[ugyfelElem]='Nyomasek Bobo';
$dataFromDIM[vonalkodElem]='012345100500';
$dataFromDIM[developPicture]='images/developby.jpg';

$pdfMakerConfigSelectParam["configName"]="config.txt";
$pdfMakerConfigSelectParam["templateName"]="pdfproba.txt";

$pdfMakerConfigSelectParam["type"]="File";
//$pdfMakerConfigSelectParam["conditionDescription"]="";

/**** pdf gener l s ****/
include_once('pdffromtemplate.inc');
$pdfMakerConfigSelectedItem = pdfMakerConfigSelect($pdfMakerConfigSelectParam);
if (!empty($pdfMakerConfigSelectedItem))
	{
	$pdfDocument = pdfConfig($pdfMakerConfigSelectedItem);
	$pdfMakerFromTemplateParam["pageCounter"]=0;
	$pdfMakerFromTemplateParam["close"]=1;
	ob_clean();
	$pdfDocument = pdfMakerFromTemplate($pdfMakerFromTemplateParam, $dataFromDIM, $pdfMakerConfigSelectedItem, $pdfDocument);
	}
?>