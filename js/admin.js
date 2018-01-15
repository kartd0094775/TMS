var a;
var addressFrameID = '';

var serializeDataObject = null;

//global cookie search expire time init
var cookieExpireTime = new Date();
var minute = 60;
cookieExpireTime.setTime(cookieExpireTime.getTime() + (minute * 60 * 1000));

var gpsAddress = '';

var modalMode = 'read';

function toPage(aName, cName) {

	if ( typeof (controllerName) == 'undefined') {
		document.location = baseUrl + '/' + controllerName + '/' + aName;
	} else {

		document.location = baseUrl + '/' + cName + '/' + aName;
	}

}

function log(x) {
	console.log(x);
}

function setDatetimepicker() {

	$('.datetimepicker').datetimepicker({
		dateFormat : 'yy-mm-dd',
		timeFormat : 'HH:mm',
		format : 'YYYY-MM-DD HH:mm:ss',
		icons : {
			time : "fa fa-clock-o",
			date : "fa fa-calendar",
			up : "fa fa-arrow-up",
			down : "fa fa-arrow-down"
		}
	});
}

/*
 function sendFile(file, editor, welEditable) {
 data = new FormData();
 data.append("file", file);
 $.ajax({
 data : data,
 type : "POST",
 dataType : 'json',
 url : getUrl('uploadPhotoDo'),
 cache : false,
 contentType : false,
 processData : false,
 success : function(r) {

 var imgUrl = baseUrl + '/upload/' + _controllerName + '/' + r['files'][0]['fileName'] + '.' + r['files'][0]['ext'];

 editor.insertImage(welEditable, imgUrl);
 }
 });
 }
 */
function sendFile(file, el) {
	var form_data = new FormData();
	form_data.append('file', file);
	$.ajax({
		data : form_data,
		type : "POST",
		dataType : 'json',
		url : getUrl('uploadPhotoDo'),
		cache : false,
		contentType : false,
		processData : false,
		success : function(r) {
			var imgUrl = baseUrl + '/upload/' + _controllerName + '/' + r['files'][0]['fileName'] + '.' + r['files'][0]['ext'];
			$(el).summernote('editor.insertImage', imgUrl);
		}
	});

}

function setSummernote() {
	$('.summernote').summernote({
		/*
		 toolbar : [
		 //['style', ['style']], // no style button
		 ['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['insert', ['picture', 'link', 'video']] // no insert buttons
		 //['table', ['table']], // no table button
		 //['help', ['help']] //no help button
		 ],
		 */
		height : 400,
		callbacks : {
			onImageUpload : function(files, editor, welEditable) {
				// sendFile(files[0], editor, welEditable);
				for (var i = files.length - 1; i >= 0; i--) {
					sendFile(files[i], this);
				}
			}
		}
	});

}

function assignJsonValue(fieldName) {
	var ddd = data[fieldName];
	for (var i in ddd) {
		var x = ddd[i];

		var e = $('*[name="' + fieldName + '[' + i + ']"]');

		if (e.prop("tagName") == 'TEXTAREA') {
			$('*[name="' + fieldName + '[' + i + ']"]').html(x);
		} else {
			$('*[name="' + fieldName + '[' + i + ']"]').val(x);
		}
	}

}

function setLanguageSource() {
	$('*[t]').each(function() {
		var text = $.trim($(this).text()).toLowerCase();

		var attr = $(this).attr('placeholder');
		if ( typeof attr !== typeof undefined && attr !== false) {
			$(this).attr('placeholder', language[$(this).attr('placeholder')]);
		}

		$(this).text(language[text]);
	});
}

function switchLanguage(x) {

	// $('*[language]').stop();
	if (x == 'all') {
		$('*[language]').slideDown();
	} else {
		$('*[language]').slideUp();
		$('*[language="' + x + '"]').slideDown();
	}
}

function pageReload() {
	location.reload();
}

function setRadioValue(name, value) {
	$('input[name=' + name + ']').each(function() {
		if ($(this).val() == value) {
			$(this).attr('checked', true);
		}
	});
}

