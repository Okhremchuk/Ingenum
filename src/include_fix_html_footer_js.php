<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular-sanitize.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular-touch.min.js"></script>
<script src="<?=$SITE_DIR?>src/lib/angular/ui-bootstrap-tpls-0.10.0.min.js"></script>
<script src="<?=$SITE_DIR?>src/lib/angular/angular-carousel.min.js"></script>
<script src="<?=$SITE_DIR?>src/lib/angular/angular-timer.js"></script>
<script src="<?=$SITE_DIR?>src/lib/jquery/magnific-popup/jquery.magnific-popup.min.js"></script>

<script src="<?=$SITE_DIR?>src/lib/jquery/jquery.scrollTo-1.4.3.1-min.js"></script>
<script src="<?=$SITE_DIR?>src/lib/jquery/jquery.carouFredSel-6.2.1-packed.js"></script>
<script src="<?=$SITE_DIR?>src/lib/jquery/jquery.mousewheel.min.js"></script>
<script src="<?=$SITE_DIR?>src/lib/jquery/jquery.touchSwipe.min.js"></script>

<script>
'use strict';

$(function(){
	$('a[data-scroll]').on('click', function() {
		$.scrollTo($($(this).attr('href')), {
		    axis : 'y',
		    duration : 500,
		    offset: -40
		});
		return false;
	});
	
	for(var i = 0, l = arrJquery.length; i < l; i++){
		arrJquery[i]();
	}
});
function onGoogleReady() {
	function initialize() {
		for(var i = 0, l = arrMaps.length; i < l; i++){
			arrMaps[i]();
		}
	}
	google.maps.event.addDomListener(window, 'load', initialize);
}
// angular ////////////
var lpB24App = angular.module("module-lp-b24", ['ui.bootstrap', 'ngSanitize', 'angular-carousel', 'timer']);

lpB24App.directive('magnificPopup', function() {
  return {   
    restrict: 'AC',    
    link: function (scope, element, attrs) {   
	  $(element).magnificPopup({
			delegate: 'a',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			mainClass: 'mfp-img-mobile',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1]
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
			}
		});        
    }
  };  
}).controller('globalController', ['$rootScope', '$scope', function ($rootScope, $scope) {
	$scope.openModalEvent = function(modalCode, $event){
		if ($event.stopPropagation) $event.stopPropagation();
	    if ($event.preventDefault) $event.preventDefault();
	    $event.cancelBubble = true;
	    $event.returnValue = false;
	    
		$rootScope.$broadcast('onNeedOpenModal'+modalCode);
	}
}]);
for(var i = 0, l = arrControllers.length; i < l; i++){
    arrControllers[i]();
}
///////////
</script>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=true&amp;callback=onGoogleReady"></script>