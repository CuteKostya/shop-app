function addComment(productId) {
    var textComment = $("#textComment").val();
    var grade = $(".stars").children(".checked").children().val();

    $.ajax({
        url: "/comment/store",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            productId: productId,
            textComment: textComment,
            grade: grade,
        },

        success: function (data) {
            console.log(data);
            location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(textStatus)
            console.log(textStatus, errorThrown);
        }
    });
}

$(function () {
    var $star = $('.stars_id');

    $star.click(function () {
        if (!$(this).hasClass('checked')) {
            $star.removeClass('checked');
            $(this).addClass('checked');
        } else {
            $(this).removeClass('checked');
            $(this).find('input').prop('checked', false);
        }
    });
});