function setFormData(formID, d) {
	assignFormValue(formID, d);
}

function assignFormValue(formID, d) {
	for (var key in d) {
		var e = $('#' + formID + ' *[name="' + key + '"]');
		var tagName = $(e).prop("tagName");
		var v = d[key];

		if (e != null && v != null) {
			if ( typeof (tagName) != 'undefined') {
				if (tagName == 'INPUT' || tagName == 'SELECT') {

					if ($(e).attr('type') == 'radio' || $(e).attr('type') == 'checkbox') {
						$('input[name=' + key + '][value=' + v + ']').prop('checked', true);
					} else {
						if ($(e).attr('type') != 'file') {
							$(e).val(v);
						}
					}

				} else {
					$(e).html(v);
				}
			}
		}
	}
}

//
// function setData(frameID, data) {
//
// for (var i in data) {
//
// var x = data[i];
//
// if ( typeof (x) == 'object') {
// setData(frameID, x);
// } else {
// $('#frameID');
//
// }
//
// }
//
// }

/*

 function setReadMode(containerID) {

 $('#' + containerID).find('input').prop('readonly', 'readonly');
 $('#' + containerID).find('select').prop('readonly', 'readonly');
 $('#' + containerID).find('textarea').prop('readonly', 'readonly');

 $('#' + containerID).find('input').prop('disabled', true);
 $('#' + containerID).find('select').prop('disabled', true);
 $('#' + containerID).find('textarea').prop('disabled', true);

 }*/

function getModalMode() {
	return modalMode;
}


$(document).ready(function() {

	setLanguageSource();

	//get notification
	/*
	 if (!isMobile()) {
	 updateNotification();
	 }
	 */
	if ( typeof (data) != 'undefined') {
		if (data != null) {
			assignFormValue('itemForm', data);

		} else {

		}
	}

	setDatepicker();
	setDatetimepicker();
	setSummernote();

	// initEvent();

	initModal();

	//number inpuy
	// $('input[type=number]').keypress(isNumberKey);
	$('input[type=number]').keydown(function(e) {
		// Allow: backspace, delete, tab, escape, enter and .
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
		// Allow: Ctrl+A
		(e.keyCode == 65 && e.ctrlKey === true) ||
		// Allow: home, end, left, right
		(e.keyCode >= 35 && e.keyCode <= 39)) {
			// let it happen, don't do anything
			return;
		}
		// Ensure that it is a number and stop the keypress
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}
	});

	$(document).on('click', '.itemDelete', function(e) {
		$(this).parent().parent().parent().parent().remove();

	});

	$(document).on('click', '.buttonView', function(e) {
		modalMode = 'read';
	});

	$(document).on('click', '.buttonEdit', function(e) {
		modalMode = 'update';
	});

	$(document).on('click', '.buttonAddItem', function(e) {
		modalMode = 'create';
	});

	// menu block------------------------------------------------------------------------------------------------------------------
	//menu event
	$('.mainMenu').click(function() {
		var mainMenuID = $(this).attr('id');
		var expireTime = new Date();
		var minute = 10;
		expireTime.setTime(expireTime.getTime() + (minute * 60 * 1000));
		$.cookie('mainMenuID', mainMenuID, {
			expires : expireTime
		});
		setTimeout('resetBodyHeight();', 1000);
	});
	//menu item event
	$('.mainMenuItem').click(function() {
		var mainMenuItemID = $(this).attr('id');
		var expireTime = new Date();
		var minute = 10;
		expireTime.setTime(expireTime.getTime() + (minute * 60 * 1000));
		$.cookie('mainMenuItemID', mainMenuItemID, {
			expires : expireTime
		});
		setTimeout('resetBodyHeight();', 1000);
	});
	//menu sub item event
	$('.mainMenuSubItem').click(function() {
		var mainMenuSubItemID = $(this).attr('id');
		var expireTime = new Date();
		var minute = 10;
		expireTime.setTime(expireTime.getTime() + (minute * 60 * 1000));
		$.cookie('mainMenuSubItemID', mainMenuSubItemID, {
			expires : expireTime
		});
	});

	//set previous menu status
	var mainMenuID = $.cookie('mainMenuID');
	var mainMenuItemID = $.cookie('mainMenuItemID');
	var mainMenuSubItemID = $.cookie('mainMenuSubItemID');
	$('#' + mainMenuID).click();
	$('#' + mainMenuItemID).click();
	$('#' + mainMenuSubItemID).addClass('active');

	// menu block------------------------------------------------------------------------------------------------------------------

	//set file upload
	// initFileUpload();

});

