
Highcharts.theme = {
	yAxis: [{ // Secondary yAxis
		title: {
			text: ""
		},
		labels: {
			formatter: function() {
				return this.value + '个';
			},
			style: {
				color: '#666',
				fontFamily:'Microsoft yahei'
			}
		},
		gridLineColor:"#D2D1D1",
		allowDecimals:false
	}],
	xAxis: [{
		labels:{
			formatter: function() {
				return this.value;
			},
			style: {
				color: '#000'
			}
		},
		title: {
			text: '',
			style: {
				color: '#7eafdd'
			}
		},
		lineColor: "#8E8E8F",
		lineWidth: 2
	}],
	legend: {
		enabled:false
	},
	labels: {
		style: {
			color: '#CCC'
		}
	},
	tooltip:{
		backgroundColor:'#525253',
		borderColor:"#000",
		style:{
			color: "#fff"
		},
		headerFormat:'',
		pointFormat: '<b style="font-family:Microsoft yahei">{point.y}个</b>'
	},
	plotOptions: {
		areaspline: {
			fillColor: "rgba(190,216,240,0.7)"
		}
	},
	exporting: {
		enabled: false
	}
};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);