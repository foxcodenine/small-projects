const { defineConfig } = require('@vue/cli-service');
const path = require("path");                                           // <- Added line

module.exports = defineConfig({
  transpileDependencies: true,
  outputDir: path.resolve(__dirname, "../000_my_landing_site"),         // <- Added line

  // publicPath: process.env.NODE_ENV === 'production'                  // <- Added line
  // ? '/projects/00_my_landing_site/'                                  // <- Added line
  // : '/'                                                              // <- Added line
  publicPath: process.env.NODE_ENV === 'production'                     // <- Added line
  ? '/000'                                    // <- Added line
  : '/'                                                                 // <- Added line

})


