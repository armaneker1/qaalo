$(document).ready(function(){
    $('.default').each(onEachDefault);
    
    $itemIndis = 0;
    $('.itemInput').keypress(onItemInputKeyPress);

    $('#searchBox').autocomplete({
        serviceUrl: '/back.topic/search',
        type:'post',
        onSelect: function (suggestion) {
            window.location.replace("/l/"+ suggestion.data);
        }
    });
    
    $('.profileLink').mouseup(function (){
        $('#profileMenu').removeClass("transparan");
        $('#profileMenu').addClass("opaque");
    });
    
    $(document).mousedown(function () {
        $('#profileMenu').removeClass("opaque");
        $('#profileMenu').addClass("transparan");
    });
    
});

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
 
$itemIndis = 0;
function onItemInputKeyPress(e) {
    if(e.which == 13) {
        e.preventDefault();
        console.log($('#item'+ ($itemIndis+1) ));
        if ($('#item'+ ($itemIndis+1) ).length == 0) {
            $itemIndis = $itemIndis +1;
            $('#itemInputList').append(
                $('<li>').attr('class','itemInputLI').append(
                    $('<input>').attr('maxlength','120').attr('autocomplete','off').attr('placeholder','Yes, what\'s next?').attr('class','itemInput default').attr('name','itemText[]').attr('id','item'+ $itemIndis)
                    ));
        }
            
        $('#item'+ $itemIndis).keypress(onItemInputKeyPress);
        $('#item'+ $itemIndis).each(onEachDefault);
        $('#item'+ $itemIndis).focus();
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
        console.log(data);
    });
}