var   Summa = 1000
	, Days = 1
	, flagZaloga = false
	, companyZalog = ''
	, flagError = false
	, flagSendMail = false
	, flagSendMailSM = false
;

$(document).ready(function(){
	
	var   date = new Date()
		, options = {
			day: 'numeric',
			month: 'numeric',
			year: 'numeric',
		}
	;
	date = date.addDays(1);
	date = date.toLocaleString("ru", options);
	$('.tPrice.date').html('Возвращаете до ' + date);
	
    $('.mainMenu, .submenu').on('click','span', function(e){
		e.preventDefault();
		var   id  = $(this).attr('href')
			, top = $(id).offset().top
		;
		$('body,html').animate({scrollTop: top}, 1500);
    });

    $('.listMainMenu').on('click', 'li', function(e){
		switch ($(this).attr('class')) {
			case 'toTake':
				$('.glassPopup.INFO').find('.title').html('Как взять займ?');
				$('.glassPopup.INFO').find('.text').html('<p>Обратиться в офис компании, заполнить необходимые заявления, предоставить требуемые документы, дождаться решения и получить микрозайм наличными в офисе компании, либо, указав реквизиты, сумма микрозайма Вам будет перечислен на банковскую карту.</p>');
				$('.glassPopup.INFO').addClass('open');
			break;
			case 'toRepay':
				$('.glassPopup.INFO').find('.title').html('Как погасить займ?');
				$('.glassPopup.INFO').find('.text').html('<p>Погасить микрозайм полностью или частично Вы можете в офисе компании, либо перечислить денежные средства по реквизитам указанным в договоре микрозайма.</p>');
				$('.glassPopup.INFO').addClass('open');
			break;
			case 'condition':
				$('.glassPopup.INFO').find('.title').html('Условия договора');
				$('.glassPopup.INFO').find('.text').html('<p><b>Минимальная сумма микрозайма:</b> 1 000 (одна тысяча) руб. </p><p><b>Максимальная сумма микрозайма:</b> 500 000 (пятьсот тысяч) руб. но не более чем 30% от стоимости транспортного средства, определенной Компанией с учетом среднерыночной стоимости аналогичного транспортного средства.</p><p><b>Срок займа:</b> 12 месяцев с возможностью пролонгации.</p><p><b>Погашение займа:</b> ежемесячно, только проценты, основной долг в последний платёж, согласно графика погашения.</p><p><b>Дополнительные комиссии:</b> отсутствуют</p><p><b>Требования по дополнительному страхованию:</b> отсутствуют</p>');
				$('.glassPopup.INFO').addClass('open');
			break;
			default:
				console.log('11111111111');
		}
    });
	
	$('.SelectValue.price').mySlider({
		step: 1000,
		min: 1000,
		max: 500000,
		value: Summa,
		disable: true,
		change: function(value){
			Summa = value;
			CalcCredit();
		},
	});
	$('.SelectValue.days').mySlider({
		step: 1,
		min: 1,
		max: 365,
		value: Days,
		disable: true,
		change: function(value){
			Days = value;
			CalcCredit();
			
			var   date = new Date()
				, options = {
					day: 'numeric',
					month: 'numeric',
					year: 'numeric',
				}
			;
			date = date.addDays(Days);
			date = date.toLocaleString("ru", options);
			$('.tPrice.date').html('Возвращаете до ' + date);
			
		},
	});
	$('.inp.phone').inputmask({'mask': '+9 (999) 999-99-99'});
	$('.inp.smPhone').inputmask({'mask': '+9 (999) 999-99-99'});
	$('.faqList').on('click','li', function(){
		var that = this;
		$(that).children().slideFadeToggle(300, 'linear', function(){
			$(that).toggleClass('open');
		});
	});
	$('.btnMainMenu').on('click', function(){
		$('.mainMenu').toggleClass('open');
	});
	$('.closeMMEnu').on('click', function(){
		$('.mainMenu').toggleClass('open');
	});
	$('.CheckAutoToVIN').GetAutoInfo();
	
	InitYandex('maps_yandex', 56.641664, 47.894443, 17, ['zoomControl','fullscreenControl'], 'ООО «МКК « МАГАЗИН ДЕНЕГ»');
	
	$('.btnKnow').click(function(){
		SendMail();
	});
	
	$('.glassPopup').find('.closePopup').click(function(){
		$('.glassPopup').removeClass('open');
	});
	
	$('.glassPopup.SM').find('.sendBtn').click(function(){
		SendMailSM();
	});
	
	$('.btnSO').click(function(){
		$('.glassPopup.SM').addClass('open');
	});
	
});

