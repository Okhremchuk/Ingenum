<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
$tFolder=$_SERVER["DOCUMENT_ROOT"].'/bitrix/templates/.default/components/bitrix/sale.order.ajax/deliveryLiberty';
//$APPLICATION->SetAdditionalCSS($templateFolder."/style_cart.css");
//$APPLICATION->SetAdditionalCSS($templateFolder."/style.css");
require 'util.php';
$arCssScr=array('style_cart','style');
?>

<style type="text/css">
	<? 
		foreach($arCssScr as $css){
				if(file_exists($tFolder."/$css.css")){
					$cnt=util::loadFile($tFolder."/$css.css");
					echo $cnt;
					}else{
						echo "Not file ".$tFolder."/$css.css<br />";
					}
			}
	?>
	.bx-touch .quantity_control{ display: none; }
.bx_ordercart .bx_sort_container a.current {
		color: #fff;
		background-color: #f58706;
	}
.bx_ordercart .bx_sort_container a.current:hover {background:#000;}
.titleMain,.ltTitleMain{
	display: inline-block;
	text-shadow: 0 0 1px #f6f6f6;
	border-bottom: 2px solid #f58706;
	padding: 0 0 10px 0;
	margin: 0 0 -2px 0;
	font-weight: 400;
	font-size: 20px;
	}
.ltTitleMain{
	font-size: 16px;
	font-weight: 350;
	}
.label {
	color:#000;
	font-size:13px;
	}
.goOder{
	background-color: #f58706 !important;
	float:right;
	font-size: 22px !important;
	padding:5px 20px !important;
	}
.controlBtn{
	background-color: #000 ;
	color:#fff;
	float:right;
	font-size: 22px ;
	padding:5px 20px;
	margin:0px 2px;
	}
.controlBtn:hover{
	background-color: #f58706 ;
	box-shadow: inset 0px 1px 0px 0px rgba(255, 255, 255, 0.5);
	background-image: -webkit-linear-gradient(top, #f58706 0%, #f5af06 100%);
	border: 1px solid #915004;
	color:#fff;
	text-shadow: 1px 1px 0px #000;
	border: 1px solid #603502;
	}
.bx_ordercart .bx_ordercart_order_pay_center span, .bx_ordercart .bx_ordercart_order_pay_center a{line-height: none!important;}
.fwb{
	color: #0088cc;
	font-size: 22px !important;
	padding-right: 5px;
	}
.flLeft{float:left;}
.warpTypeUser{display:table;}
.bx_order_make .bx_block.r1x3{width:auto}
.hide{dislay:none;}

.bx_description{display:table;}
.bx_order_make .bx_result_price{float:left;}
.left10{margin:10px 0px 0px 20px;}
#order_form_div .section {margin:10px 0px 0px 10px !important}
.has-collapse.panel-group .panel.panel-default .panel-title{
background-color:none;
	}
.has-collapse.panel-group .panel.panel-default .panel-title-norm{
		color: #333;
		background-color: #f5f5f5;
		border-color: #ddd;
		margin-top: 0;
		margin-bottom: 0;
		font-size: 16px;
		padding: 10px 15px;
		cursor: pointer;
	}
		
.has-collapse.panel-group .panel.panel-default .panel-title-active{
		background-color:#f58706 ;
		color:#fff ;
		border-color: #ddd;
		margin-top: 0;
		margin-bottom: 0;
		font-size: 16px;
		padding: 10px 15px;
		cursor: pointer;
	}
</style>

<div id="content"> 
  <div id="inner-content" class="container">
    <div class="row"> 
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-push-8 col-md-push-8"> 
        <div class="heading"> 
          <h4>Мой кабинет</h4>
         </div>
       
        <ul class="nav nav-pills nav-stacked vertical-left-menu"> 			
          <li><a href="/personal/profile/" ><i class="fa fa-angle-right"></i> Мой профиль</a></li>
         	 			
          <li><a ><i class="fa fa-angle-right"></i> Подписки</a></li>
         	 			
          <li><a href="/personal/update-files/" ><i class="fa fa-angle-right"></i> Обновления</a></li>
         	 			
          <li><a href="/personal/keys" ><i class="fa fa-angle-right"></i> Купленные ключи</a></li>
         	 			
          <li><a href="/personal/order" ><i class="fa fa-angle-right"></i> Заказы</a></li>
         	 			
          <li class="active"><a href="/personal/cart" ><i class="fa fa-angle-right"></i> Корзина</a></li>
         	 </ul>
       &nbsp;</div>
     
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-pull-4 col-md-pull-4"> 
     	   
<a name="order_form"></a>

<div id="order_form_div" class="order-checkout">
	<div class="titleMain">Ваш заказ</div>

<div class="bx_order_make">
				<script type="text/javascript">
			var BXFormPosting = false;
			function submitForm(val)
			{
				if (BXFormPosting === true)
					return true;

				BXFormPosting = true;
				if(val != 'Y')
					BX('confirmorder').value = 'N';

				var orderForm = BX('ORDER_FORM');
				BX.showWait();

				BX.ajax.submit(orderForm, ajaxResult);

				return true;
			}

			function ajaxResult(res)
			{
				try
				{
					var json = JSON.parse(res);
					BX.closeWait();

					if (json.error)
					{
						BXFormPosting = false;
						return;
					}
					else if (json.redirect)
					{
						window.top.location.href = json.redirect;
					}
				}
				catch (e)
				{
					BXFormPosting = false;
					BX('order_form_content').innerHTML = res;
				}

				BX.closeWait();
			}

			function SetContact(profileId)
			{
				BX("profile_change").value = "Y";
				submitForm();
			}
			</script>
			<form action="/personal/order/make/index.php" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
				<input type="hidden" name="sessid" id="sessid" value="24f3861dc9466523690c3116b7d2cc7e">
                <div id="order_form_content">
                <div class="panel-group has-collapse " id="faq-list" style="height: auto;">				
                
					<div class="section panel panel-default" id="panelTypeUser">
                    	<div class="panel-heading" >
                          <div data-toggle="collapse" data-parent="#faq-list" href="#collapseTypeUser" class="panel-title-norm">
                            <i class="fa fa-chevron-right"></i>Тип плательщика
                          </div>
                        </div>
                        <div id="collapseTypeUser" class="panel-collapse collapse">
                            <div class="panel-body">
                            	<div class="label left">
                                    <input type="radio" id="PERSON_TYPE_1" name="PERSON_TYPE" value="1" checked="checked" onclick="submitForm()">Физическое лицо
                                </div>
                                <div class="label left">
                                    <input type="radio" id="PERSON_TYPE_3" name="PERSON_TYPE" value="3" onclick="submitForm()">Физическое лицо предприниматель
                                </div>
                                <div class="label left">
                                    <input type="radio" id="PERSON_TYPE_2" name="PERSON_TYPE" value="2" onclick="submitForm()">Юридическое лицо
                                </div>
                         		<div class="clear"></div>
                            </div>
                         </div>
                        <input type="hidden" name="PERSON_TYPE_OLD" value="1">
					</div>
					<div class="section panel panel-default" id="panelProfil">
						<div class="panel-heading" >
                          <div data-toggle="collapse" data-parent="#faq-list" href="#collapseProfil" class="panel-title-norm">
                            <i class="fa fa-chevron-right"></i>Информация для оплаты и доставки заказа
                          </div>
                        </div>
						 <div id="collapseProfil" class="panel-collapse collapse">
                            <div class="panel-body">
                           		 <div class="bx_block r1x3">Выберите профиль</div>
                           		 <div style="clear: both;"></div>
                            	<div class="bx_block r3x1">
                                      <select name="PROFILE_ID" id="ID_PROFILE_ID" onchange="SetContact(this.value)" class="form-control">
                                              <option value="0">Новый профиль</option>
                                              <option value="1" selected="">Игорь Щербина</option>
                                      </select>
                                      <div style="clear: both;"></div><br />
                                      <div id="sale_order_props" style="display: block; overflow: hidden; opacity: 1;">
                                          <div>
                                              <div class="bx_block r1x3 pt8 hide">
                                                  Страна<span class="bx_sof_req">*</span>
                                              </div>
                                              <div class="bx_block r3x1">								
                                                  <div id="LOCATION_ORDER_PROP_4"></div>
                                                  <div id="wait_container_ORDER_PROP_4" style="display: none;"></div>
                                                  <script>
                                                      function newlocation(orderPropId)
                                                      {
                                                          var select = document.getElementById("LOCATION_ORDER_PROP_" + orderPropId);
                                                  
                                                          arSelect = select.getElementsByTagName("select");
                                                          if (arSelect.length > 0)
                                                          {
                                                              for (var i in arSelect)
                                                              {
                                                                  var elem = arSelect[i];
                                                                  elem.disabled = false;
                                                              }
                                                          }
                                                      }
                                                  </script>
                                              </div>
                                              <div style="clear: both;"></div>
                                      </div>
                           		<div>
                                <div class="bx_block r3x1">
                                    <input placeholder="Ф.И.О." type="text" maxlength="250" size="40" value="Игорь Щербина" name="ORDER_PROP_1" id="ORDER_PROP_1">
                                </div>
                                <div style="clear: both;"></div><br>
                                
                                <div class="bx_block r3x1">
                                    <input placeholder="E-Mail" type="text" maxlength="250" size="0" value="verycooleagle@gmail.com" name="ORDER_PROP_2" id="ORDER_PROP_2">
                                </div>
                                <div style="clear: both;"></div><br>
                                
                                <div class="bx_block r3x1">
                                    <input placeholder="Телефон" type="text" maxlength="250" size="0" value="3-44-20" name="ORDER_PROP_3" id="ORDER_PROP_3">
                                </div>
							</div>
                            </div>
						</div>
					</div>
					</div>
				</div>
					<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="">
					<div class="section panel panel-default" id="panelDelivery">
                          <div class="panel-heading" >
                            <div data-toggle="collapse" data-parent="#faq-list" href="#collapseDelivery" class="panel-title-norm">
                              <i class="fa fa-chevron-right"></i>Служба доставки
                            </div>
                          </div>
                          <div id="collapseDelivery" class="panel-collapse collapse">
                             <div class="panel-body">
                                  <div class="bx_block w100 vertical">
                                      <div class="bx_element">
                                          <input type="radio" id="ID_DELIVERY_ID_1" name="DELIVERY_ID" value="1" checked="" onclick="submitForm();" class="hide">
                                          <label for="ID_DELIVERY_ID_1" onclick="BX('ID_DELIVERY_ID_1').checked=true;submitForm();">
                                              <div class="bx_logotype">
                                                  <span style="background-image:url(/bitrix/templates/.default/components/bitrix/sale.order.ajax/deliveryLiberty/images/logo-default-d.gif);"></span>
                                              </div>
                                              <div class="bx_description">
                                                  <div class="name"><strong>Самовызов</strong></div>
                                                  <p>Вы можете самостоятельно вывести товар<br></p>
                                                   <span class="bx_result_price">Стоимость: <b>0.00 грн.</b><br></span>
                                              </div>
                                          </label>
                                      </div>
                                  </div>
                                  <div class="bx_block w100 vertical">
                                      <div class="bx_element">
                                          <input type="radio" id="ID_DELIVERY_ID_2" name="DELIVERY_ID" value="2" onclick="submitForm();" class="hide">
                                          <label for="ID_DELIVERY_ID_2" onclick="BX('ID_DELIVERY_ID_2').checked=true;submitForm();">
                                              <div class="bx_logotype">
                                                  <span style="background-image:url(/upload/resize_cache/sale/delivery/logotip/103/95_55_1/1034d8edb09b5212b908cbedaa6ad580.jpg);"></span>
                                              </div>
                                              <div class="bx_description">
                                                  <div class="name"><strong>Доставка курьером</strong></div>
                                                  <p>Курьерская служба вам доставить.<br></p>
                                                  <span class="bx_result_price">Стоимость: <b>200.00 грн.</b><br></span>
                                              </div>
                                          </label>
                                          <div class="clear"></div>
                                      </div>
                                  </div>
                                  <div class="bx_block w100 vertical">
                                      <div class="bx_element">
                                          <input type="radio" id="ID_DELIVERY_ID_2" name="DELIVERY_ID" value="2" onclick="submitForm();" class="hide">
                                          <label for="ID_DELIVERY_ID_2" onclick="BX('ID_DELIVERY_ID_2').checked=true;submitForm();">
                                              <div class="bx_logotype">
                                                  <span style="background-image:url(/upload/sale/delivery/logotip/15a/15a76db9861496a597df5e1c494cc603.png);"></span>
                                              </div>
                                              <div class="bx_description">
                                                  <div class="name"><strong onclick="BX('ID_DELIVERY_ua_post_ware').checked=true;submitForm();">Новая почта (Доставка до отделения почты)</strong></div>
                                                  <p>Заказ будет доставлен до ближайшего отделения почты	<br></p>
                                                  <span class="bx_result_price">Стоимость: <b>16.00 грн.</b><br></span>
                                              </div>
                                          </label>
                                          <div class="clear"></div>
                                      </div>
                                  </div>
                          </div></div><? // end panel?>
              		</div>
                    <div class="section panel panel-default" id="panelPAY">
                        <script type="text/javascript">
                            function changePaySystem(param)
                            {
                                if (BX("account_only") && BX("account_only").value == 'Y') // PAY_CURRENT_ACCOUNT checkbox should act as radio
                                {
                                    if (param == 'account')
                                    {
                                        if (BX("PAY_CURRENT_ACCOUNT"))
                                        {
                                            BX("PAY_CURRENT_ACCOUNT").checked = true;
                                            BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
                                            BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                    
                                            // deselect all other
                                            var el = document.getElementsByName("PAY_SYSTEM_ID");
                                            for(var i=0; i<el.length; i++)
                                                el[i].checked = false;
                                        }
                                    }
                                    else
                                    {
                                        BX("PAY_CURRENT_ACCOUNT").checked = false;
                                        BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
                                        BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                                    }
                                }
                                else if (BX("account_only") && BX("account_only").value == 'N')
                                {
                                    if (param == 'account')
                                    {
                                        if (BX("PAY_CURRENT_ACCOUNT"))
                                        {
                                            BX("PAY_CURRENT_ACCOUNT").checked = !BX("PAY_CURRENT_ACCOUNT").checked;
                    
                                            if (BX("PAY_CURRENT_ACCOUNT").checked)
                                            {
                                                BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
                                                BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                                            }
                                            else
                                            {
                                                BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
                                                BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                                            }
                                        }
                                    }
                                }
                    
                                submitForm();
                            }
                        </script>
                            <div class="panel-heading" >
                              <div data-toggle="collapse" data-parent="#faq-list" href="#collapsePAY" class="panel-title-norm">
                                <i class="fa fa-chevron-right"></i>Платежная система
                              </div>
                            </div>
                             <div id="collapsePAY" class="panel-collapse collapse">
	                             <div class="panel-body">
                                    <div class="bx_block w100 vertical">
                                        <div class="bx_element">
                                            <input type="radio" id="ID_PAY_SYSTEM_ID_3" name="PAY_SYSTEM_ID" value="3" onclick="changePaySystem();" class="hide">
                                            <label for="ID_PAY_SYSTEM_ID_3" onclick="BX('ID_PAY_SYSTEM_ID_3').checked=true;changePaySystem();">
                                                <div class="bx_logotype ">
                                                    <span style="background-image:url(/upload/sale/paysystem/logotip/bd9/bd9005fdeec5d3e2239fe2c4096c7afc.gif);"></span>
                                                </div>
                                                <div class="bx_description ">
                                                    <strong>Ощадбанк</strong>
                                                    <p>Вы можете оплатить заказ в любом отделении Ощадбанка. За услугу по переводу денег с Вас возьмут от 3 до 7% от стоимости заказа, в зависимости от региона. Перечисление денег займет порядка 10 дней.</p>
                                                </div>
                                            </label>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <div class="bx_block w100 vertical">
                                        <div class="bx_element">
                                            <input type="radio" id="ID_PAY_SYSTEM_ID_3" name="PAY_SYSTEM_ID" value="3" onclick="changePaySystem();" class="hide">
                                            <label for="ID_PAY_SYSTEM_ID_3" onclick="BX('ID_PAY_SYSTEM_ID_3').checked=true;changePaySystem();">
                                                <div class="bx_logotype">
                                                    <span style="background-image:url(/upload/sale/paysystem/logotip/bd9/bd9005fdeec5d3e2239fe2c4096c7afc.gif);"></span>
                                                </div>
                                                <div class="bx_description">
                                                   <strong>Банковский перевод</strong>
                                                    <p>Банковский перевод</p>
                                                </div>
                                            </label>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="section panel panel-default" id="panelFinish">  
                    <div class="panel-heading" >
                      <div data-toggle="collapse" data-parent="#faq-list" href="#collapseFinish" class="panel-title-norm">
                        <i class="fa fa-chevron-right"></i>Товары в заказе, итоговая сумма, коментарий
                      </div>
                    </div>
                    <div id="collapseFinish" class="panel-collapse collapse">
                        <div class="panel-body">
                                         <div class="bx_ordercart">
                                              <div class="bx_ordercart_order_table_container">
                                                  <table border="0" cellpadding="1" cellspacing="1" class="table table-responsive table-striped table-hover table-bordered" style="border-collapse: collapse;">
                                                      <thead>
                                                          <tr>
                                                              <th class="item" colspan="2">Товары</td>
                                                              <th class="custom">Скидка</th>
                                                              <th class="custom">Цена</th>
                                                              <th class="custom">Количество</th>
                                                              <th class="custom">Сумма</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                          <tr>
                                                              <td class="itemphoto">
                                                                      <div class="bx_ordercart_photo_container">
                                                                          <div class="bx_ordercart_photo" style="background-image:url('/bitrix/templates/.default/components/bitrix/sale.order.ajax/deliveryLiberty/images/no_photo.png')"></div>
                                                                      </div>
                                                              </td>
                                                              <td class="item" style="width:70%">
                                                                          <span class="bx_ordercart_itemtitle">
                                                                              Информационно-технологическое сопровождение 1С:Предприятия (переход) (ТЕХНО - ПРОФ, 1 месяц)																	
                                                                          </span>
                                                                          <div class="bx_ordercart_itemart"></div>
                                                              </td>
                                                              <td class="custom right">
                                                                  <span>Скидка:</span>
                                                              </td>
                                                              <td class="price right">
                                                                  <div class="current_price">130.00 грн.</div>
                                                                  <div class="old_price right"></div>
                                                              </td>
                                                              <td class="custom right">
                                                                  <span>Количество:</span>
                                                                  1&nbsp;шт
                                                              </td>
                                                              <td class="custom right">
                                                                  <span>Сумма:</span>
                                                                  130.00 грн.							
                                                               </td>
                                                          </tr>
                                                          <tr>
                                                              <td class="itemphoto">
                                                                  <div class="bx_ordercart_photo_container">
                                                                      <div class="bx_ordercart_photo" style="background-image:url('/bitrix/templates/.default/components/bitrix/sale.order.ajax/deliveryLiberty/images/no_photo.png')">
                                                                      </div>
                                                                  </div>
                                                              </td>
                                                              <td class="item" style="width:70%">
                                                                  <span class="bx_ordercart_itemtitle">
                                                                      Сервис сдачи электронной отчетности 1С:Звит (Для общей системы налогообложения, 1 месяц)																	
                                                                  </span>
                                                                  <div class="bx_ordercart_itemart"></div>
                                                              </td>
                                                              <td class="custom right">
                                                                  <span>Скидка:</span>
                                                              </td>
                                                              <td class="price right">
                                                                  <div class="current_price">72.00 грн.</div>
                                                                  <div class="old_price right"></div>
                                                              </td>
                                                              <td class="custom right">
                                                                  <span>Количество:</span>
                                                                  1&nbsp;шт							
                                                               </td>
                                                              <td class="custom right">
                                                                  <span>Сумма:</span>
                                                                  72.00 грн.							
                                                               </td>
                                                          </tr>
                                                      </tbody>
                                                  </table>
                                              </div>
                                          
                                              <div class="bx_ordercart_order_pay">
                                                  <div class="bx_ordercart_order_pay_right">
                                                      <table class="bx_ordercart_order_sum">
                                                          <tbody>
                                                                                      <tr>
                                                                      <td class="custom_t1 fwb" colspan="6">Итого:</td>
                                                                      <td class="custom_t2 fwb">202.00 грн.</td>
                                                                  </tr>
                                                                              </tbody>
                                                      </table>
                                                      <div style="clear:both;"></div>
                                          
                                                  </div>
                                                  <div style="clear:both;"></div>
                                                  
                                                  <div class="bx_section">
                                                      <a id="SComm">Сделать комментарии к заказу</a>
                                                      <div class="bx_block w100" id="BlockComm">
                                                          <textarea placeholder="Комментарии к заказу" name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION" style="max-width:100%;min-height:120px"></textarea></div>
                                                          <input type="hidden" name="" value="">
                                                          <div style="clear: both;"></div><br>
                                                  </div>
                                              </div>
                                          </div>
                                                    </div>
                                        <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
                                        <input type="hidden" name="profile_change" id="profile_change" value="N">
                                        <input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
                                        <input type="hidden" name="json" value="Y">
                                        <? // delete <div class="bx_ordercart_order_pay_center"> ?>
                                            
                                              
                                            <a href="javascript:void();" 
                                                onclick="submitForm('Y'); return false;" 
                                                id="ORDER_CONFIRM_BUTTON" 
                                                class="goOder btn  btn-primary btn-sm">Оформить заказ</a>
                                         <? // </div> ?>
                            </div>
                  		</div>     
                  </div><? // end last panel?>
                </div>   <? //end panel-group has-collapse ?>
				</form>
                
                <div style="clear:both;margin-top:10px;"></div>
                <a href="javascript:void();" 
                    id="nxt" 
                    class="controlBtn btn  btn-sm">Далее > </a>
                <a href="javascript:void();" 
                    id="prv" 
                    class="controlBtn btn btn-sm">< Назад</a>
                
					</div>
</div>
      </div>
<!-- /.col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-pull-4 col-md-pull-4 -->
    </div>
<!-- /.row -->
   </div>
<!-- /.container -->
<script type="text/javascript">
			$(function(){
					var panels=['TypeUser','Profil','Delivery','PAY','Finish'],
						getPanelElement=function(){
								var panel=$('#panel'+panels[indexActive]),
									title=panel.children('.panel-heading').children(),
									idPanel=title.attr('href');
								return {
										'title':title,
										'desc':$(idPanel)
									};
							},
						active={'background-color':'#f58706','color':'#fff'},
						norm={'background-color':'#f5f5f5','color':'#333'},
						be={'background-color':'#000','color':'#fff'},
						openPanel=function(){
								var obj=getPanelElement();
								obj.title.css(active);
								obj.title.children('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
								obj.desc.slideDown( "slow" );
							}
						closePanel=function(css){
								var obj=getPanelElement();
								obj.title.css(css);
								obj.title.children('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
								obj.desc.slideUp( "slow" );
							},
						clickNext=function(){
								if(!indexActive)$('#prv').show();
								if(indexActive!=4){
										closePanel(be);
										++indexActive; 
									}
								if(indexActive==4)$('#nxt').hide();
								openPanel();
							}
						,clickPrev=function(){
								if(indexActive==4)$('#nxt').show();
								if(indexActive!=0){
										closePanel(norm);
										--indexActive; 
									}
								if(!indexActive)$('#prv').hide();
								openPanel();
							};
					$('#BlockComm').hide();
					$('#SComm').click(function(){
							$('#BlockComm').slideToggle( "slow" );
						});
					$('.panel-collapse').each(function(){
							$(this).hide();
						});
					indexActive=0;
					openPanel(panels[0]);	
					$('#prv').click(clickPrev).hide();
					$('#nxt').click(clickNext);
					/*$('.panel').each(function(){
							var head=$(this);
							head.click(function(){
									var title=head.children('.panel-heading').children('.panel-title'),
										idPanel=title.attr('href');
									$(idPanel).slideToggle( "slow" );
								});
							
						});*/
				});
		</script>
 </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>