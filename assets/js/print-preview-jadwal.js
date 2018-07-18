$('#basic').on("click", function () {
  $('.demod').printThis({
    base: "https://jasonday.github.io/printThis/"
  });
});


$('#advanced').on("click", function () {
  $('#kitty-one, #kitty-two, #kitty-three').printThis({
    importCSS: false,
    header: "<h1>Look at all of my kitties!</h1>",
    base: "https://jasonday.github.io/printThis/"
  });
});




window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-114774247-1');