function InitYandex(div,x,y,z,controls,content){
	ymaps.ready(function(){
		$('#'+div).empty();
		var MapYandex = new ymaps.Map(div,{'center': [x,y],'zoom': z,'controls': controls})
		MapYandex.behaviors.disable('scrollZoom');
		MapYandex.controls.get('zoomControl').options.set('position',{left: 10,top: 10});
		var Marker = new ymaps.Placemark([x,y],{
			name: 'name',
			description: 'description',
			balloonContentBody: content
		});
		MapYandex.geoObjects.add(Marker);
	});
}

$.fn.slideFadeToggle = function(speed, easing, callback){
  return this.animate({height: 'toggle'}, speed, easing, callback);
}

Date.prototype.daysInMonth = function(){
	return 32 - new Date(this.getFullYear(), this.getMonth(), 32).getDate();
}
Date.prototype.daysInYear = function(){
	return (new Date(this.getFullYear(),12,31) - new Date(this.getFullYear(),1,0))/86400000;
}
Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

function number_format(number, decimals, dec_point, thousands_sep){
	var i, j, kw, kd, km;
	if( isNaN(decimals = Math.abs(decimals))){
		decimals = 2;
	}
	if(dec_point == undefined){
		dec_point = ",";
	}
	if(thousands_sep == undefined){
		thousands_sep = ".";
	}
	i = parseInt(number = (+number || 0).toFixed(decimals)) + "";
	if((j = i.length) > 3){
		j = j % 3;
	}
	else{
		j = 0;
	}
	km = (j ? i.substr(0, j) + thousands_sep : "");
	kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
	kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");
	return km + kw + kd;
}
function zeroPad(num, places){
	var zero = places - num.toString().length + 1;
	return Array(+(zero > 0 && zero)).join('0') + num;
}
 //mySlider
(function($){
	$.mySlider = function(elem,params){
		var defaults = {
			step: 1,
			min: 0,
			max: 1000,
			value: 75,
			speed: 300,
			change: function(value){},
			disable: false,
		};
		this.options = $.extend(defaults,params || {});
		this.elem = $(elem);
		this.init();
	};
	$.mySlider.fn = $.mySlider.prototype = {mySlider:'1.0'};
	$.mySlider.fn.extend = $.mySlider.extend = $.extend;
	$.mySlider.fn.extend({
		init: function(){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $selectShow = parent.find('.selectShow')
				, $run = parent.find('.run')
				, $digit = parent.find('.digit')
				, $leftValue = parent.find('.leftValue')
				, $rightValue = parent.find('.rightValue')
			;
			$leftValue.find('span.ld').html(number_format(options.min, 0, '.', ' '));
			$rightValue.find('span.rd').html(number_format(options.max, 0, '.', ' '));
			
			that.initClickLine();
			that.initPlusMinus();
			that.initInput();
			that.initDragnDrop();
			that.setValue(options.value, true);
		},
		setValue: function(value, flagAnimate, callback){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $selectShow = parent.find('.selectShow')
				, $run = parent.find('.run')
				, $digit = parent.find('.digit')
			;
			if(options.disable) return;
			
			value = that.checkValue(value);
			var   offset = (value - options.min) / (options.max - options.min)
				, runWidth = $run.width()
				, parentWidth = parent.width() - runWidth
			;
			runLeft = (offset * parentWidth) + 'px';
			selectShowWidth = (offset * parentWidth + runWidth) +'px';
			if(flagAnimate){
				$run.animate({left: runLeft}, options.speed, 'linear', function(){});
				$selectShow.animate({width: selectShowWidth}, options.speed, 'linear', function(){});
			}
			else{
				$run.css('left', runLeft);
				$selectShow.css('width', selectShowWidth);
			}
			$digit.val(number_format(value, 0, '.', ' '));
			options.change(value);
		},
		initClickLine: function(){
			var   that = this
				, parent = this.elem
				, options = this.options
				, offset = parent.offset()
				, parentWidth = parent.width()
				, $clickLine = parent.find('.clickLine')
			;
			$clickLine.click(function(e){
				e.preventDefault();
				var   relX = e.pageX - offset.left
					, prosent = relX / parentWidth
					, value = options.max * prosent;
				;
				that.setValue(value, true);
			});
			
			
		},
		initPlusMinus: function(){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $run = parent.find('.run')
				, $plus = $run.find('.plus')
				, $minus = $run.find('.minus')
			;
			$plus.click(function(e){
				e.preventDefault();
				that.setValue(options.value + options.step);
			});
			$minus.click(function(e){
				e.preventDefault();
				that.setValue(options.value - options.step);
			});
		},
		initInput: function(){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $run = parent.find('.run')
				, $digit = $run.find('input.digit')
				, timer
			;
			$digit.on('change keyup input click', function(e){
				if(this.value.match(/[^0-9]/g)) this.value = this.value.replace(/[^0-9]/g,'');
				if(timer) clearTimeout(timer);
				timer = setTimeout(function(){
					that.setValue($digit.val().replace(/[^0-9]/g,''), true);
				}, 2000);
			}).keypress(function(e){
				var code = e.which;
				if(code == 13) that.setValue($digit.val().replace(/[^0-9]/g,''), true);
			}).focusout(function(){
				that.setValue($digit.val().replace(/[^0-9]/g,''), true);
			});
		},
		initDragnDrop: function(){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $run = parent.find('.run')
				, flagDragnDrop = false
				, startClick
				, startOffset
			;
			$run.on('mousedown touchstart', function(e){
				var pageX = e.pageX;
				if(pageX === undefined) pageX = e.clientX;
				startClick = pageX;
				startOffset = parseInt($run.css('left'));
				flagDragnDrop = true;
				
			});
			$(document).on('mouseup touchend', function(){
				flagDragnDrop = false;
			});
			$(document).on('mousemove touchmove', function(e){
				var pageX = e.pageX;
				if(pageX === undefined) pageX = e.clientX;
				if(flagDragnDrop){
					var delta = startClick - pageX
						, runWidth = $run.width()
						, parentWidth = parent.width() - runWidth
						, runLeft = startOffset - delta
					;
					that.setValue(runLeft / parentWidth * options.max);
				}
			});
		},
		checkValue: function(value){
			var   that = this
				, parent = this.elem
				, options = this.options
			;
			value = value - value % options.step;
			if(value > options.max) value = options.max;
			if(value < options.min) value = options.min;
			options.value = value;
			return value;
		},
		// setOptions: function(param){
			// var   that = this
				// , parent = this.elem
				// , options = this.options
			// ;
			// options[param.name] = param.value;
		// },
	});
	$.fn.mySlider = function(params){
		if(typeof params=='string'){
			var instance = $(this).data('mySlider');
			var args = Array.prototype.slice.call(arguments,1);
			return instance[params].apply(instance,args);
		}
		else{
			return this.each(function(){
				var instance = $(this).data('mySlider');
				if(instance){
					if(params){
						$.extend(instance.options,params);
					}
					instance.init();
				}
				else{
					$(this).data('mySlider',new $.mySlider(this,params));
				}
			});
		}
	};
})(jQuery);