function resetBodyHeight() {
	var leftSide = $('.left-side').height();
	var mainContent = $('.main-content .wrapper').height();

	if (leftSide > mainContent) {
		$('.main-content').height(leftSide + 100);
	} else {
		$('.main-content').height(mainContent + 200);
	}

}

var pickerSetValueFrameID = '';
function initModal() {

	var browserHeight = $(window).height();
	$('#modalWindow').find('.iframe').height(browserHeight - 150);

	$(document).on('click', '.modalSelector', function(e) {

		var modalSelectorUrl = $(this).attr('modalSelectorUrl');
		var modalTitle = $(this).attr('modalTitle');

		pickerSetValueFrameID = $(this).attr('setValueFrameID');

		$('#modalWindow').find('.modalTitle').text(modalTitle);

		// var iframeSrc = $('#modalWindow').find('.iframe').prop('src');
		// if (iframeSrc != modalSelectorUrl) {
		$('#modalWindow').find('.iframe').prop('src', modalSelectorUrl);
		// }
		//auto calculate modal iframe height
		var browserHeight = $(window).height();
		$('#modalWindow').find('.iframe').height(browserHeight - 150);
	});

}

var modalListData = null;

function pickItem(i) {
	var data = modalListData[i];
	// console.log(data);
	// parent.afterModalPick();
	parent.modalPickItem(data);

}

function modalPickItem(data) {
	// console.log(data);
	for (var key in data) {
		var x = data[key];
		$('#' + pickerSetValueFrameID).find('*[modalName="' + key + '"]').val(x);
	}
	parent.afterModalPick();
	$('#modalWindow').find('*[data-dismiss]').click();
}

function inputAddItem(i) {
	var data = modalListData[i];
	// console.log(data);
	parent.modalAddItem(data);
}

function modalAddItem(data) {
	//
	// // console.log(data);
	// for (var key in data) {
	// var x = data[key];
	// $('#' + pickerSetValueFrameID).find('*[modalName="' + key + '"]').val(x);
	// }
	// $('#modalWindow').find('*[data-dismiss]').click();
}

function modalClose() {

	$('#modalWindow').find('*[data-dismiss]').click();

	$('#modalWindow iframe').attr('src', 'about:blank');
}

// function pickerSetValue() {
// alert('asd');
//
// }

function initEvent() {
	$('.buttonGps').click(function() {

	});

}

function updateNotification() {
	// if (isLogin) {
	// setTimeout("updateNotificationDo()", 60000);
	// }
}

function updateNotificationDo() {

	var url = baseUrl + '/site/getNotification';
	$.ajax({
		url : url,
		type : 'post',
		dataType : 'json',
		success : function(r) {
			var html = '';
			var data = r.data;
			var count = 0;
			for (var i in data) {
				var x = data[i];
				url = baseUrl + '/site/notification/' + x['_id'];
				html += '<li ><div style="padding-left:10px; width:320px"><a href="' + url + '" ><span class="btn btn-primary" style="padding:2px 5px;font-weight:bold">' + getNotificationTypeText(x['typeID']) + '</span> ' + x['description'] + ' <br><span style="margin-left:30px;" class="notificationTime">' + x['timeDifference'] + '</span></a></div></li>';

				count++;

			}

			if (html == '') {

				html = '<li><a href="' + baseUrl + '/my/notification">目前無最新通知, 點此看通知記錄</a></li>';
			}

			$('#notificationList').html(html);
			if (count > 0) {
				$('#notificationCount').text(count);
				$('#notificationCount').show();

				$('#notificationCount2').show();
				$('#notificationCount2').addClass('notificationXX');

				$('#notificationCount2').html('<span class="btn btn-danger" style="font-weight:bold;padding:3px 3px 2px 3px;border-radius:4px;width:100%;margin:auto">' + count + '</span>');
			} else {
				$('#notificationCount').hide();
				$('#notificationCount2').removeClass('notificationXX');
				$('#notificationCount2').html('<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>');
			}

			updateNotification();
		}
	});

}

