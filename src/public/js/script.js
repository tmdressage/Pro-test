$(function () {
    $(".header__menu--button").on("click", function () {
        $(
            ".menu, .header__menu--button, .header__menu--button-line,.review-read-button, .favorite-button, .tooltip, .detail__reservation, .change__reservation, .review__reservation,.review-read__content, .reservation-content, .owner__content, .reservation-status__content, .rating__form,.rating-all__content"
        ).toggleClass("open");
    });
});

window.addEventListener("DOMContentLoaded", function () {
    $(function () {
        let favorite = $(".favorite-button");
        let favoriteShopId;

        favorite.on("click", function () {
            let $this = $(this);
            favoriteShopId = $this.data("shop-id");
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: `/favorite/:${favoriteShopId}`,
                type: "POST",
                data: {
                    shop_id: favoriteShopId,
                },
            })
                .done(function () {
                    $this.toggleClass("notActive");
                    window.location.href = "/mypage";
                })

                .fail(function () {
                    console.log("fail");
                });
        });
    });
});

$(function () {
    var $input_time = $("#input-time");
    var $output_time = $("#output-time");
    $input_time.on("input", function () {
        var value = $input_time.val();
        $output_time.text(value);
    });
});

$(function () {
    var $input_date = $("#input-date");
    var $output_date = $("#output-date");
    $input_date.on("input", function () {
        var value = $input_date.val();
        $output_date.text(value);
    });
});

$(function () {
    var $input_number = $("#input-number");
    var $output_number = $("#output-number");
    $input_number.on("input", function () {
        var value = $input_number.val();
        $output_number.text(value + "人");
    });
});

$(function () {
    $(".tooltip").hide();
    $(".cancel").hover(
        function () {
            $(this).children(".tooltip").fadeIn("fast");
        },
        function () {
            $(this).children(".tooltip").fadeOut("fast");
        }
    );
});

$(function () {
    $(".tooltip").hide();
    $(".change").hover(
        function () {
            $(this).children(".tooltip").fadeIn("fast");
        },
        function () {
            $(this).children(".tooltip").fadeOut("fast");
        }
    );
});

$(function () {
    $(".tooltip").hide();
    $(".review").hover(
        function () {
            $(this).children(".tooltip").fadeIn("fast");
        },
        function () {
            $(this).children(".tooltip").fadeOut("fast");
        }
    );
});

$(function () {
    $(".tooltip").hide();
    $(".favorite").hover(
        function () {
            $(this).children(".tooltip").fadeIn("fast");
        },
        function () {
            $(this).children(".tooltip").fadeOut("fast");
        }
    );
});

$(function () {
    $(".tooltip").hide();
    $(".review-read").hover(
        function () {
            $(this).children(".tooltip").fadeIn("fast");
        },
        function () {
            $(this).children(".tooltip").fadeOut("fast");
        }
    );
});

$(function () {
    $('input[name="review"]').on("change", function () {
        var result = $(this).val();
        console.log(result);
    });
});

$(function () {
    $(".comment").on("click", function () {
        var result = $(this).val();
        console.log(result);
    });
});

$(function () {
    $(".introduction").on("click", function () {
        var result = $(this).val();
        console.log(result);
    });
});

$(function(){
  $('#count').keyup(function(){
    var count = $(this).val().length;
    $('.show-count').text(count);
  });
});

$(document).on("change", ".image-wrapper", function () {
    let elem = this; 
    let fileReader = new FileReader(); 
    fileReader.readAsDataURL(elem.files[0]); 
    fileReader.onload = function () {
        let imgTag = `<img src='${fileReader.result}'>`; 
        $(elem).nextAll(".preview").html(imgTag); 
    };
});

$(function() {
   var count = 13;
 $('.column-space').each(function() {
     var thisText = $(this).text();
      var textLength = thisText.length;
       if (textLength > count) {
          var showText = thisText.substring(0, count);
          var insertText = showText += '…';
          $(this).html(insertText);
      };
  });
});