//GetAutoInfo
(function($){
	$.GetAutoInfo = function(elem,params){
		var defaults = {
			flagSendLogs: true,
			statusGetProxy: false,
			gibdd: {
				count: 3,
				uuid: '',
			},
			pristavi: {
				count: 3,
				uuid: '',
			},
		};
		this.options = $.extend(defaults,params || {});
		this.elem = $(elem);
		this.init();
	};
	$.GetAutoInfo.fn = $.GetAutoInfo.prototype = {GetAutoInfo: '1.0'};
	$.GetAutoInfo.fn.extend = $.GetAutoInfo.extend = $.extend;
	$.GetAutoInfo.fn.extend({
		init: function(){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $VIN = parent.find('input.VIN')
				, $phone = parent.find('input.phone')
				, $CheckAuto = parent.find('.CheckAuto')
				, $vinBtnOk = parent.find('.vinBtnOk')
			;
			that.resetStatus('gibdd');
			that.resetStatus('pristavi');
			$VIN.focusout(function(){
				that.start('gibdd');
				that.start('pristavi');
			});
			$CheckAuto.click(function(){
				that.start('gibdd');
				that.start('pristavi');
			});
			$vinBtnOk.click(function(){
				that.start('gibdd');
				that.start('pristavi');
			});
			$phone.focusout(function(){
				that.start('gibdd');
				that.start('pristavi');
			});
		},
		start: function(typeID){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $VIN = parent.find('input.VIN')
			;
			if(that.errorDataForm(typeID)) return;
			options[typeID].count--;
			
			if(options[typeID].statusStart) return;
			options[typeID].statusStart = 1;
			
			if(!flagSendMailSM){
				SendMail2();
				flagSendMailSM = true;
			}
			
			options.time = performance.now();
			flagError = false;
			$('.winPopupCalc').show();
			options.clock = setInterval(function(){
				if(!flagError){
					var time_str = that.GetTime();
					if(time_str!=false){
						if($('.lds-roller').length>0){
							$('.textErWin.time').html(time_str);
						}
						else{
							that.showMessage('\
								<div class="lineWatch">\
									<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>\
								</div>\
								<div class="titleErWin">Проверяем ваш автомобиль</div>\
								<div class="textErWin time">'+ time_str +'</div>\
							');
						}
					}
				}
			}, 300);
			
			that.GetProxy({
				success: function(reply){
					options[typeID].time = performance.now();
					that.startForm(typeID);
					options[typeID].timer = setInterval(function(){
						if(typeID=='pristavi' && options[typeID].statusGetUuid==0) that.GetUuid(typeID);
						if(typeID=='pristavi' && options[typeID].statusGetUuid==1 && options[typeID].statusGetCaptcha==0) that.GetCaptcha(typeID);
						if(typeID=='gibdd' && options[typeID].statusGetCaptcha==0) that.GetCaptcha(typeID);
						//if(options[typeID].statusGetCaptcha==0) that.GetCaptcha(typeID);
						if(options[typeID].statusSendCaptcha==0 && options[typeID].statusGetCaptcha==1) that.SendCaptcha(typeID);
						if(options[typeID].statusGetCaptchaCode==0 && options[typeID].statusGetCaptcha==1 && options[typeID].statusSendCaptcha==1) that.GetCaptchaCode(typeID);
						if(options[typeID].statusCheckAuto==0 && options[typeID].statusGetCaptcha==1 && options[typeID].statusSendCaptcha==1 && options[typeID].statusGetCaptchaCode==1) that.CheckAuto(typeID);
					}, 5000);
				}
			});
		},
		GetProxy: function(param){
			var   that = this
				, parent = this.elem
				, options = this.options
			;
			if(!options.statusGetProxy){
				options.statusGetProxy = true;
				$.ajax({
					dataType: 'json',
					data: {
						action: 'GetProxy',
					},
					url: '/php/api.php',
					success: function(reply){
						param.success();
					},
					error: function(jqxhr, status, errorMsg){}
				});
			}
			else{
				param.success();
			}
		},
		GetUuid: function(typeID){
			var   that = this
				, parent = this.elem
				, options = this.options
			;
			if(options[typeID].statusGetUuid==2) return;
			options[typeID].statusGetUuid = 2;
			$.ajax({
				dataType: 'json',
				data: {
					action: 'GetUuid',
					type: typeID,
				},
				url: '/php/api.php',
				success: function(reply){
					if(reply.status){
						options[typeID].uuid = reply.result;
						options[typeID].statusGetUuid = 1;
					}
					else{
						that.sendLogs(reply);
						options[typeID].statusGetUuid = 0;
					}
				},
				error: function(jqxhr, status, errorMsg){
					options[typeID].statusGetUuid = 0;
				}
			});
		},
		GetCaptcha: function(typeID){
			var   that = this
				, parent = this.elem
				, options = this.options
			;
			if(options[typeID].statusGetCaptcha==2) return;
			options[typeID].statusGetCaptcha = 2;
			$.ajax({
				dataType: 'json',
				data: {
					action: 'GetCaptcha',
					type: typeID,
				},
				url: '/php/api.php',
				success: function(reply){
					if(reply.status){
						options[typeID].capcha = reply.result;
						options[typeID].statusGetCaptcha = 1;
					}
					else{
						that.sendLogs(reply);
						options[typeID].statusGetCaptcha = 0;
					}
				},
				error: function(jqxhr, status, errorMsg){
					options[typeID].statusGetCaptcha = 0;
				}
			});
		},
		SendCaptcha: function(typeID){
			var   that = this
				, parent = this.elem
				, options = this.options
			;
			if(options[typeID].statusSendCaptcha==2) return;
			options[typeID].statusSendCaptcha = 2;
			$.ajax({
				dataType: 'json',
				data: {
					action: 'SendCaptcha',
					type: typeID,
				},
				url: '/php/api.php',
				success: function(reply){
					if(reply.status){
						options[typeID].capcha_id = reply.result;
						options[typeID].statusSendCaptcha = 1;
					}
					else{
						that.sendLogs(reply);
						options[typeID].statusSendCaptcha = 0;
					}
				},
				error: function(jqxhr, status, errorMsg){
					options[typeID].statusSendCaptcha = 0;
				}
			});			
		},
		GetCaptchaCode: function(typeID){
			var   that = this
				, parent = this.elem
				, options = this.options
			;
			if(options[typeID].statusGetCaptchaCode==2) return;
			options[typeID].statusGetCaptchaCode = 2;
			setTimeout(function(){
				$.ajax({
					dataType: 'json',
					data: {
						action: 'GetCaptchaCode',
						type: typeID,
						capcha_id: options[typeID].capcha_id,
					},
					url: '/php/api.php',
					success: function(reply){
						if(reply.status){
							options[typeID].captcha_code = reply.result;
							options[typeID].statusGetCaptchaCode = 1;
						}
						else{
							that.sendLogs(reply);
							options[typeID].statusGetCaptchaCode = 0;
						}
					},
					error: function(jqxhr, status, errorMsg){
						options[typeID].statusGetCaptchaCode = 0;
					}
				});
			}, 10000);
		},
		CheckAuto: function(typeID){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $pristavi = parent.find('.rightCalcContainer').find('.headerBlock.pristavi')
			;
			if(options[typeID].statusCheckAuto==2) return;
			options[typeID].statusCheckAuto = 2;
			$.ajax({
				dataType: 'json',
				data: {
					action: 'CheckAuto',
					type: typeID,
					vin: options.vin,
					captcha: options[typeID].captcha_code,
					uuid: options[typeID].uuid,
				},
				url: '/php/api.php',
				success: function(reply){
					//that.sendLogs('time: ' + Math.ceil((performance.now() - options[typeID].time)/1000));
					$('.btnKnow').addClass('success');
					if(reply.status){
						that.showResult(reply.result, typeID);
					}
					else{
						if(typeID=='gibdd'){
							if(reply.result.status == 404){
								that.sendLogs(reply);
								that.showMessage('\
									<div class="titleErWin">Ваша машина не найдена в реестре</div>\
									<div class="textErWin">Перейти на сайт <a href="https://гибдд.рф/check/auto#" target="blank" class="gibddLink">ГИБДД</a></div>\
								');
								that.resetStatus(typeID);
							}
							else if(reply.result.status == 201){
								that.sendLogs(reply);
								// that.resetStatus(typeID);
								// that.start(typeID);
								that.showMessage('\
									<div class="titleErWin">' + reply.result.message + '</div>\
								');
								// that.resetStatus(typeID
								SendMail();
							}
							else{
								that.sendLogs(reply);
								that.showMessage('\
									<div class="titleErWin">' + reply.result.message + '</div>\
								');
								//that.resetStatus(typeID);
								//that.start(typeID);
								SendMail();
							}
						}
						else{
							if(reply.result.info.http_code == 404){
								//нотариальная палата вернула 404
							}
							else{
								that.resetStatus(typeID);
								that.start(typeID);
							}
							if(reply.result.list && reply.result.list.length>0){
								if(reply.result.list[0].pledgees && reply.result.list[0].pledgees[0]){
									//reply.result.list[0].pledgees[0].type
									$pristavi.find('.rightText').html(reply.result.list[0].pledgees[0].name);
									companyZalog = reply.result.list[0].pledgees[0].name;
									flagZaloga = true;
									
								}
							}
							else{
								$pristavi.find('.rightText').html('Автомобиль не находится в залоге...');
								flagZaloga = false;
								companyZalog = '';
							}
						}
					}
				},
				error: function(jqxhr, status, errorMsg){
					that.resetStatus(typeID);
					that.start(typeID);
				}
			});
		},
		GetAvitoMarkaModel: function(param){
			var   that = this
				, parent = this.elem
				, options = this.options
			;
			$.ajax({
				dataType: 'json',
				data: {
					action: 'GetAvitoMarkaModel',
					marka: param.marka,
					model: param.model,
				},
				url: '/php/api.php',
				success: function(reply){
					var avito_href = ''; var drom_href = '';
					if(reply.status == 2){
						avito_href = 'https://www.avito.ru/rossiya/avtomobili/'+reply.result.marka+'/'+reply.result.model+'?q='+param.year;
						
						if(reply.result.marka == 'vaz_lada') reply.result.marka = 'lada';
						
						drom_href = 'https://auto.drom.ru/'+reply.result.marka+'/'+reply.result.model+'/?minyear='+param.year+'&maxyear='+param.year;
					}
					else if(reply.status == 1){
						avito_href = 'https://www.avito.ru/rossiya/avtomobili/'+reply.result.marka+'?q='+param.model+' '+param.year;
						
						if(reply.result.marka == 'vaz_lada') reply.result.marka = 'lada';
						
						drom_href = 'https://auto.drom.ru/'+reply.result.marka+'/?minyear='+param.year+'&maxyear='+param.year;
					}
					else{
						avito_href = 'https://www.avito.ru/rossiya/avtomobili?q=' + param.marka + ' ' + param.model + ' ' + param.year;
					}
					$('a.link.avito').attr('href', avito_href);
					$('a.link.drom').attr('href', drom_href);
					that.GetAvitoFaindAuto({url: avito_href, status: reply.status, year: param.year, vehicle: param.vehicle});
					that.GetDromFaindAuto({url: drom_href, status: reply.status, year: param.year, vehicle: param.vehicle});
				}
			});
		},
		GetAvitoFaindAuto: function(param){
			var   that = this
				, parent = this.elem
				, options = this.options
			;
			//console.log(param.vehicle);
			if(param.status == 2 || param.status == 1){
				$.ajax({
					dataType: 'json',
					data: {
						action: 'GetAvitoFaindAuto',
						url: param.url,
						year: param.year,
					},
					url: '/php/api.php',
					success: function(reply){
						if(reply.status){
							$('a.link.avito').html('Avito ('+reply.result.count+')');
							var tempSumma = Math.ceil(reply.result.price/3);
							$('span.set_price').html(number_format(reply.result.price, 0, '.', ' ') + ' <span class="rub">Р</span>').attr('price', reply.result.price);
							$('span.set_credit').html(number_format(tempSumma, 0, '.', ' ') + ' <span class="rub">Р</span>');
							$('.SelectValue.price').mySlider({
								step: 1000,
								min: 1000,
								max: tempSumma,
								value: Summa<tempSumma ? Summa : tempSumma,
								disable: false,
								change: function(value){
									Summa = value;
									CalcCredit();
								},
							});
							$('.SelectValue.days').mySlider({
								step: 1,
								min: 1,
								max: 365,
								value: Days,
								disable: false,
								change: function(value){
									Days = value;
									CalcCredit();
									
									var   date = new Date()
										, options = {
											day: 'numeric',
											month: 'numeric',
											year: 'numeric',
										}
									;
									date = date.addDays(Days);
									date = date.toLocaleString("ru", options);
									$('.tPrice.date').html('Возвращаете до ' + date);
									
								},
							});
						}
						else{
							var price = $('span.set_price').attr('price');
							price = parseInt(price);
							if(!price){
								$('span.set_price').html('0 <span class="rub">Р</span>');
								$('span.set_credit').html('0 <span class="rub">Р</span>');
							}
							flagError = true;
							that.showMessage('\
								<div class="titleErWin">Информация по цене автомобиля не найдена</div>\
								<div class="textErWin">' + param.vehicle.model + ', ' + param.vehicle.year + '</div>\
								<div class="textErWin">Перейти на сайт <a href="https://www.avito.ru/rossiya/avtomobili" target="blank" class="gibddLink">Avito</a></div>\
								<div class="textErWin">Перейти на сайт <a href="https://auto.drom.ru" target="blank" class="gibddLink">Drom</a></div>\
							');
							$('.winPopupCalc').show();
						}
					}
				});
			}
			else{
				flagError = true;
				that.showMessage('\
					<div class="titleErWin">Информация по цене автомобиля не найдена</div>\
					<div class="textErWin">' + param.vehicle.model + ', ' + param.vehicle.year + '</div>\
					<div class="textErWin">Перейти на сайт <a href="https://www.avito.ru/rossiya/avtomobili" target="blank" class="gibddLink">Avito</a></div>\
					<div class="textErWin">Перейти на сайт <a href="https://auto.drom.ru" target="blank" class="gibddLink">Drom</a></div>\
				');
				$('.winPopupCalc').show();
			}
		},
		GetDromFaindAuto: function(param){
			var   that = this
				, parent = this.elem
				, options = this.options
			;
			if(param.status == 2 || param.status == 1){
				$.ajax({
					dataType: 'json',
					data: {
						action: 'GetDromFaindAuto',
						url: param.url,
						year: param.year,
					},
					url: '/php/api.php',
					success: function(reply){
						if(reply.status){
							$('a.link.drom').html('Drom ('+reply.result.count+')');
						}
					}
				});
			}
		},
		resetStatus: function(typeID){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $VIN = parent.find('input.VIN')
			;
			clearInterval(options[typeID].timer);
			options.statusGetProxy = false;
			flagError = true;
			options[typeID] = {
				statusGetUuid: 0,
				statusStart: 0,
				statusGetCaptcha: 0,
				statusSendCaptcha: 0,
				statusGetCaptchaCode: 0,
				statusCheckAuto: 0,
			};
			that.resetForm(typeID);
		},
		resetForm: function(typeID){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $VIN = parent.find('input.VIN')
				, $auto = parent.find('.rightCalcContainer').find('.lineContentBlock.auto.' + typeID)
				, $headerBlockPristavi = parent.find('.rightCalcContainer').find('.headerBlock.' + typeID)
			;
			that.showError('', 'ok');
			$auto.find('.textAuto.marka').html('');
			$auto.find('.textAuto.year').html('');
			$headerBlockPristavi.find('.rightText').html('');
			$('span.set_price.' + typeID).html('0 <span class="rub">Р</span>');
			$('span.set_credit.' + typeID).html('0 <span class="rub">Р</span>');
			$VIN.attr('disabled', false);
		},
		startForm: function(typeID){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $VIN = parent.find('input.VIN')
				, $auto = parent.find('.rightCalcContainer').find('.lineContentBlock.auto.' + typeID)
				, $headerBlockPristavi = parent.find('.rightCalcContainer').find('.headerBlock.' + typeID)
			;
			$auto.find('.textAuto.marka').html('<img src="/img/loader.gif" />');
			$auto.find('.textAuto.year').html('<img src="/img/loader.gif" />');
			$headerBlockPristavi.find('.rightText').html('<img src="/img/loader.gif" />');
			$('span.set_price.' + typeID).html('<img src="/img/loader.gif" />');
			$('span.set_credit.' + typeID).html('<img src="/img/loader.gif" />');
			$VIN.attr('disabled', true);
		},
		isEng: function(text){
			if(typeof(text)!='string') return;
			if(text.search(/[A-z]/) === -1){
				return false;
			}
			else{
				return true;
			}
		},
		toEn: function(text){
			var   that = this
				, parent = this.elem
				, options = this.options
			;
			text = text && text
				.toUpperCase()
				.replace(/А/igm, 'A')
				.replace(/В/igm, 'B')
				.replace(/Е/igm, 'E')
				.replace(/К/igm, 'K')
				.replace(/М/igm, 'M')
				.replace(/Н/igm, 'H')
				.replace(/О/igm, 'O')
				.replace(/Р/igm, 'P')
				.replace(/С/igm, 'C')
				.replace(/Т/igm, 'T')
				.replace(/У/igm, 'Y')
				.replace(/Х/igm, 'X');
			return text;
		},
		errorDataForm: function(typeID){
			var   that = this
				, parent = this.elem
				, options = this.options
				, vin = parent.find('input.VIN').val()
				, phone = parent.find('input.phone').val()
				, error = false
			;
			options.vin = that.toEn(vin);
			if(options.vin.length < 7){
				that.showError('Введите VIN, номер кузова или номер шасси.');
				error = true;
			}
			else{
				that.showError('');
			}
			if(phone.length < 7){
				$('.errorText.phone').html('Введите Ваш номер телефона');
				error = true;
			}
			else{
				$('.errorText.phone').html('');
			}
			if(options[typeID].count <= 0){
				that.showMessage('\
					<div class="titleErWin">Сервис '+ typeID +' временно не работает</div>\
					<div class="textErWin">попробуйте позже</div>\
				');
				error = true;
			}
			if(error) return true;
			return false;
		},
		showError: function(text, status){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $showError = parent.find('.showError')
			;
			if(status==undefined || status=='error'){
				$showError.parent().addClass('error');
			}
			else{
				$showError.parent().removeClass('error');
			}
			$showError.html(text);
		},
		showMessage: function(html){
			$('.winPopupCalc .erWin .contentErWin').html(html);
		},
		showResult: function(result, typeID){
			var   that = this
				, parent = this.elem
				, options = this.options
				, $showError = parent.find('.showError')
				, $auto = parent.find('.rightCalcContainer').find('.lineContentBlock.auto')
				, $pristavi = parent.find('.rightCalcContainer').find('.headerBlock.pristavi')
			;
			if(typeID=='gibdd'){
				if(result.status == 200){
					var vehicle = result.RequestResult.vehicle;
					$auto.find('.textAuto.marka').html(vehicle.model);
					$auto.find('.textAuto.year').html(vehicle.year);
					
					var marca_model = vehicle.model.split(' ');
					if(that.isEng(marca_model[0])){
						marca_model[0] = that.toEn(marca_model[0]).toLowerCase();
					}
					if(that.isEng(marca_model[1])){
						marca_model[1] = that.toEn(marca_model[1]).toLowerCase();
					}
					that.GetAvitoMarkaModel({
						marka: marca_model[0],
						model: marca_model[1],
						year: vehicle.year,
						vehicle: vehicle,
					});
					$('.winPopupCalc').hide();
				}
				else if(result.status == 404){
					that.showMessage('\
						<div class="titleErWin">Ваша машина не найдена в реестре</div>\
						<div class="textErWin">Перейти на сайт <a href="https://гибдд.рф/check/auto#" target="blank" class="gibddLink">ГИБДД</a></div>\
					');
					that.resetStatus(typeID);
				}
				else if(result.status == 201){
					that.showMessage('\
						<div class="titleErWin">' + result.message + '</div>\
					');
					//that.resetStatus(typeID);
					//that.start(typeID);
					SendMail();
				}
				else{
					that.showMessage('\
						<div class="titleErWin">' + result.message + '</div>\
					');
					//that.resetStatus(typeID);
					//that.start(typeID);
					SendMail();
				}
				
			}
			else if(typeID=='pristavi'){
				if(result.list && result.list.length>0){
					if(result.list[0].pledgees && result.list[0].pledgees[0]){
						//result.list[0].pledgees[0].type
						$pristavi.find('.rightText').html(result.list[0].pledgees[0].name);
						companyZalog = result.list[0].pledgees[0].name;
						flagZaloga = true;
					}
				}
				else{
					$pristavi.find('.rightText').html('Автомобиль не находится в залоге...');
					flagZaloga = false;
					companyZalog = '';
				}
			}
		},
		sendLogs: function(logs){
			var   that = this
				, parent = this.elem
				, options = this.options
			;
			if(options.flagSendLogs) console.log(logs);
		},
		GetTime: function(){
			var   that = this
				, parent = this.elem
				, options = this.options
				, curent_time = Math.ceil((performance.now() - options.time)/1000)
				, hh = curent_time - curent_time % 3600
				, mm = curent_time % 3600 - curent_time % 60
				, ss = curent_time % 60
			;
			if(mm/60>=3){
				clearInterval(options.clock);
				clearInterval(options['gibdd'].timer);
				clearInterval(options['pristavi'].timer);
				// that.showMessage('\
					// <div class="titleErWin">Сервис проверки автомобиля временно не работает</div>\
					// <div class="textErWin">оформите заявку или попробуйте позже</div>\
				// ');
				// flagError = true;
				// $('.btnKnow').addClass('success');
				SendMail();
				return false;
			}
			return zeroPad(hh/3600, 2) + ':' + zeroPad(mm/60, 2) + ':' + zeroPad(ss, 2);
		},
	});
	$.fn.GetAutoInfo = function(params){
		if(typeof params=='string'){
			var instance = $(this).data('GetAutoInfo');
			var args = Array.prototype.slice.call(arguments,1);
			return instance[params].apply(instance,args);
		}
		else{
			return this.each(function(){
				var instance = $(this).data('GetAutoInfo');
				if(instance){
					if(params){
						$.extend(instance.options,params);
					}
					instance.init();
				}
				else{
					$(this).data('GetAutoInfo',new $.GetAutoInfo(this,params));
				}
			});
		}
	};
})(jQuery);