function getNotificationTypeText(v) {
	var text = '';
	switch(v) {
	case 1:
		text = '買';
		break;
	case 2:
		text = '賣';
		break;
	case 3:
		text = '問';
		break;
	case 4:
		text = '答';
		break;

	}
	return text;
}

function newsletterDo() {
	var v = $('#footerNewsletterInput').val();

	if ($.trim(v) != '') {

		if (validateEmail(v)) {

			var url = baseUrl + '/site/newsletterDo';
			$.ajax({
				url : url,
				type : 'post',
				dataType : 'json',
				data : {
					email : v
				},
				success : function(r) {
					alert('訂閱完成!');
				}
			});

		} else {
			alert('請輸入正確信箱');
		}

	} else {
		alert('請輸入您的信箱');
	}

}

function doSearch() {
	var text = $('#headerSearchInput').val();
	if ($.trim(text) != '') {
		toPage('/search/list/' + encodeURI(text));
	} else {
		alert('請輸入關鍵字');

	}

}

function searchEnter(e) {
	if (e.keyCode == 13) {
		doSearch();
	}

}

function validateEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function setDatepicker() {
	// var option = {
	// dateFormat : 'yy-mm-dd',
	// changeYear : true
	// };

	var option = {
		dateFormat : 'yy-mm-dd',
		changeYear : true,
		//monthNames : ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
		yearRange : '-100:+10',
		// minDate : '-20y',
		//maxDate : '+0d',
	};

	$("input.datepicker").datepicker(option);

}

/*
 function setDatetimepicker() {
 var option = {
 timeFormat : 'HH:mm:ss',
 dateFormat : 'yy-mm-dd',
 changeYear : true
 };
 $("input[rel=datetimepicker]").datetimepicker(option);
 }
 */

function int(v) {
	return parseInt(v);
}

function float(v) {
	return parseFloat(v);
}

function isUrl(str) {
	var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
	'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
	'((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
	'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
	'(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
	'(\\#[-a-z\\d_]*)?$', 'i');
	// fragment locator

	// fragment locater
	if (!pattern.test(str)) {
		// alert("Please enter a valid URL.");
		return false;
	} else {
		return true;
	}
}

function filterArea() {
	var v = $('#cityID').val();
	$('#areaID').empty();
	//$('#areaID').append('<option value="0">全部區域</option>');
	$('#areaIDClone option[rel=' + v + ']').each(function() {
		$('#areaID').append($(this).clone());
	});
}

function setListHtml(html, type) {

	if ( typeof (type) == 'undefined') {
		type = 'table';
	}

	if (html == '') {
		if (type == 'table') {
			//return '<tr><td colspan="99" class="text-center">搜尋完成, 找不到任何項目...囧囧囧.......</td></tr>';
			return '<tr><td colspan="99" class="text-center">Search completed, didn\'t found anything :(</td></tr>';
		} else {
			//return '搜尋完成, 找不到任何項目 :(';
			return 'Search completed, didn\'t found anything :(';
		}
	} else {
		return html;
	}
}

function afterGetList(containerID) {
	setLanguageSource();

}

function v(v) {
	if (v == null) {
		return '';
	} else {
		return v;
	}
}

function toTop() {
	$('html, body').animate({
		scrollTop : 0
	}, 'fast');
}

function isMobile() {
	if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
		return true;

	} else {
		return false;
	}
}

function beforeGetList(containerID) {
	$('.list tbody').html('<tr><td colspan="99" style="text-align:center">Searching, please wait...</td></tr>');
}

