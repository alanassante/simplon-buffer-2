const { series, src, dest, watch } = require('gulp');
const plugins = require('gulp-load-plugins')({ camelize: true });
const autoprefixer = require('autoprefixer');
const rename = require("gulp-rename");
const cssnano = require('cssnano');
const postcssPresetEnv = require('postcss-preset-env');
const postcssObjectFitImages = require('postcss-object-fit-images');
const config = require('./gulpconfig.js');

function buildcss() {
  const postcssPlugins = [
    autoprefixer(),
    postcssObjectFitImages(),
    postcssPresetEnv({
      stage: 0,
    }),
    cssnano(),
  ];

  return src(config.src.scss)
    .pipe(plugins.sassGlobImport())
    .pipe(plugins.sass())
    .pipe(plugins.postcss(postcssPlugins))
    .pipe(rename('style.css'))
    .pipe(dest(config.dest.scss))
}


const Watch = function () {
  watch(['src/scss/**/*.scss'], buildcss);
};

exports.watch = Watch;
exports.buildcss = buildcss;
