$itemIndis = 0;

$(document).ready(function(){
    $('.default').each(onEachDefault);
    
    $('.itemInput').keypress(onItemInputKeyPress);
    
    $('[charlength]').maxlength({
        feedbackText: '{r}',
        showFeedback:"active",
        delay:1500
    });
    
    $(".categoryItem").click(function () {
        var title=$(this).attr("categoryTitle");
        var obj = $(this);
        $.ajax({
            type: "POST",
            url: "/back.category/follow",
            data: {
                categoryID : $(this).attr("categoryID")
            }
        }).done(function( data ) {
            if (data == "followed") {
                obj.removeClass("follow").addClass("unfollow");
                obj.empty();
                obj.append("-");
            } else if (data == "unfollowed") {
                if (obj.attr("permanent")=="1") {
                    obj.parent().remove();
                } else {
                    obj.removeClass("unfollow").addClass("follow");
                    obj.empty();
                    obj.append("+");
                }
            }
        });
    });
    
    
    
    $('#searchBox').autocomplete({
        serviceUrl: '/back.topic/search',
        type:'post',
        onSelect: function (suggestion) {
            window.location.replace("/l/"+ suggestion.data);
        }
    });
    
    $('.profileLink').mouseup(function (){
        $('#profileMenu').attr("style","display:block;");
        $('#profileMenu').fadeTo(50, 1);
    });
    
    $(document).mousedown(function () {
        if ($('#profileMenu').css("display") == "block") {
            $('#profileMenu').fadeTo(150, 0, function() {
                $(this).attr("style","display:none;")
            });
        }
    });
    
    $("[ajaxAction]").each(function() {
        $(this).change(function() {
            $.ajax({
                type: "POST",
                url: "/"+ $(this).attr("ajaxAction"),
                data: $(this).attr("name") +"="+ ($(this).is(':checked') ? "1" : "0")
            }).done(function( data ) {
                
                });
        });
    });
   
    
});

function showUser(userID) {
    $("#cardProfilePicture").attr("src","");
    $("#cardFullName").empty();
    $("#cardBio").empty();
    $("#cardLink").empty();
    $("#talkingAbout").hide();
    $("#latest").hide();
    $("#cardCategoryList").empty();
    $("#cardTopicList").empty();
    
    $("#userCard").lightbox_me();
    
    $.ajax({
        type: "POST",
        url: "/back.user/card",
        data: "userID=" + userID,
        dataType: 'json'
    }).done(function( data ) {
        
        $("#cardProfilePicture").attr("src", data.pic == "" ? "http://qaalo.com/inc/profile.jpg" : "http://qaalo.com/inc/img/user/"+ data.pic+".jpg");
        $("#cardFullName").append(data.name);
        $("#cardBio").append(data.bio);
        $("#cardLink").append("<a href='"+ data.url +"' target='_blank'>"+ data.url +"</a>");
        
        if (data.categories) {
            for (var key in data.categories) {
                $("#cardCategoryList").append($("<li>").append("<a href='/c/"+ key +"'>"+ data.categories[key] +"</a>"));
            }
            $("#talkingAbout").show();
        }
        
        if (data.list) {
            for (var key in data.list) {
                $("#cardTopicList").append($("<li>").append("<a href='/l/"+ key +"'>"+ data.list[key] +"</a>"));
            }
            $("#latest").show();
        }
        
        
        
        
    });
    
}

function showAll() {
    $(".hiddenItem").show("fast");
    $(".showAll").hide("fast");
}

function onEachDefault(){
    $(this).focus(function() {
        var input = $(this);
        if (input.val() == input.attr('placeholder')) {
            input.val('');
            input.removeClass('placeholder');
        }
    }).blur(function() {
        var input = $(this);
        if (input.val() == '' || input.val() == input.attr('placeholder')) {
            input.addClass('placeholder');
            input.val(input.attr('placeholder'));
        }
    }).blur();
}

function showInviteForm() {
    $("#addListers").hide();
    $(".inviteForm").show("fast");
    
}
 
$itemIndis = 0;
function onItemInputKeyPress(e) {
    if(e.which == 13) {
        e.preventDefault();
        $itemIndis = $itemIndis +1;
        $('#itemInputList').append(
            $('<li>').append(
                $("<div>").attr("class","circle").append(($itemIndis+1))
                ).append(
                $("<div>").attr("class","itemContainer").append(
                    $('<textarea>').attr('id','itemInput'+$itemIndis).attr('charlength','60').attr('autocomplete','off').attr("rows","1").attr('placeholder','Yes, what\'s next?').attr('class','itemInput default autogrow').attr('name','itemText[]')
                    )
                ).attr('id','item'+ $itemIndis)
            );
        $('#itemInput'+ $itemIndis).maxlength({
            feedbackText: '{r}',
            showFeedback:"active"
        });
        $('#itemInput'+ $itemIndis).keypress(onItemInputKeyPress);
        $('#itemInput'+ $itemIndis).each(onEachDefault);
        $('#itemInput'+ $itemIndis).focus();
        $('#itemInput'+ $itemIndis).autosize();
    }
}

function vote($id, $dir) {
    $curr = $("#"+ ($dir ==1 ? "voteUp" : "voteDown")+$id );
    $other = $("#"+ ($dir ==1 ? "voteDown" : "voteUp")+ $id );
    $voteCounter = $("#votes"+$id);
    $voteCount = parseInt($voteCounter.text());
    
    if ($curr.hasClass("voted")) {
        $curr.removeClass("voted");
        $voteCount =($voteCount-1 * $dir);
    } else {
        $curr.addClass("voted");
        
        if ($other.hasClass("voted")) {
            $voteCount =($voteCount+ $dir * 2);
        } else {
            $voteCount =($voteCount+1 * $dir);
        }
        $other.removeClass("voted");
    }
    
    $voteCounter.attr("class", $voteCount>=0 ? "voteCounterUp" : "voteCounterDown" );
    $voteCounter.text($voteCount);
    

    $.ajax({
        type: "POST",
        url: "/back.item/vote",
        data: {
            id: $id, 
            dir: $dir
        }
    }).done(function( data ) {
        
        });
}

$.fn.fadeSlideRight = function(speed,fn) {
    return $(this).animate({
        'opacity' : 1,
        'width' : '750px'
    },speed || 400, function() {
        $.isFunction(fn) && fn.call(this);
    });
}

$.fn.fadeSlideLeft = function(speed,fn) {
    return $(this).animate({
        'opacity' : 0,
        'width' : '0px'
    },speed || 400,function() {
        $.isFunction(fn) && fn.call(this);
    });
}