function getQueryParams(qs) {
	qs = qs.split("+").join(" ");
	var params = {},
	    tokens,
	    re = /[?&]?([^=]+)=([^&]*)/g;
	while ( tokens = re.exec(qs)) {
		params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
	}
	return params;
}

function setListSearchParameter(containerID, searchParameter) {
	for (var i in searchParameter) {
		var x = searchParameter[i];
		$('#' + containerID).find('input[name=' + i + ']').val(x);
	}
}

function htmlEncode(value) {
	return $('<div/>').text(value).html();
}

function htmlDecode(value) {
	return $('<div/>').html(value).text();
}

function htmlEscape(str) {
	return String(str).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

//guid
var getGuid = (function() {
	function s4() {
		return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
	}

	return function() {
		return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
	};
})();

function autoSetMenuActive() {
	$('#sideMenuFrame a[controllerName="' + controllerName + '"]').addClass('bold');
	// $('#sideMenuFrame a[controllerName="' + controllerName + '"]').addClass('underline');
	$('#sideMenuFrame a[controllerName="' + controllerName + '"]').addClass('darkPurple');
	$('#sideMenuFrame a[controllerName="' + controllerName + '"]').parent().parent().parent().addClass('nav-active');
}

function manualSetMenuActive(name) {
	$('#sideMenuFrame a[controllerName="' + name + '"]').addClass('bold');
	// $('#sideMenuFrame a[controllerName="' + controllerName + '"]').addClass('underline');
	$('#sideMenuFrame a[controllerName="' + name + '"]').addClass('darkPurple');
	$('#sideMenuFrame a[controllerName="' + name + '"]').parent().parent().parent().addClass('nav-active');
}

function setMenuActive(x) {
	$('#menu' + x).addClass('nav-active');
}

// list functions--------------------------------------------------start---------------------------------------------------

var listContainerID = 'list';
var listCondition;
var searchCookieName = controllerName + '.' + actionName + '.search';

function listConditionInit() {
	listCondition = {};
	var x = {};
	x['currentPage'] = 1;
	x['orderField'] = '';
	x['orderType'] = 'desc';
	x['itemPerPage'] = 10;
	x['getListUrl'] = baseUrl + '/' + controllerName + '/getList';

	listCondition['list'] = x;
}

//get page on ready
var getListRespond = function(r) {
	//on each list page
	var html = getListHtml(r['data']);

	html = setListHtml(html);
	//set html to table
	$('#' + listContainerID).find('.list').html(html);

	//set page html
	setPageFrame(listContainerID, r['pageTotal'], r['totalItem']);
	//something to do when set html on table
	afterGetList(listContainerID);
};

function goToPage() {

}

//list page - get list
function getList() {

	beforeGetList(listContainerID);

	var searchParameters = $('#' + listContainerID).find('.search').serialize();

	if ( typeof (listCondition[listContainerID]) == 'undefined') {
		url = baseUrl + '/' + controllerName + '/getList';
	} else {
		url = listCondition[listContainerID]['getListUrl'];
	}

	var currentPage = listCondition[listContainerID]['currentPage'];
	var orderField = listCondition[listContainerID]['orderField'];
	var orderType = listCondition[listContainerID]['orderType'];
	var itemPerPage = $('#' + listContainerID).find('.itemPerPage').val();

	//save cookie
	$.cookie(searchCookieName, searchParameters, {
		expires : cookieExpireTime
	});

	$.ajax({
		url : url,
		type : 'post',
		dataType : 'json',
		data : {
			page : currentPage,
			orderField : orderField,
			orderType : orderType,
			itemPerPage : itemPerPage,
			search : searchParameters
		},
		success : getListRespond
	});

}

function initListPage() {
	//set search parameter if exists
	if ($.cookie(searchCookieName) != null) {
		var searchParameter = getQueryParams($.cookie(searchCookieName));
		setListSearchParameter(listContainerID, searchParameter);
	}
	setListEvent(listContainerID);
	listConditionInit();
}

function deleteItem(id, e) {
	if (confirm('Confirm to delete?')) {
		var url = baseUrl + '/' + controllerName + '/deleteDo';
		$.ajax({
			url : url,
			type : 'post',
			data : {
				id : id
			},
			success : function(r) {
				if (r == 'true') {
					$(e).parent().parent().remove();
				}

			}
		});
	}
}

function setListEvent(containerID) {
	//set order event
	setOrderEvent();
	//set search  event
	setSearchEvent();

	//item per page onchange event
	$('#' + containerID).find('.itemPerPage').change(function(e) {
		getList(containerID);
	});

	$('#' + containerID).find('.buttonClear').click(function(e) {
		//clear search field
		$('#' + containerID).find('.search').val('');
	});

	$('#' + containerID).find('.buttonGoToPage').click(function(e) {
		//clear search field
		var goToPage = $('#' + containerID).find('.goToPage').val();
		goToPage = int(goToPage);
		if (goToPage > 0) {
			setPage(containerID, goToPage);
		}
		// $('#' + containerID).find('.search').val('');
	});

	$('#' + listContainerID).find('.goToPage').keypress(function(e) {
		if (e.which == 13) {
			var goToPage = $('#' + containerID).find('.goToPage').val();
			goToPage = int(goToPage);
			if (goToPage > 0) {
				setPage(containerID, goToPage);
			}
		}
	});

	// $('#' + containerID).find('.buttonSearch').click(function(e) {
	// getList(containerID);
	// });

}

function setPageFrame(containerID, pageTotal, totalItem) {

	html = '';

	if (pageTotal != 0) {

		//add prev page html
		var page = 1;
		if ( typeof (listCondition[containerID]) != 'undefined' && typeof (listCondition[containerID]['currentPage']) != 'undefined') {
			page = listCondition[containerID]['currentPage'];
		}

		if (page > 1) {

			// if (page >= 1) {
			html += '<li class="prev "  onclick="setPage(\'' + containerID + '\', ' + '1' + ')"><a href="#" t>First page</a></li>';
			// } else {
			// html += '<li class="prev"  onclick="setPage(\'' + containerID + '\', ' + '1' + ')"><a href="#">First page </a></li>';

			// }

			html += '<li class="prev" onclick="setPage(\'' + containerID + '\', ' + (page - 1) + ')"><a href="#" t>← Previous</a></li>';

		}

		//previous 10 page button
		if (page > 10) {
			//html += '<li class="pageItem" onclick="setPage(\'' + containerID + '\', ' + (page - 10) + ')"><a>上10頁</a></li>';
		}

		var fromPage = page - 4;
		if (fromPage < 1) {
			fromPage = 1;
		}
		var toPage = page + 4;
		if (toPage > pageTotal) {
			toPage = pageTotal;
		}

		for (var i = fromPage; i <= toPage; i++) {

			if (page == i) {
				html += '<li class="active" onclick="setPage(\'' + containerID + '\', ' + i + ')"><a>' + i + '</a></li>';
			} else {
				html += '<li class="" onclick="setPage(\'' + containerID + '\', ' + i + ')"><a>' + i + '</a></li>';
			}
		}

		//next 10 page button
		if ((pageTotal - 10 ) > page) {
		}

		//add next page html
		if (page < pageTotal) {

			html += '<li class="next"  onclick="setPage(\'' + containerID + '\', ' + (page + 1) + ')"><a href="#" t>Next →</a></li>';

			// if (page == pageTotal) {
			// html += '<li class="next disabled" onclick="setPage(\'' + containerID + '\')"><a href="#">Last page</a></li>';
			// } else {
			//
			//
			// }
			html += '<li class="next" onclick="setPage(\'' + containerID + '\', ' + pageTotal + ')"><a href="#" t>Last page</a></li>';

		}

		var currentPage = 1;
		if ( typeof (listCondition[containerID]) != 'undefined') {
			if ( typeof (listCondition[containerID]['currentPage']) != 'undefined') {
				currentPage = listCondition[containerID]['currentPage'];
			}

		}
	}

	$('#' + containerID).find('.pageFrame').html(html);

	if (pageTotal == 0) {
		$('#' + containerID).find('.currentPage').text(0);
	} else {
		$('#' + containerID).find('.currentPage').text(currentPage);
	}

	$('#' + containerID).find('.currentPage').text(currentPage);

	$('#' + containerID).find('.totalPage').text(pageTotal);
	$('#' + containerID).find('.totalItem').text(totalItem);
}

function setPage(containerID, v) {
	//currentPage[containerID] = v;
	listCondition[containerID]['currentPage'] = v;
	getList();
}

function setSearchEvent() {

	$('#' + listContainerID).find('.search').keypress(function(e) {
		if (e.which == 13) {
			listCondition[listContainerID]['currentPage'] = 1;
			getList();
		}
	});
	//search Button event
	$('#' + listContainerID).find('.buttonSearch').click(function() {
		listCondition[listContainerID]['currentPage'] = 1;
		getList();
	});

}

function setOrderEvent() {
	$('#' + listContainerID).find('*[orderField]').click(function() {
		//remove arrow
		// $('.arrowUp').remove();
		// $('.arrowDown').remove();

		$('#' + listContainerID).find('*[orderField]').removeClass('sort-desc');
		$('#' + listContainerID).find('*[orderField]').removeClass('sort-asc');

		var orderType = 'asc';
		if ( typeof (listCondition[listContainerID]['orderField']) != 'undefined') {
			orderType = listCondition[listContainerID]['orderType'];
		}
		listCondition[listContainerID]['orderField'] = $(this).attr('orderField');

		if (orderType == 'asc') {
			//orderType = 'desc';
			listCondition[listContainerID]['orderType'] = 'desc';
			// $(this).parent().append('<div class="arrowUp"></div>');
			// $(this).addClass('sorting_desc');
			$(this).addClass('sort-desc');
		} else {
			//orderType = 'asc';
			listCondition[listContainerID]['orderType'] = 'asc';
			// $(this).parent().append('<div class="arrowDown"></div>');

			$(this).addClass('sort-asc');
			// $(this).addClass('sorting_asc');
		}
		getList();
	});

}

// list functions--------------------------------------------------end---------------------------------------------------

// icheck checkbox
function icheckChange() {
	$('input[name="ww_jobarea_id[]"]').parent().removeClass('checked');

}

//set read mode
function setIsRead(formID, isRead) {
	if (isRead) {

		$('#' + formID).find('input').prop('readonly', 'readonly');
		$('#' + formID).find('select').prop('readonly', 'readonly');
		$('#' + formID).find('textarea').prop('readonly', 'readonly');

		$('#' + formID).find('input').prop('disabled', true);
		$('#' + formID).find('select').prop('disabled', true);
		$('#' + formID).find('textarea').prop('disabled', true);

		// $('#' + formID).find('button').prop('disabled', true);
		$('#' + formID).find('button').hide();
		$('#' + formID).find('.panel-footer').hide();

	} else {
		//sortable
		$('.sortable').sortable();
	}
}

function toggleMenu(e) {
	$('.menuItem').slideUp();
	$(e).next().stop().slideDown();
}

// function fileUploadSuccessEvent(data, textStatus, jqXHR) {
// console.log(data);
// alert('zzzzzzz');
// }

// var fileUploadSuccessEvent = function(data, textStatus, jqXHR) {
// console.log(data);
// alert('zzzzzzz');
// };

// var fileUploadSuccessEvent;

//deserialize to array
function deserialize(qs) {
	qs = qs.split("+").join(" ");

	var params = {},
	    tokens,
	    re = /[?&]?([^=]+)=([^&]*)/g;

	while ( tokens = re.exec(qs)) {
		params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
	}

	return params;
}

function getCurrentDate() {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth() + 1;
	//January is 0!
	var yyyy = today.getFullYear();

	if (dd < 10) {
		dd = '0' + dd;
	}

	if (mm < 10) {
		mm = '0' + mm;
	}

	today = yyyy + '/' + mm + '/' + dd;
	return today;
}

var setGpsID = '';
function setGps(latitude, longitude) {
	$('#' + setGpsID + ' input[modalName=latitude]').val(latitude);
	$('#' + setGpsID + ' input[modalName=longitude]').val(longitude);

}

function getLatitude() {
	var v = parseFloat($('#' + setGpsID + ' input[modalName=latitude]').val());
	if (isNaN(v)) {
		return null;
	} else {
		return v;
	}
}

function getLongitude() {
	var v = parseFloat($('#' + setGpsID + ' input[modalName=longitude]').val());
	if (isNaN(v)) {
		return null;
	} else {
		return v;
	}

}

function afterModalPick() {

}

function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

function setAddressEvent() {

	$('*[addressRel="country"]').change(function() {
		console.log('country');
	});

	$('*[addressRel="state"]').change(function() {
		console.log('state');
	});

	$('*[addressRel="city"]').change(function() {
		console.log('city');
	});

	$('*[addressRel="area"]').change(function() {
		console.log('area');
	});

}

function assignJsonData(jsonData, inputName) {

	for (var i in jsonData) {

		var x = jsonData[i];

		$('*[name="' + inputName + '[' + i + ']"]').val(x);
	}

}

function assignCheckbox(jsonData, inputName) {

	for (var i in jsonData) {

		var x = jsonData[i];

		$('*[name="' + inputName + '"][value="' + x + '"]').prop('checked', true);

	}

}

function hideEmptyMenu() {
	$('.menu-list').each(function() {
		var length = $(this).find('>ul>li>a:visible').length;

		if (length <= 0) {
			$(this).hide();
		}

	});

	//set all menu inactive
	$('.menu-list').removeClass('nav-active');

	//set menu active
	autoSetMenuActive();
}

function setAddress(serializeText) {

	// console.log(data);

	// alert(data);
	var data = deserialize(serializeText);

	console.log(data);

	$('#' + addressFrameID).find('*[modalName="addressText"]').text(data['addressText']);
	$('#' + addressFrameID).find('*[modalName="addressText"]').val(data['addressText']);

	$('#' + addressFrameID).find('*[modalName="addressZip"]').val(data['addressZip']);
	$('#' + addressFrameID).find('*[modalName="addressCountryID"]').val(data['addressCountryID']);
	$('#' + addressFrameID).find('*[modalName="addressStateID"]').val(data['addressStateID']);
	$('#' + addressFrameID).find('*[modalName="addressCityID"]').val(data['addressCityID']);
	$('#' + addressFrameID).find('*[modalName="addressAreaID"]').val(data['addressAreaID']);
	$('#' + addressFrameID).find('*[modalName="address1"]').val(data['address1']);
	$('#' + addressFrameID).find('*[modalName="address2"]').val(data['address2']);
	$('#' + addressFrameID).find('*[modalName="address3"]').val(data['address3']);

	modalClose();

}

function openAddressWindow() {

	var modalSelectorUrl = baseUrl + '/address/input';
	// var modalTitle = 'New visit record';
	var modalTitle = 'Set Address';

	// pickerSetValueFrameID = $(this).attr('setValueFrameID');

	$('#modalWindow').find('.modalTitle').text(modalTitle);
	$('#modalWindow').find('.iframe').prop('src', modalSelectorUrl);

	// var browserHeight = $(window).height();
	// $('#modalWindow').find('.iframe').height(browserHeight - 150);

}

function getUrl(a, c) {
	if ( typeof (c) == 'undefined') {
		c = controllerName;
	}
	return baseUrl + '/' + c + '/' + a;
}

/*
 function getUrl(a, c, prefix) {
 if ( typeof (c) == 'undefined') {
 c = controllerName;
 }

 if ( typeof (prefix) == 'undefined') {

 prefix = 'admin';

 return baseUrl + '/' + prefix + '/' + c + '/' + a;
 } else {

 return baseUrl + '/' + c + '/' + a;
 }

 }
 */

function ready(xxx) {
	xxx();
}

function setModalMode() {

	var modalMode = parent.getModalMode();
	if (modalMode == 'read') {
		$('input').attr('readonly', true);
		$('textarea').attr('readonly', true);
		$('select').attr('disabled', true);

		$('button').hide();
		$('.panel-footer:last').hide();

	}
}