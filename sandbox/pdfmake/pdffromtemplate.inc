<?php
$dataFromDIM["lineBreakItem"]="\n";
$dataFromDIM["lineBreakHTMLItem"]="<br>";
function pdfMakerConfigSelect($pdfMakerConfigSelectParam)
	{
	if ($pdfMakerConfigSelectParam["type"] == 'File')
		{
		/**** read pdf config from file ****/
		$pdf_templateROW["configDescription"]='';
		$size = filesize($pdfMakerConfigSelectParam["configName"]);
		$pointer = fopen($pdfMakerConfigSelectParam["configName"],"r");
		while ($line = fgets($pointer, $size))
			{
			$pdf_templateROW["configDescription"].=$line;
			}
		fclose($pointer);

		/**** read template from file ****/
		$pdf_templateROW["pdfDescription"]='';
		$size = filesize($pdfMakerConfigSelectParam["templateName"]);
		$pointer = fopen($pdfMakerConfigSelectParam["templateName"],"r");
		while ($line = fgets($pointer, $size))
			{
			$pdf_templateROW["pdfDescription"].=$line;
			}
		fclose($pointer);
		}
	else if ($pdfMakerConfigSelectParam["type"] == 'Table')
		{
		if (!ISSET($pdfMakerConfigSelectParam["tableName"]))
			{
			$pdfMakerConfigSelectParam["tableName"]="pdf_template";
			}
		$pdf_templateSQL = "SELECT * FROM ".$pdfMakerConfigSelectParam["tableName"];
		if (ISSET($pdfMakerConfigSelectParam["id"]))
			{
			$pdf_templateSQL .= " WHERE active=1 AND id=".$pdfMakerConfigSelectParam["id"];
			}
		else if (ISSET($pdfMakerConfigSelectParam["designation"]))
			{
			$pdf_templateSQL .= " WHERE active=1 AND designation='".$pdfMakerConfigSelectParam["designation"]."'";
			}
		if (!empty($p_pdfMakerParam["conditionDescription"]))
			{
			$pdf_templateSQL .= " AND conditionDescription='".$pdfMakerConfigSelectParam["conditionDescription"]."'";
			}
		$pdf_templateSQL .= " ORDER BY id DESC";
		$pdf_templateRS = mysql_query($pdf_templateSQL) or mail("hiba-l@netrisk.hu","pdf_template kiválasztás:<br>",$pdf_templateSQL);
		if (mysql_num_rows($pdf_templateRS) == 0)
			{
			$pdf_templateROW = "";
			}
		else
			{
			$pdf_templateROW = mysql_fetch_array($pdf_templateRS);
			}
		}

	return $pdf_templateROW;
	}

function pdfConfig($pdfMakerConfigSelectedItem)
	{
	$doc_title = '';
	$doc_subject = '';
	$doc_keywords = '';
	$pdf_templatePageConfigDIM = explode('<#>',str_replace(CHR(13).CHR(10),'',$pdfMakerConfigSelectedItem["configDescription"]));
	$configCounter=sizeof($pdf_templatePageConfigDIM);
	for ($configCount = 0;$configCount < $configCounter;$configCount++)
		{
		list($configType, $parameters) = explode("<=>", $pdf_templatePageConfigDIM[$configCount]);
		switch ($configType)
			{
			case "define": 
				list($defineField, $defineValue) = explode("<->", $parameters);
				define ($defineField, $defineValue);
				break;
			case "Set": 
				list($setField, $setValue) = explode("<->", $parameters);
				$variable = $setField;
				$$variable = iconv('ISO-8859-2','UTF-8',$setValue);
				break;
			}
		}
	include('config/lang/eng.php');
	include('pdfmaker.php');
	//create new PDF document (document units are set by default to millimeters)
	$pdfDocument = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true); 

	// set document information
	$pdfDocument->SetCreator(PDF_CREATOR);
	$pdfDocument->SetAuthor(PDF_AUTHOR);
	$pdfDocument->SetTitle($doc_title);
	$pdfDocument->SetSubject($doc_subject);
	$pdfDocument->SetKeywords($doc_keywords);

	$pdfDocument->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, iconv('ISO-8859-2','UTF-8',PDF_HEADER_TITLE), iconv('ISO-8859-2','UTF-8',PDF_HEADER_STRING));

	//set margins
	$pdfDocument->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	//set auto page breaks
	$pdfDocument->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdfDocument->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdfDocument->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pdfDocument->setImageScale(PDF_IMAGE_SCALE_RATIO); //set image scale factor

	$pdfDocument->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdfDocument->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	$pdfDocument->setLanguageArray($l); //set language items

	//initialize document
	$pdfDocument->AliasNbPages();
	return $pdfDocument;
	}

