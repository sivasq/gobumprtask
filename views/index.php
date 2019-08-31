<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>
<body>

<!--Carousel-->
<section>
    <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/banner.jpg"
                     class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
</section>

<!--Search Box-->
<section class="search-sec">
    <div class="container">
        <form action="<?php echo "http://" . $_SERVER['SERVER_NAME'] . '/task'; ?>/controller/services/read.php"
              id="search_services" method="post" novalidate="novalidate">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <select class="form-control search-slt" id="city" name="city" required="required">
                                <option value="" selected disabled>Select City</option>
                                <!-- cities list -->
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <select class="form-control search-slt" id="vType" name="vType" required="required">
                                <option value="" selected disabled>Select Vehicle Type</option>
                                <!-- Vehicle types list -->
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <div style="width: 100%; margin: auto; position: relative; flex-grow: 1;">
                                <input type="text" class="form-control search-slt" autocomplete="off"
                                       placeholder="Service Name" id="service" name="service">
                                <div id="searchLists" style="display: none; left: 0; right: 0; z-index: 999; position:
                                absolute; max-height: 250px; overflow-y: scroll; margin-top: 2px; background: #fff;
                                margin-bottom: 24px;
                                box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.2), 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 3px 1px -2px rgba(0, 0, 0, 0.12);">
                                    <ul id="searchServiceLists" style="margin: 0; padding: 0; list-style-type: none;">
                                        <!-- search service list -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <button type="submit" class="btn btn-danger wrn-btn">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!--Search Results-->
<div class="container">
    <div class="row" id="searchList">
        <!--  search lists -->
    </div>
</div>

