const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const config = {
  entry: "./assets/dev/dev.js",
  mode: "production",
  module: {
    rules: [
      {
        exclude: /(node_modules)/,
        test: /\.(js|jsx)$/i,
        loader: "babel-loader"
      },
      {
        test: /\.(css)$/i,
        use: [
            MiniCssExtractPlugin.loader,
            "css-loader",
            "postcss-loader"
        ]
    }
    ]
  },
  output: {
    filename: "main.js",
    path: path.resolve(__dirname, "assets/js")
  },
  plugins: [
    new MiniCssExtractPlugin({
        filename: "../css/style.css"
    })
]
};

module.exports = config;