function pdfMakerFromTemplate($pdfMakerFromTemplateParam, $dataFromDIM, $pdfMakerConfigSelectedItem, $pdfDocument)
	{
	$pdf_templateDIM = explode('<#>',str_replace(CHR(13).CHR(10),'',$pdfMakerConfigSelectedItem["pdfDescription"]));
	$configCounter=sizeof($pdf_templateDIM);
	$pdfDocument->setPrintHeader(false);
	$pdfDocument->setPrintFooter(false);
	if (ISSET($pdfMakerFromTemplateParam["pageCounter"]) && IS_INT($pdfMakerFromTemplateParam["pageCounter"]))
		{
		$pdfMakerFromTemplateParam["pageCounter"]++;
		}
	for ($configCount = 0;$configCount < $configCounter;$configCount++)
		{
		list($pdfFieldType, $parameters) = explode("<=>", $pdf_templateDIM[$configCount]);
		switch ($pdfFieldType)
			{
			case "AddPage": 
				/** AddPage<=>$orientation=''<>$jumoToTopAddPage **/
				list($orientationAddPage, $jumpToTopAddPage) = explode("<->", $parameters);
				if ($orientationAddPage == 'L' || $orientationAddPage == 'P')
					{
					$pdfDocument->AddPage($orientationAddPage);
					}
				else
					{
					$pdfDocument->AddPage();
					}
				if ($jumpToTopAddPage == 1)
					{
					$pdfDocument->Cell(1);
					}
				break;
			case "SetFont": 
				/** SetFont<=>$family<->$style=''<->$size=0 **/
				list($familySetFont, $styleSetFont, $sizeSetFont) = explode("<->", $parameters);
				if (empty($styleSetFont) || is_null($styleSetFont))
					{
					$styleSetFont = "";
					}
				if (empty($sizeSetFont) || is_null($sizeSetFont))
					{
					$sizeSetFont = 9;
					}
				$pdfDocument->SetFont($familySetFont, $styleSetFont, $sizeSetFont);
				break;
			case "Cell": 
				/** Cell<=>$width<->$height=0<->$txt=''<->$border=0<->$ln=1<->$align=''<->$fill=0<->$link=0 **/
				list($widthCell, $heightCell, $txtCell, $borderCell, $lnCell, $alignCell, $fillCell, $linkCell) = explode("<->", $parameters);
				$txtCell = pdfParseTpl($txtCell, $dataFromDIM);
				$pdfDocument->Cell($widthCell, $heightCell, iconv('ISO-8859-2','UTF-8',$txtCell), $borderCell, $lnCell, $alignCell, $fillCell, $linkCell);
				break;
			case "MultiCell": 
				/** MultiCell<=>$w<->$h<->$txt<->$border=0<->$align='J'<->$fill=0<->$ln=1 **/
				list($wMultiCell, $hMultiCell, $txtMultiCell, $borderMultiCell, $alignMultiCell, $fillMultiCell,$lnMultiCell) = explode("<->", $parameters);
				$txtMultiCell = pdfParseTpl($txtMultiCell, $dataFromDIM);
				if ($lnMultiCell == '')
					{
					$pdfDocument->MultiCell($wMultiCell, $hMultiCell, iconv('ISO-8859-2','UTF-8',$txtMultiCell), $borderMultiCell, $alignMultiCell, $fillMultiCell);
					}
				else
					{
					$pdfDocument->MultiCell($wMultiCell, $hMultiCell, iconv('ISO-8859-2','UTF-8',$txtMultiCell), $borderMultiCell, $alignMultiCell, $fillMultiCell, $lnMultiCell);
					}
				break;
			case "writeHTML": 
				/** writeHTML<=>$html<->$ln=true<->$fill=0 **/
				list($htmlwriteHTML, $lnwriteHTML, $fillwriteHTML) = explode("<->", $parameters);
				$htmlwriteHTML = pdfParseTpl($htmlwriteHTML, $dataFromDIM);
				$pdfDocument->writeHTML(iconv('ISO-8859-2','UTF-8',$htmlwriteHTML), $lnwriteHTML, $fillwriteHTML);
				break;
			case "writeHTMLCell": 
				/** writeHTMLCell<=>$w<->$h<->$x<->$y<->$html=''<->$border=0<->$ln=0<->$fill=0 **/
				list($wwriteHTMLCell, $hwriteHTMLCell, $xwriteHTMLCell, $ywriteHTMLCell, $htmlwriteHTMLCell, $borderwriteHTMLCell, $lnwriteHTMLCell, $fillwriteHTMLCell) = explode("<->", $parameters);
				$htmlwriteHTMLCell = pdfParseTpl($htmlwriteHTMLCell, $dataFromDIM);
//				$pdfDocument->writeHTMLCell($wwriteHTMLCell, $hwriteHTMLCell, $xwriteHTMLCell, $ywriteHTMLCell, iconv('ISO-8859-2','UTF-8',$htmlwriteHTMLCell), $borderwriteHTMLCell, $lnwriteHTMLCell, $fillwriteHTMLCell);
				$pdfDocument->writeHTMLCell($wwriteHTMLCell, $hwriteHTMLCell, $xwriteHTMLCell, $ywriteHTMLCell, iconv('ISO-8859-1','UTF-8',$htmlwriteHTMLCell), $borderwriteHTMLCell, $lnwriteHTMLCell, $fillwriteHTMLCell);
				break;
			case "Image": 
				/** Image<=>$file<->$x<->$y<->$w=0<->$h=0<->$type=''<->$link='' **/
				list($fileImage, $xImage, $yImage, $wImage, $hImage, $typeImage, $linkImage) = explode("<->", $parameters);
				$fileImage = pdfParseTpl($fileImage, $dataFromDIM);
				$pdfDocument->Image(iconv('ISO-8859-2','UTF-8',$fileImage), $xImage, $yImage, $wImage, $hImage, $typeImage, $linkImage);
				break;
			case "writeBarcode": 
				/** writeBarcode<=>$x<->$y<->$w<->$h<->$type<->$style<->$font<->$xres<->$code **/
				list($xwriteBarcode, $ywriteBarcode, $wwriteBarcode, $hwriteBarcode, $typeBarcode, $styleBarcode, $fontBarcode, $xresBarcode, $codeBarcode) = explode("<->", $parameters);
				$codeBarcode = pdfParseTpl($codeBarcode, $dataFromDIM);
				$pdfDocument->writeBarcode($xwriteBarcode, $ywriteBarcode, $wwriteBarcode, $hwriteBarcode, $typeBarcode, $styleBarcode, $fontBarcode, $xresBarcode, $codeBarcode);
				break;
			case "ClosePDF": 
				$pdfMakerFromTemplateParam["close"]=1;
				break;
			default :
			}
		}
	//Close and output PDF document
	if ($pdfMakerFromTemplateParam["close"]==1 || !ISSET($pdfMakerFromTemplateParam["close"]))
		{
		if (!isset($dataFromDIM['pdfFileNameElem']) || empty($dataFromDIM['pdfFileNameElem']))
			{
			$pdfDocument->Output();
			$pdfDocument->Close();
			}
		else
			{
			if (!isset($dataFromDIM['pdfFilePathElem']) || empty($dataFromDIM['pdfFilePathElem']))
				{
				$pdfDocument->Output($dataFromDIM['pdfFileNameElem'],'F');
				}
			else
				{
				$pdfDocument->Output($dataFromDIM['pdfFilePathElem'].$dataFromDIM['pdfFileNameElem'],'F');
				}
			$pdfDocument->Close();
			}
		}
	return $pdfDocument;
	}

