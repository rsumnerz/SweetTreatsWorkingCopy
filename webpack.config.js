module.exports ={
	entry: "./js/revealScroll.js",
	output: {
		path: "./js/temp/scripts",
		filename:"app.js"
	},
	module:{
		loaders:[
			{
				loader: "babel",
				query:{
					presets:["es2015"]
				},
				test: /\.js$/,
				exclude: /node_modules/

			}
		]
	}
}