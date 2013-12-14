CKEDITOR.plugins.add( 'center_image', {
    icons: 'center_image',
    init: function( editor ) {
        editor.addCommand( 'center_image', {
			exec: function( editor ) {
				var current = editor.getSelection();
				if(current.getStartElement().getName() == 'img'){
					/*var p = new CKEDITOR.dom.element( 'p' );*/
					/*current.getSelectedElement().appendTo(p);
					editor.insertElement(current);
					alert('DONE');*/
					var p = new CKEDITOR.dom.element( 'div', editor.document );
					p.setAttribute('style', 'text-align:center');
					p.addClass('centered-image');
					p.insertBefore( current.getStartElement() );
					p.append( current.getStartElement() );
				}
			}
		});
		
		editor.ui.addButton( 'center_image', {
			label: 'Center image',
			command: 'center_image',
			toolbar: 'insert'
		});
    }
});