<script>
	var baseUrl = "<?php echo "http://" . $_SERVER['SERVER_NAME'] . '/task'; ?>";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function () {
		// Search Service list while type on service Start
		$('#service').on('keyup', function () {
			// var city = $('#city').val();
			// var vType = $('#vType').val();
			//
			// if (city == '' || vType == '') {
			// 	alert("Please Select City and Vehicle Type!");
			// 	return false;
			// }

			var formData = new FormData($('#search_services')[0]);
			var searchServiceList = '';
			$.ajax({
				url: baseUrl + "/controller/services/read.php",
				method: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				dataType: 'JSON',
				error: function (request, error) {
					console.log(arguments);
					alert(" Can't do because: " + error);
				},
				success: function (response) {
					if (response.success) {
						if (response.data.length > 0) {
							$('#searchLists').css({'display': 'block'});
							$.each(response.data, function (i, item) {
								searchServiceList += '<li style="font-size: 13px; padding: 8px 5px;">' +
									'<div class="service_item" style="cursor: pointer; font-weight:600;">' +
									item['service_name'] + '</div></li>';
							});
							$('#searchLists #searchServiceLists').html(searchServiceList);
						} else {
							$('#searchLists').css({'display': 'none'});
							searchServiceList = '';
							$('#searchLists #searchServiceLists').html(searchServiceList);
						}
					} else {
						alert("Please Select City & Vehicle Type")
					}
				}
			});
		});
		// Search Service list while type on service End


		// Trigger search form submit while on select service name Start
		$('#searchServiceLists').on("click", ".service_item", function () {
			$('#service').val($(this).text());
			$('#searchLists').css({'display': 'none'});
			$("#search_services").submit();
		});
		// Trigger search form submit while on select service name End


		// close service search sug. box Start
		document.onclick = function (e) {
			var target = e.target;
			var parent = target.parentElement ? target.parentElement : target.parentElement.parentElement;
			if ((parent.id == 'searchServiceLists') || (parent.id == 'searchLists') || target.id == 'service') {
				$('#searchLists').css({'display': 'block'});
			} else {
				$('#searchLists').css({'display': 'none'});
			}
		};
		// close service search sug. box End


		// In change City
		$("#city").change(function () {
			$("#service").val('');
		});

		// In change Vehicle Type
		$("#vType").change(function () {
			$("#service").val('');
		});

		//Get All Vehicle Types
		getAllVehicleTypes();

		//Get All Cities
		getAllCities();

		// search form submit Start
		$(document).on("submit", "#search_services", function (e) {
			e.preventDefault();
			var city = $('#city').val();
			var vType = $('#vType').val();

			if (city == '' || vType == '') {
				alert("Please Select City and Vehicle Type!");
				return false;
			}
			var data = '';
			var url = $(this).attr('action');
			$.ajax({
				url: url,
				method: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				dataType: 'JSON',
				error: function (request, error) {
					console.log(arguments);
					alert(" Can't do because: " + error);
				},
				success: function (response) {
					if (response.success) {
						if (response.data.length > 0) {
							data = '';
							$.each(response.data, function (i, item) {
								var myPreviousBookings = getCookie('bookedServices');
								var myPreviousBookingsArr = [];
								if (myPreviousBookings !== undefined) {
									myPreviousBookingsArr = JSON.parse(getCookie('bookedServices'));
								}

								data += '<div class="col-12 col-sm-12 col-md-6 pl-md-2 pr-md-2 pt-2 pb-2" href="#" style="cursor: pointer;">\n' +
									'            <div class="card border p-2">\n' +
									'                <div class="row">\n' +
									'                    <div class="col-4 col-sm-4">\n' +
									'                        <div style="width: 100%; position: relative; min-height: 107px; float: left;">\n' +
									'                            <div style="width:96%; border-radius: 4px; position: absolute; bottom: 2px; top: 0; right: 0; left: 0; background-size: cover; background-position: center center; border-radius: 4px; background-image:\n' +
									'                    url(assets/images/img' +
									'.png?fit=around%7C200%3A200&crop=200%3A200%3B%2A%2C%2A;);\n' +
									'                    background-repeat: no-repeat; background-position: center; display: block;"></div>\n' +
									'                        </div>\n' +
									'                    </div>\n' +
									'                    <div class="col-8 col-sm-8 pl-0">\n' +
									'                        <a href="#">' + item['service_name'] + '</a>\n' +
									'                        <div class="description">\n' +
									'                            <div class="clear"></div>\n' +
									'                               <div class="grey-text nowrap   ln24 ">Cost ₹&nbsp;' +
									item['price'] + '</div>\n' +
									'                        </div>\n' +
									'                        <div class="clear"></div>\n' +
									'                    </div>\n' +
									'                </div>\n' +
									'                <div class="row">\n' +
									'                    <div class="col-12" style="text-align-last: right; margin-top: 10px;' +
									'">';
								if (!myPreviousBookingsArr.includes(parseInt(item['id']))) {
									data += '                       <div class="d-flex ' +
										'justify-content-end"\n' +
										'                             style="border-top: 1px solid #d8dfe4; padding: 8px 8px 0;">\n' +
										'                            <span>\n' +
										'                                <a style="font-weight: 600;" onclick="bookservice' +
										'(' + item['id'] + ');" href="#">Book Service</a>\n' +
										'                            </span>\n' +
										'                        </div>';
								} else {
									data += '                       <div class="d-flex ' +
										'justify-content-between"\n' +
										'                             style="border-top: 1px solid #d8dfe4; padding: 8px 8px 0;">\n' +
										'                            <span style="font-size: 14px; font-weight: 600; color: ' +
										'#f54600;"><i>Previously You Have\n' +
										'                                    Used This\n' +
										'                                    Service</i></span>\n' +
										'                            <span>\n' +
										'                                <a style="font-weight: 600;" onclick="bookservice' +
										'(' + item['id'] + ');" href="#">Book Service</a>\n' +
										'                            </span>\n' +
										'                        </div>';
								}
								data += '                   </div>' +
									'                </div>\n' +
									'            </div>\n' +
									'        </div>';
							});
							$('#searchList').html(data);
						}
					} else {
						alert("Please Select City & Vehicle Type")
					}
				}
			});
		});
		// search form submit End
	});

	// Booking service
	bookservice = function (serviceId) {
		// Get Cookie if available
		var myPreviousBookings = getCookie('bookedServices');
		var myPreviousBookingsArr = [];
		//Process Cookies
		if (myPreviousBookings !== undefined) {
			myPreviousBookingsArr = JSON.parse(myPreviousBookings);
			if (!myPreviousBookingsArr.includes(serviceId)) {
				myPreviousBookingsArr.push(serviceId);
			}
		} else {
			myPreviousBookingsArr.push(serviceId);
		}
		//Set Cookie
		document.cookie = "bookedServices = " + JSON.stringify(myPreviousBookingsArr);

		//Booking Alert Message
		alert("service booked");
	}

	// Get Cookie and Process
	getCookie = function (name) {
		let cookie = {};
		document.cookie.split(';').forEach(function (el) {
			let [k, v] = el.split('=');
			cookie[k.trim()] = v;
		})
		return cookie[name];
	}

	getAllVehicleTypes = function () {
		$.ajax({
			url: baseUrl + "/controller/vehicle_types/read.php",
			method: 'GET',
			processData: false,
			contentType: false,
			// dataType: 'JSON',
			error: function (request, error) {
				console.log(arguments);
				alert(" Can't do because: " + error);
			},
			success: function (response) {
				$('#vType').append(response);
			}
		});
	}

	getAllCities = function () {
		$.ajax({
			url: baseUrl + "/controller/cities/read.php",
			method: 'GET',
			processData: false,
			contentType: false,
			// dataType: 'JSON',
			error: function (request, error) {
				console.log(arguments);
				alert(" Can't do because: " + error);
			},
			success: function (response) {
				$('#city').append(response);
			}
		});
	}
</script>
</body>
</html>