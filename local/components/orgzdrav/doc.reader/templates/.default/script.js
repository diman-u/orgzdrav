BX.ready(function() {
	//let reader = new BX.Orgzdrav.DocReader('#doc-reader');
	
	const content= {};
	
	$('.js-doc[data-id] a.js-doc-title').on('click', function(e) {
		e.preventDefault();
		
		const doc = $(this).closest('.js-doc');
		const docId = doc.attr('data-id');
		
		BX.ajax.runComponentAction('orgzdrav:doc.reader', 'load', {
			data: {
				id: docId
			}
		})
		.then((response) => {
			content[docId] = response.data;
			prepareMenu(docId);
		});
	});
	
	$('.js-doc[data-id]').on('click', '.post-menu a', function(e) {
		e.preventDefault();
		
		const sectionId = this.href.split('#')[1];
		
		const doc = $(this).closest('.js-doc');
		const docId = doc.attr('data-id')
		const menu = $(this).closest('.post-menu');
		const menu_clone = menu.clone();
		
		$(this).parent().nextAll().remove();
		$(this).parent().remove();
		
		menu_clone.find('a[href="#'+sectionId+'"]').parent().prevAll().remove()
		menu_clone.find('a[href="#'+sectionId+'"]').parent().remove();
		
		const contentNode = $('<div class="post__content js-doc-workspace" id="'+sectionId+'"></div>');
		menu.after(contentNode);
		
		if (!menu.find('ul').children().length) {
			menu.remove();
		}
		if (menu_clone.find('ul').children().length) {
			contentNode.after(menu_clone);
		}
		
		docOutput(
			contentNode,
			content[docId].body.find((item) => sectionId == item.id).value
		);
	});
	
	const prepareMenu = function(docId) {
		const menu = [];
		
		content[docId].body.forEach((element) => {
			if ('section' != element.type) return;
			if (!element.id || !element.value.head) return;
			
			menu.push({
				id: element.id,
				title: element.value.head
			})
		});
		
		if (menu.length) {
			const menuNode = $('<div class="post-menu"><ul></ul></div>');
			
			menu.forEach((item) => {
				menuNode.find('ul').append('<li><a href="#'+item.id+'">'+item.title+'</a></li>');
			});
			
			$('.js-doc[data-id="'+docId+'"]').append(menuNode);
		} else {
			$('.js-doc[data-id="'+docId+'"]').append('<div class="post__content js-doc-workspace"></div>');
			
			docOutput(
				$('.js-doc[data-id="'+docId+'"] .js-doc-workspace'),
				content[docId]
			);
		}
	};
	
	const docOutput = function(container, section) {
		const level = arguments[2] || 1;
		
		if (section.hasOwnProperty('head') && '' != section.head) {
			container.append('<h'+(level+1)+'>'+section.head+'</h'+(level+1)+'>');
		}
		
		section.body.forEach((element) => {
			if ('section' == element.type) { 
				docOutput(container, element.value, level + 1);
				return;
			}
			
			container.append('<div class="js-doc-txt">'+element.value+'</div>');
		});
	};
});