mix.js("resources/js/app.js", "public/js")
  .postCss("resources/css/app.css", "public/css", [
    require("tailwindcss"),
  ]);

  mix.browserSync({
    proxy: 'zlecamy.test',
    open: false,
    port: 3000
});
