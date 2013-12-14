/*! jQuery JSON plugin 2.4.0 | code.google.com/p/jquery-json */
(function($){'use strict';var escape=/["\\\x00-\x1f\x7f-\x9f]/g,meta={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'},hasOwn=Object.prototype.hasOwnProperty;$.toJSON=typeof JSON==='object'&&JSON.stringify?JSON.stringify:function(o){if(o===null){return'null';}
var pairs,k,name,val,type=$.type(o);if(type==='undefined'){return undefined;}
if(type==='number'||type==='boolean'){return String(o);}
if(type==='string'){return $.quoteString(o);}
if(typeof o.toJSON==='function'){return $.toJSON(o.toJSON());}
if(type==='date'){var month=o.getUTCMonth()+1,day=o.getUTCDate(),year=o.getUTCFullYear(),hours=o.getUTCHours(),minutes=o.getUTCMinutes(),seconds=o.getUTCSeconds(),milli=o.getUTCMilliseconds();if(month<10){month='0'+month;}
if(day<10){day='0'+day;}
if(hours<10){hours='0'+hours;}
if(minutes<10){minutes='0'+minutes;}
if(seconds<10){seconds='0'+seconds;}
if(milli<100){milli='0'+milli;}
if(milli<10){milli='0'+milli;}
return'"'+year+'-'+month+'-'+day+'T'+
hours+':'+minutes+':'+seconds+'.'+milli+'Z"';}
pairs=[];if($.isArray(o)){for(k=0;k<o.length;k++){pairs.push($.toJSON(o[k])||'null');}
return'['+pairs.join(',')+']';}
if(typeof o==='object'){for(k in o){if(hasOwn.call(o,k)){type=typeof k;if(type==='number'){name='"'+k+'"';}else if(type==='string'){name=$.quoteString(k);}else{continue;}
type=typeof o[k];if(type!=='function'&&type!=='undefined'){val=$.toJSON(o[k]);pairs.push(name+':'+val);}}}
return'{'+pairs.join(',')+'}';}};$.evalJSON=typeof JSON==='object'&&JSON.parse?JSON.parse:function(str){return eval('('+str+')');};$.secureEvalJSON=typeof JSON==='object'&&JSON.parse?JSON.parse:function(str){var filtered=str.replace(/\\["\\\/bfnrtu]/g,'@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,']').replace(/(?:^|:|,)(?:\s*\[)+/g,'');if(/^[\],:{}\s]*$/.test(filtered)){return eval('('+str+')');}
throw new SyntaxError('Error parsing JSON, source is not valid.');};$.quoteString=function(str){if(str.match(escape)){return'"'+str.replace(escape,function(a){var c=meta[a];if(typeof c==='string'){return c;}
c=a.charCodeAt();return'\\u00'+Math.floor(c/16).toString(16)+(c%16).toString(16);})+'"';}
return'"'+str+'"';};}(jQuery));

// Vars

var labels = [];
var mapped = {};
var authors = {};

var tags_labels = [];
var tags_mapped = {};
var tags_array = {};

// Remove Author
function removeAuthor(value){
    if (typeof mapped[value] != 'undefined'){
        authors[mapped[value]] = 0;
    }
    else{
        authors[value] = 0;
    }
}

function removeTag(value){
	if (typeof tags_mapped[value] != 'undefined'){
		tags_array[tags_mapped[value]] = 0;
	}
	else{
		tags_array[value] = 0;
	}
}

// Creating typehead
$('#aditional_authors').typeahead({
    source : function (query, process){
        $.ajax({
            url : url,
            data : {query: query},
            dataType : 'json',
            type : 'POST'
        }).done(function(data){
            mapped = {};
            labels = [];
            
            $.each(data.authors, function (i, item) {
                mapped[item.label] = item.value
                labels.push(item.label)
            });
            return process(labels);
        });
    },
    
    updater : function(item){
        return item;
    }
});
1
// Add Button Click
$('button#addAuthorButton').click(function(){
    value = $('#aditional_authors').val();
    
    if (value != '' && value != ' '){
        if (typeof mapped[value] != 'undefined'){
            authors[mapped[value]] = 1;
        }
        else{
            authors[value] = 1;
        }

        $('ul#authors').append('<li><i onclick="removeAuthor(\''+ value + '\'); $(this).parent().remove();" class="glyphicon glyphicon-trash" id="remove-author"></i> '+value+'</li>');
        $('#aditional_authors').val('');
    }
});

// Remove button click
$('#remove-author').click(function(){
    alert('click');
});

// If it's update page, then we should convert array and list authors
if(mode == 'update'){
    a = $.evalJSON($('#aditional_authors').val());
    $('#aditional_authors').val('');
    
    $.each(a, function(key, value){
        authors[key] = 2;
        
        $('ul#authors').append('<li><i onclick="removeAuthor(\''+ key + '\'); $(this).parent().remove();" class="glyphicon glyphicon-trash" id="remove-author"></i> '+value+'</li>');
    });

	b = $.evalJSON($('#tags').val());
	$('#tags').val('');

	$.each(b, function(key, value){
		tags_array[key] = 2;

		$('ul#tags').append('<li><i onclick="removeTag(\''+ key + '\'); $(this).parent().remove();" class="glyphicon glyphicon-trash" id="remove-tag"></i> '+value+'</li>');
	});
}

// Creating tags_rus field
$('#tags').typeahead({
	source : function (query, process){
		$.ajax({
			url : tagsAutocomplete,
			data : {query: query, lang: lang_id},
			dataType : 'json',
			type : 'POST'
		}).done(function(data){
				tags_mapped = {};
				tags_labels = [];

				$.each(data.tags, function (i, item) {
					tags_mapped[item.label] = item.value
					tags_labels.push(item.label)
				});
				return process(tags_labels);
			});
	},

	updater : function(item){
		return item;
	}
});

// russian tag button click
$('button#addTagButton').click(function(){

	value = $('#tags').val();

	if (value != '' && value != ' '){
		if (typeof tags_mapped[value] != 'undefined'){
			tags_array[tags_mapped[value]] = 1;
		}
		else{
			tags_array[value] = 1;
		}

		$('ul#tags').append('<li><i onclick="removeTag(\''+ value + '\'); $(this).parent().remove();" class="glyphicon glyphicon-trash" id="remove-tag"></i> '+value+'</li>');
		$('#tags').val('');
	}

});


// On submit
$('#btnSubmit').click(function(){
	$('#aditional_authors_hidden').val($.toJSON(authors));
	$('#tags_hidden').val($.toJSON(tags_array));

	// Submiting form
	$('#article-form').submit();
});