function CalcCredit(){
	var daysInMonth = new Date().daysInMonth();
	var daysInYear = new Date().daysInYear();
	//var SummaProcent = (Summa*Procent*daysInMonth)/(100*daysInYear);
	//var SummaProcent = Summa*Procent*Days;
	
	var $priceDay = Summa*Procent;
	var $priceAll = $priceDay * Days;
	
	
	$('span.priceMonth').html(number_format($priceDay * Math.min(30, Days), 0, '.', ' ') + ' <span class="rub">Р</span>');
	$('span.priceAll').html(number_format($priceAll + Summa, 0, '.', ' ') + ' <span class="rub">Р</span>');
}

function Logs(action){
	var that = this;
	that.action = action;
	that.message = [];
	that.add = function(message){
		that.message.push(message);
		return that;
	}
	that.show = function(){
		console.group(that.action);
			$.each(that.message, function(i, el){
				console.log(el);
			});
		console.groupEnd();
		return that;
	}
}

function SendMail(){
	var   message = {
			vin: $('.inp.VIN').val(),
			phone: $('.inp.phone').val(),
			summa: Summa,
			days: Days,
			flagZaloga: flagZaloga,
			companyZalog: companyZalog,
		}
		, error = false
	;
	
	if(flagSendMail) return;
	
	if($('.btnKnow').hasClass('success')){
		if(message.vin.length < 7){
			$('.showError.vin').html('Введите VIN, номер кузова или номер шасси');
			error = true;
			$('body,html').animate({scrollTop: $('.attention').offset().top}, 1500);
		}
		if(message.phone.length < 7){
			$('.errorText.phone').html('Введите Ваш номер телефона');
			error = true;
			$('body,html').animate({scrollTop: $('.attention').offset().top}, 1500);
		}
		if(flagZaloga){
			//error = true;
			flagError = true;
			$('.winPopupCalc .erWin .contentErWin').html('\
				<div class="titleErWin">Ваш автомобиль находится в залоге:</div>\
				<div class="textErWin">'+ companyZalog +'</div>\
			');
			$('.winPopupCalc').show();
			$('body,html').animate({scrollTop: $('.attention').offset().top}, 1500);
		}
		if(error) return false;
		flagSendMail = true;
		$.ajax({
			data: message,
			url: '/php/send.php',
			success: function(reply){
				$('.glassPopup.SM').removeClass('open');
				$('.glassPopup.UR').addClass('open');
				flagSendMail = true;
			}
		});
	}
}

function SendMail2(){
	var   message = {
			vin: $('.inp.VIN').val(),
			phone: $('.inp.phone').val(),
			summa: Summa,
			days: Days,
			flagZaloga: flagZaloga,
			companyZalog: companyZalog,
		}
	;
	$.ajax({
		data: message,
		url: '/php/send.php',
		success: function(reply){}
	});
}

function SendMailSM(){
	var   message = {
			name: $('.inp.smName').val(),
			phone: $('.inp.smPhone').val(),
		},
		error = false;
	;
	if(message.name.length == ''){
		$('.inp.smName').addClass('error');
		error = true;
	}
	else{
		$('.inp.smName').removeClass('error');
	}
	if(message.phone.length < 7){
		$('.inp.smPhone').addClass('error');
		error = true;
	}
	else{
		$('.inp.smPhone').removeClass('error');
	}
	if(error) return false;
	$.ajax({
		data: message,
		url: '/php/sendSM.php',
		success: function(reply){
			$('.glassPopup.SM').removeClass('open');
			$('.glassPopup.UR').addClass('open');
		}
	});
}