function pdfParseTpl($tpl, $dataFromDIM)
	{
	$qs=array();
	$qv=array();
	$ex=explode ('{$',$tpl);
	for ($i=0; $i<sizeof($ex); $i++)
		{
		if (substr_count($ex[$i],'}')>0)
			{
			$xxpdfParseTpl=explode('}',$ex[$i]);
			if (substr_count($xxpdfParseTpl[0],'[')>0)
				{
				$clrpdfParseTpl=explode ('[',$xxpdfParseTpl[0]); 
				$sppdfParseTpl=str_replace('$','',substr($clrpdfParseTpl[1],0,strlen($clrpdfParseTpl[1])-1)); 
				$to=$dataFromDIM[$sppdfParseTpl];
				}
			$tpl=str_replace('{$'.$xxpdfParseTpl[0].'}', $to, $tpl);
			}
		}
	return $tpl;
	}

function pdfParseTplorig($tpl)
	{
	$qs=array();
	$qv=array();
	$ex=explode ('{$',$tpl);
	for ($i=0; $i<sizeof($ex); $i++)
		{
		if (substr_count($ex[$i],'}')>0)
			{
			$xxpdfParseTpl=explode('}',$ex[$i]);
			if (substr_count($xxpdfParseTpl[0],'[')>0)
				{
				$clrpdfParseTpl=explode ('[',$xxpdfParseTpl[0]); 
				$sppdfParseTpl=str_replace('$','',substr($clrpdfParseTpl[1],0,strlen($clrpdfParseTpl[1])-1)); 
				if(!is_integer($sppdfParseTpl) and isset($GLOBALS[$sppdfParseTpl])) $sppdfParseTpl=$GLOBALS[$sppdfParseTpl]; 
				$clrpdfParseTpl=$clrpdfParseTpl[0];
				if (!in_array($clrpdfParseTpl,$qs))
					{
					$qs[]=$clrpdfParseTpl;
					}
				if(isset($GLOBALS[$clrpdfParseTpl][$sppdfParseTpl])) $to=$GLOBALS[$clrpdfParseTpl][$sppdfParseTpl]; 
				else $to='';
				}
			else 
				{
				if(!in_array($xxpdfParseTpl[0], $qv))
					{
					$qv[]=$xxpdfParseTpl[0];
					}
				if(isset($GLOBALS[$xxpdfParseTpl[0]])) $to=$GLOBALS[$xxpdfParseTpl[0]];
				else $to='';
				}
			$tpl=str_replace('{$'.$xxpdfParseTpl[0].'}', $to, $tpl);
			}
		}
	return $tpl;
	}

function gif2jpeg($p_fl, $p_new_fl='', $bgcolor=false)
	{
	list($wd, $ht, $tp, $at)=getimagesize($p_fl);
	$img_src=imagecreatefromgif($p_fl);
	$img_dst=imagecreatetruecolor($wd,$ht);
	$clr['red']=255;
	$clr['green']=255;
	$clr['blue']=255;
	if(is_array($bgcolor)) $clr=$bgcolor;
	$kek=imagecolorallocate($img_dst,
	$clr['red'],$clr['green'],$clr['blue']);
	imagefill($img_dst,0,0,$kek);
	imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $wd, $ht, $wd, $ht);
	$draw=true;
	if(strlen($p_new_fl)>0)
		{
		if($hnd=fopen($p_new_fl,'w'))
			{
			$draw=false;
			fclose($hnd);
			}
		}
	if(true==$draw)
		{
		header("Content-type: image/jpeg");
		imagejpeg($img_dst);
		}
	else imagejpeg($img_dst, $p_new_fl);
	imagedestroy($img_dst);
	imagedestroy($img_src);
	}
?>