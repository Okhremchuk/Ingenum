<?
$YM = isset($project['info']['ANALITIC_YM']) ? trim($project['info']['ANALITIC_YM']): '';
$GA = isset($project['info']['ANALITIC_GA']) ? trim($project['info']['ANALITIC_GA']): '';
$GASiteName = 'Landing Page ' . isset($project['info']['NAME']) ? trim($project['info']['NAME']): '';

?>
<?if(strlen($YM) > 0):?>
<!-- Yandex.Metrika counter -->
<script>
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter<?=$YM;?> = new Ya.Metrika({id:<?=$YM;?>,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/<?=$YM;?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?endif;?>
<?if(strlen($GA) > 0):?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?=$GA?>', '<?=$GASiteName?>');
  ga('send', 'pageview');
  ga('require', 'displayfeatures'); 

</script>
<?endif;?>
<script>
'use strict';

function doShLpB24Analitic(counter, strParam){
	try {
	if (counter == 'ga') {
            <?if(strlen($GA) > 0):?>
		var arParam = strParam.split('_||_', 4);
		if (!!arParam[0] && arParam[0].length > 0 && !!arParam[1] && arParam[1].length > 0) {
			arParam[2] = arParam[2] || '';
			arParam[3] = arParam[3] || 0;
			ga('send', 'event', arParam[0], arParam[1], arParam[2], parseInt(arParam[3]));
			//console.log(counter, 'send event params:', arParam);
		}else{
			console.log(counter, 'bad event params:', arParam);
		}
            <?else:?>
                console.log(counter, 'counter not set');
            <?endif;?>
		
	}
	if (counter == 'ym') {
            <?if(strlen($YM) > 0):?>
		var arParam = strParam.split('_||_', 2);
		if (!!arParam[0] && arParam[0].length > 0) {
			var yaGoalParams = {};
			if (!!arParam[1] && arParam[1].length > 0) {
				yaGoalParams.price = arParam[1];
			}
			window.yaCounter<?=$YM;?>.reachGoal(arParam[0], yaGoalParams);
			//console.log(counter, 'send event params:', arParam);
		}else{
			console.log(counter, 'bad event params:', arParam);
		}
            <?else:?>
                console.log(counter, 'counter not set');
            <?endif;?>
	}
	
	} catch(e) {
		console.log(e);
	}
}
</script>