const path = require("path");
var glob = require("glob");
var webpack = require("webpack");

module.exports = {
  mode: "production",
  entry: {
    main: glob.sync("./src/js/**/*.js"),
  },
  output: {
    filename: "[name].js",
    path: path.resolve(__dirname, "./"),
  },

  plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
    }),
  ],

  module: {
    rules: [
      {
        test: /\.m?js$/,
        exclude: /(node_modules)/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env"],
          },
        },
      },
      {
        test: /\.css$/,
        use: ["style-loader", "css-loader"],
      },
    ],
  },
};
