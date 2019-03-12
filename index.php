<?php
	session_start();
	$_SESSION['SSID'] = session_id();
	include 'config.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="format-detection" content="telephone=no">
		<title>Займ денег под залог ПТС в Йошкар-Оле – автоломбард «Магазин Денег»</title>
		<meta name="description" content="Деньги под залог ПТС в Йошкар-Оле. Нужно всего 3 документа. Авто остается у Вас! Решение за 5минут!! От 1000 до 500 т.р. Оставляйте заявку!">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="reset.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<script src="/js/jquery-3.3.1.min.js"></script>
		<script id="api_maps_yandex" src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
		<script src="/js/inputmask.js"></script>
		<script src="/js/inputmask.phone.extensions.js"></script>
		<script src="/js/jquery.inputmask.js"></script>
		<script src="/js/app.js"></script>
		<script>var Procent = <?php echo $Procent;?>/100;</script>
  <style>
   p {
    position: relative;
	float: left;
	width: 100%;
	color: #1f1f1f;
	font-size: 20px;
	font-family: OpenSans-Regular;
	line-height: 1.3em;
	margin-top: 10px;
	box-sizing: border-box;
	padding-left: 12px;
   }

h1, h2, h3 {
	position: relative;
	float: left;
	width: 100%;
	color: #1f1f1f;
	font-size: 30px;
	font-family: OpenSans-Semibold;
	line-height: 1.3em;
	margin-top: 10px;
	box-sizing: border-box;
	padding-left: 12px;
	}

  </style>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter50366932 = new Ya.Metrika2({
                    id:50366932,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/50366932" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	</head>
	<body>
		<div class="glassPopup UR">
			<div class="winPopup">
				<div class="closePopup"></div>
				<div class="contentPopup">
					<div class="title">Спасибо!</div>
					<div class="subtitle">Ваше обращение отправлено</div>
					<div class="text">Наш менеджер свяжется с Вами в ближайшее время</div>
				</div>
			</div>
		</div>
		<div class="glassPopup INFO">
			<div class="winPopup">
				<div class="closePopup"></div>
				<div class="contentPopup">
					<div class="title"></div>
					<div class="text"></div>
				</div>
			</div>
		</div>
		<div class="glassPopup SM">
			<div class="winPopup">
				<div class="closePopup"></div>
				<div class="contentPopup">
					<div class="subtitle">Оставьте заявку</div>
					<div class="lineInput">
						<div class="labbel">Ваше имя</div>
						<input class="inp smName" />
					</div>
					<div class="lineInput">
						<div class="labbel">Ваш телефон</div>
						<input class="inp smPhone" />
					</div>
					<div class="lineBtn">
						<button class="sendBtn">Отправить</button>
					</div>
					<div class="lineCheck">
						<div class="checkS"></div>
						<div class="textCh">Отправляя заявку я даю согласие на обработку персональных данных</div>
					</div>
				</div>
			</div>
		</div>
		<section class="wrap">
			<section class="work">
				<section class="header">
					<div class="headerContent">
						<a href="/" class="logo"></a>
						<div class="rightH">
							<span class="phone">8(8362) 333-070</span>
							<span class="regim">с 9:00 до 18:00 по Московскому времени</span>
						</div>
					</div>
				</section>
				<section class="menuSection">
					<div class="home"></div>
					<nav class="mainMenu">
						<div class="btnMainMenu"></div>
						<ul class="listMainMenu">
							<span class="closeMMEnu"></span>
							<li class="toTake"><span>Как взять займ?</span></li>
							<li class="toRepay"><span>Как погасить займ?</span></li>
							<li class="condition"><span>Условия договора</span></li>
							<li><span>Личный кабинет</span></li>
							<li><span href="#docsSection">Документы</span></li>
						</ul>
					</nav>
				</section>
				<section class="broadcrumbs">
					<ul class="listBroadcrumbs">
						<li>Главная</li>
						<li>Займ под ПТС</li>
					</ul>
				</section>
				<section class="submenu">
					<ul class="listSubmenu">
						<li><span href="#conditionSection">Условия выдачи</span></li>
						<li><span href="#workSection">как это работает</span></li>
						<li><span href="#parthners">Партнерам</span></li>
						<li><span href="#contactsSection">Контакты</span></li>
					</ul>
				</section>
				<div class="bitTitle">займ под залог паспорта транспортного средства</div>
				<div class='attention'><span>Ваш Автомобиль остается у Вас</span></div>
				<section class="calcSection CheckAutoToVIN">
					<div class="leftCalc">
						<div class="lineInput">
							<div class="title">Введите VIN вашего автомобиля</div>
							<span class="errorText showError vin"></span>
							<span class="tooltip CheckAuto">Проверить на сайте ГИБДД</span>
							<div class="input vinc">
								<input class="inp VIN" />
								<div class="vinBtnOk" title="Нажимая на кнопку Вы подтвержаете свое согласие на обработку личных данных"></div>
							</div>
						</div>
						<div class="lineInput">
							<span class="tooltip wu">1/3 от стоимости вашего авто</span>
							<div class="title">Сумма займа</div>
							<div class="SelectValue price">
								<span class="leftValue">от <span class="ld">0</span> <span class="rub">Р</span></span>
								<span class="rightValue">до <span class="rd">200 000</span> <span class="rub">Р</span></span>
								<div class="clickLine"></div>
								<div class="runLineBG">
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
								</div>
								<div class="selectShow"></div>
								<div class="run">
										<input class="digit" value="1 000" type="text" />
										<span class="rub">Р</span>
										<div class="minus">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="8" height="11.719" viewBox="0 0 8 11.719">
											  <path d="M7.989,10.367 L6.648,11.708 L0.011,6.071 L1.352,4.730 L1.473,4.832 L6.293,0.011 L7.707,1.426 L3.002,6.131 L7.989,10.367 Z" class="cls-1"/>
											</svg>
										</div>
										<div class="plus">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="8" height="12" viewBox="0 0 8 12">
											  <path d="M7.989,6.216 L1.352,11.988 L0.011,10.616 L4.998,6.278 L0.293,1.460 L1.707,0.012 L6.527,4.948 L6.648,4.843 L7.989,6.216 Z" class="cls-1"/>
											</svg>
										</div>
								</div>
							</div>
						</div>
						<div class="lineInput">
							<div class="title">Срок займа</div>
							<div class="SelectValue days">
								<span class="leftValue">от <span class="ld">5</span> дней</span>
								<span class="rightValue">до <span class="rd">364</span> дней</span>
								<div class="clickLine"></div>
								<div class="runLineBG">
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
									<span class="separator"></span>
								</div>
								<div class="selectShow"></div>
								<div class="run">
										<input class="digit days" value="1" type="text" />
										<span>ДНЕЙ</span>
										<div class="minus">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="8" height="11.719" viewBox="0 0 8 11.719">
											  <path d="M7.989,10.367 L6.648,11.708 L0.011,6.071 L1.352,4.730 L1.473,4.832 L6.293,0.011 L7.707,1.426 L3.002,6.131 L7.989,10.367 Z" class="cls-1"/>
											</svg>
										</div>
										<div class="plus">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="8" height="12" viewBox="0 0 8 12">
											  <path d="M7.989,6.216 L1.352,11.988 L0.011,10.616 L4.998,6.278 L0.293,1.460 L1.707,0.012 L6.527,4.948 L6.648,4.843 L7.989,6.216 Z" class="cls-1"/>
											</svg>
										</div>
								</div>
							</div>
						</div>
						<div class="lineInput">
							<div class="title">Ваш телефон</div>
							<span class="errorText phone"></span>
							<div class="input">
								<input class="inp phone" />
							</div>
						</div>
					</div>
					<div class="rightCalc">
						<div class="rightCalcContainer">
							<div class="winPopupCalc">
								<div class="erWin">
									<div class="contentErWin">
										<div class="titleErWin">Для проверки вашего автомобиля</div>
										<div class="textErWin">введите его VIN-код</div>
									</div>
								</div>
							</div>
							<div class="headerBlock pristavi">
								<div class="leftText">Данное имущество находится в залоге у</div>
								<div class="rightText"></div>
							</div>
							<div class="contentBlock">
								<div class="lineContentBlock auto gibdd">
									<span class="titAuto">Марка:</span>
									<span class="textAuto marka"></span>
									<span class="titAuto">Год выпуска:</span>
									<span class="textAuto year"></span>
								</div>
								<div class="lineContentBlock"><span class="titleLine">Средняя рыночная стоимость вашего авто:</span></div>
								<div class="lineContentBlock flex">
									<span class="price set_price gibdd">0 <span class="rub">Р</span></span>
									<div class="linePars">
										<span class="info">Авто по такой же цене на</span>
										<a class="link avito" target="blank">Avito (0)</a>
										<a class="link drom" target="blank">Drom (0)</a>
									</div>
								</div>
								<div class="lineContentBlock"><span class="titleLine">Сумма займа до:</span></div>
								<div class="lineContentBlock">
									<span class="price set_credit gibdd">0 <span class="rub">Р</span></span>
									<span class="info short">Максимальная сумма займа равна 1/3 рыночной стоимости вашего авто</span>
								</div>
								<div class="footerBlock">
									<div class="halfFooter">
										<span class="tPrice">Ежемесячный платеж по погашению процентов состовляет от:</span>
										<span class="price priceMonth">0 <span class="rub">Р</span></span>
									</div>
									<div class="halfFooter">
										<span class="tPrice date"></span>
										<span class="price priceAll">0 <span class="rub">Р</span></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="lineBtnCalc"><button class="btnKnow" onclick="yaCounter50366932.reachGoal('KNOPKA_VIN'); return true;">Узнать решение</button></div>
				</section>
				<div id="conditionSection" class="bitTitle">Условия выдачи</div>
				<section class="conditionSection">
					<div class="leftPartCondition">
						<div class="conditionBlock">
							<div class="title docs">Документы</div>
							<ul class="listConditions">
								<li>Свидетельство о регистрации транспортного средства</li>
								<li>ПТС</li>
								<li>Паспорт</li>
							</ul>
						</div>
						<div class="conditionBlock">
							<div class="title srok">Срок погашения займа</div>
							<ul class="listConditions">
								<li>От 1 до 365 дней</li>
							</ul>
						</div>
					</div>
					<div class="rightPartCondition">
						<div class="conditionBlock">
							<div class="title treb">Требования</div>
							<ul class="listConditions">
								<li>Возраст от 18 лет</li>
								<li>Вы собственник автомобиля</li>
								<li>Автомобиль не обременен залогом и иными правами третьих лиц</li>
							</ul>
						</div>
						<div class="conditionBlock">
							<div class="title summa">Сумма</div>
							<ul class="listConditions">
								<li>От 1000 до 500 000 <span class="rub">Р</span></li>
							</ul>
						</div>
					</div>
					<div class="infoCondition">
						<div class="infop">Без подтверждения доходов</div>
						<div class="infop">Без переоформления прав собственности</div>
						<div class="infop">Без запроса в бюро кредитных историй</div>
						<div class="infop">Без помещения на стоянку</div>
					</div>
				</section>
<h1>Выгодный залог Авто под птс на индивидуальных условиях</h1>
<p>Срочно понадобились деньги? Есть авто? Возьмите займ под птс в компании "Магазин денег"! Машина остается в вашем распоряжении. Минимум документов и времени на оформление, 0% отказов, удобная система расчета. Кредитная история или справки 2НДФЛ не интересуют компанию. Не имеет значение финансовый доход.</p>
<h2>Успейте оформить!</h2>
<p>Клиентам с плохой историей часто отказывают банки в предоставлении заемных средств. Получить наличные непросто даже с хорошей КИ. Так же требуется собрать портфель документов, доказать платежеспособность. Можно посетить любой автоломбард в Йошкар - Оле, но и тут существуют определенные риски: высокие проценты, отсутствие пролонгации, заниженная рыночная стоимость вашего транспортного средства.
Обращайтесь в надежную организацию, такую как "Магазин денег". Компания успешно развивается с 2016 года, предлагая заемщикам лояльные и выгодные условия сделки. Деятельность фирмы вышла за пределы столицы и распространилась на соседние регионы республики. На ее счету 58 представителей. Становитесь клиентом компании с большим будущем.
Чтобы снизить риски и получить деньги в залог птс, воспользуйтесь реальным предложением от надежной фирмы. Авто остается в вашей собственности. Вы можете его сдать на охраняемую стоянку, продлить срок или реструктуризировать заем. Условия разбираются в индивидуальном порядке. А чтобы не тратить время, проверьте авто по ВИН (уникальному идентификатору). Введите VIN вашего транспортного средства и номер телефона в форму на сайте. Программа автоматически соберет данные об автотранспорте: находится ли он в аресте, ДТП, имеются ли табу на регистрацию в ГИБДД. Так же система просканирует ОСАГО, серию и номер документа, количество владельцев.</p>
<p>•	Без длинных очередей!</p>
<p>•	Без кипы справок!</p>
<p>•	Без скрытых процентов!</p>
<p>•	Без подтверждения дохода!</p>
<p>•	Без переоформления права собственности!</p>
<p>Вы получаете выгодный кредит под птс автомобиля в Йошкар - Оле! Обращайтесь, если вас интересуют прозрачные сделки и низкие проценты.</p>
<h2>Честная политика</h2>
<p>Организация выдает микрозаймы под любые виды техники с ПТС или ПСМ:</p>
<p>•	Легковые, грузовые автомобили;</p>
<p>•	мотоциклы, квадроциклы;</p>
<p>•	прицепы, снегоходы.</p>
<p>«Магазин денег» - ваш выбор. Средства поступят на счет в течение 5 минут. От вас требуется паспорт, ПТС и свидетельство регистрации ТС. Срок погашения выбираете вы - от 1 до 365 дней.
Вам больше 18 лет? Вы владелец автотехники, не обремененной долговыми и прочими обязательствами? Получите от 1000 до 500 000 рублей прямо сейчас! Осталось заполнить анкету и узнать решение! Скорее жми кнопку.</p>




				<span id="workSection" class="bitTitle">Как это работает</span>
				<section class="workSection">
					<div class="stepWork">
						<div class="tr">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="66" height="134" viewBox="0 0 66 134">
								<filter id="dropShadow">
									<feGaussianBlur in="SourceAlpha" stdDeviation="2.2"/>
	                <feOffset dx="1" dy="1" result="offsetblur"/>
	                <feFlood flood-color="rgba(0,0,0,0.3)"/>
	                <feComposite in2="offsetblur" operator="in"/>
	                <feMerge>
	                        <feMergeNode/>
	                        <feMergeNode in="SourceGraphic"/>
	                </feMerge>
								</filter>
							  <path d="M66.000,67.000 L0.000,134.000 L0.000,0.000 L66.000,67.000 Z" class="cls-1"/>
							</svg>
						</div>
						<div class="tr2">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="66" height="134" viewBox="0 0 66 134">
							  <path d="M66.000,67.000 L0.000,134.000 L0.000,0.000 L66.000,67.000 Z" class="cls-2"/>
							</svg>
						</div>
						<span class="text">
								<div class="ltext">Заполните простую<span class="st">Анкету</span></div>
						</span>
					</div>
					<div class="stepWork">
						<div class="tr">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="66" height="134" viewBox="0 0 66 134">
								<filter id="dropShadow">
									<feGaussianBlur in="SourceAlpha" stdDeviation="2.2"/>
									<feOffset dx="1" dy="1" result="offsetblur"/>
									<feFlood flood-color="rgba(0,0,0,0.3)"/>
									<feComposite in2="offsetblur" operator="in"/>
									<feMerge>
													<feMergeNode/>
													<feMergeNode in="SourceGraphic"/>
									</feMerge>
								</filter>
								<path d="M66.000,67.000 L0.000,134.000 L0.000,0.000 L66.000,67.000 Z" class="cls-1"/>
							</svg>
						</div>
						<div class="tr2">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="66" height="134" viewBox="0 0 66 134">
								<path d="M66.000,67.000 L0.000,134.000 L0.000,0.000 L66.000,67.000 Z" class="cls-2"/>
							</svg>
						</div>
						<span class="text">
							<div class="ltext">Узнайте<span class="st">Решениие</span></div>
						</span>
					</div>
					<div class="stepWork">
						<span class="text">
							<div class="ltext">Получите деньги<span class="st">в течении 5 минут</span></div>
						</span>
					</div>
				</section>
				<section class="textInfo">
					<div class="textInfoBlock">ИНН 1215209808, КПП 121501001, ОГРН 1161215054835; Рег. номер свидетельства: 001603388007809, дата включения в реестр 07.06.2016,
						является членом Саморегулируемой организации Союза микрофинансовых организаций «Единство», действует на основании Федерального закона № 151-ФЗ
						«О микрофинансовой деятельности и микрофинансовых организациях», Федерального закона № 353 «О потребительском кредите (займе)».</div>
					<div class="textInfoBlock">Общество с ограниченной ответственностью «Микрокредитная компания «Магазин Денег»
						Займ предоставляется гражданам РФ в возрасте от 18 лет, обладающих полной дееспособностью, имеющих постоянную регистрацию
						на территории РФ, имеющих в собственности транспортное средство. Без справок о доходе и поручителей. Срок рассмотрения - 1 день.
						Срок погашения займа - от 1 до 365 дней.
					</div>
					<div class="textInfoBlock">Сумма займа - от 1000 до 500000 руб. Процентная ставка от 60 до 84 % годовых или от 0,16 до 0,23 % в день.
						Расчет процентов за пользование займом производится каждый день по фиксированной ставке на фактический остаток задолженности по возврату основной
						суммы займа. Юр. адрес: 424000, Республика Марий Эл, г. Йошкар-Ола, ул. Красноармейская, д.42, помещение 1, сайт: https://shopfinance.ru
					</div>
				</section>
				<span id="parthners" class="bitTitle">Партнёрам</span>
				<section class="forParthners">
					<div class="parthners">
						<span class="title">Получите стабильный поток клиентов</span>
						<div class="text">Добавьте нашу услугу в список ваших продуктов и увеличивайте поток клиентов в среднем на 30%! Всю рекламную активность мы берем на себя.</div>
					</div>
					<div class="parthners">
						<span class="title">Увеличьте дополнительную прибыль</span>
						<ul class="text">
								<li>агентское вознаграждение по каждой сделке;</li>
								<li>повторное обращение клиентов;</li>
								<li>возможности для развития бизнеса путем инвестиций в понятную бизнес-модель МКК "Авто Агент"</li>
						</ul>
					</div>
				</section>
				<section class="advantages">
					<div class="title">7 уникальных преимуществ:</div>
					<ul class="listAdvantages">
						<li>Расширение линейки продуктов</li>
						<li>Увеличение клиентской базы</li>
						<li>Долгосрочная перспектива сотрудничества</li>
						<li>Дополнительные возможности заработка</li>
						<li>Бесплатное обучение сотрудников</li>
						<li>Удобные IT решения</li>
						<li>Деловая репутация</li>
					</ul>
				</section>
				<div class="lineBtnCalc mt"><button class="btnSO" onclick="yaCounter50366932.reachGoal('ZAYVKA'); return true;" >Оставить заявку</button></div>
				<span id="faqSection" class="bitTitle">Вопросы и ответы</span>
				<section class="faqSection">
					<ul class="faqList">
						<li>Влияет ли кредитная история на решение о выдаче микрозайма?
							<div class="answer"><span>Ответ:</span>Компания лояльно относится к кредитной истории заемщиков, главное чтобы Ваш автомобиль не числился в реестре залогов и не был обременен залогом и иными правами третьих лиц, не обременен никаким иным образом. Каждая заявка рассматривается индивидуально.</div>
						</li>
						<li>Вносится ли какие – либо запись в ПТС/ПСМ транспортного средства?
							<div class="answer"><span>Ответ:</span>Нет, в ПТС транспортного средства или ПСМ самоходной машины никакие записи компанией не вносятся.</div>
						</li>
						<li>Где происходит оформление микрозайма?
							<div class="answer"><span>Ответ:</span>Оформление документов на микрозайм происходит в офисе компании по адресу указанному на нашем сайте.</div>
						</li>
						<li>Как и в каком виде микрозайм получает заемщик?
							<div class="answer"><span>Ответ:</span>После подписания договоров, Вы получаете микрозайм наличными денежными средствами в офисе компании, либо перечислением по представленными Вами реквизитам.</div>
						</li>
						<li>Можно ли досрочно или частично погасить микрозайм?
							<div class="answer"><span>Ответ:</span>Да, Вы можете досрочно погасить микрозайм. Если Вы частично погашаете сумму микрозайма, то сумма процентов пересчитывается на остаток фактической задолженности. </div>
						</li>
					</ul>
				</section>
				<div id="contactsSection" class="bitTitle">Контакты <span>ООО «МКК « МАГАЗИН ДЕНЕГ»</span></div>
				<section class="contactsSection">
					<ul class="listContacts">
						<li>
							<h3 class="title">Почтовый адрес</h3>
							<div class="text">424000, Республика Марий Эл,<br> г. Йошкар-Ола, ул. Красноармейская,<br> д. 42, помещение 1</div>
						</li>
						<li>
							<h3 class="title">Юридический адрес</h3>
							<div class="text">424000, Республика Марий Эл,<br> г. Йошкар-Ола, ул. Красноармейская,<br> д. 42, помещение 1</div>
						</li>
						<li>
							<h3 class="title">Контактный телефон</h3>
							<div class="text">
								<div class="phone">+7 (927) <span>883-30-70</span></div>
								<div class="phone">+7 (902) <span>107-41-98</span></div>
							</div>
						</li>
					</ul>
					<div class="licenz"><img src="images/licenz.jpg" /></div>
				</section>
			</section>
		</section>
		<section class=" wrap docsSection" id="docsSection">
			<section class="work">
				<div id="conditionSection" class="bitTitle">Наши документы</div>
				<div class="docsListContainer">
					<div class="leftDocsList">
						<h2 class="TitleDocsList">Учредительные документы</h2>
						<ul class="DocsList">
							<li><a href="/pdf/Ustav-new-1.pdf" target="_blank">Устав ООО «МКК «Магазин Денег»</a></li>
							<li><a href="/pdf/sv-vo_nalog.pdf" target="_blank">Свидетельство о постановке на учет в налоговом органе</a></li>
							<li><a href="/pdf/1svidetelstvo_o_vnes.pdf" target="_blank">Свидетельство о внесении изменений о юр.лице в гос реестр МФО</a></li>
							<li><a href="/pdf/list-zapici-egrul.pdf" target="_blank">Лист записи ЕГРЮЛ</a></li>
						</ul>
						<h2 class="TitleDocsList">Документация</h2>
						<ul class="DocsList">
							<li><a href="/pdf/politika_PDn.pdf" target="_blank">Политика в отношении обработки персональных данных</a></li>
							<li><a href="/pdf/1svidetelstvo_sro.pdf" target="_blank">Свидетельство СРО</a></li>
							<li><a href="/pdf/inf-o-licax222.pdf" target="_blank">Информация о лицах, оказывающих существенное (прямое или косвенное) влияние на решения, принимаемые органами управления Общества</a></li>
							<li><a href="/pdf/obch_uslov_pred_zaima.pdf" target="_blank">Общие условия договора потребительского займа</a></li>
							<li><a href="/pdf/prav_predost_zaimov.pdf" target="_blank">Правила предоставления, пользования и возврата потребительских займов ООО МКК Магазин Денег</a></li>
							<li><a href="/pdf/obsch_uslov_s_obespech.pdf" target="_blank">Общие условия договора микрозайма с обеспечением</a></li>
							<li><a href="/pdf/microzaim_s_obespech.pdf" target="_blank">Правила предоставления, пользования и возврата микрозаймов с обеспечением ООО МКК Магазин Денег</a></li>
						</ul>
					</div>
					<div class="rightDocsList">
						<h2 class="TitleDocsList">Решения</h2>
						<ul class="DocsList">
							<li><a href="/pdf/vipiskresh3.pdf" target="_blank">Выписка из решения участника №3 от 09 декабря 2016г.</a></li>
							<li><a href="/pdf/vipiskresh4.pdf" target="_blank">Выписка из решения участника №4 от 28 декабря 2016г.</a></li>
							<li><a href="/pdf/vipiskresh5.pdf" target="_blank">Выписка из решения участника №5 от 21 марта 2017г.</a></li>
							<li><a href="/pdf/vipiskresh6.pdf" target="_blank">Выписка из решения участника №6 от 07 апреля 2017г.</a></li>
							<li><a href="/pdf/vipiskresh7.pdf" target="_blank">Выписка из решения участника №7 от 18 июля 2017г.</a></li>
							<li><a href="/pdf/vipiskresh8.pdf" target="_blank">Выписка из решения участника №8 от 18 июля 2017г.</a></li>
						</ul>
					</div>
				</div>
			</section>
		</section>
		<section class="wrap">
			<div id="maps_yandex"></div>
		</section>
		<section class="wrap">
			<section class="work">
				<div class="recvizits">
					<ul>
						<li><span>ИНН</span> 1215209808</li>
						<li><span>КПП</span> 121501001</li>
						<li><span>Банк </span> Отделение Марий Эл №8614 ПАО Сбербанк</li>
						<li><span>Расчётный счёт</span> 40701810037000000022</li>
						<li><span>БИК</span> 048860630</li>
						<li><span>ОГРН</span> 1161215054835</li>
						<li><span>ОКВЭД</span> 64.92</li>
						<li><span>Корр.счёт</span> 30101810300000000630</li>
						<li><span>ОКПО</span> 02058713</li>
						<li><span>Е-майл</span> info@shopfinance.ru</li>
					</ul>
				</div>
				<div class="footer">
					<span class="leftFooter">© МКК "Авто Агент" 2018. Все права защищены</span>
					<span class="rightFooter">Created by Alfabirds</span>
				</div>
			</section>
		</section>
	</body>
</html>
