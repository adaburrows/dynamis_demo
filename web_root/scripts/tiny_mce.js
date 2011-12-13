//<![CDATA[
	tinyMCE.init({

		// General options

		mode : "exact"/*"specific_textareas"*/,
		remove_script_host: false,
		relative_urls: false,
		elements : "content",
		/*editor_selector : "mce",*/

		theme : "advanced",

		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",



		// Theme options

		theme_advanced_buttons1 : "undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,charmap,media,image,|,link,unlink,anchor,|,insertdate,inserttime",
		theme_advanced_buttons2 : "formatselect,outdent,indent,blockquote,|,sub,sup,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,removeformat,cleanup,help",
		theme_advanced_buttons3 : "",
		theme_advanced_blockformats : "p,div,h1,h2,h3,h4,h5,h6,blockquote,dt,dd,code,samp",
		theme_advanced_toolbar_location : "top",

		theme_advanced_toolbar_align : "left",

		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		file_browser_callback: 'fileBrowserCallBack',

		content_css : "/style_guide/stylesheet.css",
		body_id : "main"
});
//]]>
