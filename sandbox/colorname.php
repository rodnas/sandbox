
<?php
/*
header("Content-type: text/html; charset=utf-8");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
*/
$color = [];
$color[] = array('color'=>'#FFFFFF','background-color'=>'#000000','name'=>'Black');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#000080','name'=>'Navy');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#00008B','name'=>'DarkBlue');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#0000CD','name'=>'MediumBlue');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#191970','name'=>'MidnightBlue');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#4B0082','name'=>'Indigo');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#0000FF','name'=>'Blue');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#800000','name'=>'Maroon');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#8B0000','name'=>'DarkRed');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#8B008B','name'=>'Purple');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#8B008B','name'=>'DarkMagenta');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#9400D3','name'=>'DarkViolet');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#8B4513','name'=>'SaddleBrown');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#483D8B','name'=>'DarkSlateBlue');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#006400','name'=>'DarkGreen');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#2F4F4F','name'=>'DarkSlateGray');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#A52A2A','name'=>'Brown');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#B22222','name'=>'FireBrick');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#A0522D','name'=>'Sienna');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#8A2BE2','name'=>'BlueViolet');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#556B2F','name'=>'DarkOliveGreen');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#008000','name'=>'Green');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#DC143C','name'=>'Crimson');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#C71585','name'=>'MediumVioletRed');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#FF0000','name'=>'Red');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#9932CC','name'=>'DarkOrchid');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#008080','name'=>'Teal');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#696969','name'=>'DimGray');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#D2691E','name'=>'Chocolate');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#FF00FF','name'=>'Fuchsia');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#FF00FF','name'=>'Magenta');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#6A5ACD','name'=>'SlateBlue');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#808000','name'=>'Olive');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#CD5C5C','name'=>'IndianRed');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#008B8B','name'=>'DarkCyan');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#FF4500','name'=>'OrangeRed');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#4169E1','name'=>'RoyalBlue');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#228B22','name'=>'ForestGreen');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#BA55D3','name'=>'MediumOrchid');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#FF1493','name'=>'DeepPink');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#B8860B','name'=>'DarkGoldenrod');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#2E8B57','name'=>'SeaGreen');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#6B8E23','name'=>'OliveDrab');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#7B68EE','name'=>'MediumSlateBlue');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#FF6347','name'=>'Tomato');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#DB7093','name'=>'PaleVioletRed');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#808080','name'=>'Gray');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#708090','name'=>'SlateGray');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#CD853F','name'=>'Peru');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#1E90FF','name'=>'DodgerBlue');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#FF8C00','name'=>'DarkOrange');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#9370DB','name'=>'MediumPurple');
$color[] = array('color'=>'#FFFFFF','background-color'=>'#4682B4','name'=>'SteelBlue');
$color[] = array('color'=>'#000000','background-color'=>'#FF7F50','name'=>'Coral');
$color[] = array('color'=>'#000000','background-color'=>'#778899','name'=>'LightSlateGray');
$color[] = array('color'=>'#000000','background-color'=>'#DA70D6','name'=>'Orchid');
$color[] = array('color'=>'#000000','background-color'=>'#FA8072','name'=>'Salmon');
$color[] = array('color'=>'#000000','background-color'=>'#F08080','name'=>'LightCoral');
$color[] = array('color'=>'#000000','background-color'=>'#FF69B4','name'=>'HotPink');
$color[] = array('color'=>'#000000','background-color'=>'#BC8F8F','name'=>'RosyBrown');
$color[] = array('color'=>'#000000','background-color'=>'#FFA500','name'=>'Orange');
$color[] = array('color'=>'#000000','background-color'=>'#DAA520','name'=>'Goldenrod');
$color[] = array('color'=>'#000000','background-color'=>'#5F9EA0','name'=>'CadetBlue');
$color[] = array('color'=>'#000000','background-color'=>'#20B2AA','name'=>'LightSeaGreen');
$color[] = array('color'=>'#000000','background-color'=>'#E9967A','name'=>'DarkSalmon');
$color[] = array('color'=>'#000000','background-color'=>'#00BFFF','name'=>'DeepSkyBlue');
$color[] = array('color'=>'#000000','background-color'=>'#EE82EE','name'=>'Violet');
$color[] = array('color'=>'#000000','background-color'=>'#6495ED','name'=>'CornflowerBlue');
$color[] = array('color'=>'#000000','background-color'=>'#3CB371','name'=>'MediumSeaGreen');
$color[] = array('color'=>'#000000','background-color'=>'#F4A460','name'=>'SandyBrown');
$color[] = array('color'=>'#000000','background-color'=>'#00CED1','name'=>'DarkTurquoise');
$color[] = array('color'=>'#000000','background-color'=>'#FFA07A','name'=>'LightSalmon');
$color[] = array('color'=>'#000000','background-color'=>'#32CD32','name'=>'LimeGreen');
$color[] = array('color'=>'#000000','background-color'=>'#A9A9A9','name'=>'DarkGray');
$color[] = array('color'=>'#000000','background-color'=>'#BDB76B','name'=>'DarkKhaki');
$color[] = array('color'=>'#000000','background-color'=>'#DDA0DD','name'=>'Plum');
$color[] = array('color'=>'#000000','background-color'=>'#D2B48C','name'=>'Tan');
$color[] = array('color'=>'#000000','background-color'=>'#8FBC8F','name'=>'TaDarkSeaGreenn');
$color[] = array('color'=>'#000000','background-color'=>'#9ACD32','name'=>'YellowGreen');
$color[] = array('color'=>'#000000','background-color'=>'#DEB887','name'=>'Gold');
$color[] = array('color'=>'#000000','background-color'=>'#FFD700','name'=>'BurlyWood');
$color[] = array('color'=>'#000000','background-color'=>'#66CDAA','name'=>'MediumAquamarine');
$color[] = array('color'=>'#000000','background-color'=>'#FFB6C1','name'=>'LightPink');
$color[] = array('color'=>'#000000','background-color'=>'#C0C0C0','name'=>'Silver');
$color[] = array('color'=>'#000000','background-color'=>'#00FF00','name'=>'Lime');
$color[] = array('color'=>'#000000','background-color'=>'#48D1CC','name'=>'MediumTurquoise');
$color[] = array('color'=>'#000000','background-color'=>'#00FA9A','name'=>'MediumSpringGreen');
$color[] = array('color'=>'#000000','background-color'=>'#D8BFD8','name'=>'Thistle');
$color[] = array('color'=>'#000000','background-color'=>'#00FF7F','name'=>'SpringGreen');
$color[] = array('color'=>'#000000','background-color'=>'#B0C4DE','name'=>'LightSteelBlue');
$color[] = array('color'=>'#000000','background-color'=>'#FFC0CB','name'=>'Pink');
$color[] = array('color'=>'#000000','background-color'=>'#40E0D0','name'=>'Turquoise');
$color[] = array('color'=>'#000000','background-color'=>'#00FFFF','name'=>'Aqua');
$color[] = array('color'=>'#000000','background-color'=>'#00FFFF','name'=>'Cyan');
$color[] = array('color'=>'#000000','background-color'=>'#7CFC00','name'=>'LawnGreen');
$color[] = array('color'=>'#000000','background-color'=>'#87CEEB','name'=>'SkyBlue');
$color[] = array('color'=>'#000000','background-color'=>'#7FFF00','name'=>'Chartreuse');
$color[] = array('color'=>'#000000','background-color'=>'#87CEFA','name'=>'LightSkyBlue');
$color[] = array('color'=>'#000000','background-color'=>'#D3D3D3','name'=>'LightGrey');
$color[] = array('color'=>'#000000','background-color'=>'#ADD8E6','name'=>'LightBlue');
$color[] = array('color'=>'#000000','background-color'=>'#90EE90','name'=>'LightGreen');
$color[] = array('color'=>'#000000','background-color'=>'#ADFF2F','name'=>'GreenYellow');
$color[] = array('color'=>'#000000','background-color'=>'#FFDAB9','name'=>'PeachPuff');
$color[] = array('color'=>'#000000','background-color'=>'#FFFF00','name'=>'Yellow');
$color[] = array('color'=>'#000000','background-color'=>'#F0E68C','name'=>'Khaki');
$color[] = array('color'=>'#000000','background-color'=>'#F5DEB3','name'=>'Wheat');
$color[] = array('color'=>'#000000','background-color'=>'#FFDEAD','name'=>'NavajoWhite');
$color[] = array('color'=>'#000000','background-color'=>'#DCDCDC','name'=>'Gainsboro');
$color[] = array('color'=>'#000000','background-color'=>'#B0E0E6','name'=>'PowderBlue');
$color[] = array('color'=>'#000000','background-color'=>'#EEE8AA','name'=>'PaleGoldenrod');
$color[] = array('color'=>'#000000','background-color'=>'#FFE4B5','name'=>'Moccasin');
$color[] = array('color'=>'#000000','background-color'=>'#FFE4C4','name'=>'Bisque');
$color[] = array('color'=>'#000000','background-color'=>'#98FB98','name'=>'PaleGreen');
$color[] = array('color'=>'#000000','background-color'=>'#FFE4E1','name'=>'MistyRose');
$color[] = array('color'=>'#000000','background-color'=>'#AFEEEE','name'=>'PaleTurquoise');
$color[] = array('color'=>'#000000','background-color'=>'#FFEBCD','name'=>'BlanchedAlmond');
$color[] = array('color'=>'#000000','background-color'=>'#E6E6FA','name'=>'Lavender');
$color[] = array('color'=>'#000000','background-color'=>'#FAEBD7','name'=>'AntiqueWhite');
$color[] = array('color'=>'#000000','background-color'=>'#7FFFD4','name'=>'Aquamarine');
$color[] = array('color'=>'#000000','background-color'=>'#FFEFD5','name'=>'PapayaWhip');
$color[] = array('color'=>'#000000','background-color'=>'#FAF0E6','name'=>'Linen');
$color[] = array('color'=>'#000000','background-color'=>'#F5F5DC','name'=>'Beige');
$color[] = array('color'=>'#000000','background-color'=>'#FFF0F5','name'=>'LavenderBlush');
$color[] = array('color'=>'#000000','background-color'=>'#FDF5E6','name'=>'OldLace');
$color[] = array('color'=>'#000000','background-color'=>'#FFFACD','name'=>'LemonChiffon');
$color[] = array('color'=>'#000000','background-color'=>'#FAFAD2','name'=>'LightGoldenrodYellow');
$color[] = array('color'=>'#000000','background-color'=>'#FFF8DC','name'=>'Cornsilk');
$color[] = array('color'=>'#000000','background-color'=>'#FFF5EE','name'=>'Seashell');
$color[] = array('color'=>'#000000','background-color'=>'#F5F5F5','name'=>'WhiteSmoke');
$color[] = array('color'=>'#000000','background-color'=>'#F0F8FF','name'=>'AliceBlue');
$color[] = array('color'=>'#000000','background-color'=>'#FFFAF0','name'=>'FloralWhite');
$color[] = array('color'=>'#000000','background-color'=>'#F8F8FF','name'=>'GhostWhite');
$color[] = array('color'=>'#000000','background-color'=>'#FFFFE0','name'=>'LightYellow');
$color[] = array('color'=>'#000000','background-color'=>'#FFFAFA','name'=>'Snow');
$color[] = array('color'=>'#000000','background-color'=>'#F0FFF0','name'=>'Honeydew');
$color[] = array('color'=>'#000000','background-color'=>'#E0FFFF','name'=>'LightCyan');
$color[] = array('color'=>'#000000','background-color'=>'#FFFFF0','name'=>'Ivory');
$color[] = array('color'=>'#000000','background-color'=>'#F5FFFA','name'=>'MintCream');
$color[] = array('color'=>'#000000','background-color'=>'#F0FFFF','name'=>'Azure');
$color[] = array('color'=>'#000000','background-color'=>'#FFFFFF','name'=>'White');

