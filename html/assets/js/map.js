//高德地图API
 	var map = new AMap.Map("mapContainer", {
        resizeEnable: true,
        zoom:12
    });
    var inputSearch=$("#search-input").val();
    AMap.service(["AMap.PlaceSearch"], function() {
        var placeSearch = new AMap.PlaceSearch({ //构造地点查询类
            pageSize:5,
            pageIndex:1,
            city:"021",
            map: map,
            panel: "result"
        });
        
        placeSearch.search(inputSearch);
        $("#search-map a").click(function(){
			inputSearch=$(this).parents("#search-map").find("#search-input").val();
			placeSearch.search(inputSearch);
		});
    });
	$(".servicer-list li").click(function(){
		var addhHtml=$(this).find(".ser-address").eq(0).html();
		$("#search-input").val(addhHtml);
		$("#search-map a").trigger("click");
	})
	