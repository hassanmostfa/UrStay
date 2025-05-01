$(document).ready(function () {
    $(".show_tax").on("click", function (e) {
        e.preventDefault();
        $(this).nextAll(".hide-content-pop-up").fadeIn()
        $(this).nextAll(".pop-up").fadeIn()
        if ($("aside").is(":visible")) {
            $("aside, .hide-content").addClass("animate__slideOutRight").fadeOut()
            $("aside, .hide-content").removeClass("animate__slideInRight")
            $(".body_wrapper").removeClass("margin_right")
        }
    })
    $(".ok").on("click", function (e) {
        e.preventDefault();
        $(this).parents('.pop-up').prevAll(".hide-content-pop-up").fadeOut()
        $(this).parents('.pop-up').fadeOut()
    })
    $('.has-drop').on("click", function () {
        if (!$(this).find(".more").is(":visible")) {
            $(this).find(".hide-menu svg").css("transform", "rotate(-90deg)")
        } else
            $(this).find(".hide-menu svg").css("transform", "rotate(0)")

        $(this).find(".more").slideToggle()
    })
    $('.progress-done').each(function () {
        $(this).css({
            "width": $(this).attr('data-done') + "%",
            "opacity": '1'
        })
    })
    $(".toggle_menu, .hide-content").on("click", function (e) {
        e.preventDefault()
        if ($("aside").is(":visible")) {
            $("aside, .hide-content").addClass("animate__slideOutRight").fadeOut()
            $("aside, .hide-content").removeClass("animate__slideInRight")
            $(".body_wrapper").removeClass("margin_right")
        }
        else {
            $("aside, .hide-content").addClass("animate__slideInRight").fadeIn()
            $("aside, .hide-content").removeClass("animate__slideOutRight")
            $(".body_wrapper").addClass("margin_right")
        }
    })
    $(".show_user_more").on("click", function (e) {
        e.preventDefault()
        if ($(".user_more ul").is(":visible")) {
            $(".user_more ul").fadeOut()
            $(".user_more ul").removeClass("animate__bounceIn")
        }
        else {
            $(".user_more ul").addClass("animate__bounceIn").fadeIn()
        }
    })
});
$(function () {

    setCheckboxSelectLabels();

    $('.toggle-next').click(function (e) {
        e.preventDefault()
        $(this).next('.checkboxes').slideToggle(400);
    });

    $('.ckkBox').change(function () {
        toggleCheckedAll(this);
        setCheckboxSelectLabels();
    });

});

function setCheckboxSelectLabels(elem) {
    var wrappers = $('.wrapper');
    $.each(wrappers, function (key, wrapper) {
        var checkboxes = $(wrapper).find('.ckkBox');
        var label = $(wrapper).find('.checkboxes').attr('id');
        var prevText = '';
        $.each(checkboxes, function (i, checkbox) {
            var button = $(wrapper).find('button');
            if ($(checkbox).is(":checked")) {
                var text = $(checkbox).next().html();
                var btnText = prevText + text;
                var numberOfChecked = $(wrapper).find('input.val:checked').length;
                if (numberOfChecked >= 4) {
                    btnText = numberOfChecked + ' ' + label + ' selected';
                }
                prevText = btnText + ', ';
                console.log(numberOfChecked);
                $(button).text(btnText);
            } else {
                var numberOfChecked = $(wrapper).find('input.val:checked').length;
                if (numberOfChecked == 0) {
                    $(button).text("اختر ----")
                }
            }
        });
    });
}

function toggleCheckedAll(checkbox) {
    var apply = $(checkbox).closest('.wrapper').find('.apply-selection');
    apply.fadeIn('slow');

    var val = $(checkbox).closest('.checkboxes').find('.val');
    var all = $(checkbox).closest('.checkboxes').find('.all');
    var ckkBox = $(checkbox).closest('.checkboxes').find('.ckkBox');

    if (!$(ckkBox).is(':checked')) {
        $(all).prop('checked', true);
        return;
    }

    if ($(checkbox).hasClass('all')) {
        $(val).prop('checked', false);
    } else {
        $(all).prop('checked', false);
    }
}
