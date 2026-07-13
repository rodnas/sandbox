<?php
/*****************************************************************
File:           YaTemplate_class,php
Autor:          Dmitry Levashov <dima@syntech.ru> <dima@glagol.ru>
License:        GPL
version:        1.01
Last Modified:  21.10.2001
Add:
CleanBlock(),
GetVar(),
ParseBlock()
Append2Var()
Change:
SetBlockTree()
    - only one parent and no limit for tree depth
Parse()
    - minor optimize
******************************************************************/

class YaTemplate {          //yet another template :)

var $mDir       = array();  //paths to templates
var $mFile      = array();
var $mVar       = array();  //array of vars to parse
var $mVal       = array();  //array of values of vars
var $mBlock     = array();  //dinamic blocks
var $mLd        = "{{";     // left delimiter
var $mRd        = "}}";     // right delimiter
var $_mLast     = "";       //name of the last parsed template
var $_mOnError  = "halt";   //what to do on error - ""(nothing), "warn", "halt"
var $_mUndef    = "comment";//what to do whith undefined vars in template - "", "comment", "drop"

/*************************************
            CONSTRUCTOR
*************************************/

function YaTemplate($dir = "") {

    if (!empty($dir))
    {
        $this->SetDir($dir);
    }
    else
    {
        $this->mDir[] = realpath(".");
    }
}

/*************************************
            PUBLIC
*************************************/

function setDir($dir) {

    if (!is_array($dir))
    {
        if (is_dir($dir))
        {
            $this->mDir[] = realpath($dir);
        }
        else
        {
            $this->_Error("[setDir] $dir is not dir");
        }
    }
    else
    {
        foreach ($dir as $v)
        {
            if (is_dir($v))
            {
                $this->mDir[] = realpath($v);
            }
            else
            {
                $this->_Error("[setDir] $v is not directory");
            }
        }
    }
    return;
}

/*--------------------------------------*/

function SetFile($tplFile, $trailer = "") {

    if (!is_array($tplFile))
    {
        if (empty($trailer))
        {
            $this->_Error("[setFile]: for $tplFile filename is empty");
        }
        elseif ($fileName = $this->_SetFileName($trailer))
        {
            $this->mFile[$tplFile] = $fileName;
        }
        else
        {
            $this->_Error("[setFile]: file $trailer does not exists");
        }
    }
    else
    {
        foreach ($tplFile as $k=>$v)
        {
            if (empty($v))
            {
                $this->_Error("[setFile]: for $k filename is empty");
                return;
            }
            elseif ($fileName = $this->_SetFileName($v))
            {
                $this->mFile[$k] = $fileName;
            }
            else
            {
                $this->_Error("[setFile]: file $v does not exists");
            }
        }
    }
    return;
}

/*--------------------------------------*/

function SetVar($var, $trailer = "")
{
    if (empty($var))
    {
        $this->_Error("[setVar]: variable without name");
        return;
    }

    if (!is_array($var))        // scalar context
    {
        $this->mVar[$var] = $this->mLd . $var . $this->mRd;
        $this->mVal[$var] = $trailer;
    }
    else
    {
        foreach ($var as $k=>$v)
        {
            if (!empty($k))
            {
                $this->mVar[$k] = $this->mLd . $k . $this->mRd;
                $this->mVal[$k] = $v;
            }
            else
            {
                $this->_Error("[setVar]: variable without name");
            }
        }
    }
    return;
}
/*--------------------------------------*/

function Append2Var($varName, $appendix)
{
    if (empty($varName)) return false;

    if (isset($this->mVar[$varName]))
    {
        $this->mVal[$varName] .= $appendix;
    }
    else
    {
        $this->SetVar($varName, $appendix);
    }
    return true;
}

/*--------------------------------------*/

function SetBlock($parent, $block)
{
    if (empty($parent))
    {
        $this->_Error("[setBlock] : parent for block $block undefined");
        return;
    }
    elseif (empty($block))
    {
        $this->_Error("[setBlock] : block for $parent undefined");
        return;
    }

    $this->mBlock[$block][parent] = $parent;
    $this->_CutBlock($block);

    return;
}

/*-----------------------------------------*/

function SetBlockTree($parent, $tree)
{
    if (!is_array($tree))
    {
        $this->SetBlock($parent, $tree);
        return;
    }

    foreach ($tree as $node=>$block)
    {
        if (!is_array($block))              //one block
        {
            if ("string" == gettype($node)) //crazy trick
            {
                $this->SetBlock($parent, $node);
                $this->SetBlock($node, $block);
            }
            else
            {
            $this->mBlock[$block][parent] = $parent;
            $this->_CutBlock($block);
            }
        }
        else                                //tree
        {
            $this->mBlock[$node][parent] = $parent;
            $this->_CutBlock($node);                 //cut block from parent
            $this->SetBlockTree($node, $block);      //process new tree
        }
    }

    return;
}

/*--------------------------------------*/

function CleanVar($varName)
{
    if (!is_array($varName))
    {
        unset($this->mVar[$varName], $this->mVal[$varName]);
    }
    else
    {
        foreach ($varName as $var)
            unset($this->mVar[$var], $this->mVal[$var]);
    }
    return;
}
/*----------------------------------------*/
function CleanBlock($blockName)
{
    if (!is_array($blockName))
    {
        unset($this->mBlock[$blockName]);
    }
    else
    {
        foreach ($blockName as $block)
            unset ($this->mBlock[$block]);
    }
    return;
}
/*------------------------------------------*/
function GetVar($varName = "")
{
    if (empty($varName)) $varName = $this->_mLast;
    return $this->mVal[$varName];
}

/*--------------------------------------*/

function Parse($targetVar, $tmpl, $append = false)
{
    if (!is_array($tmpl))       //scalar context
    {
        $str = $this->_ParseTmpl($tmpl);
        if ($append)
            $str = $this->mVal[$targetVar] . $str;

        $this->SetVar($targetVar, $str);
    }
    else                        // array context
    {
        foreach ($tmpl as $v)
        {
            $this->SetVar($targetVar, $this->mVal[$targetVar] . $this->_ParseTmpl($v));
        }
    }

    $this->_mLast = $targetVar;
    return;
}

/*--------------------------------------*/

function ParseBlock($blockName) //alias for Parse() парсит блок в переменную с таким же именем
{
    $this->Parse($blockName, $blockName, true);
    return;
}

/*--------------------------------------*/

function PrintOut($tmpl = "")
{
    if (!$tmpl)
    {
        $tmpl = $this->_mLast;
    }

    if ($this->_mUndef)
    {
        $this->_ProccessUndef($tmpl);
    }

    if (!empty($this->_mLast))
    {
        echo $this->mVal[$tmpl];
    }
    else
    {
        echo "You forget to parse your templates :)";
    }

    return;
}

/*****************************************
            PRIVATE
*****************************************/

function _ProccessUndef($tmpl)
{
    $reg = "/" . $this->mLd . "([a-zA-Z0-9_]+)" . $this->mRd . "/";

    if ("comment" == $this->_mUndef)
    {
        $replace = "<!-- undefined variable \\1 -->";
    }
    elseif ("drop" == $this->_mUndef)
    {
        $replace = "";
    }

    $str = preg_replace($reg, $replace, $this->mVal[$tmpl]);
    $this->mVal[$tmpl] = $str;
    return;
}

/*--------------------------------------*/

function _SetFileName($file)
{
    foreach ($this->mDir as $v)
    {
        $fileName = "$v/$file";

        if (file_exists($fileName))
        {
            return $fileName;
        }
    }
    return false;
}

/*--------------------------------------*/

function _LoadFile($tmpl){

    $str = implode("", @file($this->mFile[$tmpl]));

    if (!empty($str))
    {
        $this->SetVar($tmpl, $str);
    }
    else
    {
        $this->_Error("[_LoadFile]: file for $tmpl  empty");
    }
    return;
}

/*--------------------------------------*/

function _ParseTmpl($tmpl)
{
    return str_replace($this->mVar, $this->mVal, $this->_GetTmpl($tmpl));
}

/*--------------------------------------*/

function _GetTmpl($tmpl)
{
    if (!isset($this->mVar[$tmpl]) || empty($this->mVal[$tmpl]))
    {
        if (isset($this->mFile[$tmpl]))
        {
            $this->_LoadFile($tmpl);
        }
        elseif (isset($this->mBlock[$tmpl]))
        {
            if (!$this->mBlock[$tmpl][content])
            {
                $this->_CutBlock($tmpl);
            }
        }
        else
        {
            $this->_Error("[_getTmpl]: template $tmpl does not exists");
        }
    }
    return ($this->mBlock[$tmpl] ? $this->mBlock[$tmpl][content] : $this->mVal[$tmpl]);
}

/*--------------------------------------*/

function _CutBlock($block)
{
    $parentName = $this->mBlock[$block][parent];
    $parent = $this->_GetTmpl($parentName);
    $reg = "/<!--\\s+BEGIN BLOCK $block\\s+-->(.*)\n\s*<!--\\s+END BLOCK $block\\s+-->/sm";

    if (preg_match_all($reg, $parent, $m))
    {
        $this->mBlock[$block][content] = $m[1][0];
        $parentCont = preg_replace($reg, $this->mLd.$block.$this->mRd, $parent);

        if (isset($this->mBlock[$parentName]))
        {
            $this->mBlock[$parentName][content] = $parentCont;
        }
        else
        {
            $this->mVar[$parentName] = $this->mLd . $parentName . $this->mRd;
            $this->mVal[$parentName] = $parentCont;
        }
    }
    else
    {
        $this->_Error("[_catchBlock]: Can't find block $block in parent $parentName");
    }
    return;
}

/*--------------------------------------*/

function _Error($mes)
{
    if ("warn" == $this->_mOnError)
    {
        echo "<br>ERROR: $mes<br>" ;
    }
    if ("halt" == $this->_mOnError)
    {
        echo "<br>HALT ON ERROR: $mes<br>" ;
        exit();
    }
    return;
}

/***********Fin*************************/
}
?>