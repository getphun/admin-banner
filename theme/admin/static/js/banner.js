$(function(){
    var el = $('#field-type');
    if(el.get(0)){
        el.change(function(){
            $('.ban-prop').addClass('hidden');
            var val = $(this).val();
            $('#ban-type-'+val).removeClass('hidden');
        });
        
        el.change();
    }
    
    var el = $('#field-name');
    if(el.get(0)){
        var titleDirty = false;
        var elTD = $('#field-ban_title');
        
        elTD.click(function(){ titleDirty = true; });
        elTD.keyup(function(){ titleDirty = true; });
        elTD.focus(function(){ titleDirty = true; });
        if(elTD.val())
            titleDirty = true;
        
        el.keyup(function(){
            if(titleDirty)
                return;
            elTD.val( $(this).val() );
        });
    }
})