CKEDITOR.plugins.add('grafikart',
{
	requires : [ 'iframedialog' ],
	lang : [ 'en' ],
	
	init : function(editor)
	{
		var pluginName = 'grafikart';
		
		CKEDITOR.dialog.add('grafikart', this.path + 'dialogs/grafikart.js' );

		
		editor.addCommand( 'grafikart', new CKEDITOR.dialogCommand( 'grafikart' ) );

		editor.ui.addButton('grafikart',
		{
				// label : editor.lang.grafikart.title,
				label : 'Media Manager',
				command : 'grafikart',
				icon: this.path + 'images/grafikart.png'
		});
	}
});

