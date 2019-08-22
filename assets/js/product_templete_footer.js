	$(document).ready(function(){
	/* second slider section */
		$("#flexiselsliderhome1 li").hover(function(){
		var ids = $(this).attr("id");
		//var firid = "#first_"+ids;
		//var secid = "#second_"+ids;
		$("first_"+ids).hide();
		$("#second_"+ids).show();
		}, function(){
		/*var ids = $(this).attr("id");
		$("#first_"+ids).css("display", "block");
		$("#second_"+ids).css("display", "none");*/
		});
	});
	$(window).load(function() {
		/* for slider 2 */    
	     $("#flexiselsliderhome1").flexisel({
	        visibleItems: 5,
	        itemsToScroll: 4,
	        animationSpeed: 200,
	        infinite: true,
	        navigationTargetSelector: null,
	        autoPlay: {
	            enable: false,
	            interval: 5000,
	            pauseOnHover: true
	        },
	        responsiveBreakpoints: { 
	            portrait: { 
	                changePoint:480,
	                visibleItems: 1,
	                itemsToScroll: 1
	            }, 
	            landscape: { 
	                changePoint:640,
	                visibleItems: 2,
	                itemsToScroll: 2
	            },
	            tablet: { 
	                changePoint:768,
	                visibleItems: 3,
	                itemsToScroll: 3
	            }
	        }
	    });
	});