print_r(colorNameBackHex('Azure',$color));

print_r('<br>');
print_r(colorBack('name','Azure',$color)['background-color']);
print_r('<br>');
print_r(colorBack('background-color','#F5FFFA',$color)['name']);
print_r('<br>');
print_r(colorBack('background-color','#F5FFFAA',$color)['name']);
print_r('<br>');
print_r(colorBack('colorId',12,$color)['name']);

function colorBack($field, $color, $array) {
	$colorId = 0;
	foreach ($array as $key => $val) {
		switch ($field) {
			case 'name':
				if ($val[$field] === $color) {
					$resultColor['color'] = $val['color'];
					$resultColor['background-color'] = $val['background-color'];
					$resultColor['name'] = $val['name'];
					return $resultColor;
				}
				break;
			case 'background-color':
				if ($val[$field] === $color) {
					$resultColor['color'] = $val['color'];
					$resultColor['background-color'] = $val['background-color'];
					$resultColor['name'] = $val['name'];
					return $resultColor;
				}
				break;
			case 'colorId':
				if ($colorId === $color) {
					$resultColor['color'] = $val['color'];
					$resultColor['background-color'] = $val['background-color'];
					$resultColor['name'] = $val['name'];
					return $resultColor;
				}
				break;
			default:
				break;
		}
		$colorId++;
	}
	$resultColor['color'] = 'Bad input!';
	$resultColor['background-color'] = 'Bad input!';
	$resultColor['name'] = 'Bad input!';
	return $resultColor;
}

function colorNameBackHex($name, $array) {
	foreach ($array as $key => $val) {
		if ($val['name'] === $name) {
			return $val['background-color'];
		}
	}
	return null;
}

function colorHexBackName($hex, $array) {
	foreach ($array as $key => $val) {
		if ($val['background-color'] === $hex) {
			return $val['name'];
		}
	}
	return null;
}

function searchColorName($name, $array) {
	foreach ($array as $key => $val) {
		if ($val['name'] === $name) {
			return $key;
		}
	}
	return null;
}

function searchHexColor($hexColor, $array) {
	foreach ($array as $key => $val) {
		if ($val['color'] === $hexColor) {
			return $key;
		}
	}
	return null;
}

function searchHexBackgroundColor($hexBackgroundColor, $array) {
	foreach ($array as $key => $val) {
		if ($val['background-color'] === $hexBackgroundColor) {
			return $key;
		}
	}
	return null;
}

function hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);
	if (strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	//return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}

/*
print_r('<pre>');
print_r($color);
$colorId1 = searchColorName("navy",$color);
$colorId2 = searchHexColor("#FFFFFF",$color);
$colorId3 = searchHexBackgroundColor("#00008B",$color);

print_r('['.$color[$colorId1]['background-color'].']');
print_r('['.$color[$colorId2]['name'].']');
print_r('['.$color[$colorId3]['name'].']');
print_r(hex2rgb($color[$colorId3]['name']));
*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<script>
localStorage.lastname = "Subidubi ezt kapd ki!";
</script>
<table border=0 width=200 height=50>
<tr><td align="center" style="background-color:black;color:white;"><p>black</p></td><td align="center"><p>#000000</p></td></tr>
<tr><td align="center" style="background-color:white;color:black;"><p>white</p></td><td align="center"><p>#FFFFFF</p></td></tr>
<tr><td align="center" style="background-color:silver;color:black;"><p>silver</p></td><td align="center"><p>#C0C0C0</p></td></tr>
<tr><td align="center" style="background-color:gray;color:white;"><p>gray</p></td><td align="center"><p>#808080</p></td></tr>
<tr><td align="center" style="background-color:maroon;color:white;"><p>maroon</p></td><td align="center"><p>#800000</p></td></tr>
<tr><td align="center" style="background-color:red;color:white;"><p>red</p></td><td align="center"><p>#FF0000</p></td></tr>
<tr><td align="center" style="background-color:purple;color:white;"><p>purple</p></td><td align="center"><p>#800080</p></td></tr>
<tr><td align="center" style="background-color:fuchsia;color:white;"><p>fuchsia</p></td><td align="center"><p>#FF00FF</p></td></tr>
<tr><td align="center" style="background-color:green;color:white;"><p>green</p></td><td align="center"><p>#008000</p></td></tr>
<tr><td align="center" style="background-color:lime;color:black;"><p>lime</p></td><td align="center"><p>#00FF00</p></td></tr>
<tr><td align="center" style="background-color:olive;color:white;"><p>olive</p></td><td align="center"><p>#808000</p></td></tr>
<tr><td align="center" style="background-color:yellow;color:black;"><p>yellow</p></td><td align="center"><p>#FFFF00</p></td></tr>
<tr><td align="center" style="background-color:navy;color:white;"><p>navy</p></td><td align="center"><p>#000080</p></td></tr>
<tr><td align="center" style="background-color:blue;color:white;"><p>blue</p></td><td align="center"><p>#0000FF</p></td></tr>
<tr><td align="center" style="background-color:teal;color:white;"><p>teal</p></td><td align="center"><p>#008080</p></td></tr>
<tr><td align="center" style="background-color:aqua;color:black;"><p>aqua</p></td><td align="center"><p>#00FFFF</p></td></tr>
<tr><td align="center" style="background-color:orange;color:black;"><p>orange</p></td><td align="center"><p>#FFA500</p></td></tr>
</table>

A Gray alternatív Grey formában is írható. Továbbá az Aqua és a Cyan, valamint a Magenta és a Fuchsia ugyanazokat a színeket nevezik meg.
<table>
<tr>
<td style="vertical-align:top;">
<table border=0 width=200 height=50>
<tr>
<th colspan="3" style="font-family:Arial, sans-serif">Világosság szerint</th>
</tr>
<?php
$counter=0;
foreach ($color as $key => $val) {
	$counter++;
	echo '<tr>';
	echo '<td>'.$counter.'</td>';
	echo '<td style="color:'.$val['color'].';background-color:'.$val['background-color'].'">'.$val['name'].'</td>';
	echo '<td style="color:'.$val['color'].';background-color:'.$val['background-color'].'">'.$val['background-color'].'</td>';
	echo '</tr>';
}
?>
</table>
</td>
<td style="vertical-align:top;">

<table border=0 width=200 height=50>
<tr>
<th colspan="2" style="font-family:Arial, sans-serif">Világosság szerint</th>
</tr>
<tr>
<td style="color:#FFF;background-color:black">Black</td>
<td style="color:#FFF;background-color:#000000">#000000</td>
</tr>
<tr>
<td style="color:#FFF;background-color:navy">Navy</td>
<td style="color:#FFF;background-color:#000080">#000080</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkblue">DarkBlue</td>
<td style="color:#FFF;background-color:#00008B">#00008B</td>
</tr>
<tr>
<td style="color:#FFF;background-color:Mediumblue">MediumBlue</td>
<td style="color:#FFF;background-color:#0000CD">#0000CD</td>
</tr>
<tr>
<td style="color:#FFF;background-color:midnightblue">MidnightBlue</td>
<td style="color:#FFF;background-color:#191970">#191970</td>
</tr>
<tr>
<td style="color:#FFF;background-color:indigo">Indigo</td>
<td style="color:#FFF;background-color:#4B0082">#4B0082</td>
</tr>
<tr>
<td style="color:#FFF;background-color:blue">Blue</td>
<td style="color:#FFF;background-color:#0000FF">#0000FF</td>
</tr>
<tr>
<td style="color:#FFF;background-color:maroon">Maroon</td>
<td style="color:#FFF;background-color:#800000">#800000</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkred">DarkRed</td>
<td style="color:#FFF;background-color:#8B0000">#8B0000</td>
</tr>
<tr>
<td style="color:#FFF;background-color:purple">Purple</td>
<td style="color:#FFF;background-color:#800080">#800080</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkmagenta">DarkMagenta</td>
<td style="color:#FFF;background-color:#8B008B">#8B008B</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkviolet">DarkViolet</td>
<td style="color:#FFF;background-color:#9400D3">#9400D3</td>
</tr>
<tr>
<td style="color:#FFF;background-color:saddlebrown">SaddleBrown</td>
<td style="color:#FFF;background-color:#8B4513">#8B4513</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkslateblue">DarkSlateBlue</td>
<td style="color:#FFF;background-color:#483D8B">#483D8B</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkgreen">DarkGreen</td>
<td style="color:#FFF;background-color:#006400">#006400</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkslategray">DarkSlateGray</td>
<td style="color:#FFF;background-color:#2F4F4F">#2F4F4F</td>
</tr>
<tr>
<td style="color:#FFF;background-color:brown">Brown</td>
<td style="color:#FFF;background-color:#A52A2A">#A52A2A</td>
</tr>
<tr>
<td style="color:#FFF;background-color:firebrick">FireBrick</td>
<td style="color:#FFF;background-color:#B22222">#B22222</td>
</tr>
<tr>
<td style="color:#FFF;background-color:sienna">Sienna</td>
<td style="color:#FFF;background-color:#A0522D">#A0522D</td>
</tr>
<tr>
<td style="color:#FFF;background-color:blueviolet">BlueViolet</td>
<td style="color:#FFF;background-color:#8A2BE2">#8A2BE2</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkolivegreen">DarkOliveGreen</td>
<td style="color:#FFF;background-color:#556B2F">#556B2F</td>
</tr>
<tr>
<td style="color:#FFF;background-color:green">Green</td>
<td style="color:#FFF;background-color:#008000">#008000</td>
</tr>
<tr>
<td style="color:#FFF;background-color:crimson">Crimson</td>
<td style="color:#FFF;background-color:#DC143C">#DC143C</td>
</tr>
<tr>
<td style="color:#FFF;background-color:mediumvioletred">MediumVioletRed</td>
<td style="color:#FFF;background-color:#C71585">#C71585</td>
</tr>
<tr>
<td style="color:#FFF;background-color:red">Red</td>
<td style="color:#FFF;background-color:#FF0000">#FF0000</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkorchid">DarkOrchid</td>
<td style="color:#FFF;background-color:#9932CC">#9932CC</td>
</tr>
<tr>
<td style="color:#FFF;background-color:teal">Teal</td>
<td style="color:#FFF;background-color:#008080">#008080</td>
</tr>
<tr>
<td style="color:#FFF;background-color:dimgray">DimGray</td>
<td style="color:#FFF;background-color:#696969">#696969</td>
</tr>
<tr>
<td style="color:#FFF;background-color:chocolate">Chocolate</td>
<td style="color:#FFF;background-color:#D2691E">#D2691E</td>
</tr>
<tr>
<td style="color:#FFF;background-color:fuchsia">Fuchsia</td>
<td style="color:#FFF;background-color:#FF00FF">#FF00FF</td>
</tr>
<tr>
<td style="color:#FFF;background-color:magenta">Magenta</td>
<td style="color:#FFF;background-color:#FF00FF">#FF00FF</td>
</tr>
<tr>
<td style="color:#FFF;background-color:slateblue">SlateBlue</td>
<td style="color:#FFF;background-color:#6A5ACD">#6A5ACD</td>
</tr>
<tr>
<td style="color:#FFF;background-color:olive">Olive</td>
<td style="color:#FFF;background-color:#808000">#808000</td>
</tr>
<tr>
<td style="color:#FFF;background-color:indianred">IndianRed</td>
<td style="color:#FFF;background-color:#CD5C5C">#CD5C5C</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkcyan">DarkCyan</td>
<td style="color:#FFF;background-color:#008B8B">#008B8B</td>
</tr>
<tr>
<td style="color:#FFF;background-color:orangered">OrangeRed</td>
<td style="color:#FFF;background-color:#FF4500">#FF4500</td>
</tr>
<tr>
<td style="color:#FFF;background-color:royalblue">RoyalBlue</td>
<td style="color:#FFF;background-color:#4169E1">#4169E1</td>
</tr>
<tr>
<td style="color:#FFF;background-color:forestgreen">ForestGreen</td>
<td style="color:#FFF;background-color:#228B22">#228B22</td>
</tr>
<tr>
<td style="color:#FFF;background-color:mediumorchid">MediumOrchid</td>
<td style="color:#FFF;background-color:#BA55D3">#BA55D3</td>
</tr>
<tr>
<td style="color:#FFF;background-color:deeppink">DeepPink</td>
<td style="color:#FFF;background-color:#FF1493">#FF1493</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkgoldenrod">DarkGoldenrod</td>
<td style="color:#FFF;background-color:#B8860B">#B8860B</td>
</tr>
<tr>
<td style="color:#FFF;background-color:seagreen">SeaGreen</td>
<td style="color:#FFF;background-color:#2E8B57">#2E8B57</td>
</tr>
<tr>
<td style="color:#FFF;background-color:olivedrab">OliveDrab</td>
<td style="color:#FFF;background-color:#6B8E23">#6B8E23</td>
</tr>
<tr>
<td style="color:#FFF;background-color:mediumslateblue">MediumSlateBlue</td>
<td style="color:#FFF;background-color:#7B68EE">#7B68EE</td>
</tr>
<tr>
<td style="color:#FFF;background-color:tomato">Tomato</td>
<td style="color:#FFF;background-color:#FF6347">#FF6347</td>
</tr>
<tr>
<td style="color:#FFF;background-color:palevioletred">PaleVioletRed</td>
<td style="color:#FFF;background-color:#DB7093">#DB7093</td>
</tr>
<tr>
<td style="color:#FFF;background-color:gray">Gray</td>
<td style="color:#FFF;background-color:#808080">#808080</td>
</tr>
<tr>
<td style="color:#FFF;background-color:slategray">SlateGray</td>
<td style="color:#FFF;background-color:#708090">#708090</td>
</tr>
<tr>
<td style="color:#FFF;background-color:peru">Peru</td>
<td style="color:#FFF;background-color:#CD853F">#CD853F</td>
</tr>
<tr>
<td style="color:#FFF;background-color:dodgerblue">DodgerBlue</td>
<td style="color:#FFF;background-color:#1E90FF">#1E90FF</td>
</tr>
<tr>
<td style="color:#FFF;background-color:darkorange">DarkOrange</td>
<td style="color:#FFF;background-color:#FF8C00">#FF8C00</td>
</tr>
<tr>
<td style="color:#FFF;background-color:mediumpurple">MediumPurple</td>
<td style="color:#FFF;background-color:#9370DB">#9370DB</td>
</tr>
<tr>
<td style="color:#FFF;background-color:steelblue">SteelBlue</td>
<td style="color:#FFF;background-color:#4682B4">#4682B4</td>
</tr>
<tr>
<td style="color:#000;background-color:Coral">Coral</td>
<td style="color:#000;background-color:#FF7F50">#FF7F50</td>
</tr>
<tr>
<td style="color:#000;background-color:LightSlateGray">LightSlateGray</td>
<td style="color:#000;background-color:#778899">#778899</td>
</tr>
<tr>
<td style="color:#000;background-color:Orchid">Orchid</td>
<td style="color:#000;background-color:#DA70D6">#DA70D6</td>
</tr>
<tr>
<td style="color:#000;background-color:Salmon">Salmon</td>
<td style="color:#000;background-color:#FA8072">#FA8072</td>
</tr>
<tr>
<td style="color:#000;background-color:LightCoral">LightCoral</td>
<td style="color:#000;background-color:#F08080">#F08080</td>
</tr>
<tr>
<td style="color:#000;background-color:HotPink">HotPink</td>
<td style="color:#000;background-color:#FF69B4">#FF69B4</td>
</tr>
<tr>
<td style="color:#000;background-color:RosyBrown">RosyBrown</td>
<td style="color:#000;background-color:#BC8F8F">#BC8F8F</td>
</tr>
<tr>
<td style="color:#000;background-color:Orange">Orange</td>
<td style="color:#000;background-color:#FFA500">#FFA500</td>
</tr>
<tr>
<td style="color:#000;background-color:Goldenrod">Goldenrod</td>
<td style="color:#000;background-color:#DAA520">#DAA520</td>
</tr>
<tr>
<td style="color:#000;background-color:CadetBlue">CadetBlue</td>
<td style="color:#000;background-color:#5F9EA0">#5F9EA0</td>
</tr>
<tr>
<td style="color:#000;background-color:LightSeaGreen">LightSeaGreen</td>
<td style="color:#000;background-color:#20B2AA">#20B2AA</td>
</tr>
<tr>
<td style="color:#000;background-color:DarkSalmon">DarkSalmon</td>
<td style="color:#000;background-color:#E9967A">#E9967A</td>
</tr>
<tr>
<td style="color:#000;background-color:DeepSkyBlue">DeepSkyBlue</td>
<td style="color:#000;background-color:#00BFFF">#00BFFF</td>
</tr>
<tr>
<td style="color:#000;background-color:Violet">Violet</td>
<td style="color:#000;background-color:#EE82EE">#EE82EE</td>
</tr>
<tr>
<td style="color:#000;background-color:CornflowerBlue">CornflowerBlue</td>
<td style="color:#000;background-color:#6495ED">#6495ED</td>
</tr>
<tr>
<td style="color:#000;background-color:MediumSeaGreen">MediumSeaGreen</td>
<td style="color:#000;background-color:#3CB371">#3CB371</td>
</tr>
<tr>
<td style="color:#000;background-color:SandyBrown">SandyBrown</td>
<td style="color:#000;background-color:#F4A460">#F4A460</td>
</tr>
<tr>
<td style="color:#000;background-color:DarkTurquoise">DarkTurquoise</td>
<td style="color:#000;background-color:#00CED1">#00CED1</td>
</tr>
<tr>
<td style="color:#000;background-color:LightSalmon">LightSalmon</td>
<td style="color:#000;background-color:#FFA07A">#FFA07A</td>
</tr>
<tr>
<td style="color:#000;background-color:LimeGreen">LimeGreen</td>
<td style="color:#000;background-color:#32CD32">#32CD32</td>
</tr>
<tr>
<td style="color:#000;background-color:DarkGray">DarkGray</td>
<td style="color:#000;background-color:#A9A9A9">#A9A9A9</td>
</tr>
<tr>
<td style="color:#000;background-color:DarkKhaki">DarkKhaki</td>
<td style="color:#000;background-color:#BDB76B">#BDB76B</td>
</tr>
<tr>
<td style="color:#000;background-color:Plum">Plum</td>
<td style="color:#000;background-color:#DDA0DD">#DDA0DD</td>
</tr>
<tr>
<td style="color:#000;background-color:Tan">Tan</td>
<td style="color:#000;background-color:#D2B48C">#D2B48C</td>
</tr>
<tr>
<td style="color:#000;background-color:DarkSeaGreen">DarkSeaGreen</td>
<td style="color:#000;background-color:#8FBC8F">#8FBC8F</td>
</tr>
<tr>
<td style="color:#000;background-color:YellowGreen">YellowGreen</td>
<td style="color:#000;background-color:#9ACD32">#9ACD32</td>
</tr>
<tr>
<td style="color:#000;background-color:BurlyWood">BurlyWood</td>
<td style="color:#000;background-color:#DEB887">#DEB887</td>
</tr>
<tr>
<td style="color:#000;background-color:Gold">Gold</td>
<td style="color:#000;background-color:#FFD700">#FFD700</td>
</tr>
<tr>
<td style="color:#000;background-color:MediumAquamarine">MediumAquamarine</td>
<td style="color:#000;background-color:#66CDAA">#66CDAA</td>
</tr>
<tr>
<td style="color:#000;background-color:LightPink">LightPink</td>
<td style="color:#000;background-color:#FFB6C1">#FFB6C1</td>
</tr>
<tr>
<td style="color:#000;background-color:Silver">Silver</td>
<td style="color:#000;background-color:#C0C0C0">#C0C0C0</td>
</tr>
<tr>
<td style="color:#000;background-color:Lime">Lime</td>
<td style="color:#000;background-color:#00FF00">#00FF00</td>
</tr>
<tr>
<td style="color:#000;background-color:MediumTurquoise">MediumTurquoise</td>
<td style="color:#000;background-color:#48D1CC">#48D1CC</td>
</tr>
<tr>
<td style="color:#000;background-color:MediumSpringGreen">MediumSpringGreen</td>
<td style="color:#000;background-color:#00FA9A">#00FA9A</td>
</tr>
<tr>
<td style="color:#000;background-color:Thistle">Thistle</td>
<td style="color:#000;background-color:#D8BFD8">#D8BFD8</td>
</tr>
<tr>
<td style="color:#000;background-color:SpringGreen">SpringGreen</td>
<td style="color:#000;background-color:#00FF7F">#00FF7F</td>
</tr>
<tr>
<td style="color:#000;background-color:LightSteelBlue">LightSteelBlue</td>
<td style="color:#000;background-color:#B0C4DE">#B0C4DE</td>
</tr>
<tr>
<td style="color:#000;background-color:Pink">Pink</td>
<td style="color:#000;background-color:#FFC0CB">#FFC0CB</td>
</tr>
<tr>
<td style="color:#000;background-color:Turquoise">Turquoise</td>
<td style="color:#000;background-color:#40E0D0">#40E0D0</td>
</tr>
<tr>
<td style="color:#000;background-color:Aqua">Aqua</td>
<td style="color:#000;background-color:#00FFFF">#00FFFF</td>
</tr>
<tr>
<td style="color:#000;background-color:Cyan">Cyan</td>
<td style="color:#000;background-color:#00FFFF">#00FFFF</td>
</tr>
<tr>
<td style="color:#000;background-color:LawnGreen">LawnGreen</td>
<td style="color:#000;background-color:#7CFC00">#7CFC00</td>
</tr>
<tr>
<td style="color:#000;background-color:SkyBlue">SkyBlue</td>
<td style="color:#000;background-color:#87CEEB">#87CEEB</td>
</tr>
<tr>
<td style="color:#000;background-color:Chartreuse">Chartreuse</td>
<td style="color:#000;background-color:#7FFF00">#7FFF00</td>
</tr>
<tr>
<td style="color:#000;background-color:LightSkyBlue">LightSkyBlue</td>
<td style="color:#000;background-color:#87CEFA">#87CEFA</td>
</tr>
<tr>
<td style="color:#000;background-color:LightGrey">LightGrey</td>
<td style="color:#000;background-color:#D3D3D3">#D3D3D3</td>
</tr>
<tr>
<td style="color:#000;background-color:LightBlue">LightBlue</td>
<td style="color:#000;background-color:#ADD8E6">#ADD8E6</td>
</tr>
<tr>
<td style="color:#000;background-color:LightGreen">LightGreen</td>
<td style="color:#000;background-color:#90EE90">#90EE90</td>
</tr>
<tr>
<td style="color:#000;background-color:GreenYellow">GreenYellow</td>
<td style="color:#000;background-color:#ADFF2F">#ADFF2F</td>
</tr>
<tr>
<td style="color:#000;background-color:PeachPuff">PeachPuff</td>
<td style="color:#000;background-color:#FFDAB9">#FFDAB9</td>
</tr>
<tr>
<td style="color:#000;background-color:Yellow">Yellow</td>
<td style="color:#000;background-color:#FFFF00">#FFFF00</td>
</tr>
<tr>
<td style="color:#000;background-color:Khaki">Khaki</td>
<td style="color:#000;background-color:#F0E68C">#F0E68C</td>
</tr>
<tr>
<td style="color:#000;background-color:Wheat">Wheat</td>
<td style="color:#000;background-color:#F5DEB3">#F5DEB3</td>
</tr>
<tr>
<td style="color:#000;background-color:NavajoWhite">NavajoWhite</td>
<td style="color:#000;background-color:#FFDEAD">#FFDEAD</td>
</tr>
<tr>
<td style="color:#000;background-color:Gainsboro">Gainsboro</td>
<td style="color:#000;background-color:#DCDCDC">#DCDCDC</td>
</tr>
<tr>
<td style="color:#000;background-color:PowderBlue">PowderBlue</td>
<td style="color:#000;background-color:#B0E0E6">#B0E0E6</td>
</tr>
<tr>
<td style="color:#000;background-color:PaleGoldenrod">PaleGoldenrod</td>
<td style="color:#000;background-color:#EEE8AA">#EEE8AA</td>
</tr>
<tr>
<td style="color:#000;background-color:Moccasin">Moccasin</td>
<td style="color:#000;background-color:#FFE4B5">#FFE4B5</td>
</tr>
<tr>
<td style="color:#000;background-color:Bisque">Bisque</td>
<td style="color:#000;background-color:#FFE4C4">#FFE4C4</td>
</tr>
<tr>
<td style="color:#000;background-color:PaleGreen">PaleGreen</td>
<td style="color:#000;background-color:#98FB98">#98FB98</td>
</tr>
<tr>
<td style="color:#000;background-color:MistyRose">MistyRose</td>
<td style="color:#000;background-color:#FFE4E1">#FFE4E1</td>
</tr>
<tr>
<td style="color:#000;background-color:PaleTurquoise">PaleTurquoise</td>
<td style="color:#000;background-color:#AFEEEE">#AFEEEE</td>
</tr>
<tr>
<td style="color:#000;background-color:BlanchedAlmond">BlanchedAlmond</td>
<td style="color:#000;background-color:#FFEBCD">#FFEBCD</td>
</tr>
<tr>
<td style="color:#000;background-color:Lavender">Lavender</td>
<td style="color:#000;background-color:#E6E6FA">#E6E6FA</td>
</tr>
<tr>
<td style="color:#000;background-color:AntiqueWhite">AntiqueWhite</td>
<td style="color:#000;background-color:#FAEBD7">#FAEBD7</td>
</tr>
<tr>
<td style="color:#000;background-color:Aquamarine">Aquamarine</td>
<td style="color:#000;background-color:#7FFFD4">#7FFFD4</td>
</tr>
<tr>
<td style="color:#000;background-color:PapayaWhip">PapayaWhip</td>
<td style="color:#000;background-color:#FFEFD5">#FFEFD5</td>
</tr>
<tr>
<td style="color:#000;background-color:Linen">Linen</td>
<td style="color:#000;background-color:#FAF0E6">#FAF0E6</td>
</tr>
<tr>
<td style="color:#000;background-color:Beige">Beige</td>
<td style="color:#000;background-color:#F5F5DC">#F5F5DC</td>
</tr>
<tr>
<td style="color:#000;background-color:LavenderBlush">LavenderBlush</td>
<td style="color:#000;background-color:#FFF0F5">#FFF0F5</td>
</tr>
<tr>
<td style="color:#000;background-color:OldLace">OldLace</td>
<td style="color:#000;background-color:#FDF5E6">#FDF5E6</td>
</tr>
<tr>
<td style="color:#000;background-color:LemonChiffon">LemonChiffon</td>
<td style="color:#000;background-color:#FFFACD">#FFFACD</td>
</tr>
<tr>
<td style="color:#000;background-color:LightGoldenrodYellow">LightGoldenrodYellow</td>
<td style="color:#000;background-color:#FAFAD2">#FAFAD2</td>
</tr>
<tr>
<td style="color:#000;background-color:Cornsilk">Cornsilk</td>
<td style="color:#000;background-color:#FFF8DC">#FFF8DC</td>
</tr>
<tr>
<td style="color:#000;background-color:Seashell">Seashell</td>
<td style="color:#000;background-color:#FFF5EE">#FFF5EE</td>
</tr>
<tr>
<td style="color:#000;background-color:WhiteSmoke">WhiteSmoke</td>
<td style="color:#000;background-color:#F5F5F5">#F5F5F5</td>
</tr>
<tr>
<td style="color:#000;background-color:AliceBlue">AliceBlue</td>
<td style="color:#000;background-color:#F0F8FF">#F0F8FF</td>
</tr>
<tr>
<td style="color:#000;background-color:FloralWhite">FloralWhite</td>
<td style="color:#000;background-color:#FFFAF0">#FFFAF0</td>
</tr>
<tr>
<td style="color:#000;background-color:GhostWhite">GhostWhite</td>
<td style="color:#000;background-color:#F8F8FF">#F8F8FF</td>
</tr>
<tr>
<td style="color:#000;background-color:LightYellow">LightYellow</td>
<td style="color:#000;background-color:#FFFFE0">#FFFFE0</td>
</tr>
<tr>
<td style="color:#000;background-color:Snow">Snow</td>
<td style="color:#000;background-color:#FFFAFA">#FFFAFA</td>
</tr>
<tr>
<td style="color:#000;background-color:Honeydew">Honeydew</td>
<td style="color:#000;background-color:#F0FFF0">#F0FFF0</td>
</tr>
<tr>
<td style="color:#000;background-color:LightCyan">LightCyan</td>
<td style="color:#000;background-color:#E0FFFF">#E0FFFF</td>
</tr>
<tr>
<td style="color:#000;background-color:Ivory">Ivory</td>
<td style="color:#000;background-color:#FFFFF0">#FFFFF0</td>
</tr>
<tr>
<td style="color:#000;background-color:MintCream">MintCream</td>
<td style="color:#000;background-color:#F5FFFA">#F5FFFA</td>
</tr>
<tr>
<td style="color:#000;background-color:Azure">Azure</td>
<td style="color:#000;background-color:#F0FFFF">#F0FFFF</td>
</tr>
<tr>
<td style="color:#000;background-color:White">White</td>
<td style="color:#000;background-color:#FFFFFF">#FFFFFF</td>
</tr>
</table>

</td>
<td style="vertical-align:top;">

<table border=0 width=200 height=50>
<tr>
<th colspan="2" style="font-family:Arial, sans-serif">Telítettség szerint</th>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Maroon">Maroon</td>
<td style="color:#FFFFFF;background-color:#800000">#800000</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkRed">DarkRed</td>
<td style="color:#FFFFFF;background-color:#8B0000">#8B0000</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:FireBrick">FireBrick</td>
<td style="color:#FFFFFF;background-color:#B22222">#B22222</td>
</tr>
<tr>
<td style="color:#000000;background-color:Red">Red</td>
<td style="color:#000000;background-color:#FF0000">#FF0000</td>
</tr>
<tr>
<td style="color:#000000;background-color:Salmon">Salmon</td>
<td style="color:#000000;background-color:#FA8072">#FA8072</td>
</tr>
<tr>
<td style="color:#000000;background-color:Tomato">Tomato</td>
<td style="color:#000000;background-color:#FF6347">#FF6347</td>
</tr>
<tr>
<td style="color:#000000;background-color:Coral">Coral</td>
<td style="color:#000000;background-color:#FF7F50">#FF7F50</td>
</tr>
<tr>
<td style="color:#000000;background-color:OrangeRed">OrangeRed</td>
<td style="color:#000000;background-color:#FF4500">#FF4500</td>
</tr>
<tr>
<td style="color:#000000;background-color:Chocolate">Chocolate</td>
<td style="color:#000000;background-color:#D2691E">#D2691E</td>
</tr>
<tr>
<td style="color:#000000;background-color:SandyBrown">SandyBrown</td>
<td style="color:#000000;background-color:#F4A460">#F4A460</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkOrange">DarkOrange</td>
<td style="color:#000000;background-color:#FF8C00">#FF8C00</td>
</tr>
<tr>
<td style="color:#000000;background-color:Orange">Orange</td>
<td style="color:#000000;background-color:#FFA500">#FFA500</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkGoldenrod">DarkGoldenrod</td>
<td style="color:#000000;background-color:#B8860B">#B8860B</td>
</tr>
<tr>
<td style="color:#000000;background-color:Goldenrod">Goldenrod</td>
<td style="color:#000000;background-color:#DAA520">#DAA520</td>
</tr>
<tr>
<td style="color:#000000;background-color:Gold">Gold</td>
<td style="color:#000000;background-color:#FFD700">#FFD700</td>
</tr>
<tr>
<td style="color:#000000;background-color:Olive">Olive</td>
<td style="color:#000000;background-color:#808000">#808000</td>
</tr>
<tr>
<td style="color:#000000;background-color:Yellow">Yellow</td>
<td style="color:#000000;background-color:#FFFF00">#FFFF00</td>
</tr>
<tr>
<td style="color:#000000;background-color:YellowGreen">YellowGreen</td>
<td style="color:#000000;background-color:#9ACD32">#9ACD32</td>
</tr>
<tr>
<td style="color:#000000;background-color:GreenYellow">GreenYellow</td>
<td style="color:#000000;background-color:#ADFF2F">#ADFF2F</td>
</tr>
<tr>
<td style="color:#000000;background-color:Chartreuse">Chartreuse</td>
<td style="color:#000000;background-color:#7FFF00">#7FFF00</td>
</tr>
<tr>
<td style="color:#000000;background-color:LawnGreen">LawnGreen</td>
<td style="color:#000000;background-color:#7CFC00">#7CFC00</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Green">Green</td>
<td style="color:#FFFFFF;background-color:#008000">#008000</td>
</tr>
<tr>
<td style="color:#000000;background-color:Lime">Lime</td>
<td style="color:#000000;background-color:#00FF00">#00FF00</td>
</tr>
<tr>
<td style="color:#000000;background-color:LimeGreen">LimeGreen</td>
<td style="color:#000000;background-color:#32CD32">#32CD32</td>
</tr>
<tr>
<td style="color:#000000;background-color:SpringGreen">SpringGreen</td>
<td style="color:#000000;background-color:#00FF7F">#00FF7F</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumSpringGreen">MediumSpringGreen</td>
<td style="color:#000000;background-color:#00FA9A">#00FA9A</td>
</tr>
<tr>
<td style="color:#000000;background-color:Turquoise">Turquoise</td>
<td style="color:#000000;background-color:#40E0D0">#40E0D0</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightSeaGreen">LightSeaGreen</td>
<td style="color:#000000;background-color:#20B2AA">#20B2AA</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumTurquoise">MediumTurquoise</td>
<td style="color:#000000;background-color:#48D1CC">#48D1CC</td>
</tr>
<tr>
<td style="color:#000000;background-color:Teal">Teal</td>
<td style="color:#000000;background-color:#008080">#008080</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkCyan">DarkCyan</td>
<td style="color:#000000;background-color:#008B8B">#008B8B</td>
</tr>
<tr>
<td style="color:#000000;background-color:Aqua">Aqua</td>
<td style="color:#000000;background-color:#00FFFF">#00FFFF</td>
</tr>
<tr>
<td style="color:#000000;background-color:Cyan">Cyan</td>
<td style="color:#000000;background-color:#00FFFF">#00FFFF</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkTurquoise">DarkTurquoise</td>
<td style="color:#000000;background-color:#00CED1">#00CED1</td>
</tr>
<tr>
<td style="color:#000000;background-color:DeepSkyBlue">DeepSkyBlue</td>
<td style="color:#000000;background-color:#00BFFF">#00BFFF</td>
</tr>
<tr>
<td style="color:#000000;background-color:DodgerBlue">DodgerBlue</td>
<td style="color:#000000;background-color:#1E90FF">#1E90FF</td>
</tr>
<tr>
<td style="color:#000000;background-color:RoyalBlue">RoyalBlue</td>
<td style="color:#000000;background-color:#4169E1">#4169E1</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Navy">Navy</td>
<td style="color:#FFFFFF;background-color:#000080">#000080</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkBlue">DarkBlue</td>
<td style="color:#FFFFFF;background-color:#00008B">#00008B</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:MediumBlue">MediumBlue</td>
<td style="color:#FFFFFF;background-color:#0000CD">#0000CD</td>
</tr>
<tr>
<td style="color:#000000;background-color:Blue">Blue</td>
<td style="color:#000000;background-color:#0000FF">#0000FF</td>
</tr>
<tr>
<td style="color:#000000;background-color:BlueViolet">BlueViolet</td>
<td style="color:#000000;background-color:#8A2BE2">#8A2BE2</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkOrchid">DarkOrchid</td>
<td style="color:#000000;background-color:#9932CC">#9932CC</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkViolet">DarkViolet</td>
<td style="color:#000000;background-color:#9400D3">#9400D3</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Purple">Purple</td>
<td style="color:#FFFFFF;background-color:#800080">#800080</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkMagenta">DarkMagenta</td>
<td style="color:#FFFFFF;background-color:#8B008B">#8B008B</td>
</tr>
<tr>
<td style="color:#000000;background-color:Fuchsia">Fuchsia</td>
<td style="color:#000000;background-color:#FF00FF">#FF00FF</td>
</tr>
<tr>
<td style="color:#000000;background-color:Magenta">Magenta</td>
<td style="color:#000000;background-color:#FF00FF">#FF00FF</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumVioletRed">MediumVioletRed</td>
<td style="color:#000000;background-color:#C71585">#C71585</td>
</tr>
<tr>
<td style="color:#000000;background-color:DeepPink">DeepPink</td>
<td style="color:#000000;background-color:#FF1493">#FF1493</td>
</tr>
<tr>
<td style="color:#000000;background-color:HotPink">HotPink</td>
<td style="color:#000000;background-color:#FF69B4">#FF69B4</td>
</tr>
<tr>
<td style="color:#000000;background-color:Crimson">Crimson</td>
<td style="color:#000000;background-color:#DC143C">#DC143C</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Brown">Brown</td>
<td style="color:#FFFFFF;background-color:#A52A2A">#A52A2A</td>
</tr>
<tr>
<td style="color:#000000;background-color:IndianRed">IndianRed</td>
<td style="color:#000000;background-color:#CD5C5C">#CD5C5C</td>
</tr>
<tr>
<td style="color:#000000;background-color:RosyBrown">RosyBrown</td>
<td style="color:#000000;background-color:#BC8F8F">#BC8F8F</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightCoral">LightCoral</td>
<td style="color:#000000;background-color:#F08080">#F08080</td>
</tr>
<tr>
<td style="color:#000000;background-color:Snow">Snow</td>
<td style="color:#000000;background-color:#FFFAFA">#FFFAFA</td>
</tr>
<tr>
<td style="color:#000000;background-color:MistyRose">MistyRose</td>
<td style="color:#000000;background-color:#FFE4E1">#FFE4E1</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkSalmon">DarkSalmon</td>
<td style="color:#000000;background-color:#E9967A">#E9967A</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightSalmon">LightSalmon</td>
<td style="color:#000000;background-color:#FFA07A">#FFA07A</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Sienna">Sienna</td>
<td style="color:#FFFFFF;background-color:#A0522D">#A0522D</td>
</tr>
<tr>
<td style="color:#000000;background-color:SeaShell">SeaShell</td>
<td style="color:#000000;background-color:#FFF5EE">#FFF5EE</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:SaddleBrown">SaddleBrown</td>
<td style="color:#FFFFFF;background-color:#8B4513">#8B4513</td>
</tr>
<tr>
<td style="color:#000000;background-color:Peachpuff">Peachpuff</td>
<td style="color:#000000;background-color:#FFDAB9">#FFDAB9</td>
</tr>
<tr>
<td style="color:#000000;background-color:Peru">Peru</td>
<td style="color:#000000;background-color:#CD853F">#CD853F</td>
</tr>
<tr>
<td style="color:#000000;background-color:Linen">Linen</td>
<td style="color:#000000;background-color:#FAF0E6">#FAF0E6</td>
</tr>
<tr>
<td style="color:#000000;background-color:Bisque">Bisque</td>
<td style="color:#000000;background-color:#FFE4C4">#FFE4C4</td>
</tr>
<tr>
<td style="color:#000000;background-color:Burlywood">Burlywood</td>
<td style="color:#000000;background-color:#DEB887">#DEB887</td>
</tr>
<tr>
<td style="color:#000000;background-color:Tan">Tan</td>
<td style="color:#000000;background-color:#D2B48C">#D2B48C</td>
</tr>
<tr>
<td style="color:#000000;background-color:AntiqueWhite">AntiqueWhite</td>
<td style="color:#000000;background-color:#FAEBD7">#FAEBD7</td>
</tr>
<tr>
<td style="color:#000000;background-color:NavajoWhite">NavajoWhite</td>
<td style="color:#000000;background-color:#FFDEAD">#FFDEAD</td>
</tr>
<tr>
<td style="color:#000000;background-color:BlanchedAlmond">BlanchedAlmond</td>
<td style="color:#000000;background-color:#FFEBCD">#FFEBCD</td>
</tr>
<tr>
<td style="color:#000000;background-color:PapayaWhip">PapayaWhip</td>
<td style="color:#000000;background-color:#FFEFD5">#FFEFD5</td>
</tr>
<tr>
<td style="color:#000000;background-color:Moccasin">Moccasin</td>
<td style="color:#000000;background-color:#FFE4B5">#FFE4B5</td>
</tr>
<tr>
<td style="color:#000000;background-color:Wheat">Wheat</td>
<td style="color:#000000;background-color:#F5DEB3">#F5DEB3</td>
</tr>
<tr>
<td style="color:#000000;background-color:Oldlace">Oldlace</td>
<td style="color:#000000;background-color:#FDF5E6">#FDF5E6</td>
</tr>
<tr>
<td style="color:#000000;background-color:FloralWhite">FloralWhite</td>
<td style="color:#000000;background-color:#FFFAF0">#FFFAF0</td>
</tr>
<tr>
<td style="color:#000000;background-color:Cornsilk">Cornsilk</td>
<td style="color:#000000;background-color:#FFF8DC">#FFF8DC</td>
</tr>
<tr>
<td style="color:#000000;background-color:Khaki">Khaki</td>
<td style="color:#000000;background-color:#F0E68C">#F0E68C</td>
</tr>
<tr>
<td style="color:#000000;background-color:LemonChiffon">LemonChiffon</td>
<td style="color:#000000;background-color:#FFFACD">#FFFACD</td>
</tr>
<tr>
<td style="color:#000000;background-color:PaleGoldenrod">PaleGoldenrod</td>
<td style="color:#000000;background-color:#EEE8AA">#EEE8AA</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkKhaki">DarkKhaki</td>
<td style="color:#000000;background-color:#BDB76B">#BDB76B</td>
</tr>
<tr>
<td style="color:#000000;background-color:Beige">Beige</td>
<td style="color:#000000;background-color:#F5F5DC">#F5F5DC</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightGoldenrodYellow">LightGoldenrodYellow</td>
<td style="color:#000000;background-color:#FAFAD2">#FAFAD2</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightYellow">LightYellow</td>
<td style="color:#000000;background-color:#FFFFE0">#FFFFE0</td>
</tr>
<tr>
<td style="color:#000000;background-color:Ivory">Ivory</td>
<td style="color:#000000;background-color:#FFFFF0">#FFFFF0</td>
</tr>
<tr>
<td style="color:#000000;background-color:OliveDrab">OliveDrab</td>
<td style="color:#000000;background-color:#6B8E23">#6B8E23</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkOliveGreen">DarkOliveGreen</td>
<td style="color:#FFFFFF;background-color:#556B2F">#556B2F</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkSeaGreen">DarkSeaGreen</td>
<td style="color:#000000;background-color:#8FBC8F">#8FBC8F</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkGreen">DarkGreen</td>
<td style="color:#FFFFFF;background-color:#006400">#006400</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:ForestGreen">ForestGreen</td>
<td style="color:#FFFFFF;background-color:#228B22">#228B22</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightGreen">LightGreen</td>
<td style="color:#000000;background-color:#90EE90">#90EE90</td>
</tr>
<tr>
<td style="color:#000000;background-color:PaleGreen">PaleGreen</td>
<td style="color:#000000;background-color:#98FB98">#98FB98</td>
</tr>
<tr>
<td style="color:#000000;background-color:Honeydew">Honeydew</td>
<td style="color:#000000;background-color:#F0FFF0">#F0FFF0</td>
</tr>
<tr>
<td style="color:#000000;background-color:SeaGreen">SeaGreen</td>
<td style="color:#000000;background-color:#2E8B57">#2E8B57</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumSeaGreen">MediumSeaGreen</td>
<td style="color:#000000;background-color:#3CB371">#3CB371</td>
</tr>
<tr>
<td style="color:#000000;background-color:Mintcream">Mintcream</td>
<td style="color:#000000;background-color:#F5FFFA">#F5FFFA</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumAquamarine">MediumAquamarine</td>
<td style="color:#000000;background-color:#66CDAA">#66CDAA</td>
</tr>
<tr>
<td style="color:#000000;background-color:Aquamarine">Aquamarine</td>
<td style="color:#000000;background-color:#7FFFD4">#7FFFD4</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkSlateGray">DarkSlateGray</td>
<td style="color:#FFFFFF;background-color:#2F4F4F">#2F4F4F</td>
</tr>
<tr>
<td style="color:#000000;background-color:PaleTurquoise">PaleTurquoise</td>
<td style="color:#000000;background-color:#AFEEEE">#AFEEEE</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightCyan">LightCyan</td>
<td style="color:#000000;background-color:#E0FFFF">#E0FFFF</td>
</tr>
<tr>
<td style="color:#000000;background-color:Azure">Azure</td>
<td style="color:#000000;background-color:#F0FFFF">#F0FFFF</td>
</tr>
<tr>
<td style="color:#000000;background-color:CadetBlue">CadetBlue</td>
<td style="color:#000000;background-color:#5F9EA0">#5F9EA0</td>
</tr>
<tr>
<td style="color:#000000;background-color:PowderBlue">PowderBlue</td>
<td style="color:#000000;background-color:#B0E0E6">#B0E0E6</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightBlue">LightBlue</td>
<td style="color:#000000;background-color:#ADD8E6">#ADD8E6</td>
</tr>
<tr>
<td style="color:#000000;background-color:SkyBlue">SkyBlue</td>
<td style="color:#000000;background-color:#87CEEB">#87CEEB</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightSkyBlue">LightskyBlue</td>
<td style="color:#000000;background-color:#87CEFA">#87CEFA</td>
</tr>
<tr>
<td style="color:#000000;background-color:SteelBlue">SteelBlue</td>
<td style="color:#000000;background-color:#4682B4">#4682B4</td>
</tr>
<tr>
<td style="color:#000000;background-color:AliceBlue">AliceBlue</td>
<td style="color:#000000;background-color:#F0F8FF">#F0F8FF</td>
</tr>
<tr>
<td style="color:#000000;background-color:SlateGray">SlateGray</td>
<td style="color:#000000;background-color:#708090">#708090</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightSlateGray">LightSlateGray</td>
<td style="color:#000000;background-color:#778899">#778899</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightSteelBlue">LightsteelBlue</td>
<td style="color:#000000;background-color:#B0C4DE">#B0C4DE</td>
</tr>
<tr>
<td style="color:#000000;background-color:CornflowerBlue">CornflowerBlue</td>
<td style="color:#000000;background-color:#6495ED">#6495ED</td>
</tr>
<tr>
<td style="color:#000000;background-color:Lavender">Lavender</td>
<td style="color:#000000;background-color:#E6E6FA">#E6E6FA</td>
</tr>
<tr>
<td style="color:#000000;background-color:GhostWhite">GhostWhite</td>
<td style="color:#000000;background-color:#F8F8FF">#F8F8FF</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:MidnightBlue">MidnightBlue</td>
<td style="color:#FFFFFF;background-color:#191970">#191970</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:SlateBlue">SlateBlue</td>
<td style="color:#FFFFFF;background-color:#6A5ACD">#6A5ACD</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkSlateBlue">DarkSlateBlue</td>
<td style="color:#FFFFFF;background-color:#483D8B">#483D8B</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumSlateBlue">MediumSlateBlue</td>
<td style="color:#000000;background-color:#7B68EE">#7B68EE</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumPurple">MediumPurple</td>
<td style="color:#000000;background-color:#9370DB">#9370DB</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Indigo">Indigo</td>
<td style="color:#FFFFFF;background-color:#4B0082">#4B0082</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumOrchid">MediumOrchid</td>
<td style="color:#000000;background-color:#BA55D3">#BA55D3</td>
</tr>
<tr>
<td style="color:#000000;background-color:Plum">Plum</td>
<td style="color:#000000;background-color:#DDA0DD">#DDA0DD</td>
</tr>
<tr>
<td style="color:#000000;background-color:Violet">Violet</td>
<td style="color:#000000;background-color:#EE82EE">#EE82EE</td>
</tr>
<tr>
<td style="color:#000000;background-color:Thistle">Thistle</td>
<td style="color:#000000;background-color:#D8BFD8">#D8BFD8</td>
</tr>
<tr>
<td style="color:#000000;background-color:Orchid">Orchid</td>
<td style="color:#000000;background-color:#DA70D6">#DA70D6</td>
</tr>
<tr>
<td style="color:#000000;background-color:LavenderBlush">LavenderBlush</td>
<td style="color:#000000;background-color:#FFF0F5">#FFF0F5</td>
</tr>
<tr>
<td style="color:#000000;background-color:PaleVioletRed">PaleVioletRed</td>
<td style="color:#000000;background-color:#DB7093">#DB7093</td>
</tr>
<tr>
<td style="color:#000000;background-color:Pink">Pink</td>
<td style="color:#000000;background-color:#FFC0CB">#FFC0CB</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightPink">LightPink</td>
<td style="color:#000000;background-color:#FFB6C1">#FFB6C1</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Black">Black</td>
<td style="color:#FFFFFF;background-color:#000000">#000000</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DimGray">DimGray</td>
<td style="color:#FFFFFF;background-color:#696969">#696969</td>
</tr>
<tr>
<td style="color:#000000;background-color:Gray">Gray</td>
<td style="color:#000000;background-color:#808080">#808080</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkGray">DarkGray</td>
<td style="color:#000000;background-color:#A9A9A9">#A9A9A9</td>
</tr>
<tr>
<td style="color:#000000;background-color:Silver">Silver</td>
<td style="color:#000000;background-color:#C0C0C0">#C0C0C0</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightGrey">LightGrey</td>
<td style="color:#000000;background-color:#D3D3D3">#D3D3D3</td>
</tr>
<tr>
<td style="color:#000000;background-color:Gainsboro">Gainsboro</td>
<td style="color:#000000;background-color:#DCDCDC">#DCDCDC</td>
</tr>
<tr>
<td style="color:#000000;background-color:WhiteSmoke">WhiteSmoke</td>
<td style="color:#000000;background-color:#F5F5F5">#F5F5F5</td>
</tr>
<tr>
<td style="color:#000000;background-color:White">White</td>
<td style="color:#000000;background-color:#FFFFFF">#FFFFFF</td>
</tr>
</table>

</td>
<td style="vertical-align:top;">

<table border=0 width=200 height=50>
<tr>
<th colspan="2" style="font-family:Arial, sans-serif">Ábécé sorrendben</th>
</tr>
<tr>
<td style="color:#000000;background-color:AliceBlue">AliceBlue</td>
<td style="color:#000000;background-color:#F0F8FF">#F0F8FF</td>
</tr>
<tr>
<td style="color:#000000;background-color:AntiqueWhite">AntiqueWhite</td>
<td style="color:#000000;background-color:#FAEBD7">#FAEBD7</td>
</tr>
<tr>
<td style="color:#000000;background-color:Aqua">Aqua</td>
<td style="color:#000000;background-color:#00FFFF">#00FFFF</td>
</tr>
<tr>
<td style="color:#000000;background-color:Aquamarine">Aquamarine</td>
<td style="color:#000000;background-color:#7FFFD4">#7FFFD4</td>
</tr>
<tr>
<td style="color:#000000;background-color:Azure">Azure</td>
<td style="color:#000000;background-color:#F0FFFF">#F0FFFF</td>
</tr>
<tr>
<td style="color:#000000;background-color:Beige">Beige</td>
<td style="color:#000000;background-color:#F5F5DC">#F5F5DC</td>
</tr>
<tr>
<td style="color:#000000;background-color:Bisque">Bisque</td>
<td style="color:#000000;background-color:#FFE4C4">#FFE4C4</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Black">Black</td>
<td style="color:#FFFFFF;background-color:#000000">#000000</td>
</tr>
<tr>
<td style="color:#000000;background-color:BlanchedAlmond">BlanchedAlmond</td>
<td style="color:#000000;background-color:#FFEBCD">#FFEBCD</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Blue">Blue</td>
<td style="color:#FFFFFF;background-color:#0000FF">#0000FF</td>
</tr>
<tr>
<td style="color:#000000;background-color:BlueViolet">BlueViolet</td>
<td style="color:#000000;background-color:#8A2BE2">#8A2BE2</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Brown">Brown</td>
<td style="color:#FFFFFF;background-color:#A52A2A">#A52A2A</td>
</tr>
<tr>
<td style="color:#000000;background-color:BurlyWood">BurlyWood</td>
<td style="color:#000000;background-color:#DEB887">#DEB887</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:CadetBlue">CadetBlue</td>
<td style="color:#FFFFFF;background-color:#5F9EA0">#5F9EA0</td>
</tr>
<tr>
<td style="color:#000000;background-color:Chartreuse">Chartreuse</td>
<td style="color:#000000;background-color:#7FFF00">#7FFF00</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Chocolate">Chocolate</td>
<td style="color:#FFFFFF;background-color:#D2691E">#D2691E</td>
</tr>
<tr>
<td style="color:#000000;background-color:Coral">Coral</td>
<td style="color:#000000;background-color:#FF7F50">#FF7F50</td>
</tr>
<tr>
<td style="color:#000000;background-color:CornflowerBlue">CornflowerBlue</td>
<td style="color:#000000;background-color:#6495ED">#6495ED</td>
</tr>
<tr>
<td style="color:#000000;background-color:Cornsilk">Cornsilk</td>
<td style="color:#000000;background-color:#FFF8DC">#FFF8DC</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Crimson">Crimson</td>
<td style="color:#FFFFFF;background-color:#DC143C">#DC143C</td>
</tr>
<tr>
<td style="color:#000000;background-color:Cyan">Cyan</td>
<td style="color:#000000;background-color:#00FFFF">#00FFFF</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkBlue">DarkBlue</td>
<td style="color:#FFFFFF;background-color:#00008B">#00008B</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkCyan">DarkCyan</td>
<td style="color:#FFFFFF;background-color:#008B8B">#008B8B</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkGoldenrod">DarkGoldenrod</td>
<td style="color:#FFFFFF;background-color:#B8860B">#B8860B</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkGray">DarkGray</td>
<td style="color:#000000;background-color:#A9A9A9">#A9A9A9</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkGreen">DarkGreen</td>
<td style="color:#FFFFFF;background-color:#006400">#006400</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkKhaki">DarkKhaki</td>
<td style="color:#000000;background-color:#BDB76B">#BDB76B</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkMagenta">DarkMagenta</td>
<td style="color:#FFFFFF;background-color:#8B008B">#8B008B</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkOliveGreen">DarkOliveGreen</td>
<td style="color:#FFFFFF;background-color:#556B2F">#556B2F</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkOrange">DarkOrange</td>
<td style="color:#000000;background-color:#FF8C00">#FF8C00</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkOrchid">DarkOrchid</td>
<td style="color:#000000;background-color:#9932CC">#9932CC</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkRed">DarkRed</td>
<td style="color:#FFFFFF;background-color:#8B0000">#8B0000</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkSalmon">DarkSalmon</td>
<td style="color:#000000;background-color:#E9967A">#E9967A</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkSeaGreen">DarkSeaGreen</td>
<td style="color:#000000;background-color:#8FBC8F">#8FBC8F</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkSlateBlue">DarkSlateBlue</td>
<td style="color:#FFFFFF;background-color:#483D8B">#483D8B</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DarkSlateGray">DarkSlateGray</td>
<td style="color:#FFFFFF;background-color:#2F4F4F">#2F4F4F</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkTurquoise">DarkTurquoise</td>
<td style="color:#000000;background-color:#00CED1">#00CED1</td>
</tr>
<tr>
<td style="color:#000000;background-color:DarkViolet">DarkViolet</td>
<td style="color:#000000;background-color:#9400D3">#9400D3</td>
</tr>
<tr>
<td style="color:#000000;background-color:DeepPink">DeepPink</td>
<td style="color:#000000;background-color:#FF1493">#FF1493</td>
</tr>
<tr>
<td style="color:#000000;background-color:DeepSkyBlue">DeepSkyBlue</td>
<td style="color:#000000;background-color:#00BFFF">#00BFFF</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:DimGray">DimGray</td>
<td style="color:#FFFFFF;background-color:#696969">#696969</td>
</tr>
<tr>
<td style="color:#000000;background-color:DodgerBlue">DodgerBlue</td>
<td style="color:#000000;background-color:#1E90FF">#1E90FF</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:FireBrick">FireBrick</td>
<td style="color:#FFFFFF;background-color:#B22222">#B22222</td>
</tr>
<tr>
<td style="color:#000000;background-color:FloralWhite">FloralWhite</td>
<td style="color:#000000;background-color:#FFFAF0">#FFFAF0</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:ForestGreen">ForestGreen</td>
<td style="color:#FFFFFF;background-color:#228B22">#228B22</td>
</tr>
<tr>
<td style="color:#000000;background-color:Fuchsia">Fuchsia</td>
<td style="color:#000000;background-color:#FF00FF">#FF00FF</td>
</tr>
<tr>
<td style="color:#000000;background-color:Gainsboro">Gainsboro</td>
<td style="color:#000000;background-color:#DCDCDC">#DCDCDC</td>
</tr>
<tr>
<td style="color:#000000;background-color:GhostWhite">GhostWhite</td>
<td style="color:#000000;background-color:#F8F8FF">#F8F8FF</td>
</tr>
<tr>
<td style="color:#000000;background-color:Gold">Gold</td>
<td style="color:#000000;background-color:#FFD700">#FFD700</td>
</tr>
<tr>
<td style="color:#000000;background-color:Goldenrod">Goldenrod</td>
<td style="color:#000000;background-color:#DAA520">#DAA520</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Gray">Gray</td>
<td style="color:#FFFFFF;background-color:#808080">#808080</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Green">Green</td>
<td style="color:#FFFFFF;background-color:#008000">#008000</td>
</tr>
<tr>
<td style="color:#000000;background-color:GreenYellow">GreenYellow</td>
<td style="color:#000000;background-color:#ADFF2F">#ADFF2F</td>
</tr>
<tr>
<td style="color:#000000;background-color:Honeydew">Honeydew</td>
<td style="color:#000000;background-color:#F0FFF0">#F0FFF0</td>
</tr>
<tr>
<td style="color:#000000;background-color:HotPink">HotPink</td>
<td style="color:#000000;background-color:#FF69B4">#FF69B4</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:IndianRed">IndianRed</td>
<td style="color:#FFFFFF;background-color:#CD5C5C">#CD5C5C</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Indigo">Indigo</td>
<td style="color:#FFFFFF;background-color:#4B0082">#4B0082</td>
</tr>
<tr>
<td style="color:#000000;background-color:Ivory">Ivory</td>
<td style="color:#000000;background-color:#FFFFF0">#FFFFF0</td>
</tr>
<tr>
<td style="color:#000000;background-color:Khaki">Khaki</td>
<td style="color:#000000;background-color:#F0E68C">#F0E68C</td>
</tr>
<tr>
<td style="color:#000000;background-color:Lavender">Lavender</td>
<td style="color:#000000;background-color:#E6E6FA">#E6E6FA</td>
</tr>
<tr>
<td style="color:#000000;background-color:LavenderBlush">LavenderBlush</td>
<td style="color:#000000;background-color:#FFF0F5">#FFF0F5</td>
</tr>
<tr>
<td style="color:#000000;background-color:LawnGreen">LawnGreen</td>
<td style="color:#000000;background-color:#7CFC00">#7CFC00</td>
</tr>
<tr>
<td style="color:#000000;background-color:LemonChiffon">LemonChiffon</td>
<td style="color:#000000;background-color:#FFFACD">#FFFACD</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightBlue">LightBlue</td>
<td style="color:#000000;background-color:#ADD8E6">#ADD8E6</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightCoral">LightCoral</td>
<td style="color:#000000;background-color:#F08080">#F08080</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightCyan">LightCyan</td>
<td style="color:#000000;background-color:#E0FFFF">#E0FFFF</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightGoldenrodYellow">LightGoldenrodYellow</td>
<td style="color:#000000;background-color:#FAFAD2">#FAFAD2</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightGreen">LightGreen</td>
<td style="color:#000000;background-color:#90EE90">#90EE90</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightGrey">LightGrey</td>
<td style="color:#000000;background-color:#D3D3D3">#D3D3D3</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightPink">LightPink</td>
<td style="color:#000000;background-color:#FFB6C1">#FFB6C1</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightSalmon">LightSalmon</td>
<td style="color:#000000;background-color:#FFA07A">#FFA07A</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:LightSeaGreen">LightSeaGreen</td>
<td style="color:#FFFFFF;background-color:#20B2AA">#20B2AA</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightSkyBlue">LightSkyBlue</td>
<td style="color:#000000;background-color:#87CEFA">#87CEFA</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:LightSlateGray">LightSlateGray</td>
<td style="color:#FFFFFF;background-color:#778899">#778899</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightSteelBlue">LightSteelBlue</td>
<td style="color:#000000;background-color:#B0C4DE">#B0C4DE</td>
</tr>
<tr>
<td style="color:#000000;background-color:LightYellow">LightYellow</td>
<td style="color:#000000;background-color:#FFFFE0">#FFFFE0</td>
</tr>
<tr>
<td style="color:#000000;background-color:Lime">Lime</td>
<td style="color:#000000;background-color:#00FF00">#00FF00</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:LimeGreen">LimeGreen</td>
<td style="color:#FFFFFF;background-color:#32CD32">#32CD32</td>
</tr>
<tr>
<td style="color:#000000;background-color:Linen">Linen</td>
<td style="color:#000000;background-color:#FAF0E6">#FAF0E6</td>
</tr>
<tr>
<td style="color:#000000;background-color:Magenta">Magenta</td>
<td style="color:#000000;background-color:#FF00FF">#FF00FF</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Maroon">Maroon</td>
<td style="color:#FFFFFF;background-color:#800000">#800000</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumAquamarine">MediumAquamarine</td>
<td style="color:#000000;background-color:#66CDAA">#66CDAA</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:MediumBlue">MediumBlue</td>
<td style="color:#FFFFFF;background-color:#0000CD">#0000CD</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumOrchid">MediumOrchid</td>
<td style="color:#000000;background-color:#BA55D3">#BA55D3</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumPurple">MediumPurple</td>
<td style="color:#000000;background-color:#9370DB">#9370DB</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:MediumSeaGreen">MediumSeaGreen</td>
<td style="color:#FFFFFF;background-color:#3CB371">#3CB371</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumSlateBlue">MediumSlateBlue</td>
<td style="color:#000000;background-color:#7B68EE">#7B68EE</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumSpringGreen">MediumSpringGreen</td>
<td style="color:#000000;background-color:#00FA9A">#00FA9A</td>
</tr>
<tr>
<td style="color:#000000;background-color:MediumTurquoise">MediumTurquoise</td>
<td style="color:#000000;background-color:#48D1CC">#48D1CC</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:MediumVioletRed">MediumVioletRed</td>
<td style="color:#FFFFFF;background-color:#C71585">#C71585</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:MidnightBlue">MidnightBlue</td>
<td style="color:#FFFFFF;background-color:#191970">#191970</td>
</tr>
<tr>
<td style="color:#000000;background-color:MintCream">MintCream</td>
<td style="color:#000000;background-color:#F5FFFA">#F5FFFA</td>
</tr>
<tr>
<td style="color:#000000;background-color:MistyRose">MistyRose</td>
<td style="color:#000000;background-color:#FFE4E1">#FFE4E1</td>
</tr>
<tr>
<td style="color:#000000;background-color:Moccasin">Moccasin</td>
<td style="color:#000000;background-color:#FFE4B5">#FFE4B5</td>
</tr>
<tr>
<td style="color:#000000;background-color:NavajoWhite">NavajoWhite</td>
<td style="color:#000000;background-color:#FFDEAD">#FFDEAD</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Navy">Navy</td>
<td style="color:#FFFFFF;background-color:#000080">#000080</td>
</tr>
<tr>
<td style="color:#000000;background-color:OldLace">OldLace</td>
<td style="color:#000000;background-color:#FDF5E6">#FDF5E6</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Olive">Olive</td>
<td style="color:#FFFFFF;background-color:#808000">#808000</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:OliveDrab">OliveDrab</td>
<td style="color:#FFFFFF;background-color:#6B8E23">#6B8E23</td>
</tr>
<tr>
<td style="color:#000000;background-color:Orange">Orange</td>
<td style="color:#000000;background-color:#FFA500">#FFA500</td>
</tr>
<tr>
<td style="color:#000000;background-color:OrangeRed">OrangeRed</td>
<td style="color:#000000;background-color:#FF4500">#FF4500</td>
</tr>
<tr>
<td style="color:#000000;background-color:Orchid">Orchid</td>
<td style="color:#000000;background-color:#DA70D6">#DA70D6</td>
</tr>
<tr>
<td style="color:#000000;background-color:PaleGoldenrod">PaleGoldenrod</td>
<td style="color:#000000;background-color:#EEE8AA">#EEE8AA</td>
</tr>
<tr>
<td style="color:#000000;background-color:PaleGreen">PaleGreen</td>
<td style="color:#000000;background-color:#98FB98">#98FB98</td>
</tr>
<tr>
<td style="color:#000000;background-color:PaleTurquoise">PaleTurquoise</td>
<td style="color:#000000;background-color:#AFEEEE">#AFEEEE</td>
</tr>
<tr>
<td style="color:#000000;background-color:PaleVioletRed">PaleVioletRed</td>
<td style="color:#000000;background-color:#DB7093">#DB7093</td>
</tr>
<tr>
<td style="color:#000000;background-color:PapayaWhip">PapayaWhip</td>
<td style="color:#000000;background-color:#FFEFD5">#FFEFD5</td>
</tr>
<tr>
<td style="color:#000000;background-color:PeachPuff">PeachPuff</td>
<td style="color:#000000;background-color:#FFDAB9">#FFDAB9</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Peru">Peru</td>
<td style="color:#FFFFFF;background-color:#CD853F">#CD853F</td>
</tr>
<tr>
<td style="color:#000000;background-color:Pink">Pink</td>
<td style="color:#000000;background-color:#FFC0CB">#FFC0CB</td>
</tr>
<tr>
<td style="color:#000000;background-color:Plum">Plum</td>
<td style="color:#000000;background-color:#DDA0DD">#DDA0DD</td>
</tr>
<tr>
<td style="color:#000000;background-color:PowderBlue">PowderBlue</td>
<td style="color:#000000;background-color:#B0E0E6">#B0E0E6</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Purple">Purple</td>
<td style="color:#FFFFFF;background-color:#800080">#800080</td>
</tr>
<tr>
<td style="color:#000000;background-color:Red">Red</td>
<td style="color:#000000;background-color:#FF0000">#FF0000</td>
</tr>
<tr>
<td style="color:#000000;background-color:RosyBrown">RosyBrown</td>
<td style="color:#000000;background-color:#BC8F8F">#BC8F8F</td>
</tr>
<tr>
<td style="color:#000000;background-color:RoyalBlue">RoyalBlue</td>
<td style="color:#000000;background-color:#4169E1">#4169E1</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:SaddleBrown">SaddleBrown</td>
<td style="color:#FFFFFF;background-color:#8B4513">#8B4513</td>
</tr>
<tr>
<td style="color:#000000;background-color:Salmon">Salmon</td>
<td style="color:#000000;background-color:#FA8072">#FA8072</td>
</tr>
<tr>
<td style="color:#000000;background-color:SandyBrown">SandyBrown</td>
<td style="color:#000000;background-color:#F4A460">#F4A460</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:SeaGreen">SeaGreen</td>
<td style="color:#FFFFFF;background-color:#2E8B57">#2E8B57</td>
</tr>
<tr>
<td style="color:#000000;background-color:Seashell">Seashell</td>
<td style="color:#000000;background-color:#FFF5EE">#FFF5EE</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Sienna">Sienna</td>
<td style="color:#FFFFFF;background-color:#A0522D">#A0522D</td>
</tr>
<tr>
<td style="color:#000000;background-color:Silver">Silver</td>
<td style="color:#000000;background-color:#C0C0C0">#C0C0C0</td>
</tr>
<tr>
<td style="color:#000000;background-color:SkyBlue">SkyBlue</td>
<td style="color:#000000;background-color:#87CEEB">#87CEEB</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:SlateBlue">SlateBlue</td>
<td style="color:#FFFFFF;background-color:#6A5ACD">#6A5ACD</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:SlateGray">SlateGray</td>
<td style="color:#FFFFFF;background-color:#708090">#708090</td>
</tr>
<tr>
<td style="color:#000000;background-color:Snow">Snow</td>
<td style="color:#000000;background-color:#FFFAFA">#FFFAFA</td>
</tr>
<tr>
<td style="color:#000000;background-color:SpringGreen">SpringGreen</td>
<td style="color:#000000;background-color:#00FF7F">#00FF7F</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:SteelBlue">SteelBlue</td>
<td style="color:#FFFFFF;background-color:#4682B4">#4682B4</td>
</tr>
<tr>
<td style="color:#000000;background-color:Tan">Tan</td>
<td style="color:#000000;background-color:#D2B48C">#D2B48C</td>
</tr>
<tr>
<td style="color:#FFFFFF;background-color:Teal">Teal</td>
<td style="color:#FFFFFF;background-color:#008080">#008080</td>
</tr>
<tr>
<td style="color:#000000;background-color:Thistle">Thistle</td>
<td style="color:#000000;background-color:#D8BFD8">#D8BFD8</td>
</tr>
<tr>
<td style="color:#000000;background-color:Tomato">Tomato</td>
<td style="color:#000000;background-color:#FF6347">#FF6347</td>
</tr>
<tr>
<td style="color:#000000;background-color:Turquoise">Turquoise</td>
<td style="color:#000000;background-color:#40E0D0">#40E0D0</td>
</tr>
<tr>
<td style="color:#000000;background-color:Violet">Violet</td>
<td style="color:#000000;background-color:#EE82EE">#EE82EE</td>
</tr>
<tr>
<td style="color:#000000;background-color:Wheat">Wheat</td>
<td style="color:#000000;background-color:#F5DEB3">#F5DEB3</td>
</tr>
<tr>
<td style="color:#000000;background-color:White">White</td>
<td style="color:#000000;background-color:#FFFFFF">#FFFFFF</td>
</tr>
<tr>
<td style="color:#000000;background-color:WhiteSmoke">WhiteSmoke</td>
<td style="color:#000000;background-color:#F5F5F5">#F5F5F5</td>
</tr>
<tr>
<td style="color:#000000;background-color:Yellow">Yellow</td>
<td style="color:#000000;background-color:#FFFF00">#FFFF00</td>
</tr>
<tr>
<td style="color:#000000;background-color:YellowGreen">YellowGreen</td>
<td style="color:#000000;background-color:#9ACD32">#9ACD32</td>
</tr>
</table>
</td>
</tr>
</table>
<script>
// Retrieve
alert(localStorage.lastname);
//localStorage.removeItem("lastname");
</script>
</body>
</html>


